<?php
header('Content-type: text/html; charset=utf-8');
//Задание #1
//
//Создайте   переменную   $name   и   присвойте   ей   строковое   значение   содержащее  Ваше имя
$name = 'Никита';
//Создайте   переменную   $age   и   присвойте   ей   строковое   значение   содержащее   Ваш  возраст
$age = '30';
//Выведите   с   помощью   echo   (или   print)   фразу   “Меня   зовут:   ​ваше_имя​”   например:  “Меня зовут: Игорь”
echo 'Меня   зовут: '.$name.PHP_EOL;
//Выведите фразу “Мне ​ваш_возраст​ лет”, например: “Мне 99 лет”
echo '<br>Мне '.$age.' лет'.PHP_EOL;
//Выведите следующий набор символов, включая кавычки - “!|\/’”\ (двойная кавычка, воскл. знак, вертикальная черта, обратный слэш, слэш, кавычка, двойная кавычка, обратный слэш)
echo '<br>"!|\\/\'"\\'.PHP_EOL;
//Каждая фраза должна начинаться с новой строки
//Задание #2
//
//Дана задача: На школьной выставке 80 рисунков. 23 из них выполнены фломастерами, 40 карандашами, а остальные — красками. Сколько рисунков, выполненные красками, на школьной выставке?
//Описать и вывести условия, решение этой задачи на PHP. Все числа должны быть указаны в переменных.
$all_pic = 80;
$pic_by_marker = 23;
$pic_by_pencil = 40;
$pic_by_paint = $all_pic - $pic_by_marker - $pic_by_pencil;
echo '<br>Рисунков красками на школьной выставке: '.$pic_by_paint;
//Задание #3
//
//Создайте константу и присвойте ей значение.
define('ASD', 'Моя константа 5');
//Проверьте, существует ли константа, которую Вы хотите использовать
if (defined('ASD')) {
echo '<br>Константа объявлена и равна:'.ASD; //
}

//Выведите значение созданной константы
echo '<br>Значение константы: '.ASD;
//Попытайтесь изменить значение созданной константы.
const ASD = 'замена константы';
echo '<br>Пытаюсь поменять константу: '.ASD;


//Задание #4 
 
//-Создайте переменную $age 
$age;
//-Присвойте переменной $age произвольное числовое значение
$age = mt_rand(0, 200);
echo '<br><br>Сейчас случайное число = '.$age;
//-Напишите   конструкцию   if,   которая   выводит   фразу:   “Вам   еще работать   и   работать”  при   условии   что   значение   переменной   //$age   попадает   в   диапазон   чисел   от   18   до   65  (включительно) 
if (($age >= 18) && ($age <= 65)) {
	echo '<br>Вам   еще работать   и   работать';
}
//-Расширьте   конструкцию   if,   выводя   фразу:   “Вам   пора   на   пенсию”   при   условии,   что  значение переменной $age больше 65 
if (($age >= 18) && ($age <= 65)) {
	echo '<br>Вам   еще работать   и   работать';
} else if ($age > 65) {
	echo '<br>Вам   пора   на   пенсию';
}
//-Расширьте   конструкцию   ­elseif,   выводя   фразу:   “Вам   ещё   рано   работать”   при  условии,   что   значение   переменной   $age   
//попадает   в   диапазон   чисел   от   1   до   17  (включительно)  
if (($age >= 18) && ($age <= 65)) {
	echo '<br>Вам   еще работать   и   работать';
} else if ($age > 65) {
	echo '<br>Вам   пора   на   пенсию';
} else if (($age >= 1) && ($age <= 17)) {
	echo '<br>Вам   ещё   рано   работать';
}
//-Дополните   конструкцию   if­elseif,   выводя   фразу:   “Неизвестный   возраст”   при  условии,   что   значение   переменной   $age   не   
//попадет   в   вышеописанные   диапазоны чисел*/
if (($age >= 18) && ($age <= 65)) {
	echo '<br>Вам   еще работать   и   работать';
} else if ($age > 65) {
	echo '<br>Вам   пора   на   пенсию';
} else if (($age >= 1) && ($age <= 17)) {
	echo '<br>Вам   ещё   рано   работать';
} else {
	echo '<br>Неизвестный возраст';
}

//Задание #5
 
//Создайте переменную $day и присвойте ей произвольное числовое значение
$day = mt_rand(0, 10);
echo '<br>$day = '.$day;
//С   помощью   конструкции   switch   выведите   фразу   “Это   рабочий   день”,   если   значение  переменной $day попадает в диапазон чисел от //1 до 5 (включительно)
switch ($day) {
	case 1:
	case 2:
	case 3:
	case 4:
	case 5:
		echo "<br>Это   рабочий   день";
}
//Выведите   фразу   “Это   выходной   день”,   если   значение   переменной   $day   равно  числам 6 или 7 
switch ($day) {
	case 1:
	case 2:
	case 3:
	case 4:
	case 5:
		echo "<br>Это   рабочий   день";
		break;
	case 6:
	case 7:
		echo "<br>Это   выходной   день";
		break;
}
//Выведите   фразу   “Неизвестный   день”,   если   значение   переменной   $day   не   попадает  в диапазон чисел от 1 до 7 (включительно)
switch ($day) {
	case 1:
	case 2:
	case 3:
	case 4:
	case 5:
		echo "<br>Это   рабочий   день";
		break;
	case 6:
	case 7:
		echo "<br>Это   выходной   день";
		break;
	default:
       echo "<br>Неизвестный   день";
}


