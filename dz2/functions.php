<?php 
header('Content-type: text/html; charset=utf-8');
// Задание выполняется в двух файлах. Файл functions.php содержит все 10 функций. Функции именуются task1, task2, task3, с маленькой буквы, слитно. Файл с именем index.php содержит require(‘functions.php’); и вызов всех функций.

// Задание #1
// Функция должна принимать массив строк и выводить каждую строку в отдельном параграфе (тег <p>)
// Если в функцию передан второй параметр true, то возвращать (через return) результат в виде одной объединенной строки.
$arr_str = array('str1', 'str2', 'str3', 'str4', 'str5');

function task1($arr) {
	foreach ($arr as $key => $value) {
		echo '<p>'.$value.'</p>';
	}
	if (func_get_arg(1) == true) {
		$back_to_str = implode(" : ", $arr);
		//echo '<br>'.$back_to_str;
		$arr = $back_to_str;
		return $arr;
	}
}

//echo task1($arr_str, true);



// Задание #2

// Функция должна принимать 2 параметра:
// - массив чисел;
// - строку, обозначающую арифметическое действие, которое нужно выполнить со всеми элементами массива.
// Функция должна вывести результат на экран.
// Функция должна обрабатывать любой ввод, в том числе некорректный и выдавать сообщения об этом

$arr_num = array(1,2,3,4);
$sign = '+';

function task2($array, $sign) {
    if ($sign == '+' || $sign == '-') {
        $result = 0;
    } else {
        $result = 1; 
    }
    for ($i=0; $i < count($array); $i++) {
        if ($sign == '+') {
        	$result += $array[$i];
    	} elseif ($sign == '-') {
            $result -= $array[$i];    
        } elseif ($sign == '*') {
            $result *= $array[$i];    
        } elseif ($sign == '/') {
            //$array[$i] /= $array[$i+1]; 
            $result = $array[$i] / $array[$i + 1];// $array[2];
            if ($i == (count($array) - 2)) break;    
        } else {
            echo "<br>Неверный знак";
            if ($i == 0) break;
        }
    }
    echo '<br>'.$result;
}
//task2($arr_num, $sign);


// Задание #3

// Функция должна принимать переменное число аргументов.
// Первым аргументом обязательно должна быть строка, обозначающая арифметическое действие, которое необходимо выполнить со всеми передаваемыми аргументами.
// Остальные аргументы это целые и/или вещественные числа.

// Пример вызова: calcEverything(‘+’, 1, 2, 3, 5.2);
// Результат: 1 + 2 + 3 + 5.2 = 11.2

function task3() {
    $numargs = func_num_args();
    echo "<br>Колличество аргументов :".$numargs;

    $sign_task3 = func_get_arg(0);
    echo "<br>Знак :".func_get_arg(0);

    $arg_list = func_get_args();
     /*for ($i = 0; $i < $numargs; $i++) {
         echo "Аргумент $i is: ".$arg_list[$i]."<br>\n";
     }*/
    foreach ($arg_list as $key => $value) {
        echo "<br>".$key.'=>'.$value;
    }


    if ($sign_task3 == '+' || $sign_task3 == '-') {
        $result = 0;
    } else {
        $result = 1; 
    }
    for ($i=1; $i < $numargs; $i++) {
        if ($sign_task3 == '+') {
            $result += $arg_list[$i];
            $formula_str .= $sign_task3.' '.$arg_list[$i].' ';
        } elseif ($sign_task3 == '-') {
            $result -= $arg_list[$i];
            $formula_str .= $sign_task3.' '.$arg_list[$i].' ';    
        } elseif ($sign_task3 == '*') {
            $result *= $arg_list[$i];
            $formula_str .= $sign_task3.' '.$arg_list[$i].' ';    
        } elseif ($sign_task3 == '/') {
            //$array[$i] /= $array[$i+1]; 
            $result = $arg_list[$i] / $arg_list[$i + 1];// $array[2];
            $formula_str .= $sign_task3.' '.$arg_list[$i].' ';
            if ($i == ($numargs - 1)) break;    
        } else {
            echo "<br>Неверный знак";
            if ($i == 0) break;
        }
    }

    $str_arrr = explode(' ', $formula_str);

    for ($i=1; $i<(count($str_arrr)-1); $i++) {
        $itog .= $str_arrr[$i].' ';
    }

    echo '<br>'.$itog.'= '.$result;
    /*
    echo '<pre>';
    print_r($str_arrr);
    echo '</pre>';
    */
}

//task3('+', 1, 2, 3, 5.2);





// Задание #4

// Функция должна принимать два параметра – целые числа. 
// Если в функцию передали 2 целых числа, то функция должна отобразить таблицу умножения размером со значения параметров, переданных в функцию. (Например если передано 8 и 8, то нарисовать от 1х1 до 8х8). Таблица должна быть выполнена с использованием тега <table>
//  В остальных случаях выдавать корректную ошибку.

