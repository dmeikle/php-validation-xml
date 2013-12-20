<?php

namespace validation\rules;

use validation\rules\ValidatorCommand;
use validation\core\ValidationItem;

/**
 * BusinessNameValidatorCommand - receives an string and validates if it holds a value
 * 
 * @author	Dave Meikle
 * 
 * @copyright 2007 - 2014
 */
class BusinessNameValidatorCommand extends ValidatorCommand{
    
    /**
     * default constructor
     */
    public function __construct() {
        parent::__construct("^[a-zA-Z\\d '!&()-,.]+$^");
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
        if("validatebusiness"!=strtolower($action)) {
        	return false;
        }          
      
	    //the object contains a pass/fail flag within it...
        $this->checkValidChars($object);
        
        //this just means that this was the class we wanted to call
        return true;
    }
    
}


