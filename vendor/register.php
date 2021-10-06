<?php
session_start();
require_once 'db.php';

$fullname = $_POST['fullname'];
$phome_number = $_POST['phome_number'];
$password = $_POST['password'];
$password_confirm = $_POST['password_confirm'];

if ($fullname == '' || $phone == '' || $password == '' || $password_confirm == ''){
    $_SESSION['error'] = true;
    $_SESSION['error_message'] = 'Поля для ввода данных не заполнены';
    header('Location: ../regIn.php');
}
if ($password === $password_confirm){
    $path = 'uploads/' . time() . $_FILES['avatar']['name'];
    if (!move_uploaded_file($_FILES['avatar']['tmp_name'], '../'. $path)) {
        $_SESSION['error'] = true;
        $_SESSION['error_message'] = 'Ошибка загрузки автара пользователя';
        header('Location: ../regIn.php');
    }

    $password = md5($password);

    mysqli_query($db,"INSERT INTO `users` (`fullname`, `phone`, `avatar`, `password`) VALUES ('$fullname', '$phome_number', '$path', '$password')");

    $_SESSION['success'] = true;
    $_SESSION['success_message'] = 'Регистрация прошла успешно!';
    header('Location: ../login.php');
} else {
    $_SESSION['error'] = true;
    $_SESSION['error_message'] = 'Пароли не совпадают';
    header('Location: ../regIn.php');
}
?>