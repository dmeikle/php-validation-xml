<?php

namespace validation\rules;

use validation\rules\ValidatorCommand;
use validation\core\ValidationItem;



/**
 * NumericValidatorCommand - receives a numeric value and validates only if it holds a value
 * 
 * @author	Dave Meikle
 * 
 * @copyright 2007 - 2014
 */
class TelephoneValidatorCommand extends ValidatorCommand{
    
    /** Creates a new instance of TelephoneValidatorCommand */
    public function __construct() {
    	//there are a variety of formats - for now, stick to a strict format:
    	// 1-123-123-1234 x 234
    	// 1-123-123-1234
    	// 1-123-123-1234 ext 234
    	// 1-123-123-1234 x234
    	// 123-123-1234
    	// we can revisit this if we need to change for different country
    
    	parent::__construct("/^([0-9])?(\-|\s|\+)?([0-9]{3})+(\-|\s|\+)?([0-9]{3})(\-|\s|\+)?([0-9]{4})(\s)?((ext|x)?((\s)?[0-9])+)?$/");
        
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
        if("validatetelephone" != strtolower($action)) {
        	return false;
        }
            
	    //the object contains a pass/fail flag within it...
        $this->checkValidChars($object);
        
        //this just means that this was the class we wanted to call
        return true;
    }
    
}

