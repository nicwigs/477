<?php
require __DIR__ . "/../../vendor/autoload.php";

/** @file
 * Empty unit testing template
 * @cond 
 * Unit tests for the class
 */

use Enigma\BatchController as BatchController;
use Enigma\System as System;

class BatchControllerTest extends \PHPUnit_Framework_TestCase
{
	public function test_encode() {
        $system = new System();
        $bc = new BatchController($system,array());

        $this->assertEquals('CSEVIERSIEBENSIEBENRULESX',$bc->prepare("CSE477 Rules."));
        $system->encode('CSEVIERSIEBENSIEBENRULESX');
        $this->assertEquals("QXCYD NNFJC ITTNZ NLZYV TBTPI",$system->getEncoded());

        $system->reset();
        $system->decode("QXCYDNNFJCITTNZNLZYVTBTPI");
        $this->assertEquals("CSEVI ERSIE BENSI EBENR ULESX",$system->getDecoded());

    }
}

/// @endcond
