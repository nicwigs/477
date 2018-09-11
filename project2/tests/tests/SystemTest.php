<?php
require __DIR__ . "/../../vendor/autoload.php";

/** @file
 * Empty unit testing template
 * @cond 
 * Unit tests for the class
 */
use Enigma\System as System;
use Enigma\Enigma as Enigma;

class SystemTest extends \PHPUnit_Framework_TestCase
{
	public function test_construct() {
	    $system = new System();
        $this->assertInstanceOf('Enigma\System',$system );
        $this->assertInstanceof('Enigma\Sender',$system->getSender());
	}

	public function test_press(){
	    $system = new System();

	    $this->assertEquals(null,$system->getActive());
	    $this->assertEquals(null,$system->isLit());

	    $system->setActive('A');
        $this->assertEquals('A',$system->getActive());
        $this->assertEquals(true,$system->getCells()['A']->isPressed());

        $system->setActive('B');
        $this->assertEquals('B',$system->getActive());
        $this->assertEquals(false,$system->getCells()['A']->isPressed());
        $this->assertEquals(true,$system->getCells()['B']->isPressed());


    }
}

/// @endcond
