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
use validation\core\CommandChain;
 
class CommandChainTest extends \PHPUnit_Framework_TestCase
{
	private $chain = null;
	
	private function init() {
		$this->chain = new CommandChain();
		
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
		$this->chain = new CommandChain();
		
		//first lets pass a null object in
		$object = null;
		$this->chain->addCommand($object);
		
		
	}
	
	public function testRunCommand() {
		
	}
}
