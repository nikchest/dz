$(document).ready(function() {

    
    //Проверка логина на повторение при регистрации
    $("#inputEmail3").keyup(function() {
        if ($.trim($(this).val().length) != 0) {
            
            $.ajax({
                url: "./php/check_login.php",
                type: "POST",
                data: $(this).serialize()
            }).done(function(data) {
                //$('.valid').html(data);
                $('.valid').css('display', 'block');
                var json = JSON.parse(data);  //JSON.stringify()
                var str = json.valid_login;
                $('.valid').html(str);
                if (str == 'Логин свободен') {
                    $('.valid').css('color','green');
                } else {
                    $('.valid').css('color','red');
                };
            });
        };// if
    }); // keypress

    //Убираем подпись проверки логина
    $("#inputEmail3").on('change paste keyup', function(e) {
        if ((e.keyCode == 46 || e.keyCode == 8) && $(this).val().length == 0) { //46 кнопка делит, 8 кнопка бэкспейс
            $('.valid').css('display', 'none');
        };
    });

    //проверка пароля на совпанение со 2-м паролем
    $('#inputPassword4').keyup(function(){
        if ($(this).val() !== $('#inputPassword3').val() && $(this).val().length == $('#inputPassword3').val().length) {
            $('.valid_form').html('Пароли не совпадают');
            $('.valid_form').css('display', 'block');
            $('.valid_form').css('color', 'red');
        } else if ($(this).val() == $('#inputPassword3').val() && 
                   $(this).val().length == $('#inputPassword3').val().length &&
                   $(this).val() !== '' &&
                   $('#inputPassword3').val() !== '') {
            $('.valid_form').html('Пароли совпадают</span>');
            $('.valid_form').css('display', 'block');
            $('.valid_form').css('color', 'green');
        } else if ($(this).val() == '' && $('#inputPassword3').val() == '') {
            $('.valid_form').html('Задайте пароль');
            $('.valid_form').css('color', 'red');
        } else if ($('#inputPassword3').val() == '') {
            $('.valid_form').html('Задайте пароль');
            $('.valid_form').css('color', 'red');
        } else {
            $('.valid_form').html('Пароли не совпадают');
            $('.valid_form').css('color', 'red');
        };
    });

    //проверка пароля на совпанение с подтверждением с 1-м паролем
    $('#inputPassword3').keyup(function(){
        if ($(this).val() !== $('#inputPassword4').val() && $(this).val().length == $('#inputPassword4').val().length) {
            $('.valid_form').html('Пароли не совпадают');
            $('.valid_form').css('display', 'block');
            $('.valid_form').css('color', 'red');
        } else if ($(this).val() == $('#inputPassword3').val() && 
                   $(this).val().length == $('#inputPassword3').val().length &&
                   $(this).val() !== '' &&
                   $('#inputPassword4').val() !== '') {
            $('.valid_form').html('Пароли совпадают</span>');
            $('.valid_form').css('display', 'block');
            $('.valid_form').css('color', 'green');
        } else if ($(this).val() == '' && $('#inputPassword4').val() == '') {
            $('.valid_form').html('Задайте пароль');
            $('.valid_form').css('color', 'red');
        } else if ($('#inputPassword4').val() == '') {
            $('.valid_form').html('Подтвердите пароль');
            $('.valid_form').css('color', 'red');
        } else {
            $('.valid_form').html('Пароли не совпадают');
            $('.valid_form').css('color', 'red');
        };
    });


    //Убираем подпись проверки на совпадение паролей
    $("#inputPassword4").on('change paste keyup', function(e) {
        if ((e.keyCode == 46 || e.keyCode == 8) && $(this).val().length == 0) { //46 кнопка делит, 8 кнопка бэкспейс
            $('.valid_pass').css('display', 'none');
        };
    });

    //Регистрируем пользователя
    $('#form_reg').submit(function(){
        $('.valid_pass').css('display', 'none');
        $.ajax({
            type: 'POST',
            url: './php/registration.php',
            data: $(this).serialize()
        }).done(function(data) {
            $('.valid_form').css('display', 'block');
            $('.valid_form').css('color','red');
                var json = JSON.parse(data);  
                var valid_form = json.valid_form;
                switch (valid_form) {
                  case 'Ошибка №0':
                    $('.valid_form').html('Логин всё-таки занят');
                    break;
                  case 'Ошибка №1':
                    $('.valid_form').html('Пароли не совпадают');
                    break;
                  case 'Ошибка №2':
                    $('.valid_form').html('Заполните все поля');
                    break;
                  case 'true':
                    $('.reg_result').html('Вы успешно зарегестрированы<br>можете <a href="index.html">авторизоваться</a>');
                    $('.reg_btn').css('display', 'none');
                    $('.valid').css('display', 'none');
                    $('.valid_form').css('display', 'none');
                    break;
                  default:
                    $('.valid_form').html(data);
                };
        });
        return false;
    });

    
    //Авторизация по логину паролю
    $('#form_auth').submit(function(){
        $.ajax({
            type: 'POST',
            url: './php/authorization.php',
            data: $(this).serialize()
        }).done(function(data) {
            $('.auth_res').css('color','red');
                var json = JSON.parse(data);  
                var valid_auth = json.valid_auth;
                switch (valid_auth) {
                  case 'Ошибка №2':
                    $('.auth_res').html('Заполните все поля');
                    break;
                  case 'Ошибка №3':
                    $('.auth_res').html('Вы ввели неправильный<br>логин или пароль');
                    break;
                  case 'true':
                    window.location.href = 'lk.php';
                    break;
                  default:
                    $('.auth_res').html(data);
                };
        });
        return false;
    });

    //Загрузка профайла с фото
    $('#form_profile').submit(function(){
        var formData = new FormData(this);
        $.ajax({
            url: './php/insert_profile.php',
            type: 'POST',
            processData: false,
            contentType: false,
            data: formData,
        }).done(function(data) {
            $('.res_upload').css('color','red');
            var json = JSON.parse(data);  
            var valid_form = json.valid_form;
            switch (valid_form) {
              case 'Ошибка №2':
                $('.res_upload').html('Заполните все поля');
                break;
              case 'Ошибка №4':
                $('.res_upload').html('Ошибка загрузки файла');
                break;
              case 'Ошибка №5':
                $('.res_upload').html('Картинка должна соответствовать форматам: jpg, png, gif, bmp, jpeg');
                break;
              case 'Ошибка №6':
                $('.res_upload').html('Размер файла не должен превышать 5 Мб!');
                break;
              case 'true':
                $('.res_upload').html('Профиль успешно добавлен с фото');
                $('.res_upload').css('color','green');
                break;
              default:
                $('.res_upload').html(valid_form);
            };
            
        });
        return false;
    });

    //удаляем фотку
    $('.photo a').on('click', function(e) {
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: './php/delete.php',
            data: {file_name: $(this).attr('href')},
            dataType: "html",
        }).done(function(data) {
            if (data == 'Ошибка удаления фотки') {
                alert(data);
            } else {
                location.reload();//перезагрузим страницу, чтоб увидеть что фотка удалилась
            };
        });
    });

    //удаляем юзера
    $('.users a').on('click', function(e) {
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: './php/delete.php',
            data: {user_id: $(this).attr('href'),
                   file_name_user: $(this).attr('id') },
            dataType: "html",
        }).done(function(data) {
            if (data == 'Ошибка удаления юзера') {
                alert(data);
            } else {
                location.reload();//перезагрузим страницу, чтоб увидеть что фотка удалилась
            };
        });
    });


});

