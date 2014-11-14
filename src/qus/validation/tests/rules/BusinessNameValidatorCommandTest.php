<?php
namespace qus\validation\tests\rules;

require_once  DIRECTORY_SEPARATOR . 'tests' . DIRECTORY_SEPARATOR . "testinit.php";

use qus\validation\rules\BusinessNameValidatorCommand;
use qus\validation\core\ValidationItem;
 
class BusinessNameValidatorCommandTest extends \PHPUnit_Framework_TestCase
{
	
	 
	 
    public function testOnCommand() {
        // make an instance of the Validator Command
        $command = new BusinessNameValidatorCommand();
		$validString = "Dave's company - (200 years of quality service!)";
		$invalidString = '<script>@$delete something</script>';
		
 		$object = new ValidationItem($invalidString); 		
 
 		//first pass in a different command type to check if this is the command we need (false)
 		$result = $command->onCommand('anythinghere', $object); 
 		$this->assertFalse($result);
		
		//now pass in a valid command parameter to begin executing the tests
		$result = $command->onCommand('validatebusiness', $object); 
 		$this->assertTrue($result);
		
		//now lets start looking at the object flags after validation
		//this should have failed the initial 'invalidAddress' test
		$this->assertFalse(is_null($object));
		$this->assertFalse($object->getIsValid());
		
		//now let's pass in an empty string - we don't care if it NEEDS to be there,
		//we only care that IF there is something, it is valid
		$object = new ValidationItem(''); 	
		$command->onCommand('validatebusiness', $object); 		
		$this->assertTrue($object->getIsValid());
		
		//now let's pass in a valid address
		$object = new ValidationItem($validString); 	
		$command->onCommand('validatebusiness', $object); 		
		$this->assertTrue($object->getIsValid());
    }
	
}