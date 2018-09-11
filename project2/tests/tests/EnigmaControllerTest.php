<?php
require __DIR__ . "/../../vendor/autoload.php";

/** @file
 * Empty unit testing template
 * @cond 
 * Unit tests for the class
 */

use Enigma\EnigmaController as EnigmaController;
use Enigma\System as System;

class EnigmaControllerTest extends \PHPUnit_Framework_TestCase
{
    public function test_construct() {
        $system = new System();
        $controller = new EnigmaController($system, array());

        $this->assertInstanceOf('Enigma\EnigmaController',$controller );
    }
}

/// @endcond
