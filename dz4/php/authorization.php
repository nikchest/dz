<?php
header('Content-Type: text/html; charset=UTF-8');
require_once 'connection.php'; // подключаем скрипт коннекта к БД

//Подключаемся к серверу
if(!$connect_db) die("Ошибка доступа к базе данных. Приносим свои извинения" . mysqli_error($connect_db));
//print("Подключение выполнено успешно");

//Очищаем от лишнего поля данных
$login = protect($_POST['login']);
$password = protect($_POST['password']);
$remember = protect($_POST['remember']);

$answer = '';
//Если форма заполнена, то проверяем лониг и пароль в базе
if (!empty($login) && !empty($password)) {
	
	$select_by_login = 'SELECT * FROM users_dz4 WHERE login="'.$login.'"';
	$result_select_by_login = mysqli_query($connect_db, $select_by_login) or die('Ошибка запроса: ' . mysqli_error($connect_db));
	$result_select_by_login_assoc = mysqli_fetch_assoc($result_select_by_login);

	//Если в массив записались данные запроса, значит такой логин есть и надо проверить пароль
	if(!empty($result_select_by_login_assoc)) {
		//echo "<span style='color:red'>логин есть </span>";
			
		//Берем соль из БД
		$salt = $result_select_by_login_assoc['salt'];

		//Солим пароль из формы авторизации
		$saltedPassword = crypt($password, $salt);

		//Сверяем соленый пароль из формы с базой, если совпал, то открываем сессию
		if($result_select_by_login_assoc['password'] == $saltedPassword) {
			$answer = array(
	        'valid_auth' => 'true', //Авторизовался юзер
		    );
		    $jsonString = json_encode($answer);
		    echo($jsonString);
			//Открываем сессию
			session_start(); 
			//Пишем в сессию информацию о том, что мы авторизовались:
			$_SESSION['auth'] = true;
			//Пишем в сессию логин и id пользователя (их мы берем из БД):
			$_SESSION['id'] = $result_select_by_login_assoc['id']; 
			$_SESSION['login'] = $result_select_by_login_assoc['login'];

			//Если нажата галочка запомнить юзера, то пишем куки
			if ($remember == 1) {

				//echo '<br>галку нажал '  . $remember; //для отладки сообщение
				//Определяем переменную для записи пометки куки-случайной строки для сверки кук
				$salt_cookie = generateSalt(); //юзаем функцию для соли, для генерации 8 случайных символов
				$key_cookie = crypt($login, $salt_cookie); //солим метку куки
				
				//Записываем куки (имя куки, значение, время жизни - сейчас+месяц)
				setcookie('login', $result_select_by_login_assoc['login'], time()+60*60*24*30, '/'); //логин
				setcookie('key_cookie', $key_cookie, time()+60*60*24*30, '/'); //случайная строка

				
				//echo '<br>кука логин '  . $_COOKIE['login'];
				//echo '<br>метка куки '  . $_COOKIE['key_cookie'] . ' ' . $key_cookie;
				//Записываем куку в базу
				$write_cookies_in_db = 'UPDATE users_dz4 SET cookie ="'.$key_cookie.'" WHERE login="'.$login.'"';
				$result_write_cookies_in_db = mysqli_query($connect_db, $write_cookies_in_db) or die('Ошибка записи кук: ' . mysqli_error($connect_db));
			} else {
				//echo '<br>галку НЕ нажал ' . $remember; //для отладки сообщение
			}
		} else {
			$answer = array(
	        'valid_auth' => 'Ошибка №3', //Вы ввели неправильный<br>логин или пароль
		    );
		    $jsonString = json_encode($answer);
		    echo($jsonString);
		}
	} else {
		$answer = array(
        'valid_auth' => 'Ошибка №3', //Вы ввели неправильный<br>логин или пароль
	    );
	    $jsonString = json_encode($answer);
	    echo($jsonString);
	}
} else {
	$answer = array(
        'valid_auth' => 'Ошибка №2', //Заполните все поля
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