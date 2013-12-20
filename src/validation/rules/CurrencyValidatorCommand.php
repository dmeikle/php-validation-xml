<?php

namespace validation\rules;

use validation\rules\ValidatorCommand;
use validation\core\ValidationItem;
use exceptions\InvalidInstanceException;

/**
 * CurrencyValidatorCommand - receives a value and validates only if it holds a value
 * 
 * @author	Dave Meikle
 * 
 * @copyright 2007 - 2014
 */
class CurrencyValidatorCommand extends ValidatorCommand{
    
    /**
     * default constructor
     */
    public function __construct() {
        parent::__construct("/^-?[0-9]+(?:\.[0-9]{1,2})?$/");
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
        if("validatecurrency"!=strtolower($action)) {
        	return false;
        }         
      
	    //the object contains a pass/fail flag within it...
        $this->checkValidChars($object);
        
        //this just means that this was the class we wanted to call
        return true;
    }
    
}


