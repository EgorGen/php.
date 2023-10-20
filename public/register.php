<?php

    require_once 'User.php';
    require_once 'FileUserPersist.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST'){
        $user = new User((string) $_POST['login'], (string) $_POST['password'], (string) $_POST['password2'], (string) $_POST['address'], (string) $_POST['email'], (string) $_POST['number']);
        if ($user -> isPassworsEquals()) {
            $filePersist = new FileUserPersist();

            if($filePersist->get($_POST['login']) instanceof User) {
                header('Location: register.php?error=userAllreadyExist');
                die();
            }

            session_start();

            $_SESSION['user'] = $user->getLogin();
            
            header('Location: usercab.php');
            $filePersist->save($user);

            
        } else {
            header('Location: register.php?error=passwordsAreDifferent');
            die();
        }
    }
?>


<!doctype html>

<html>
<head>
    <title>Заголовок страницы в браузере</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/style2.css">
</head>

<body>

    <?php if ($_SERVER['REQUEST_METHOD'] === 'GET') { ?>
    <form action="" method="post">
    <h1 title="Форма регистрации">Регистрация<h1>
        <div class="mb-3">
            <label for="LoginInput">Логин</label>
            <input type="text" class="form-control" name='login' id="LoginInput" placeholder='Введите логин'>
        </div>

        <div class="mb-3">
            <label for="password-field1">Пароль</label>
            <input type="password" class="form-control" name='password' id="password-field1" placeholder="Введите свой пароль">
        </div>

        <div class="mb-3">
            <label type="password-field2">Подтверждение пароля</label>
            <input type="password" class="form-control"  name="password2" id="password-field2" placeholder="Подтвердите пароль">
        </div>

        <div class="mb-3">
            <label for="address-field1" class="form-label">Адрес доставки</label>
            <input type="text" class="form-control" name="address" id="address-field1" placeholder="Адрес доставки">
        </div>

        <div class="mb-3">
            <label for="mailInput" class="form-label">Адрес электронной почты</label>
            <input type="email" class="form-control" name="email" id="mailInput" placeholder="Адрес электронной почты" >
        </div>

        <div class="mb-3">
            <label for="number-phone" class="form-label">Номер телефона</label>
            <input type="text" class="form-control" name="number" id="nuber-phone"  placeholder="Номер телефона" >
        </div>


        <div class="error">
            <?php
                if(isset($_GET['error']) && 'passwordsAreDifferent' === $_GET['error']){
                    echo 'Пароли не совпабают';
                }

                if(isset($_GET['error']) && 'userAllreadyExist' === $_GET['error']){
                    echo 'Пользователь с таким логином уже существует';
                }
            ?>
        </div>
        <center><button>Зарегистрировать</button></center>
        <p>
            У вас уже есть аккаунт? - <a href="/index.php">авторизируйтесь!</a>
        </p>
    </form>
        <?php
    }
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>
</html>