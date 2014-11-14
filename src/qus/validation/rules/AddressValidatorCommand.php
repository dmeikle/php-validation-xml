<?php

namespace qus\validation\rules;

use qus\validation\rules\ValidatorCommand;
use qus\validation\core\ValidationItem;


/**
 * AddressValidatorCommand - receives an address and validates if it holds a value
 * 
 * @author	Dave Meikle
 * 
 * @copyright 2007 - 2014
 */
class AddressValidatorCommand extends ValidatorCommand {

	/**
     * default constructor
     */
	public function __construct() {
		
		parent::__construct("^[A-Za-z0-9\\s\\-\\.]$^");
		
	}

	/**
     * method onCommand - used by the command chain
     * 
     * @param string 			action
     * @param ValidationItem 	object
	 * 
	 * @return boolean
     */
	public function onCommand($action, ValidationItem &$object) {
		if ('validateaddress' != strtolower($action)) {
			return false;
		}	
		
		//the object contains a pass/fail flag within it...
		$this -> checkValidChars($object);

		//this just means that this was the class we wanted to call
		return true;
	}

}