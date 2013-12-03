<?
abstract class ValidatorCommand extends Command
{
    protected $regex;
    
    public function __construct($regex){
        $this->regex=$regex;//this is the regex expression
    }
 
    protected function checkValidChars(&$itemToCheck){
    	
        if(preg_match($this->regex,$itemToCheck->getStringValue()))
			$itemToCheck->setValid();
    }
    
    //because sometimes you just don't want to figure out why your regex isn't working...
    protected function checkValidCharsAgainstString(&$itemToCheck, $expression){
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

?>