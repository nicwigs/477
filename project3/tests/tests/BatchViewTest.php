<?php
require __DIR__ . "/../../vendor/autoload.php";

/** @file
 * Empty unit testing template
 * @cond 
 * Unit tests for the class
 */

use Enigma\System as System;
use Enigma\BatchView as BatchView;
class BatchViewTest extends \PHPUnit_Framework_TestCase
{
	public function test_textarea() {
        $system = new System();
        $bv = new BatchView($system);

        $system->encode('CSEVIERSIEBENSIEBENRULESX');
        $this->assertContains("QXCYD NNFJC ITTNZ NLZYV TBTPI</textarea>",$bv->present_body());
	}
}

/// @endcond
