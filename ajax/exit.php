<?php
use app\{Admin,Connection};

// error_reporting(E_ALL | E_STRICT);
// ini_set('display_errors', TRUE);
// ini_set('display_startup_errors', TRUE);
require_once '../vendor/autoload.php';

$con = new Connection();
$con->Connect();

$login  = null;
$password  = null;
$pdo = null;

$ExitAdmin = new Admin($login, $password ,$con->pdo);

$ExitAdmin->Exit();
