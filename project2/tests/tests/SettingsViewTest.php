<?php
require __DIR__ . "/../../vendor/autoload.php";

/** @file
 * Empty unit testing template
 * @cond 
 * Unit tests for the class
 */
use Enigma\System as System;
use Enigma\SettingsView as SettingsView;

class SettingsViewTest extends \PHPUnit_Framework_TestCase
{
	public function test_view() {
		$system = new System();
		$sv = new SettingsView($system);

		$ans = '<p class="wheel wheel-s wheel-1">A</p>';

        $this->assertContains($ans,$sv->present_body());

    }
}

/// @endcond
