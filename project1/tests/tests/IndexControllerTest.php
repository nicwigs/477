<?php
require __DIR__ . "/../../vendor/autoload.php";

/** @file
 * Empty unit testing template
 * @cond 
 * Unit tests for the class
 */
use Enigma\System as System;

class IndexControllerTest extends \PHPUnit_Framework_TestCase
{
	public function test_invalids() {
		$system = new System();
		$this->assertEquals(System::NONAME, $system->check());

		$system->name('');
		$this->assertEquals(System::INVALID,$system->check());
        $this->assertEquals('', $system->getName());

        $system->name('     ');
        $this->assertEquals(System::INVALID,$system->check());
        $this->assertEquals('     ', $system->getName());

        $system->name('Nic');
        $this->assertEquals(System::VALID,$system->check());
        $this->assertEquals('Nic', $system->getName());
	}
}

/// @endcond
