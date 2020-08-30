<?php 
use app\{Admin,Connection};
require_once '../vendor/autoload.php';

error_reporting(E_ALL | E_STRICT);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);

$con = new Connection();
$con->Connect();

$taskId = $_POST['taskId'];

$password = null;
$login = null;
$newStatus = new Admin($login,$password,$con->pdo);
$newStatus->DeleteTask($taskId);