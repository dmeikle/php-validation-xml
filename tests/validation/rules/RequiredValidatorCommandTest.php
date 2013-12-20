<?php
namespace tests\validation\rules;

require_once  DIRECTORY_SEPARATOR . 'tests' . DIRECTORY_SEPARATOR . "testinit.php";

use validation\rules\RequiredValidatorCommand;
use validation\core\ValidationItem;
 
class RequiredValidatorCommandTest extends \PHPUnit_Framework_TestCase
{
	
	 
	 
    public function testOnCommand() {
        // make an instance of the Validator Command
        $command = new RequiredValidatorCommand();
		$validString1 = 'anything can go in here';
		$validString2 = '<script>@$delete something</script> is still valid for this';
		$invalidString = '';
		
 		$object = new ValidationItem($invalidString); 		
 
 		//first pass in a different command type to check if this is the command we need (false)
 		$result = $command->onCommand('anythinghere', $object); 
 		$this->assertFalse($result);
		
		//now pass in a valid command parameter to begin executing the tests
		$result = $command->onCommand('validateRequired', $object); 
 		$this->assertTrue($result);
		
		
		//now let's pass in an empty string - we don't care if it NEEDS to be there,
		//we only care that IF there is something, it is valid
		$this->assertFalse(is_null($object));
		$this->assertFalse($object->getIsValid());
		
		
		
		//now let's pass in a valid string
		$object = new ValidationItem($validString1); 	
		$command->onCommand('validateRequired', $object); 		
		$this->assertTrue($object->getIsValid());
		
		
		$object = new ValidationItem($validString2); 	
		$command->onCommand('validateRequired', $object); 		
		$this->assertTrue($object->getIsValid());
    }
	
}