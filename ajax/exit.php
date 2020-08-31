<?php
use app\{Admin,Connection};
require_once '../vendor/autoload.php';

$con = new Connection();
$con->Connect();

$login  = null;
$password  = null;
$pdo = null;

$ExitAdmin = new Admin($login, $password ,$con->pdo);

$ExitAdmin->Exit();
