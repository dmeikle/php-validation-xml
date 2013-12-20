<?php

namespace validation\rules;

use validation\core\Command;
use validation\core\ValidationItem;

abstract class ValidatorCommand extends Command
{
    protected $regex;
    
    public function __construct($regex){
        $this->regex=$regex;//this is the regex expression
    }
 
    protected function checkValidChars(ValidationItem &$itemToCheck){
    	if(strlen($itemToCheck->getStringValue()) == 0) {
    		//we don't check for 'required' so if there's nothing to check it passed
    		$itemToCheck->setValid();
			
			return;
    	}
		
		if(preg_match($this->regex,$itemToCheck->getStringValue())) {
        	$itemToCheck->setValid();
        }
			
    }
    
    //because sometimes you just don't want to figure out why your regex isn't working...
    protected function checkValidCharsAgainstString(ValidationItem &$itemToCheck, $expression){
        $string=$itemToCheck->getStringValue();
        //loop through the character array checking each character exists in the expression to validate against
        for($i=0; $i< count($chars); $i++){
            $char=$string[i];
            if(strpos($expression,$char)<0)
                return; //default set to fail inside of ValidationItem            
        }
        $itemToCheck->setValid();
    }
}
