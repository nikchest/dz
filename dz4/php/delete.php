<?php
header('Content-Type: text/html; charset=UTF-8');
require_once 'connection.php'; // подключаем скрипт коннекта к БД

//принимаем имя фотки на удаление
$photo = protect($_POST['file_name']);
//удаляем имя фотки
$delete_photo = 'UPDATE users_dz4 SET photo = NULL WHERE photo ="'.$photo.'"';
$result_delete_photo = mysqli_query($connect_db, $delete_photo) or die('Ошибка удаления фотки');
//удаляем фотку с серверка
$path = '../photos/' . $photo;
unlink($path);

//принимаем id юзера и название фотки и удалаем строку в базе
$user_id = protect($_POST['user_id']);
$file_name_user = protect($_POST['file_name_user']);

$delete_user = 'DELETE FROM users_dz4 WHERE id="'.$user_id.'"';
$result_delete_user = mysqli_query($connect_db, $delete_user) or die('Ошибка удаления юзера');
//удаляем фотку с серверка
$path_for_del_user = '../photos/' . $file_name_user;
unlink($path_for_del_user);

//Блок защиты
//Чистим ввод юзера, по идее не надо, но мало ли чего там
function protect($value) {
    $value = trim($value); //убираем пробелы c концов
    $value = stripslashes($value); //удаляет экранирование символов
    $value = strip_tags($value); //удаляем все хтмл теги
    $value = htmlspecialchars($value); //преобразуем хтмл в обычный символы
    return $value;
}