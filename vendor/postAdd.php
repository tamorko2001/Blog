<?php
session_start();
require_once 'db.php';

$title = $_POST['title'];
$description = $_POST['description'];
$author = $_POST['author'];

if ($title == '' || $description == '' || $author == ''){
    $_SESSION['error_post'] = true;
    $_SESSION['error_post_msg'] = 'Вы ничего  не ввели';
    header('Location: ../profile.php');
} else {
    $_SESSION['success_post'] = true;
    $_SESSION['success_post_msg'] = 'Пост успешно добавлен';
    mysqli_query($db,"INSERT INTO `posts` (`title`, `description`, `author`) VALUES ('$title', '$description', '$author')");
    header("Location: ../profile.php");
}

///Редактировать данные


?>