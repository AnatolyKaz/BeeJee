<?php 
use app\{User,Connection};
require_once '../vendor/autoload.php';

$con = new Connection();
$con->Connect();


$UserName = trim(filter_var($_POST['UserName'],FILTER_SANITIZE_STRING));
$UserMail = trim(filter_var($_POST['UserMail'],FILTER_SANITIZE_STRING));
$taskText = trim(filter_var($_POST['taskText'],FILTER_SANITIZE_STRING));
$error = '';
if (strlen($UserName) <= 3)
    $error = 'Введите Имя!';
else if (strlen($UserMail) <= 5)
    $error = 'Введите E-Mail!';
else if (strlen($taskText) <= 10)
    $error = 'Введите текст задания!';

        if ($error != ''){
            echo $error;
            exit();
        } 

    

        $task = new User ($UserName, $UserMail, $taskText , $con->pdo);
        $task->InsertTask();
