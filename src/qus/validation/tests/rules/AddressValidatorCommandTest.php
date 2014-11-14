<?php
namespace qus\validation\tests\rules;

require_once  DIRECTORY_SEPARATOR . 'tests' . DIRECTORY_SEPARATOR . "testinit.php";

use qus\validation\rules\AddressValidatorCommand;
use qus\validation\core\ValidationItem;
 
class AddressValidatorCommandTest extends \PHPUnit_Framework_TestCase
{
	
	 
	 
    public function testOnCommand() {
        // make an instance of the Validator Command
        $command = new AddressValidatorCommand();
		$validAddress = '100 - 1234 34A Street';
		$invalidAddress = '<script>@$delete something</script>';
		
 		$object = new ValidationItem($invalidAddress); 		
 
 		//first pass in a different command type to check if this is the command we need (false)
 		$result = $command->onCommand('anythinghere', $object); 
 		$this->assertFalse($result);
		
		//now pass in a valid command parameter to begin executing the tests
		$result = $command->onCommand('validateAddress', $object); 
 		$this->assertTrue($result);
		
		//now lets start looking at the object flags after validation
		//this should have failed the initial 'invalidAddress' test
		$this->assertFalse(is_null($object));
		$this->assertFalse($object->getIsValid());
		
		
		//now let's pass in an empty string - we don't care if it NEEDS to be there,
		//we only care that IF there is something, it is valid
		$object = new ValidationItem(''); 	
		$command->onCommand('validateAddress', $object); 		
		$this->assertTrue($object->getIsValid());
		
		//now let's pass in a valid address
		$object = new ValidationItem($validAddress); 	
		$command->onCommand('validateAddress', $object); 
		
		$this->assertTrue($object->getIsValid());
    }
	
}