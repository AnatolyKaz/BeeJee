<?php
use app\{Admin,Connection};


require_once '../vendor/autoload.php';

$con = new Connection();
$con->Connect();

$login = trim(filter_var($_POST['login'],FILTER_SANITIZE_STRING));
$password = trim(filter_var($_POST['password'],FILTER_SANITIZE_STRING));

$error = '';
        if (strlen($login) <= 3)
            $error = 'Введите логин!';
        else if (strlen($password) <= 2)
            $error = 'Введите пароль!';

                if ($error != ''){
                    echo $error;
                    exit();
                } 

$AuthAdmin = new Admin($login, $password ,$con->pdo);

$AuthAdmin->Authorization();
