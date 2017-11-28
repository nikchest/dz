<?php
header('Content-Type: text/html; charset=UTF-8');
require_once 'connection.php'; // подключаем скрипт коннекта к БД

//Максимум 1 фотку можно залить
//ini_set('max_file_uploads', '1');

//Задаем переменный для данных из формы
$name = protect($_POST['name']);
$age = protect($_POST['age']);
$des = protect($_POST['description']);
$photo = $_FILES['photo'];

$answer = '';
//Проверяем заполненность формы
if(!empty($name) && !empty($age) && !empty($des)) {

	//Нет ли ошибок при загрузке картинки
	if (!empty($photo) && $photo['error'] == 0) {
  
		//Загружаем файл во временный каталог с временным именем
	    $up_file = $photo['tmp_name']; 
		//$up_file_name = str_replace(' ', '-', $photo['name']); //заменяем пробелы на - в названии файла на компе юзера
		//проверяем разрешение файла
		// разбиваем имя файла по точке и получаем массив
		$getMime = explode('.', $photo['name']);
		//перевод в нижний регистр и выбираем символы после последней точки
		//echo '<pre>';
		//print_r($getMime);
		$mime = strtolower(end($getMime));


		// объявим массив допустимых расширений
		$types = array('jpg', 'png', 'gif', 'bmp', 'jpeg');
		// если расширение не входит в список допустимых - то ошибка
		if (!in_array($mime, $types)) {
			$answer = array(
		    'valid_form' => 'Ошибка №5', //Картинка должна соответствовать форматам: jpg, png, gif, bmp, jpeg
		    );
		    $jsonString = json_encode($answer);
		    echo($jsonString);
		} elseif ($photo['size'] > 5242880) { //проверяем размер файла
			$answer = array(
		    'valid_form' => 'Ошибка №6', //Размер файла превышает 5 Мб!
		    );
		    $jsonString = json_encode($answer);
		    echo($jsonString);
		} else { //иначе проверяем есть ли такой юзер и льем фотку на сервак
			
			session_start();

			$search_user = 'SELECT id FROM users_dz4 WHERE id ="'.$_SESSION['id'].'"';
			$result_search_user = mysqli_query($connect_db, $search_user) or die('Ошибка поиска id юзера: ' . mysqli_error($connect_db));
			$result_search_user_num = mysqli_num_rows($result_search_user);
			
			if ($result_search_user_num == 0) {
				$answer = array(
			    'valid_form' => 'Юзера с id: '.$_SESSION['id'].', нет в базе', //Ошибка загрузки файла
			    );
			    $jsonString = json_encode($answer);
			    echo($jsonString);
			} else {
				//Имя фотки для базы
				$up_file_name = $_SESSION['id'] . '.' . $mime;
				move_uploaded_file($up_file, '../photos/' . $up_file_name);
				
				$update_profile = 'UPDATE users_dz4 SET name ="'.$name.'", age ="'.$age.'", description ="'.$des.'", photo ="'.$up_file_name.'" WHERE id="'.$_SESSION['id'].'"';
				$result_update_profile = mysqli_query($connect_db, $update_profile) or die('Ошибка записи кук: ' . mysqli_error($connect_db));

				$answer = array(
			    'valid_form' => 'true', //Профиль добавлен с фото
			    );
			    $jsonString = json_encode($answer);
			    echo($jsonString);
			}
		}
	} else {
		$answer = array(
	    'valid_form' => 'Ошибка №4', //Ошибка загрузки файла
	    );
	    $jsonString = json_encode($answer);
	    echo($jsonString);
	}
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