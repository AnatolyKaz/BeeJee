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
$sql = "SELECT * FROM `tasksList` ORDER BY `taskId` DESC ";
/////========================Sort =======
if (isset($_POST['sortStatus'])) {
    $statusClicked =  $_POST['statusClicked'];
    $sortStatus = $_POST['sortStatus'];
    if ($sortStatus == 'sortNameButton') {
        if ($statusClicked == 1) {
            $sql = "SELECT * FROM `tasksList` ORDER BY `userName` ASC ";
        }else {
            $sql = "SELECT * FROM `tasksList` ORDER BY `userName` DESC ";
        }
        
    }
    if ($sortStatus == 'sortEmailButton') {
        if ($statusClicked == 1) {
            $sql = "SELECT * FROM `tasksList` ORDER BY `email` ASC";
        }else {
            $sql = "SELECT * FROM `tasksList` ORDER BY `email` DESC";
        }
        
    }
    if ($sortStatus == 'sortStatusButton') {
        if ($statusClicked == 1) {
            $sql = "SELECT * FROM `tasksList` ORDER BY `taskStatus` DESC ";
        }else {
            $sql = "SELECT * FROM `tasksList` ORDER BY `taskStatus` ASC ";
        }
        
    }
}
$taskList->TaskList($sql);











