<?php 
use app\{User,Connection};
require_once '../vendor/autoload.php';

$con = new Connection();
$con->Connect();


$UserName = trim(filter_var($_POST['UserName'],FILTER_SANITIZE_STRING));
$UserMail = trim(filter_var($_POST['UserMail'],FILTER_VALIDATE_EMAIL));
$taskText = trim(filter_var($_POST['taskText'],FILTER_SANITIZE_STRING));
$error = '';
if (strlen($UserName) <= 3)
    $error = 'Введите Имя!';
else if (strlen($UserMail) <= 5)
    $error = ' E-Mail невалиден!';
else if (strlen($taskText) <= 5)
    $error = 'Введите текст задания!';

        if ($error != ''){
            echo $error;
            exit();
        } 

    

        $task = new User ($UserName, $UserMail, $taskText , $con->pdo);
        $task->InsertTask();
