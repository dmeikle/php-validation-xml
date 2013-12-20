<?php
namespace tests\validation\rules;

require_once  DIRECTORY_SEPARATOR . 'tests' . DIRECTORY_SEPARATOR . "testinit.php";

use validation\rules\EmailValidatorCommand;
use validation\core\ValidationItem;
use exceptions\InvalidInstanceException;


class EmailValidatorCommandTest extends \PHPUnit_Framework_TestCase
{
	
	 
	 
    public function testOnCommand() {
        // make an instance of the Validator Command
        $command = new EmailValidatorCommand();
		$validString1 = 'dave@hotmall.com';
		$validString2 = 'dave.meikle@hotmall.com';
		$validString3 = 'dave.meikle1@hotmal-l.com';
		$invalidString1 = '<script>@$delete something</script>';
		$invalidString2 = 'dave.@meikle@hotmall.com';
		$invalidString3 = 'dave.>><meikle@hotmall.com';
		$invalidString4 = ' dave.meikle@hotmall.com';
		
 		$object = new ValidationItem($invalidString1); 		
 
 		//first pass in a different command type to check if this is the command we need (false)
 		$result = $command->onCommand('anythinghere', $object); 
 		$this->assertFalse($result);
		
		//now pass in a valid command parameter to begin executing the tests
		$result = $command->onCommand('validateEmail', $object); 
 		$this->assertTrue($result);
		
		//now lets start looking at the object flags after validation
		//this should have failed the initial 'invalidString' test
		$this->assertFalse(is_null($object));
		$this->assertFalse($object->getIsValid());
		
		//check against various input types
		$object = new ValidationItem($invalidString2); 	
		$command->onCommand('validateEmail', $object); 		
		$this->assertFalse($object->getIsValid());
		
		$object = new ValidationItem($invalidString3); 	
		$command->onCommand('validateEmail', $object); 		
		$this->assertFalse($object->getIsValid());	
		
		$object = new ValidationItem($invalidString4); 	
		$command->onCommand('validateEmail', $object); 		
		$this->assertFalse($object->getIsValid());
		
		//hey, did we get a valid object passed in?
		$object = new \stdClass();
		
		//PHP instrinsic code for invalid argument
		$errorCode = 4096;
		//this should throw an error since it didn't get proper object
		try{
			$result = $command->onCommand('validateEmail', $object); 
		}catch(\Exception $e) {
			$this->assertEquals($errorCode, $e->getCode());
		}
		
		
		//now let's pass in an empty string - we don't care if it NEEDS to be there,
		//we only care that IF there is something, it is valid
		$object = new ValidationItem(''); 	
		$command->onCommand('validateEmail', $object); 		
		$this->assertTrue($object->getIsValid());
		
		//now let's pass in a valid email
		$object = new ValidationItem($validString1); 	
		$command->onCommand('validateEmail', $object); 		
		$this->assertTrue($object->getIsValid());
		
		$object = new ValidationItem($validString2); 	
		$command->onCommand('validateEmail', $object); 		
		$this->assertTrue($object->getIsValid());
		
		$object = new ValidationItem($validString3); 	
		$command->onCommand('validateEmail', $object); 	
		$this->assertTrue($object->getIsValid());
    }
	
}