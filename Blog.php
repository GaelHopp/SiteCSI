<?php


session_start();


include "BlogController.php";

$controle = new BlogController();

$controle->analyse();

?>
