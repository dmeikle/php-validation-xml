<?php
namespace qus\validation\tests\rules;

require_once  DIRECTORY_SEPARATOR . 'tests' . DIRECTORY_SEPARATOR . "testinit.php";

use qus\validation\rules\IPValidatorCommand;
use qus\validation\core\ValidationItem;
use qus\exceptions\InvalidInstanceException;


class IPValidatorCommandTest extends \PHPUnit_Framework_TestCase
{
	
	 
	 
    public function testOnCommand() {
        // make an instance of the Validator Command
        $command = new IPValidatorCommand();
		$validString1 = '127.0.0.1';
		$validString2 = '111.111.111.111';
		$validString3 = '0.0.0.0';
		$invalidString1 = '<script>@$delete something</script>';
		$invalidString2 = 'dave.@meikle@hotmall.com';
		$invalidString3 = '00.0.0';
		$invalidString4 = ' 13.13.13.13';
		
 		$object = new ValidationItem($invalidString1); 		
 
 		//first pass in a different command type to check if this is the command we need (false)
 		$result = $command->onCommand('anythinghere', $object); 
 		$this->assertFalse($result);
		
		//now pass in a valid command parameter to begin executing the tests
		$result = $command->onCommand('validateIP', $object); 
 		$this->assertTrue($result);
		
		//now lets start looking at the object flags after validation
		//this should have failed the initial 'invalidString' test
		$this->assertFalse(is_null($object));
		$this->assertFalse($object->getIsValid());
		
		//check against various input types
		$object = new ValidationItem($invalidString2); 	
		$command->onCommand('validateIP', $object); 		
		$this->assertFalse($object->getIsValid());
		
		$object = new ValidationItem($invalidString3); 	
		$command->onCommand('validateIP', $object); 		
		$this->assertFalse($object->getIsValid());	
		
		$object = new ValidationItem($invalidString4); 	
		$command->onCommand('validateIP', $object); 		
		$this->assertFalse($object->getIsValid());
		
		//hey, did we get a valid object passed in?
		$object = new \stdClass();
		
		//PHP instrinsic code for invalid argument
		$errorCode = 4096;
		//this should throw an error since it didn't get proper object
		try{
			$result = $command->onCommand('validateIP', $object); 
		}catch(\Exception $e) {
			$this->assertEquals($errorCode, $e->getCode());
		}
		
		
		//now let's pass in an empty string - we don't care if it NEEDS to be there,
		//we only care that IF there is something, it is valid
		$object = new ValidationItem(''); 	
		$command->onCommand('validateIP', $object); 		
		$this->assertTrue($object->getIsValid());
		
		//now let's pass in a valid IP
		$object = new ValidationItem($validString1); 	
		$command->onCommand('validateIP', $object); 		
		$this->assertTrue($object->getIsValid());
		
		$object = new ValidationItem($validString2); 	
		$command->onCommand('validateIP', $object); 		
		$this->assertTrue($object->getIsValid());
		
		$object = new ValidationItem($validString3); 	
		$command->onCommand('validateIP', $object); 
		$this->assertTrue($object->getIsValid());	
    }
	
}