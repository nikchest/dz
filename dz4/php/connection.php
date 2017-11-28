<?php
$host = 'localhost'; // адрес сервера 
$database = 'u307379916_db'; // имя базы данных
$user = 'u307379916_nik'; // имя пользователя
$password = 'Pass11word'; // пароль
$connect_db = mysqli_connect($host, $user, $password, $database) or die("Ошибка " . mysqli_error($connect_db));
?>