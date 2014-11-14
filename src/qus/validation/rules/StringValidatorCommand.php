<?php

namespace qus\validation\rules;

use qus\validation\rules\ValidatorCommand;
use qus\validation\core\ValidationItem;



/**
 * StringValidatorCommand - receives a string value and validates only if it holds a value
 * 
 * @author	Dave Meikle
 * 
 * @copyright 2007 - 2014
 */
class StringValidatorCommand extends ValidatorCommand{
    
    /** Creates a new instance of StringValidatorCommand */
    public function __construct() {
        parent::__construct("/^[a-zA-Z\\s-\']+$/");
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
    	
        if("validatestring" != strtolower($action)) {
        	return false;
        }
		
        //the object contains a pass/fail flag within it...
        $this->checkValidChars($object);
        
        //this just means that this was the class we wanted to call
        return true;
    }
    
}
