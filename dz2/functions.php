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
        return $back_to_str;
    }
}

//echo task1($arr_str, true);



// Задание #2

// Функция должна принимать 2 параметра:
// - массив чисел;
// - строку, обозначающую арифметическое действие, которое нужно выполнить со всеми элементами массива.
// Функция должна вывести результат на экран.
// Функция должна обрабатывать любой ввод, в том числе некорректный и выдавать сообщения об этом

$arr_num = array(15, 5, 4);
$sign = '/';

function task2($array, $sign) {
    if (preg_match('/[a-zA-Zа-яёА-ЯЁ]/u', implode("", $array))) {
        echo "<br>Массив может содержать только цифры";        
    } else {
        if ($sign == '+') {
            for ($i=0; $i < count($array); $i++) {
                $result +=$array[$i];
            }
        } elseif ($sign == '-') {
            for ($i=0; $i < count($array); $i++) {
                $array[0] *= (-1);
                $result -=$array[$i]; 
            }
        } elseif ($sign == '*') {
            $result = 1;
            for ($i=0; $i < count($array); $i++) {
                $result *=$array[$i]; 
            }
        } elseif ($sign == '/') {
            $result = $array[0];
            for ($i=1; $i < count($array); $i++) {
                if ($array[0] == 0 || $array[$i] == 0 ) {
                    echo '<br>На ноль делить нельзя';
                    break;
                }
                $result /=$array[$i];
            }
        } else {
            echo "<br>Неверный знак";
        }
    }
    /*if ($sign == '+' || $sign == '-') {
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
    }*/
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
    echo "<br>Знак :".$sign_task3;

    $arg_list = func_get_args();

    foreach ($arg_list as $key => $value) {
        echo "<br>".$key.'=>'.$value;
    }

    if (preg_match('/[a-zA-Zа-яёА-ЯЁ]/u', implode("", $arg_list))) {
        echo "<br>Массив может содержать только цифры";        
    } else {
        if ($sign_task3 == '+') {
            for ($i=1; $i < $numargs; $i++) {
                $result +=$arg_list[$i];
                $formula_str .= $sign_task3.' '.$arg_list[$i].' ';
            }
        } elseif ($sign_task3 == '-') {
            for ($i=1; $i < $numargs; $i++) {
                $arg_list[1] *= (-1);
                $result -=$arg_list[$i];
                if ($i==1) {
                    $arg_list[1] *= (-1);
                }
                $formula_str .= $sign_task3.' '.$arg_list[$i].' ';
            }
        } elseif ($sign_task3 == '*') {
            $result = 1;
            for ($i=1; $i < $numargs; $i++) {
                $result *=$arg_list[$i]; 
                $formula_str .= $sign_task3.' '.$arg_list[$i].' ';
            }
        } elseif ($sign_task3 == '/') {
            $result = $arg_list[1];
            for ($i=2; $i < $numargs; $i++) {
                if ($arg_list[1] == 0 || $arg_list[$i] == 0 ) {
                    echo '<br>На ноль делить нельзя';
                    break;
                }
                $result /= $arg_list[$i];
                //$formula_str = $arg_list[1];
                $formula_str .= $arg_list[1].' '.$sign_task3.' '.$arg_list[$i].' ';
            }
        } else {
            echo "<br>Неверный знак";
        }
    }

/*
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
    }*/

    $str_arrr = explode(' ', $formula_str);

    echo '<pre>';
    print_r($str_arrr);
    echo '</pre>';

    if ($sign_task3 == '/') {

            for ($i=0; $i<(count($str_arrr)-1); $i++) {
                
                if (($i !==0 ) && ($i % 3 == 0)) continue;
                $itog .= $str_arrr[$i].' ';
            }
        } else {
            for ($i=1; $i<(count($str_arrr)-1); $i++) {
                $itog .= $str_arrr[$i].' ';
            }
        }
    
    echo '<br>'.$itog.'= '.$result;
}

//task3('/', 1, 2, 3, 5.2);





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
    
    $str = mb_strtolower($str, 'utf-8');
    //$str = preg_match('/[0-9a-zA-Zа-яёА-ЯЁ]/u', $str)
    $str = preg_replace("/\s/", "", $str);
    $str_arr = preg_split('//u',$str,-1,PREG_SPLIT_NO_EMPTY);
    //$arr1 = str_split($rgTest);
       
    echo '<pre>';
    print_r($str_arr);
    echo '</pre>'.count($str_arr);
    
        for ($i=0; $i<count($str_arr); $i++) {
            echo '<br>'.$str_arr[$i].' = '.$str_arr[count($str_arr) - ($i+1)];
            
            if ($str_arr[$i] == $str_arr[count($str_arr) - ($i+1)]) {
                $res_p = 1; 
            } else {
                $res_p = 0;        
            }
            
        }

    if ($res_p == 1) {
        return true;
    } else {
        return false; 
    } 
}

function task5_2($str_check) {
    if (task5_1($str_check)) {
        echo '<br>Строка палиндром';
    } else {
        echo '<br>Строка не палиндром';
    }
}

//task5_2('3топот3');

// Задание #6 (выполняется после вебинара “ВСТРОЕННЫЕ ВОЗМОЖНОСТИ ЯЗЫКА”)

// Выведите информацию о текущей дате в формате 31.12.2016 23:59


function task6() {
    echo '<br>'.date('d.m.Y h:i');

// Выведите unixtime время соответствующее 24.02.2016 00:00:00.
    $date = date_parse_from_format("d.m.Y", '24.02.2016 00:00:00');
    $unixTime = mktime($date['hour'], 
                       $date['minute'], 
                       $date['second'], 
                       $date['month'], 
                       $date['day'], 
                       $date['year']);
    echo '<br>'.$unixTime;
    echo '<pre>';
    print_r(getdate($unixTime));
    echo '</pre>';
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
//task9_1();

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
