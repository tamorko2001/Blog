<?php
session_start();
require_once 'db.php';

$id = $_POST['id'];
$title = $_POST['title'];
$description = $_POST['description'];
$author = $_POST['author'];

if ($title == '' || $description == '' || $author == ''){
    $_SESSION['error_post'] = true;
    $_SESSION['error_post_msg'] = 'Вы не заполнили поля для ввода!';
    header('Location: ../profile.php');
} 
    
mysqli_query($db,"UPDATE `posts` SET `title` = '$title', `description` = '$description', `author` = '$author ' WHERE `posts`.`id` = '$id'");


///Редактировать данные

?>