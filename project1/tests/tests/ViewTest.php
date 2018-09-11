<?php
require __DIR__ . "/../../vendor/autoload.php";

/** @file
 * Empty unit testing template
 * @cond 
 * Unit tests for the class
 */
use Enigma\System as System;
use Enigma\Enigma as Enigma;
use Enigma\View as View;

class ViewTest extends \PHPUnit_Framework_TestCase
{
    public function getView(){
        $system = new System();
        $view = new View($system);

        return $view;
    }
    public function test_construct() {
        $view = $this->getView();

        $this->assertInstanceOf('Enigma\View',$view );
    }

    public function test_get(){
        $view = $this->getView();

        $this->assertInstanceOf('Enigma\System',$view->getSystem() );

    }

    public function test_present_header(){
        $view = $this->getView();

        $html = <<<HTML
<nav><ul><li class="selected"><a href="enigma.php">Enigma</a></li><li><a href="settings.php">Settings</a></li><li><a href="batch.php">Batch</a></li><li><a href="./">Ausloggen</a></li></ul></nav>
HTML;
        $header = $view->present_header();
        $this->assertContains($html,$header);
    }

    public function test_present_footer(){
        $view = $this->getView();

        $html = <<<HTML
<p class="center"><img src="images/banner1-800.png" width="800" height="100" alt="Footer image"/></p>
HTML;
        $footer = $view->present_footer();
        $this->assertContains($html,$footer);
    }

    public function test_head(){
        $view = $this->getView();

        $html = <<<HTML
<link href="enigma.css" type="text/css" rel="stylesheet" />
HTML;
        $head = $view->head();
        $this->assertContains($html,$head);


    }
    public function test_present(){
        $view = $this->getView();

        $html_h = <<<HTML
<nav><ul><li class="selected"><a href="enigma.php">Enigma</a></li><li><a href="settings.php">Settings</a></li><li><a href="batch.php">Batch</a></li><li><a href="./">Ausloggen</a></li></ul></nav>
HTML;
        $html_f = <<<HTML
<p class="center"><img src="images/banner1-800.png" width="800" height="100" alt="Footer image"/></p>
HTML;
        $all = $view->present();
        $this->assertContains($html_h,$all);
        $this->assertContains($html_f,$all);


    }
}

/// @endcond
