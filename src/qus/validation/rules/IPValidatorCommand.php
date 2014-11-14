<?php

namespace qus\validation\rules;

use qus\validation\rules\ValidatorCommand;
use qus\validation\core\ValidationItem;



/**
 * IPValidatorCommand - receives an IP address and validates only if it holds a value
 * 
 * @author	Dave Meikle
 * 
 * @copyright 2007 - 2014
 */
 class IPValidatorCommand extends ValidatorCommand{
    
    /** Creates a new instance of IPValidatorCommand */
    public function __construct() {
        parent::__construct("/^((2[0-4]\\d|25[0-5]|[01]?\\d\\d?)\\.){3}(2[0-4]\\d|25[0-5]|[01]?\\d\\d?)$/");
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
    	
        if("validateip"!=strtolower($action)) {
        	return false;
        }            
       
	    //the object contains a pass/fail flag within it...
        $this->checkValidChars($object);
        
        //this just means that this was the class we wanted to call
        return true;
    }
    
}
