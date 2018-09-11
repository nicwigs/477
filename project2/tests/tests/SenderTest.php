<?php
require __DIR__ . "/../../vendor/autoload.php";

/** @file
 * Empty unit testing template
 * @cond 
 * Unit tests for the class
 */
class SenderTest extends \PHPUnit_Framework_TestCase
{
    public function test_constructor(){
        $sender = new Enigma\Sender();

        $this->assertEquals(array(), $sender->getRecipients());

        $sender->addRecipients(11);
        $sender->addRecipients(12);

        $this->assertEquals(array(11=>11,12=>12), $sender->getRecipients());

        $sender->removeRecipient(12);
        $this->assertEquals(array(11=>11), $sender->getRecipients());

        $sender->addRecipients(11);
        $sender->addRecipients(11);
        $sender->addRecipients(11);

        $sender->removeRecipient(11);
        $this->assertEquals(array(), $sender->getRecipients());



    }
}

/// @endcond
