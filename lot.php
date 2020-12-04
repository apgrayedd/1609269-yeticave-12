<?php
include(__DIR__.'/bootstrap.php');

$id = $_GET['id'];

$select_categories = 
"SELECT categories.* 
FROM categories";
$select_lots = 
"SELECT lots.id ,name,start_price,img_link,
MAX(COALESCE(bids.price,lots.start_price)) AS price, 
date_completion ,category,description, MAX(COALESCE(bids.price,lots.start_price)) + step_rate AS min_bid

FROM lots
LEFT JOIN bids
ON lots.id = bids.lot_id

LEFT JOIN categories
ON lots.id = categories.id

WHERE lots.id = ?
GROUP BY lots.id
ORDER BY lots.date_create DESC;";
$select_bids = 
"SELECT bids.date_create, bids.price ,users.name
FROM bids
JOIN users
ON users.id = bids.user_id
WHERE bids.lot_id = ?
ORDER BY bids.date_create DESC;";

$products_query = replace_in_query($select_lots,$con,$id);
$bids_query = replace_in_query($select_bids,$con,$id);

$products = mysqli_fetch_assoc($products_query);
$categorys = mysqli_fetch_all(mysqli_query($con,$select_categories),MYSQLI_ASSOC);
$bids =  mysqli_fetch_all($bids_query,MYSQLI_ASSOC);

if(!$products){

$title_name = 'Файл не найден';

$content = include_template("404.php",[]);
$page = include_template("layout.php",['content' => $content,
                                       'is_auth' => $is_auth,
                                       'categorys' => $categorys,
                                       'title_name' => $title_name,
                                       'user_name' => $user_name]);
print($page);
}else{

$title_name = $products['name'];

$content = include_template("lot.main.php",['products' =>$products, 'bids' => $bids]);
$page = include_template("layout.php",['content' => $content,
                                        'categorys' => $categorys,
                                       'is_auth' => $is_auth,
                                       'title_name' => $title_name,
                                       'user_name' => $user_name]);
print($page);
}