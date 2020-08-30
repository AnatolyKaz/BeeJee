<?php
// use app\{Admin,Connection};
// require_once '../vendor/autoload.php';
require 'Twigtemplate.php';

if (isset($_COOKIE['login'])) {
  $coockie = $_COOKIE['login'];
}else {
  $coockie = '';
}
// $con = new Connection();
// $con->Connect();
////===========EditTask((((
// $taskId = $_POST['taskId'];
// $login = null;
// $password = null;
// $editTask = new Admin($login,$password,$con->pdo);
// $renderEditTask = $editTask->GetTask($taskId);

$template =  $twig->load('auth.html');
echo $template->render(array('coockie'=>$coockie)) ;

?>
