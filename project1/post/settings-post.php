<?php
/**
 * Created by PhpStorm.
 * User: nicwiggins
 * Date: 6/8/18
 * Time: 12:22 AM
 */

require_once "../lib/enigma.inc.php";
//print_r($_POST);

$controller = new \Enigma\SettingsController($system, $_POST);
//echo $controller->showRedirect();
header("location: " . $controller->getRedirect());