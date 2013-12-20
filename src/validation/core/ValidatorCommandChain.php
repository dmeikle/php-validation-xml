<?php
namespace validation\core;

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
use validation\rules\ValidatorCommand;
use validation\core\ValidationItem;


/**
 * ValidatorCommandChain - this class extends CommandChain rather then simply accessing CommandChain directly 
 * since we're not passing in a value to a save/edit/delete, etc...Command class.
 * We're passing in a value to validate and determine whether it's valid (true/false)
 * and since the Command->onCommand returns true (meaning, yes, I am the command u want) already, 
 * we need to pass in a separate object (ValidationItem) as a container we can look into for the final result 
 * 
 * @author	Dave Meikle
 * 
 * @copyright 2007 - 2014
 */
class ValidatorCommandChain
{
	
	private $_commands = array();
	
	
	/**
	 *  default constructor
	 */
	function __construct() {
		$this->init();
	}
	
	/**
	 * addCommand 		- adds the command object to the list of choices
	 * 
	 * @param Command	- the object to add
	 */
	public function addCommand(ValidatorCommand $cmd) {
		
		$this->_commands[] = $cmd;
		
	}
	
	/**
	 * init	- instantiate and load all the selected validation commands
	 */
	private function init() {
        $this->addCommand(new AddressValidatorCommand());
        $this->addCommand(new AlphaNumericValidatorCommand());
        $this->addCommand(new AlphabetValidatorCommand());
        $this->addCommand(new BusinessNameValidatorCommand());
        $this->addCommand(new CurrencyValidatorCommand());
        $this->addCommand(new DateValidatorCommand());
        $this->addCommand(new EmailValidatorCommand());
        $this->addCommand(new IPValidatorCommand());
        $this->addCommand(new NumericValidatorCommand());
        $this->addCommand(new StringValidatorCommand());
        $this->addCommand(new TelephoneValidatorCommand());
        $this->addCommand(new URLValidatorCommand());
        $this->addCommand(new RequiredValidatorCommand());
				
    }
	
  

	/**
	 * runCommand	- the entry point for the validation from the page to be validated
	 * 
	 * @param string	name of command
	 * @param string 	input to validate
	 * 
	 * @return boolean
	 */
	public function runCommand($name, &$args) {
		$name= preg_replace('/[^A-Za-z]/', '',$name);//mitigate SQL injection
  
  		if(is_null($name) || strlen($name) == 0) {
  			throw new \InvalidArgumentException('empty runCommand received',5050);
  		}
		
  		$item = new ValidationItem($args);
		
    	foreach($this->_commands as $cmd) {
			if ($cmd->onCommand($name, $item)) {
    	  		return $item->getIsValid();
    	  	}      
			
    	}
		
		throw new \InvalidArgumentException('invalid runCommand received or command not loaded',5055);
  	}
	
}

