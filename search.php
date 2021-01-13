<?php
include(__DIR__.'/bootstrap.php');
if(empty($_GET['search'])){
    header("Location: /index.php");
    die();
}
$page = (isset($_GET['page']) and $_GET['page'] > 0) ? $_GET['page']: 1;
$limit = (isset($_GET['limit']) and $_GET['limit'] > 0) ? $_GET['limit']: 6;

//Удаление с запроса логические операторы
$search_query = str_replace(["+","-","<",">","(",")","~","*",'"'],"",$_GET['search']);
//Добавление к запросу необходимые логические операторы
$search_query = preg_replace('/([^ ]+)/', '+$1*', $search_query);

$count_lots = count_lots_by_search_query($con,$search_query);
$count_page = ceil($count_lots/$limit);
if($page > $count_page and $count_page > 0){
    page_404($categorys);
} 
$lots = select_lots_by_search_query($con,$search_query,$limit,$page);

$http = function($page) use ($limit){
    return http_build_query(['page' => $page,'limit' => $limit,'search' => $_GET['search']]);
};
show_page("search.html.php","Результат поиска",['lots' =>$lots,
                                                'http' =>$http,
                                                'count_page' => $count_page,
                                                'page' => $page,
                                                'limit' => $limit],$categorys);