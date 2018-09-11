<?php
/**
 * Created by PhpStorm.
 * User: nicwiggins
 * Date: 6/7/18
 * Time: 8:01 PM
 */

require_once "../lib/enigma.inc.php";
//print_r($_POST);
$controller = new \Enigma\EnigmaController($system, $_POST);
//echo $controller->showRedirect();
header("location: " . $controller->getRedirect());