function task4($num1, $num2) {
    if (is_int($num1) && is_int($num2)) {
        echo '<br><br><caption>Таблица умножения '.$num1.'х'.$num2.'</caprion><table border="1" cellpadding="5"><tr>';
        for ($i = 1; $i <= $num1; $i++) {
            echo '<td>';
            for ($j=1; $j <=$num2; $j++) { 
                //echo $i.' х '.$j.' = '.$i*$j.'<br>';
                echo $i.' х '.$j.' = '.$i*$j.'<br>';
                
            }
            echo '</td>';
        }
        echo '</tr></table>';
    } else {
        echo '<br>Оба числа должны быть целыми';
    }
}

//task4(4,4);

// Задание #5

// Написать две функции.
// Функция №1 принимает 1 строковый параметр и возвращает true, если строка является палиндромом*, false в противном случае. Пробелы и регистр не должны учитываться.
// Функция №2 выводит сообщение в котором на русском языке оговаривается результат из функции №1
// * Палиндром – строка, одинаково читающаяся в обоих направлениях.

function task5_1($str) {
    
    $str = strtoupper(preg_replace("/\s/u", "", $str));
    $arr1 = str_split($str);
    
    echo '<pre>';
    print_r($arr1);
    echo '</pre>'.count($arr1);
    
    if (count($arr1) % 2 == 0) {
        for ($i=0; $i<count($arr1); $i++) {
            echo '<br>'.$arr1[$i].' = '.$arr1[count($arr1) - ($i+1)];
            
            if ($arr1[$i] == $arr1[count($arr1) - ($i+1)]) {
                $res_p = 1; 
            } else {
                $res_p = 0;        
            }
            
        }
    } else {
        echo "<br>Четное кол-во симолов без пробелов нннадо";
    }

    if ($res_p == 1) {
        return 'true';
    } else {
        return 'false'; 
    } 
    
}

function task5_2() {
    echo '<br>'.task5_1('a b c cba');
}

//task5_2();

// Задание #6 (выполняется после вебинара “ВСТРОЕННЫЕ ВОЗМОЖНОСТИ ЯЗЫКА”)

// Выведите информацию о текущей дате в формате 31.12.2016 23:59
// Выведите unixtime время соответствующее 24.02.2016 00:00:00.

function task6() {
    echo '<br>'.date('d.m.Y h:i');
    echo '<br>'.date('d.m.Y h:i:s', time());
}
//task6();

// Задание #7 (выполняется после вебинара “ВСТРОЕННЫЕ ВОЗМОЖНОСТИ ЯЗЫКА”)
// Дана строка: “Карл у Клары украл Кораллы”. удалить из этой строки все заглавные буквы “К”.
// Дана строка “Две бутылки лимонада”. Заменить “Две”, на “Три”. По желанию дополнить задание.
function task7($str) {
    $str = preg_replace('/[А-ЯЁ]/u', '', $str);
    echo '<br>'.$str;
}
//task7('Карл у Клары украл Кораллы');

function task7_1($str) {
    $search = 'Две'; 
    $replace = 'Три';
    echo '<br>'.str_replace($search, $replace, $str);
}
//task7_1('Две бутылки лимонада');


// Задание #8 (выполняется после вебинара “ВСТРОЕННЫЕ ВОЗМОЖНОСТИ ЯЗЫКА”)
// Напишите функцию, которая с помощью регулярных выражений, получит информацию о переданных RX пакетах из переданной строки:
// Пример строки: “RX packets:950381 errors:0 dropped:0 overruns:0 frame:0. “
// Если кол-во пакетов более 1000, то выдавать сообщение: “Сеть есть”
// Если в переданной в функцию строке есть “:)”, то нарисовать смайл в ASCII и не выдавать сообщение из пункта №3. Смайл должен храниться в отдельной функции

function task8() {

}


// Задание #9 (выполняется после вебинара “ВСТРОЕННЫЕ ВОЗМОЖНОСТИ ЯЗЫКА”)

// Создайте средствами ОС файл test.txt и поместите в него текст “Hello, world” 
// Напишите функцию, которая будет принимать имя файла, открывать файл и выводить содержимое на экран.
function task9_1() {
    $text = 'Hello, world';
    $file = fopen('test.txt', 'a');
    fwrite($file, $text);
    fclose($file);
}
task9_1();

function task9_2($file_name) {
    echo '<br>'.file_get_contents($file_name);
}
//task9_2('test.txt');

// Задание #10 (выполняется после вебинара “ВСТРОЕННЫЕ ВОЗМОЖНОСТИ ЯЗЫКА”)

// Создайте файл anothertest.txt средствами PHP. Поместите в него текст - “Hello again!”
function task10($text) {
    $file = fopen('anothertest.txt', 'a');
    fwrite($file, $text);
    fclose($file);
}
//task10('Hello again!');