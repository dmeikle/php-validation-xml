<?php

namespace qus\validation\rules;

use qus\validation\rules\ValidatorCommand;
use qus\validation\core\ValidationItem;



/**
 * DateValidatorCommand - receives a date and validates only if it holds a value
 * 
 * @author	Dave Meikle
 * 
 * @copyright 2007 - 2014
 */
class DateValidatorCommand extends ValidatorCommand{
    
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
        if("validatedate"!=strtolower($action)) {
        	return false;
        }          
      
	  	//pass it if there's nothing to check
	  	if(strlen($object->getStringValue()) == 0) {
	  		$object->setValid();
			
	  		return true;
	  	}
	    //the object contains a pass/fail flag within it...
	    if($this->isDate($object->getStringValue()))
			$object->setValid();
        
        //this just means that this was the class we wanted to call
        return true;
    }
	
	/**
	 * method isDate - checks format to ensure is proper date format
	 * 
	 * @param string - the date to check
	 * 
	 * @return boolean
	 */
    private function isDate($string) {
	    $t = strtotime($string);
		
		//for invalid strings it defaults to 01/01/1970 on an empty $t value
		//so kick it out before we check if there's no value in $t
		if($t=='') {
			return false;
		}
		
	    $m = date('m',$t);
	    $d = date('d',$t);
	    $y = date('Y',$t);
		
	    return checkdate ($m, $d, $y);
	}
}

