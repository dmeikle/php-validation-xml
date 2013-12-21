<?php

namespace validation\rules;

use validation\core\Command;
use validation\core\ValidationItem;


/**
 * ValidatorCommand - Base class for the validation commands
 * 
 * @author	Dave Meikle
 * 
 * @copyright 2007 - 2014
 */
abstract class ValidatorCommand extends Command
{
	
	/** 
	 * this is the regex expression
	 */
    protected $regex;
    
	/** default constructor */
    public function __construct($regex){
        $this->regex=$regex;
    }
 
 	/**
     * method checkValidChars - does the actual checking
     * 
     * @param ValidationItem 	object
	 *
     */
    protected function checkValidChars(ValidationItem &$itemToCheck){
    	
    	if(!is_array($itemToCheck->getStringValue()) && strlen($itemToCheck->getStringValue()) == 0 ||
			is_array($itemToCheck->getStringValue()) && count($itemToCheck->getStringValue()) == 0) {
    		//we don't check for 'required' so if there's nothing to check it passed
    		$itemToCheck->setValid();
			
			return;
    	}
		
		if(is_array($itemToCheck->getStringValue())) {
						
			$rows = $itemToCheck->getStringValue();
			
			foreach($rows as $row) {
				if(!preg_match($this->regex,$row)) {
					//fail right away
		        	return;
		        }
			}
		} else {
			if(preg_match($this->regex,$itemToCheck->getStringValue())) {
	        	$itemToCheck->setValid();
	        }
		}
			
    }
    
    /**
     * method checkValidCharsAgainstString - does the actual checking
     * 
     * @param ValidationItem 	object
	 * @param string			valid character list
	 *
     */
    protected function checkValidCharsAgainstString(ValidationItem &$itemToCheck, $expression){
        $string=$itemToCheck->getStringValue();
        //loop through the character array checking each character exists in the expression to validate against
        for($i = 0; $i < count($chars); $i++) {
        	
            $char = $string[i];
			
            if(strpos($expression,$char) < 0) {
            	
            	return; //default set to fail inside of ValidationItem     
            }
                       
        }
		
        $itemToCheck->setValid();
    }
}
