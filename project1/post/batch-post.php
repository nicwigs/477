<?php
/**
 * Created by PhpStorm.
 * User: nicwiggins
 * Date: 6/8/18
 * Time: 3:50 AM
 */

require_once "../lib/enigma.inc.php";
//print_r($_POST);

$controller = new \Enigma\BatchController($system, $_POST);
//echo $controller->showRedirect();
header("location: " . $controller->getRedirect());