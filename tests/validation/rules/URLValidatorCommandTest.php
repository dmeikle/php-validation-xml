<?php
namespace tests\validation\rules;

require_once  DIRECTORY_SEPARATOR . 'tests' . DIRECTORY_SEPARATOR . "testinit.php";

use validation\rules\URLValidatorCommand;
use validation\core\ValidationItem;
 
class URLValidatorCommandTest extends \PHPUnit_Framework_TestCase
{	
	 
    public function testOnCommand() {
        // make an instance of the Validator Command
        $command = new URLValidatorCommand();
		$validString1 = 'http://www.mytest.com';
		$validString2 = 'https://www.mytest.com';
		$validString3 = 'http://mytest.org';
		$validString4 = 'ftp://www.mytest.com';
		$validString5 = 'http://www.mytest.com:8083';
		

		$invalidString1 = '<script>@$delete something</script>';
		$invalidString2 = 'http://spammy.com/go/to/this/script?id=3';
		$invalidString3 = 'http://www.mytest.com/<script>';
		
		
 		$object = new ValidationItem($invalidString1); 		
 
 		//first pass in a different command type to check if this is the command we need (false)
 		$result = $command->onCommand('anythinghere', $object); 
 		$this->assertFalse($result);
		
		//now pass in a valid command parameter to begin executing the tests
		$result = $command->onCommand('validateurl', $object); 
 		$this->assertTrue($result);
		
		
		//now let's pass in an empty string - we don't care if it NEEDS to be there,
		//we only care that IF there is something, it is valid
		$this->assertFalse(is_null($object));
		$this->assertFalse($object->getIsValid());		
		
		
		$object = new ValidationItem($invalidString2); 	
		$command->onCommand('validateurl', $object); 		
		$this->assertFalse($object->getIsValid());
		
		$object = new ValidationItem($invalidString3); 	
		$command->onCommand('validateurl', $object); 		
		$this->assertFalse($object->getIsValid());
		
		
		//now let's pass in a valid string
		$object = new ValidationItem($validString1); 	
		$command->onCommand('validateurl', $object); 		
		$this->assertTrue($object->getIsValid());
		
		
		$object = new ValidationItem($validString2); 	
		$command->onCommand('validateurl', $object); 		
		$this->assertTrue($object->getIsValid());
		
		$object = new ValidationItem($validString3); 	
		$command->onCommand('validateurl', $object); 		
		$this->assertTrue($object->getIsValid());
		
		$object = new ValidationItem($validString4); 	
		$command->onCommand('validateurl', $object); 		
		$this->assertTrue($object->getIsValid());
		
		$object = new ValidationItem($validString5); 	
		$command->onCommand('validateurl', $object); 		
		$this->assertTrue($object->getIsValid());
    }
	
}