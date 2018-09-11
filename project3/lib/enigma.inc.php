<?php
/**
 * Created by PhpStorm.
 * User: nicwiggins
 * Date: 6/6/18
 * Time: 10:36 PM
 */

require __DIR__ . "/../vendor/autoload.php";

// Start the PHP session system
session_start();
define("SYSTEM", 'system');

// If there is a System session, use that. Otherwise, create one
if(!isset($_SESSION[SYSTEM])) {
    $_SESSION[SYSTEM] = new Enigma\System();
}

$system = $_SESSION[SYSTEM];
