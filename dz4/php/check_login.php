<?php
require_once 'connection.php'; // подключаем скрипт коннекта к БД
 
//print("Подключение выполнено успешно");

//Очищаем от лишнего поля данных
$login = protect($_POST['login']);


//Поиск в БД на совпадение Логина
$search_users = 'SELECT login FROM users_dz4 WHERE login ="'.$login.'"';
$query_search_users = mysqli_query($connect_db, $search_users) or die('Ошибка поиска записи: ' . mysqli_error($connect_db));
$result_query_search_users = mysqli_num_rows($query_search_users);

//Если строк нет в базе по логин, то логин свободен
$answer = '';
if ($result_query_search_users == 0) {
    $answer = array(
        'valid_login' => 'Логин свободен',
    );
    $jsonString = json_encode($answer);
    echo($jsonString);
} else {
    $answer = array(
        'valid_login' => 'Логин занят',
    );
    $jsonString = json_encode($answer);
    echo($jsonString);
}

//Блок защиты
//Чистим ввод юзера
function protect($value) {
    $value = trim($value); //убираем пробелы c концов
    $value = stripslashes($value); //удаляет экранирование символов
    $value = strip_tags($value); //удаляем все хтмл теги
    $value = htmlspecialchars($value); //преобразуем хтмл в обычный символы
    return $value;
}