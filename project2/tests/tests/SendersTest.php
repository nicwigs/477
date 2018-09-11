<?php
require __DIR__ . "/../../vendor/autoload.php";


/** @file
 * Empty unit testing template/database version
 * @cond 
 * Unit tests for the class
 */

class SendersTest extends \PHPUnit_Extensions_Database_TestCase
{
	/**
     * @return PHPUnit_Extensions_Database_DB_IDatabaseConnection
     */
    public function getConnection()
    {

        return $this->createDefaultDBConnection(self::$site->pdo(), 'wiggin63');
    }

    /**
     * @return PHPUnit_Extensions_Database_DataSet_IDataSet
     */
    public function getDataSet()
    {
        //return new PHPUnit_Extensions_Database_DataSet_DefaultDataSet();

        return $this->createFlatXMLDataSet(dirname(__FILE__) . '/db/user.xml');

        //return $this->createFlatXMLDataSet(dirname(__FILE__) . 
		//	'/db/users.xml');
    }

    private static $site;

    public static function setUpBeforeClass() {
        self::$site = new Enigma\Site();
        $localize  = require 'localize.inc.php';
        if(is_callable($localize)) {
            $localize(self::$site);
        }
    }

    public function test_construct() {
        $senders = new Enigma\Senders(self::$site);
        $this->assertInstanceOf('Enigma\Senders', $senders);
    }

    public function test_sendMessage(){
        $senders = new Enigma\Senders(self::$site);

        $sender = new Enigma\Sender();
        $sender->setCode('AWE');
        $sender->setMessage('this is not a real message');
        $sender->setSenderID(9);

        $sender->addRecipients(17);
        $sender->addRecipients(56);
        $sender->addRecipients(82);


        $senders->sendMessage($sender);

        $receivers = new Enigma\Receivers(self::$site);
        $msgs = $receivers->fetchMessages(56);
        $msg = $msgs[0];
        $this->assertEquals(9,$msg['userid']);
        $this->assertEquals('this is not a real message',$msg['message']);
        $this->assertEquals('AWE',$msg['code']);
        $this->assertEquals("Simpson, Bart", $msg['name']);

        $msg = $receivers->fetchMessage(8);
        $this->assertEquals('AWE',$msg['code']);
        $this->assertEquals('this is not a real message', $msg['message']);



    }




}

/// @endcond
