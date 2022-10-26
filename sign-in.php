<?php
require ('connect.php');
$login = $_POST["Login"];
$password = $_POST["Password"];


$result = $connect->query("SELECT `id`, `name`, `surname`, `patronymic`,`email`
                    FROM `contact` WHERE `login`='$login' AND `password`='$password'");
if (!$result){
    echo $connect->error;
    return;
}

if($result->num_rows == 0){
    echo "Нет данных";
    return;
}

header("location: /index.php",true,301);
?>
