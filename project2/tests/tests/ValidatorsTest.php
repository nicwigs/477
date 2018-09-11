<?php
require __DIR__ . "/../../vendor/autoload.php";

/** @file
 * Empty unit testing template/database version
 * @cond 
 * Unit tests for the class
 */


class ValidatorsTest extends \PHPUnit_Extensions_Database_TestCase
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
        return $this->createFlatXMLDataSet(dirname(__FILE__) . '/db/validator.xml');

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
        $validator = new Enigma\Validators(self::$site);
        $this->assertInstanceOf('Enigma\Validators', $validator);
    }

    public function test_newValidator() {
        $validators = new Enigma\Validators(self::$site);

        $validator = $validators->newValidator('steve', 'steve@email.com');
        $this->assertEquals(32, strlen($validator));

        $table = $validators->getTableName();
        $sql = <<<SQL
select * from $table
where name=? and validator=?
SQL;

        $stmt = $validators->pdo()->prepare($sql);
        $stmt->execute(array('steve', $validator));
        $this->assertEquals(1, $stmt->rowCount());
    }


    public function test_get() {
        $validators = new Enigma\Validators(self::$site);

        // Test a not-found condition
        $this->assertNull($validators->get(""));

        // Create a validator
        $validator = $validators->newValidator('bob','bob@email.com');

        $row = $validators->get($validator);
        $this->assertEquals('bob@email.com', $row['email']);
        $this->assertEquals('bob', $row['name']);


        // Remove the validator for this user
        $validators->remove('bob@email.com');
        $this->assertNull($validators->get($validator));

        // Create two validators
        // Either can work.
        $validator1 = $validators->newValidator('joh','joh@email.com');
        $validator2 = $validators->newValidator('joh','joh@email.com');

        $row1= $validators->get($validator1);
        $this->assertEquals('joh@email.com', $row1['email']);
        $this->assertEquals('joh', $row1['name']);

        $row2= $validators->get($validator2);
        $this->assertEquals('joh@email.com', $row2['email']);
        $this->assertEquals('joh', $row2['name']);

        // Remove the validator for this user
        $validators->remove('joh@email.com');

        $this->assertNull($validators->get($validator1));
        $this->assertNull($validators->get($validator2));
    }




}

/// @endcond
