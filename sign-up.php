<?php
include(__DIR__.'/bootstrap.php');
$errors = [];
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $errors['email'] = check_input_email('email',$con,'users','email','sign-up');
    $errors['password'] = check_input('password',8,20);
    $errors['name'] = check_input('name',1,15);
    $errors['message'] = check_input('message',0,2000,FILTER_VALIDATE_INT);
    if(!array_filter($errors)){
        $insert_new_user = 
       "INSERT INTO users(date_create,
                          email,
                          name,
                          password,
                          сontact)  
        VALUES (?,?,?,?,?)";
        prepared_query($insert_new_user,$con,[date("Y-m-d H:i:s"),
                                              $_POST['email'],
                                              $_POST['name'],
                                              password_hash($_POST['password'],PASSWORD_DEFAULT),
                                              $_POST['message']]);
        $is_auth = 1;
        $_SESSION['user_name'] = $_POST['name'];
        header('Location: /index.php');
    }
}
if(empty($_SESSION['user_name'])){
    $_SESSION['user_name'] = 'user_name';
    $is_auth = 0;
}
show_page('sign-up.html.php','Регистрация нового аккаунта',['errors' => $errors],$categorys,$is_auth,$_SESSION['user_name']);