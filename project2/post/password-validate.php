<?php
$open = true;		// Can be accessed when not logged in
require '../lib/enigma.inc.php';

//echo "<pre>";
//print_r($_POST);
//echo "</pre>";

$controller = new Enigma\PasswordValidateController($site,$_SESSION,$_POST);
header("location: " . $controller->getRedirect());
//echo '<a href="' . $controller->getRedirect() . '">' .$controller->getRedirect() . '</a>';
