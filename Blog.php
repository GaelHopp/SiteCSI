<?php


session_start();
//session_unset();

include_once "BlogController.php";

$controle = new BlogController();

$controle->analyse();

?>
