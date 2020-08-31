<?php
require 'Twigtemplate.php';

if (isset($_COOKIE['login'])) {
  $coockie = $_COOKIE['login'];
}else {
  $coockie = '';
}

$template =  $twig->load('auth.html');
echo $template->render(array('coockie'=>$coockie)) ;

?>
