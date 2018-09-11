<?php
require __DIR__ . "/../../vendor/autoload.php";

/** @file
 * Empty unit testing template
 * @cond 
 * Unit tests for the class
 */
use Enigma\Cell as Cell;

class CellTest extends \PHPUnit_Framework_TestCase
{
	public function test_cell() {
        $cell = new Cell('A');

        $this->assertEquals('A',$cell->getLetter());
        $this->assertEquals(false,$cell->isLit());
        $this->assertEquals(false,$cell->isPressed());

        $cell->light();
        $this->assertEquals(true,$cell->isLit());
        $this->assertEquals(false,$cell->isPressed());

        $cell->press();
        $this->assertEquals(true,$cell->isLit());
        $this->assertEquals(true,$cell->isPressed());
	}
}

/// @endcond
