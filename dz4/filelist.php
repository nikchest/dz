<?php
require_once 'php/auth_by_sess_cookies.php'; //СЮДА НАШУ КУКУ ПРОВЕРКИ ПОДРУБАЕМ И РЕДИРЕКТИМ НА ИНДЕКС


// Выход
if ($_GET['logout'] == 'yes') {
    session_destroy();
    header('Location: index.html');
}

//Выводим фотку
$search_photo = "SELECT photo FROM users_dz4 WHERE photo IS NOT NULL";
$result_search_photo = mysqli_query($connect_db, $search_photo) or die('Ошибка поиска записи: ' . mysqli_error($connect_db));
$result_search_photo_all = mysqli_fetch_all($result_search_photo);

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Starter Template for Bootstrap</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">


    <!-- Custom styles for this template -->
    <link href="starter-template.css" rel="stylesheet">


    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Project name</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li><a href="list.php">Список пользователей</a></li>
            <li class="active"><a href="filelist.php">Список файлов</a></li>
            <li><a href="lk.php">Личный кабинет</a></li>
            <li><a href="lk.php?logout=yes" id="out">Выход</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

    <div class="container">
    <h1>Запретная зона, доступ только авторизированному пользователю</h1>
      <h2>Информация выводится из списка файлов</h2>
      
      <table class="table table-bordered photo">
        <tr>
          <th>Название файла</th>
          <th>Фотография</th>
          <th>Действия</th>
        </tr>
        <?php
        $dir = '';//путь к картинке
        foreach ($result_search_photo_all as $value) {
          $dir = 'http://oimarketing.ru/lsphp/dz-4/photos/' . $value[0];
          echo 
          '<tr>
            <td>' . $value[0] . '</td>
            <td><img src="' . $dir .'" alt="" width="auto" height="70"></td>
            <td>
              <a href="' . $value[0] . '">Удалить аватарку пользователя</a>
            </td>
          </tr>';
        }
        ?>
      </table>

    </div><!-- /.container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="js/ajax.js"></script>
    <script src="js/main.js"></script>
    <script src="js/bootstrap.min.js"></script>

  </body>
</html>
