<?php

$connect = new mysqli('localhost','root' ,'','db');
    if (!$connect) {
        die('Ошибка: невозможно подключиться: ' . mysqli_error());
}