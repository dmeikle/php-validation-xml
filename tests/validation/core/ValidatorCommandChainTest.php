<?php
namespace tests\validation\core;

require_once  DIRECTORY_SEPARATOR . 'tests' . DIRECTORY_SEPARATOR . "testinit.php";

use validation\rules\AddressValidatorCommand;
use validation\rules\AlphaNumericValidatorCommand;
use validation\rules\AlphabetValidatorCommand;
use validation\rules\BusinessNameValidatorCommand;
use validation\rules\CurrencyValidatorCommand;
use validation\rules\DateValidatorCommand;
use validation\rules\EmailValidatorCommand;
use validation\rules\IPValidatorCommand;
use validation\rules\NumericValidatorCommand;
use validation\rules\StringValidatorCommand;
use validation\rules\TelephoneValidatorCommand;
use validation\rules\URLValidatorCommand;
use validation\rules\RequiredValidatorCommand;
use validation\core\ValidatorCommandChain;
 
class ValidatorCommandChainTest extends \PHPUnit_Framework_TestCase
{
	private $chain = null;
	
	private function init() {
		
		$this->chain->addCommand(new AddressValidatorCommand());
        $this->chain->addCommand(new AlphaNumericValidatorCommand());
        $this->chain->addCommand(new AlphabetValidatorCommand());
        $this->chain->addCommand(new BusinessNameValidatorCommand());
        $this->chain->addCommand(new CurrencyValidatorCommand());
        $this->chain->addCommand(new DateValidatorCommand());
        $this->chain->addCommand(new EmailValidatorCommand());
        $this->chain->addCommand(new IPValidatorCommand());
        $this->chain->addCommand(new NumericValidatorCommand());
        $this->chain->addCommand(new StringValidatorCommand());
        $this->chain->addCommand(new TelephoneValidatorCommand());
        $this->chain->addCommand(new URLValidatorCommand());
        $this->chain->addCommand(new RequiredValidatorCommand());
		
	}
	
	public function testAddCommand() {
		$this->chain = new ValidatorCommandChain();
		
		//first lets pass a null object in
		$object = null;
		try{
			$this->chain->addCommand($object);
			$this->fail('passing a null object should have thrown an exception');
		}catch(\Exception $e) {
			//check to make sure the return code is 4096 - PHP value for passing a null
			$this->assertEquals($e->getCode(), 4096);
		}
		
		//now lets pass the wrong object in 
		$object = new \stdClass();
		try{
			$this->chain->addCommand($object);
			$this->fail('passing the wrong object should have thrown an exception');
		}catch(\Exception $e) {
			//check to make sure the return code is 4096 - PHP value for passing a null
			$this->assertEquals($e->getCode(), 4096);
		}
		
		//now add the correct objects
		try{
			$this->init();		
		}catch(\Exception $e) {
			$this->fail('error thrown while adding valid objects to chain');
		}
		
	}
	
	public function testRunCommand() {
		$this->chain = new ValidatorCommandChain();
		$this->init();
		
		$args = 'this is an invalid string1';		
		$result = $this->chain->runCommand('validateString', $args);
		$this->assertFalse($result);
		
		$args = 'this is a valid string';		
		$result = $this->chain->runCommand('validateString', $args);
		$this->assertTrue($result);
		
		//now pass junk in to see if we handle it properly
		$args = 'this is a valid string';	
		try{
			$result = $this->chain->runCommand('', $args);
			$this->fail('validator command chain should throw exception on empty command name');
		}catch(\Exception $e) {
			$this->assertEquals($e->getCode(), 5050);
		}
		
		//now pass junk in to see if we handle it properly
		$args = 'this is a valid string';	
		try{
			$result = $this->chain->runCommand(null, $args);
			$this->fail('validator command chain should throw exception on empty command name');
		}catch(\Exception $e) {
			$this->assertEquals($e->getCode(), 5050);
		}
		//now pass junk in to see if we handle it properly
		$args = 'this is a valid string';	
		try{
			$result = $this->chain->runCommand('thisCommandDoesNotExist', $args);
			$this->fail('validator command chain should throw exception on incorrect command name');
		}catch(\Exception $e) {
			$this->assertEquals($e->getCode(), 5055);
		}
	}
	
}
