<?php
require __DIR__ . "/../../vendor/autoload.php";

/** @file
 * Empty unit testing template
 * @cond 
 * Unit tests for the class
 */
use Enigma\SettingsController as SettingsController;
use Enigma\System as System;

class SettingsControllerTest extends \PHPUnit_Framework_TestCase
{
	public function test_construct() {
        $system = new System();
        $p1 = array('rotor-1'=>1, 'initial-1'=>'9', 'rotor-2'=> 5, 'initial-2'=>'A','rotor-3'=>3,'initial-3'=>'A','set'=>'Set');

        $c = new SettingsController($system,$p1);
        $this->assertContains('Please enter letter A -> Z',$system->getSettingsErrors());
	}
}

/// @endcond
