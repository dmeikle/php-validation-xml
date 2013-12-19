<?php
namespace tests\validation\rules;

require_once  DIRECTORY_SEPARATOR . 'tests' . DIRECTORY_SEPARATOR . "testinit.php";

use validation\rules\AddressValidatorCommand;
use validation\ValidationItem;
 
class AddressValidatorCommandTest extends \PHPUnit_Framework_TestCase
{
	
	 
	 
    public function testOnCommand() {
        // make an instance of the Validator Command
        $command = new AddressValidatorCommand();
 		$object = new ValidationItem();
 		
 
 		$result = $command->onCommand('anythinghere', $object);
 
 		$this->assertFalse($result);
		
        // use assertEquals to ensure the greeting is what you
        // $expected = "Hello world1!";
        // $actual = $user->talk();
        // $this->assertEquals($expected, $actual);
    }
	
}