<?php 
use app\{Admin,Connection};
require_once '../vendor/autoload.php';


$con = new Connection();
$con->Connect();

$login = null;
$password = null;
$editTask = new Admin($login,$password,$con->pdo);
$editTask->EditTaskList();