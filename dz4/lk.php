<?php
require_once 'php/auth_by_sess_cookies.php'; //СЮДА НАШУ КУКУ ПРОВЕРКИ ПОДРУБАЕМ И РЕДИРЕКТИМ НА ИНДЕКС


// Выход
if ($_GET['logout'] == 'yes') {
    session_destroy();
    header('Location: index.html');
}

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

    <title>Личный кабинет</title>

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
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
                    aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php">Project name</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li><a href="list.php">Список пользователей</a></li>
                <li><a href="filelist.php">Список файлов</a></li>
                <li class="active"><a href="lk.php">Личный кабинет</a></li>
                <li><a href="lk.php?logout=yes" id="out">Выход</a></li>
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</nav>
<div class="container">
    <div class="form-container">
        <form class="form-horizontal" id="form_profile" enctype="multipart/form-data">
            <div class="form-group">
                <label for="name" class="col-sm-2 control-label">Имя</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="name" placeholder="Имя" name="name"
                           value="">
                </div>
            </div>
            <div class="form-group">
                <label for="age" class="col-sm-2 control-label">Возраст</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="age" placeholder="Возраст" name="age"
                           value="">
                </div>
            </div>
            <div class="form-group">
                <label for="description" class="col-sm-2 control-label">Описание</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="description" placeholder="Описание" name="description"
                           value="">
                </div>
            </div>
            <div class="form-group">
                <img src='' alt='' style='width:100px'>

                <label for="photo_path" class="col-sm-2 control-label">Фото</label>
                <div class="col-sm-10">
                    <input type="file" name="photo">
                </div>
                <div class="res_upload"></div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-default" name="submit">Сохранить</button>
                    <br><br>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="js/main.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="js/ajax.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>