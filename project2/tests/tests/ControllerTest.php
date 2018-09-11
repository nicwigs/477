<?php
require __DIR__ . "/../../vendor/autoload.php";

/** @file
 * Empty unit testing template
 * @cond 
 * Unit tests for the class
 */
use Enigma\System as System;
use Enigma\Enigma as Enigma;
use Enigma\Controller as Controller;

class ControllerTest extends \PHPUnit_Framework_TestCase
{
    public function test_construct() {
        $system = new System();
        $controller = new Controller($system);

        $this->assertInstanceOf('Enigma\Controller',$controller );
    }
}

/// @endcond
