<?php
/**
 * Created by PhpStorm.
 * User: nicwiggins
 * Date: 6/6/18
 * Time: 10:36 PM
 */

require __DIR__ . "/../vendor/autoload.php";

$site = new Enigma\Site();
$localize = require 'localize.inc.php';
if(is_callable($localize)) {
    $localize($site);
}

// Start the PHP session system
session_start();
define("SYSTEM", 'system');

// If there is a System session, use that. Otherwise, create one
if(!isset($_SESSION[SYSTEM])) {
    $_SESSION[SYSTEM] = new Enigma\System();
}

$user = null;
if(isset($_SESSION[Enigma\User::SESSION_NAME])) {
    $user = $_SESSION[Enigma\User::SESSION_NAME];
}
// redirect if user is not logged in
if(!isset($open) && $user === null) {
    $root = $site->getRoot();
    header("location: $root/");
    exit;
}

$system = $_SESSION[SYSTEM];
