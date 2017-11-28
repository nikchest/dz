<?php
require_once 'connection.php'; // подключаем скрипт коннекта к БД

//Подключаемся к серверу
if(!$connect_db) die("Ошибка доступа к базе данных. Приносим свои извинения" . mysqli_error($connect_db));
//print("Подключение выполнено успешно");

//Очищаем от лишнего поля данных
$login = protect($_POST['login']);
$pass = protect($_POST['pass']);
$pass2 = protect($_POST['pass2']);

$answer = '';
//Проверяем на заполненность все поля и коинфирм пароля
if ((!empty($login) && !empty($pass) && !empty($pass2)) && $pass == $pass2) {
	
	//Проверка логина на совпадение
	$search_user = 'SELECT login FROM users_dz4 WHERE login ="'.$login.'"';
	$result_search_user = mysqli_query($connect_db, $search_user) or die('Ошибка поиска логина: ' . mysqli_error($connect_db));
	$result_search_user_num = mysqli_num_rows($result_search_user);

	//Если строк нет в базе по логину, то логин свободен
	if ($result_search_user_num == 0) {

		$salt = generateSalt(); //генерируем соль
		$hashed_pass = crypt($pass, $salt); // солим пароль

		//Добавляем в базу юзера
	    $insert_user = 'INSERT INTO users_dz4 SET login="'.$login.'", password="'.$hashed_pass.'", salt="'.$salt.'"';

		$insert_user_result = mysqli_query($connect_db, $insert_user) or die('Ошибка запроса записи в БД логин и пароль : ' . mysqli_error($connect_db));

		if ($insert_user_result) {
		    $answer = array(
	        	'valid_form' => 'true',
		    );
		    $jsonString = json_encode($answer);
		    echo($jsonString);
		} else {
		    echo "Ошибка реги" . mysqli_error($connect_db);
		}
	} else {
		$answer = array(
        	'valid_form' => 'Ошибка №0', //Логин всё-таки занят
	    );
	    $jsonString = json_encode($answer);
	    echo($jsonString);
	}
} else if ($pass != $pass2){
	$answer = array(
        'valid_form' => 'Ошибка №1', //Пароли не совпадают
    );
    $jsonString = json_encode($answer);
    echo($jsonString);
} else {
	$answer = array(
        'valid_form' => 'Ошибка №2', //Заполните все поля
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

//Функция для генерации соли
function generateSalt() {
	$salt = '';
	$saltLength = 8; //длина соли
	for($i=0; $i<$saltLength; $i++) {
		$salt .= chr(mt_rand(1,100));
	}
	return $salt;
}