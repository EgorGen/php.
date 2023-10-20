<?php

    require_once 'User.php';
    require_once 'FileUserPersist.php';

    session_start();
    if ($_SERVER['REQUEST_METHOD'] === 'POST'){

        $filePersist = new FileUserPersist();


        $user = $filePersist->get(strtolower($_POST['login']));
        $password = $filePersist->get($_POST['password']);


        if(!$user){
            header('Location: index.php?error=userNotFound');
            die();
        }

        if(!$password){
            header('Location: index.php?error=pswrNotFound');
            die();
        }

        if($user->getPassword() === sha1($_POST['password'])){
            session_start();

            $_SESSION['user'] = $user->getLogin();
        }
        
        header('Location: usercab.php');
        die();
    }
?>

<!doctype html>

<html>
<head>
<title>Заголовок страницы в браузере</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
<div class="container">
    <header class="d-flex justify-content-center py-3">
        <ul class="nav nav-pills">
            <li class="nav-item"><a href="#" class="nav-link">Тарифы</a></li>
            <li class="nav-item"><a href="#" class="nav-link">Новости</a></li>
            <li class="nav-item"><a href="#" class="nav-link">Техническая поддержка</a></li>
            <li class="nav-item"><a href="#" class="nav-link">Документы</a></li>
            <li class="nav-item"><a href="#" class="nav-link">Справка</a></li>
        </ul>
    </header>
</div>
    
    <?php if ($_SERVER['REQUEST_METHOD'] === 'GET') { ?>
    <form action="" method="POST">
    <h1 title="Форма регистрации">авторизация<h1>
        <div class="mb-3">
            <label for="LoginInput">Логин</label>
            <input type="text" class="form-control"  name='login' id="LoginInput" placeholder="Введите свой логин">
        </div>

        <div class="mb-3">
            <label for="passwordInput">Пароль</label>
            <input type="password" class="form-control" name='password' id="passwordInput" placeholder="Введите свой пароль">
        </div>
        
        <div class="error">
            <?php
                if(isset($_GET['error']) && 'userNotFound' === $_GET['error']){
                    echo 'Некоректный логин';
                }
                if(isset($_GET['error']) && 'pswrNotFound' === $_GET['error']){
                    echo 'Некоректный пароль';
                }  
            ?>
        </div>
        <center><button>Войти</button></center>
        <p>
            У вас нет аккаунта? - <a href="/public/register.php">зарегистрируйтесь!</a>
        </p>
    </form>
        <?php
    }
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>
</html>