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
class NumericValidatorCommand extends ValidatorCommand{
    
    /** Creates a new instance of URLValidator */
    public function __construct() {
        
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
        if("validatenumeric" != strtolower($action)) {
        	return false;
        }        
		
		if(strlen($object->getStringValue()) == 0) {
			$object->setValid();
			
			return true;
		}

	    if(is_numeric($object->getStringValue()) == 1) {
			$object->setValid();
		}
        
        //this just means that this was the class we wanted to call
        return true;
    }
    
}




?>