//Задание #6 
 
//Создайте массив $bmw с ячейками: 
//model 
//speed 
//doors 
//year 
// Заполните ячейки значениями соответсвенно: “X5”, 120, 5, “2015”
$bmw = array(
    'model' => "X5",
    'speed' => 120,
    'doors' => 5,
    'year' => "2015",
);
//Создайте   массивы   $toyota   и   $opel   аналогичные   массиву   $bmw   (заполните  данными)
$toyota = array(
    'model' => "Camry",
    'speed' => 140,
    'doors' => 4,
    'year' => "2014",
);
$opel = array(
    'model' => "Astra",
    'speed' => 130,
    'doors' => 4,
    'year' => "2013",
);
//Объедините три массива в один многомерный массив
/*$car['bmw'] = $bmw;
$car['toyota'] = $toyota;
$car['opel'] = $opel;*/

$car = array
(
    'bmw' => $bmw,
    'toyota' => $toyota,
    'opel' => $opel,
);

echo '<pre>';
print_r($car);
echo '</pre>';
//Выведите значения всех трех массивов в виде:
//CAR name
//name ­ model ­speed ­ doors ­ year
//Например: 
//CAR bmw
//X5 ­120 ­ 5 ­ 2015 

echo '<b>Вариант 1</b>';
foreach ($car as $key => $item) {
    echo '<br><br>CAR '.$key.'<br>';
    foreach ($car[$key] as $kk => $ii) {
        echo $ii . ' ';
    }
}
echo '<br><br><b>Вариант 2</b><br>';
foreach ($car as $key => $item) {
    echo '<br>CAR ' . $key . '<br>' . $car[$key]['model'] . ' ' . $car[$key]['speed'] . ' ' . $car[$key]['doors'] . ' ' . $car[$key]['year'] . '<br>';
}


/*
for ($i=0; $i <= 2 ; $i++) { 
	echo '<br>CAR '.$car[$i];
        //['name'].'<br>'.$car[$i]['model'].' '.$car[$i]['speed'].' '.$car[$i]['doors'].' '.$car[$i]['year'].'<br>';
}
*/
/*
echo '<br>CAR bmw<br>'.$bmw['model'].' '.$bmw['speed'].' '.$bmw['doors'].' '.$bmw['year'];
echo '<br>CAR toyota<br>'.$toyota['model'].' '.$toyota['speed'].' '.$toyota['doors'].' '.$toyota['year']; 
echo '<br>CAR opel<br>'.$opel['model'].' '.$opel['speed'].' '.$opel['doors'].' '.$opel['year']; 
*/

//Задание #7 
 
//Используя цикл for, выведите таблицу умножения размером 10x10. Таблица должна быть выведена с помощью HTML тега <table>
//Если значение индекса строки и столбца чётный, то результат вывести в круглых скобках.
//Если значение индекса строки и столбца Нечётный, то результат вывести в квадратных скобках.
//Во всех остальных случаях результат выводить просто числом
echo '<br><br><caption>Таблица умножения 10х10</caprion><table border="1" cellpadding="5"><tr>';
for ($i = 1; $i <= 10; $i++) {
	echo '<td>';
	for ($j=1; $j <=10; $j++) { 
		//echo $i.' х '.$j.' = '.$i*$j.'<br>';
		echo $i.' х '.$j;
		if (($i % 2 == 0) && ($j % 2 == 0)) {
			echo ' = ('.$i*$j.')<br>';
		} else if (($i % 2 != 0) && ($j % 2 != 0)) {
			echo ' = ['.$i*$j.']<br>';
		} else {
			echo ' = '.$i*$j.'<br>';
		}
	}
	echo '</td>';
}
echo '</tr></table>';

//Задание #8

//Создайте переменную $str, которой присвойте строковое значение, содержащее отдельные слова разделенные пробелом. Выведите строку на экран.
$str = 'раз два три';
echo '<br><br>'.$str.'<br>';
//Затем разбейте строку на массив с помощью функции explode. Выведите массив. 
$str_arr = explode(' ', $str);
echo '<pre>';
print_r($str_arr);
echo '</pre>';
//Затем используя циклы while или do-while (на ваше усмотрение) 
//развернуть массив и склеить в строку используя любой символ, кроме пробела. Вывести результат.

$i = 0;
$b = count($str_arr);

while ($i < $b) {
	
	$elem[] = $str_arr[$b - $i - 1];
	$i++;
	
	//Пример. $str=”123 456”. В результате должно быть “456 123”, то есть выведено наоборот.
	if ($i == 3) {
	$back_to_str = implode(" : ", $elem);
	echo '<br>'.$back_to_str;
	}
}
