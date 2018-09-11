<?php
/**
 * Created by PhpStorm.
 * User: nicwiggins
 * Date: 6/7/18
 * Time: 8:01 PM
 */

require_once "../lib/enigma.inc.php";
$controller = new \Enigma\EnigmaController($system, $_POST);
$view = new Enigma\EnigmaView($system);

$rotors = $view->present_rotors();                  //we update rotor html
$lit = strtolower($system->isLit());                //what light do we illuminate?

$result = json_encode(array('rotors' => $rotors, 'lit' => $lit));
echo $result;