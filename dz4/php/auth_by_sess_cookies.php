<?php
header('Content-Type: text/html; charset=UTF-8');
require_once 'connection.php'; // подключаем скрипт коннекта к БД


//Подключаемся к серверу
if(!$connect_db) die("Ошибка доступа к базе данных. Приносим свои извинения" . mysqli_error($connect_db));
//print("Подключение выполнено успешно");


session_start();
//Проверяем наличие открытой сессии
if (empty($_SESSION['auth']) || $_SESSION['auth'] == false) {

    //echo 'сессии нету';
	//Сессии нету, значит проверяем наличе кук
	if (!empty($_COOKIE['login']) && !empty($_COOKIE['key_cookie'])) {


		//Куки есть
		$login = $_COOKIE['login']; //логин в куке
		$key_cookie = $_COOKIE['key_cookie']; //метка куки(аналог пароля, в базе поле cookie)
		//$key_cookie = iconv( "utf-8", "windows-1251", $key_cookie);

		//echo 'куки есть ' . $login . ' ' . $key_cookie .'<br>';

		//В базе проверяем на совпадение логина из куки и метки куки
		$search_cookies_in_db = 'SELECT id, login FROM users_dz4 WHERE login="'.$login.'" AND cookie="'.$key_cookie.'"';
		$result_search_cookies_in_db = mysqli_query($connect_db, $search_cookies_in_db) or die('Ошибка запроса совпадения куки: ' . mysqli_error($connect_db));
		$result_search_cookies_in_db_assoc = mysqli_fetch_assoc($result_search_cookies_in_db);
		//print_r($result_search_cookies_in_db_assoc);

		//Если есть совпадение кук в базе
		if (!empty($result_search_cookies_in_db_assoc)) {

			//echo '<br>куки совпали с базой ' . $login . ' ' . $key_cookie .'<br>';
			//Открываем сессию юзеру
			session_start(); 

			//Пишем в сессию информацию о том, что мы авторизовались:
			$_SESSION['auth'] = true; 

			//Пишем в сессию логин и id пользователя
			$_SESSION['id'] = $result_search_cookies_in_db_assoc['id']; 
			$_SESSION['login'] = $result_search_cookies_in_db_assoc['login']; 

			//Перезаписываем куки при каждом новом заходе, чтоб если украли куки, то они протухнуть после новой авторизации юзера
			$salt_cookie = generateSalt(); //юзаем функцию для соли, для генерации 8 случайных символов
			$key_cookie = crypt($login, $salt_cookie); //солим метку куки
			
			//Записываем куки (имя куки, значение, время жизни - сейчас+месяц)
			setcookie('login', $result_search_cookies_in_db_assoc['login'], time()+3600*24*30, '/'); //логин на месяц пишем в куки
			setcookie('key_cookie', $key_cookie, time()+3600*24*30, '/'); //случайная строка, тож на месяц пишем её в куку

			//Записываем куку в базу
			$write_cookies_in_db = 'UPDATE users_dz4 SET cookie ="'.$key_cookie.'" WHERE login="'.$login.'"';
			$result_write_cookies_in_db = mysqli_query($connect_db, $write_cookies_in_db) or die('Ошибка записи кук: ' . mysqli_error($connect_db));

		} else {
			//echo "<br>в базе чет не то с куками";//для отладки сообщение
			header('Location: index.html');
		}
	} else {
		//echo 'нету кук и сессии<br>';//для отладки сообщение
		header('Location: index.html');
	}
} else {
	//echo 'есть сессия<br>';//для отладки сообщение
	//echo $_SESSION['id'];//для отладки сообщение
	//header('Location: lk.php');
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