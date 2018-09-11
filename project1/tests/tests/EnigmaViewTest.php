<?php
require __DIR__ . "/../../vendor/autoload.php";

/** @file
 * Empty unit testing template
 * @cond 
 * Unit tests for the class
 */

use Enigma\System as System;
use Enigma\EnigmaView as EnigmaView;

class EnigmaViewTest extends \PHPUnit_Framework_TestCase
{

    public function test_selected(){
        $system = new System();
        $view = new EnigmaView($system);

        $system->setActive('A');
        $ans = '<div class="key key-a pressed ">';
        $this->assertContains($ans, $view->present_body());

        $ans2 = '<div class="key key-b ">';
        $this->assertContains($ans2, $view->present_body());

        $system ->setActive('B');
        $ans = '<div class="key key-b pressed ">';
        $this->assertContains($ans, $view->present_body());

        $ans2 = '<div class="key key-a ">';
        $this->assertContains($ans2, $view->present_body());
    }
}

/// @endcond
