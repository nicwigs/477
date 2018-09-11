<?php
/**
 * Created by PhpStorm.
 * User: nicwiggins
 * Date: 6/6/18
 * Time: 11:11 PM
 */

require_once "../lib/enigma.inc.php";
$controller = new \Enigma\IndexController($system, $_POST);
//echo $controller->showRedirect();
header("location: " . $controller->getRedirect());