<?php

require_once 'db.php';

$id = $_GET['id'];

mysqli_query($db, "DELETE FROM `posts` WHERE `posts`.`id` = '$id'");

header("Location: ../profile.php");
///Редактировать данные

?>













?>