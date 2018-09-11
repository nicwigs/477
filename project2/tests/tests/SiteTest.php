<?php
require __DIR__ . "/../../vendor/autoload.php";

/** @file
 * Empty unit testing template
 * @cond 
 * Unit tests for the class
 */
class SiteTest extends \PHPUnit_Framework_TestCase
{
	public function test_basic() {
        $site = new Enigma\Site();

        $this->assertEquals('',$site->getEmail());
        $this->assertEquals('',$site->getTablePrefix());
        $this->assertEquals('',$site->getRoot());

        $site->setEmail('email@email.com');
        $this->assertEquals('email@email.com',$site->getEmail());

        $site->setRoot('root');
        $this->assertEquals('root',$site->getRoot());

        $site->dbConfigure('google','me','mypassword','testingprefix');
        $this->assertEquals('testingprefix',$site->getTablePrefix());

	}
    public function test_localize() {
        $site = new Enigma\Site();
        $localize = require 'localize.inc.php';
        if(is_callable($localize)) {
            $localize($site);
        }
        $this->assertEquals('testp2_', $site->getTablePrefix());
    }
}

/// @endcond
