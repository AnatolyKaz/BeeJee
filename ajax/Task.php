<?php 
use app\{User,Connection};
require_once '../vendor/autoload.php';

error_reporting(E_ALL | E_STRICT);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);

$con = new Connection();
$con->Connect();

$UserName = null;
$UserMail = null;
$taskText = null;

$taskList = new User($UserName,$UserMail,$taskText,$con->pdo);

$taskList->TaskList();
