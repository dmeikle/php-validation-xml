<?php
namespace tests\validation\rules;

require_once  DIRECTORY_SEPARATOR . 'tests' . DIRECTORY_SEPARATOR . "testinit.php";

use validation\rules\TelephoneValidatorCommand;
use validation\core\ValidationItem;
 
class TelephoneValidatorCommandTest extends \PHPUnit_Framework_TestCase
{
	
	 
	 
    public function testOnCommand() {
        // make an instance of the Validator Command
        $command = new TelephoneValidatorCommand();
		$validString1 = '1-123-123-1234';
		$validString2 = '1-123-123-1234 ext 234';
		$validString3 = '1-123-123-1234 x234';
		$validString4 = '123-123-1234';
		$validString5 = '1-123-123-1234 x 234';
		

		$invalidString1 = '<script>@$delete something</script>';
		$invalidString2 = '123.';
		$invalidString3 = '(800) ##111-1234';
		$invalidString4 = '(800) 1111-234';
		$invalidString5 = '+123-1123';
		
		
 		$object = new ValidationItem($invalidString1); 		
 
 		//first pass in a different command type to check if this is the command we need (false)
 		$result = $command->onCommand('anythinghere', $object); 
 		$this->assertFalse($result);
		
		//now pass in a valid command parameter to begin executing the tests
		$result = $command->onCommand('validatetelephone', $object); 
 		$this->assertTrue($result);
		
		
		//now let's pass in an empty string - we don't care if it NEEDS to be there,
		//we only care that IF there is something, it is valid
		$this->assertFalse(is_null($object));
		$this->assertFalse($object->getIsValid());		
		
		
		$object = new ValidationItem($invalidString2); 	
		$command->onCommand('validatetelephone', $object); 		
		$this->assertFalse($object->getIsValid());
		
		$object = new ValidationItem($invalidString3); 	
		$command->onCommand('validatetelephone', $object); 		
		$this->assertFalse($object->getIsValid());
		
		$object = new ValidationItem($invalidString4); 	
		$command->onCommand('validatetelephone', $object); 		
		$this->assertFalse($object->getIsValid());
		
		$object = new ValidationItem($invalidString5); 	
		$command->onCommand('validatetelephone', $object); 		
		$this->assertFalse($object->getIsValid());
		
		
		//now let's pass in a valid string
		$object = new ValidationItem($validString1); 	
		$command->onCommand('validatetelephone', $object); 		
		$this->assertTrue($object->getIsValid());
		
		
		$object = new ValidationItem($validString2); 	
		$command->onCommand('validatetelephone', $object); 		
		$this->assertTrue($object->getIsValid());
		
		$object = new ValidationItem($validString3); 	
		$command->onCommand('validatetelephone', $object); 		
		$this->assertTrue($object->getIsValid());
		
		$object = new ValidationItem($validString4); 	
		$command->onCommand('validatetelephone', $object); 		
		$this->assertTrue($object->getIsValid());
		
		$object = new ValidationItem($validString5); 	
		$command->onCommand('validatetelephone', $object); 		
		$this->assertTrue($object->getIsValid());
    }
	
}