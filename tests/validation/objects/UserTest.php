<?php
namespace tests\objects;

require_once  DIRECTORY_SEPARATOR . 'tests' . DIRECTORY_SEPARATOR . "testinit.php";

use objects\User;

 
class UserTest extends \PHPUnit_Framework_TestCase
{
	
	 // test the talk method
    public function testTalk() {
        // make an instance of the user
        $user = new User();
 
        // use assertEquals to ensure the greeting is what you
        $expected = "Hello world1!";
        $actual = $user->talk();
        $this->assertEquals($expected, $actual);
    }
	
}