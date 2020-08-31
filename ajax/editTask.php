<?php 
use app\{Admin,Connection};
require_once '../vendor/autoload.php';


$con = new Connection();
$con->Connect();

$taskId = $_POST['taskId'];
$editText = trim(filter_var($_POST['editText'],FILTER_SANITIZE_STRING));

$login = null;
$password = null;
$editTask = new Admin($login,$password,$con->pdo);
$editTask->SaveEditText($taskId,$editText);