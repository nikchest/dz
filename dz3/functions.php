<?php 
header('Content-type: text/html; charset=utf-8');
// Задание выполняется в двух файлах. Файл functions.php содержит все 10 функций. Функции именуются task1, task2, task3, с маленькой буквы, слитно. Файл с именем index.php содержит require(‘functions.php’); и вызов всех функций.

//Задание #1
//Дан XML файл. Сохраните его под именем data.xml:
//Написать скрипт, который выведет всю информацию из этого файла в удобно читаемом виде. Представьте, что результат вашего скрипта будет распечатан и выдан курьеру для доставки, разберется ли курьер в этой информации?

function task1() {
	$xmlPath = './data.xml';
    $xml = simplexml_load_file($xmlPath);
        //echo '<pre>';
        //print_r($xml);
    $attrs = $xml->attributes();
    echo 'Заказ № ' . $attrs['PurchaseOrderNumber'] . ' От ' . $attrs['OrderDate'] . '<br/><br/>';
    /*foreach ($xml as $country) {
        echo $country->id . ' - ' . $country->title . '<br/>';
    }
    foreach ($movies->movie->characters->character as $character) {
        echo $character->name, ' играет ', $character->actor, PHP_EOL;
    }*/
    foreach ($xml->Address as $address) {
        echo 'Имя: ' .    $address->Name . '<br>' . 
             'Улица: ' .  $address->Street . '<br>' . 
             'Город: ' .  $address->City . '<br>' . 
             'Штат: ' .   $address->State . '<br>' . 
             'Индекс: ' . $address->Zip . '<br>' . 
             'Страна: ' . $address->Country . '<br><br>';
    }
    
    echo 'Заметка: ' . $xml->DeliveryNotes . '<br><br>';
    
    foreach ($xml->Items->Item as $item) {
        echo 'Артикул : ' .      $item['PartNumber'] . '<br>' .
             'Продукт : ' .      $item->ProductName . '<br>' . 
             'Количество : ' .   $item->Quantity . '<br>' . 
             'Цена: ' .          $item->USPrice . '<br>' . 
             'Дата отгурзки: ' . $item->ShipDate . '<br>' . 
             'Коммент: ' .       $item->Comment . '<br><br>';
    }
}

//task1();

/*
Задача #2

Создайте массив, в котором имеется как минимум 1 уровень вложенности. Преобразуйте его в JSON.  Сохраните как output.json
Откройте файл output.json. Случайным образом решите изменять данные или нет. Сохраните как output2.json
Откройте оба файла. Найдите разницу и выведите информацию об отличающихся элементах
*/

function task2() {
    
    $bmw = array(
        'name' => "bmw",
        'model' => "X5",
        'speed' => 120,
        'doors' => 5,
        'year' => "2015",
    );
    //Создайте   массивы   $toyota   и   $opel   аналогичные   массиву   $bmw   (заполните  данными)
    $toyota = array(
        'name' => "toyota",
        'model' => "Camry",
        'speed' => 140,
        'doors' => 4,
        'year' => "2014",
    );
    $opel = array(
        'name' => "opel",
        'model' => "Astra",
        'speed' => 130,
        'doors' => 4,
        'year' => "2013",
    );
    //Объедините три массива в один многомерный массив
    $car = array($bmw, $toyota, $opel);
    echo '<pre>';
    print_r($car);
    echo '</pre>';

    //Преобразуйте его в JSON.
    $jsonString = json_encode($car);
    //Сохраните как output.json
    file_put_contents('output.json', $jsonString);
    echo $jsonString;

    //Откройте файл output.json
    $jsonPath = './output.json';
    $jsonFile = file_get_contents($jsonPath);
    $jsonArray = json_decode($jsonFile, true);
    echo '<pre>';
    print_r($jsonArray);

    //Случайным образом решите изменять данные или нет
    $jsonArray[0]['year'] = "2011";
    $jsonArray[1]['year'] = "2012";
    $jsonArray[2]['year'] = "2010";

    for ($i=0; $i <= 2 ; $i++) { 
        echo '<br>CAR '.$jsonArray[$i]['name'].'<br>';
        echo $jsonArray[$i]['model'].' '.$jsonArray[$i]['speed'].' '.$jsonArray[$i]['doors'].' '.$jsonArray[$i]['year'].'<br>';
    }

    //Сохраните как output2.json
    $jsonString_second = json_encode($jsonArray);
    file_put_contents('output2.json', $jsonString_second);
    echo $jsonString_second;

    //Откройте оба файла
    //output.json
    $jsonPath_output = './output.json';
    $jsonFile_output = file_get_contents($jsonPath_output);
    $jsonArray_output = json_decode($jsonFile_output, true);
    //echo '<pre>';
    //print_r($jsonArray_output);
    //output2.json
    $jsonPath_output2 = './output2.json';
    $jsonFile_output2 = file_get_contents($jsonPath_output2);
    $jsonArray_output2 = json_decode($jsonFile_output2, true);
    //echo '<pre>';
    //print_r($jsonArray_output2);
    
    //Найдите разницу и выведите информацию об отличающихся элементах
    /*$result = array_diff($jsonArray_output, $jsonArray_output2);
    echo 'срав<pre>';
    print_r($result);*/

    //т.к. массив ассоциативный, то будем упрощать сравнение элементов массива, объявляем перменные, в которые потом запишем упрощенные массивы 
    $arr_compare_output = ''; 
    $arr_compare_output2 = '';

    for ($i = 0, $j = 0; $i < count($jsonArray_output), $j < count($jsonArray_output2); $i++, $j++) {
        
        
        //перебериам ассоциативные массивы и переводим их в строку с разделитем элементов через пробел, чтобы потом в простые массивы записать для сравнения      
        foreach ($jsonArray_output2[$j] as $key => $value) {
            //echo '<br>' . $key . ' ' . $value;
            $arr_compare_output .= $key . ' ' . $value . ' ';
        }
        foreach ($jsonArray_output[$i] as $k => $v) {
            //echo '<br>' . $k . ' ' . $v;
            $arr_compare_output2 .= $k . ' ' . $v . ' ';
        }

    }
    
    $str_arr_output = explode(' ', $arr_compare_output);//создаем упрощенный исходный массив
    /*echo '<pre>';
    print_r($str_arr_output);
    echo '</pre>';*/

    $str_arr_output2 = explode(' ', $arr_compare_output2);//создаем упрощенный измененный массив
    /*echo '<pre>';
    print_r($str_arr_output2);
    echo '</pre>';*/
    
    //сравниваем что поменялось и выводим изменения
    for ($i=0, $j=0; $i < (count($str_arr_output) - 1), $j < (count($str_arr_output2) - 1); $i++, $j++) {
        //echo '<br>' . $str_arr_output[$i] . ' = ' . $str_arr_output2[$j];
        if ($str_arr_output[$i] != $str_arr_output2[$j]) {
            echo '<br><b>Было: ' . $str_arr_output[$i] . '. Поменяли на: ' . $str_arr_output2[$j] . '</b>';
        }
    }

    

}

