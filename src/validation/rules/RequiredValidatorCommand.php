<?php

namespace validation\rules;

use validation\rules\ValidatorCommand;
use validation\core\ValidationItem;



/**
 * RequiredValidatorCommand - receives a value and validates only if it holds a value
 * 
 * @author	Dave Meikle
 * 
 * @copyright 2007 - 2014
 */
class RequiredValidatorCommand extends ValidatorCommand{
    
    /** Creates a new instance of RequiredValidatorCommand */
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
    	
        if("validaterequired"!=strtolower($action)) {
        	return false;
        }
		
	    //the object contains a pass/fail flag within it...
       if(strlen($object->getStringValue()) > 0) {
	   		$object->setValid();
	   }
	   
        //this just means that this was the class we wanted to call
        return true;
    }
    
}
