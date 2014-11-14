<?php
namespace qus\validation\tests\rules;

require_once  DIRECTORY_SEPARATOR . 'tests' . DIRECTORY_SEPARATOR . "testinit.php";

use qus\validation\rules\StringValidatorCommand;
use qus\validation\core\ValidationItem;
 
class StringValidatorCommandTest extends \PHPUnit_Framework_TestCase
{
	
	 
	 
    public function testOnCommand() {
        // make an instance of the Validator Command
        $command = new StringValidatorCommand();
		$validString1 = 'this is a valid string with letters and spaces only';
		$validString2 = 'thisisavalidstringwithlettersonly';
		$validString3 = "sometimes Irish people are named O'Reilly";
		$validString4 = "sometimes married people take on a second last name like smith-Jones";
		$invalidString1 = '<script>@$delete something</script>';
		$invalidString2 = '123';
		
		
 		$object = new ValidationItem($invalidString1); 		
 
 		//first pass in a different command type to check if this is the command we need (false)
 		$result = $command->onCommand('anythinghere', $object); 
 		$this->assertFalse($result);
		
		//now pass in a valid command parameter to begin executing the tests
		$result = $command->onCommand('validateString', $object); 
 		$this->assertTrue($result);
		
		
		//now let's pass in an empty string - we don't care if it NEEDS to be there,
		//we only care that IF there is something, it is valid
		$this->assertFalse(is_null($object));
		$this->assertFalse($object->getIsValid());		
		
		
		$object = new ValidationItem($invalidString2); 	
		$command->onCommand('validateString', $object); 		
		$this->assertFalse($object->getIsValid());
		
		
		//now let's pass in a valid string
		$object = new ValidationItem($validString1); 	
		$command->onCommand('validateString', $object); 		
		$this->assertTrue($object->getIsValid());
		
		
		$object = new ValidationItem($validString2); 	
		$command->onCommand('validateString', $object); 		
		$this->assertTrue($object->getIsValid());
		
		$object = new ValidationItem($validString3); 	
		$command->onCommand('validateString', $object); 		
		$this->assertTrue($object->getIsValid());
		
		$object = new ValidationItem($validString4); 	
		$command->onCommand('validateString', $object); 		
		$this->assertTrue($object->getIsValid());
    }
	
}