<?php
use app\{Admin,Connection};

require_once '../vendor/autoload.php';

$con = new Connection();
$con->Connect();

$taskId = $_POST['taskId'];

$password = null;
$login = null;
$newStatus = new Admin($login,$password,$con->pdo);
$newStatus->NewStatus($taskId);


