<?php


session_start();


include_once "BlogController.php";

$controle = new BlogController();

$controle->analyse();

?>
