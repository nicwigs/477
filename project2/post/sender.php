<?php
require '../lib/enigma.inc.php';

//echo "<pre>";
//print_r($_POST);
//print_r($system);
//echo "</pre>";

$controller = new Enigma\SenderController($system, $_POST,$site,$user);
header("location: " . $controller->getRedirect());
//echo '<a href="' . $controller->getRedirect() . '">' .$controller->getRedirect() . '</a>';
