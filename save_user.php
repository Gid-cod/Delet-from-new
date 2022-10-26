<?php
require("connect.php");

$login = $_POST["Login"];
$password = $_POST["Password"];
$name  = $_POST["Name"];
$surname = $_POST["Surname"];
$patronymic = $_POST["Patronymic"];
$email = $_POST["Email"];

$result = $connect->query("INSERT INTO `contact`( `name`, `surname`, `patronymic`, `login`, `password`,`email`)
                VALUES ('$name', '$surname','$patronymic','$login','$password','$email')");
if (!$result) {
    echo $connect->error;
    return;
}
$result = $connect->query("SELECT `id`,  `name`, `surname`, `patronymic` 
                           FROM `contact` WHERE `login`='$login' AND `password`='$password'");
if (!$result) {
    echo $connect->error;
    return;
}

$account = $result->fetch_assoc();
if (!$account) {
    echo $connect->error;
    return;
}
header("Location: /index.php",TRUE,301);
?>
