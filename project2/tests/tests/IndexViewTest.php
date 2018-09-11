<?php
require __DIR__ . "/../../vendor/autoload.php";

/** @file
 * Empty unit testing template
 * @cond 
 * Unit tests for the class
 */
use Enigma\System as System;
use Enigma\IndexView as IndexView;


class IndexViewTest extends \PHPUnit_Framework_TestCase
{
	public function test_view() {
        $system = new System();
        $view = new IndexView($system);

        $system->name('');
        $this->assertContains('<p>You must enter a name!</p>',$view->present_body());


	}
}

/// @endcond
