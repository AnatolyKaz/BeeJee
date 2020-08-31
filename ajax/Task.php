<?php 
use app\{User,Connection};
require_once '../vendor/autoload.php';


$con = new Connection();
$con->Connect();

$UserName = null;
$UserMail = null;
$taskText = null;


$taskList = new User($UserName,$UserMail,$taskText,$con->pdo);
/////=====================pagination
if (isset($_POST['downEdge'])) {
    $downEdge = $_POST['downEdge'];
} else {
    $downEdge = 0;
}
$sql = "SELECT * FROM `tasksList` LIMIT $downEdge ,3 ";
/////========================Sort =======
if (isset($_POST['sortStatus'])) {
    
    $sortStatus = $_POST['sortStatus'];
    if ($sortStatus == 'sortNameButton') {
        $sql = "SELECT * FROM `tasksList` ORDER BY `userName` ASC LIMIT $downEdge ,3 ";
    }
    if ($sortStatus == 'sortEmailButton') {
        $sql = "SELECT * FROM `tasksList` ORDER BY `email` ASC LIMIT $downEdge ,3";
    }
    if ($sortStatus == 'sortStatusButton') {
        $sql = "SELECT * FROM `tasksList` ORDER BY `taskStatus` DESC LIMIT $downEdge ,3 ";
    }
}
$taskList->TaskList($sql);











