<?php

namespace validation\rules;

use validation\rules\ValidatorCommand;
use validation\core\ValidationItem;

class AddressValidatorCommand extends ValidatorCommand {

	/** Creates a new instance of AddressValidator */
	public function __construct() {
		//parent::__construct("^[0-9]+\\s+([a-zA-Z]+|[a-zA-Z]+\\s[a-zA-Z]+)$^");
		parent::__construct("^[A-Za-z0-9\\s\\-\\.]$^");
		
	}

	public function onCommand($action, &$object) {
		if ('validateaddress' != strtolower($action))
			return false;
		
		//object should be of type ValidationItem...
		if (!($object instanceof ValidationItem))
			return false;

		//the object contains a pass/fail flag within it...
		$this -> checkValidChars($object);

		//this just means that this was the class we wanted to call
		return true;
	}

}