//task2();

/*
Задача #3
Программно создайте массив, в котором перечислено не менее 50 случайных числел от 1 до 100
Сохраните данные в файл csv
Откройте файл csv и посчитайте сумму четных чисел
*/
function task3() {
    $arr = [];
    for ($i = 0; $i < 50; $i++) {
        $arr[$i] = mt_rand(1, 100);;
    }
    echo '<pre>';
    print_r($arr);
    //Сохраните данные в файл csv
    $fp_write = fopen('file.csv', 'w');
    fputcsv($fp_write, $arr);
    fclose($fp_write);

    //Откройте файл csv
    $list = '';//переменная для записи данных из файла csv в массив
    if (($fp_read = fopen("file.csv", "r")) !== FALSE) {
        while (($data = fgetcsv($fp_read, 0)) !== FALSE) {
            $list = array($data);
        }
    echo '<pre>';
    print_r($list);


    //и посчитайте сумму четных чисел
    $list = $list[0];//т.к. массив получается многоуровневый, то избавляемся от верхнего уровня
    foreach ($list as $key => $value) {
        echo '<br> ' . $key . ' ' . $value;
        if ($value % 2 == 0) {
            $sum_even += $value;
        }
    }
    echo '<br><b>Сумма четных чисел массива = ' . $sum_even . '</b>';
    fclose($fp_read);
    }

}

//task3();

/*
Задача #4
С помощью CURL запросить данные по адресу: https://en.wikipedia.org/w/api.php?action=query&titles=Main%20Page&prop=revisions&rvprop=content&format=json
Вывести title и page_id
*/

function task4() {

    function curl_get($host, $referer = null){
        $ch = curl_init();// инициализация библиотеки, создает новый сеанс CURL
     
        curl_setopt($ch, CURLOPT_HEADER, 0);//параметр, при установке которого в значение неравное "0", ответ будет включать еще и передаваемые сервером заголовки.
        curl_setopt($ch, CURLOPT_REFERER, $referer);//параметр который задает значение HTTP заголовка "Referer", тоесть откуда мы попали на данную страницу к которой обращаемся по CURL .
        //curl_setopt($ch, CURLOPT_USERAGENT, "Super browser");//параметр подменяющий значение HTTP заголовка "User-Agen", сервер определит версию браузера и сам браузер, таким образом эмулируется работа браузера.
        curl_setopt($ch, CURLOPT_URL, $host);//URL адрес сайта\хоста к которому будет отправлен HTTP запрос посредством CURL . Значение этого параметра также может быть задано в вызове функции CURL _init().
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);//параметр задает максимальное время выполнения операции по получению\отправки данных в секундах.
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);//параметр, установка которого в ненулевое значение определяет что CURL не будет выводить полученные данные, а помещать их в переменную.
        //curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);//параметр, установка которого в ненулевое значение определяет, что если сервер при обращении к нему, применяет Redirekt - следовать по пути переадресации и получать данные.
     
        $html = curl_exec($ch);//функция вызывается после инициализации сеанса CURL и установки всех необходимых опций, фактически это она выполняет требуемую операцию.
        echo curl_error($ch);//возвращает строку содержащую номер последней ошибки для текущей сессии CURL .
        curl_close($ch);//функция завершающая сеанс работы CURL .
        
        $html_json = json_decode($html, true);
        
        //echo '<pre>';
        //print_r($html_json);

        echo "page_id : " . $html_json['query']['pages']['15580374']['pageid'] . "<br>";
        echo "title : " . $html_json['query']['pages']['15580374']['title'] . "<br>";
    }
    
    $result = curl_get('https://en.wikipedia.org/w/api.php?action=query&titles=Main%20Page&prop=revisions&rvprop=content&format=json', 'http://google.com');
}

//task4();
