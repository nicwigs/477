<?php
require __DIR__ . "/../../vendor/autoload.php";


/** @file
 * Empty unit testing template/database version
 * @cond 
 * Unit tests for the class
 */
class EmailMock extends Enigma\Email {
    public function mail($to, $subject, $message, $headers)
    {
        $this->to = $to;
        $this->subject = $subject;
        $this->message = $message;
        $this->headers = $headers;
    }

    public $to;
    public $subject;
    public $message;
    public $headers;
}
class UsersTest extends \PHPUnit_Extensions_Database_TestCase
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
        $users = new Enigma\Users(self::$site);
        $this->assertInstanceOf('Enigma\Users', $users);
    }

    public function test_login() {
        $users = new Enigma\Users(self::$site);

        // Test a valid login based on email address
        $user = $users->login("dudess@dude.com", "87654321");
        $this->assertInstanceOf('Enigma\User', $user);

        // Test a valid login based on email address
        $user = $users->login("cbowen@cse.msu.edu", "super477");
        $this->assertInstanceOf('Enigma\User', $user);

        // Test a failed login
        $user = $users->login("dudess@dude.com", "wrongpw");
        $this->assertNull($user);

        //Test values getting set correctly
        $user = $users->login("cbowen@cse.msu.edu", "super477");
        $this->assertInstanceOf('Enigma\User', $user);
        $this->assertEquals(8,$user->getId());
        $this->assertEquals("cbowen@cse.msu.edu",$user->getEmail());
        $this->assertEquals("Owen, Charles",$user->getName());

    }

    public function test_get() {
        $users = new Enigma\Users(self::$site);

        // Test a valid get
        $user = $users->get(7);
        $this->assertInstanceOf('Enigma\User', $user);

        // Test a valid get
        $user = $users->get(10);
        $this->assertInstanceOf('Enigma\User', $user);

        // Test a failed get
        $user = $users->get(2);
        $this->assertNull($user);

        //Test values getting set correctly
        $user = $users->get(8);
        $this->assertInstanceOf('Enigma\User', $user);
        $this->assertEquals(8,$user->getId());
        $this->assertEquals("cbowen@cse.msu.edu",$user->getEmail());
        $this->assertEquals("Owen, Charles",$user->getName());

    }

    public function test_exists() {
        $users = new Enigma\Users(self::$site);

        $this->assertTrue($users->exists("dudess@dude.com"));
        $this->assertFalse($users->exists("dudess"));
        $this->assertFalse($users->exists("cbowen"));
        $this->assertTrue($users->exists("cbowen@cse.msu.edu"));
        $this->assertFalse($users->exists("nobody"));
        $this->assertFalse($users->exists("7"));
    }

    public function test_add() {
        $users = new Enigma\Users(self::$site);

        //$mailer = new Enigma\Email();
        //$mailer = new EmailMock();


        $user7 = $users->get(7);
        $this->assertContains("Email address already exists",
            $users->add($user7));

        $row = array('id' => 0,
            'email' => 'dude@ranch.com',
            'name' => 'Dude, The');
        $user = new Enigma\User($row);
        $users->add($user);

        $table = $users->getTableName();
        $sql = <<<SQL
select * from $table where email='dude@ranch.com'
SQL;

        $stmt = $users->pdo()->prepare($sql);
        $stmt->execute();
        $this->assertEquals(1, $stmt->rowCount());


    }
    public function test_sendEmail(){
        $users = new Enigma\Users(self::$site);

        $mailer = new EmailMock();

        $name = 'Ali';
        $email = 'Ali@gmail.com';

        $users->sendEmail($name,$email,$mailer);

        $this->assertEquals($email, $mailer->to);
        $this->assertEquals("Confirm your email", $mailer->subject);
    }

    public function test_setPassword() {
        $users = new Enigma\Users(self::$site);

        // Test a valid login based on user ID
        $user = $users->login("dudess@dude.com", "87654321");
        $this->assertNotNull($user);
        $this->assertEquals("Dudess, The", $user->getName());

        // Change the password
        $users->setPassword(7, "dFcCkJ6t");

        // Old password should not work
        $user = $users->login("dudess@dude.com", "87654321");
        $this->assertNull($user);

        // New password does work!
        $user = $users->login("dudess@dude.com", "dFcCkJ6t");
        $this->assertNotNull($user);
        $this->assertEquals("Dudess, The", $user->getName());
    }

    public function test_setPasswordviaEmail() {
        $users = new Enigma\Users(self::$site);

        // Test a valid login based on user ID
        $user = $users->login("dudess@dude.com", "87654321");
        $this->assertNotNull($user);
        $this->assertEquals("Dudess, The", $user->getName());

        // Change the password
        $users->setPasswordViaEmail("dudess@dude.com", "dFcCkJ6t");

        // Old password should not work
        $user = $users->login("dudess@dude.com", "87654321");
        $this->assertNull($user);

        // New password does work!
        $user = $users->login("dudess@dude.com", "dFcCkJ6t");
        $this->assertNotNull($user);
        $this->assertEquals("Dudess, The", $user->getName());
    }


}

/// @endcond
