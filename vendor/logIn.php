<?php
session_start();
require_once 'db.php';

$fullname = $_POST['fullname'];
$password = md5($_POST['password']);

$check_user = mysqli_query($db, "SELECT * FROM `users` WHERE `fullname` = '$fullname' AND `password` = '$password'");
if (mysqli_num_rows($check_user) > 0) {
    $user = mysqli_fetch_assoc($check_user);
    $_SESSION['user'] = [
        "id" => $user['id'],
        "phone" => $user['phone'],
        "fullname" => $user['fullname'],
        "avatar" => $user['avatar'],
        "password" => $user['password'],
    ];

    header("Location: ../profile.php");

} else {
    $_SESSION['error'] = true;
    $_SESSION['error_message'] = 'Неверный логин или пароль!';
    header('Location: ../login.php');
}
?>