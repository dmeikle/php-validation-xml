<?php

namespace qus\validation\rules;

use qus\validation\rules\ValidatorCommand;
use qus\validation\core\ValidationItem;



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
	
		//if it's an array we need to check its count
		if(is_array($object->getStringValue())) {
			
			//the object contains a pass/fail flag within it...
	       	if(count($object->getStringValue()) > 0) {
		   		$object->setValid();
			 
			   	return true;
				
		   	}
		}
	    //the object contains a pass/fail flag within it...
       if(strlen($object->getStringValue()) > 0) {
	   		$object->setValid();
	   }
	   
        //this just means that this was the class we wanted to call
        return true;
    }
    
}
