<?


namespace rules;

use ValidatorCommand;

class NumericValidatorCommand extends ValidatorCommand{
    
    /** Creates a new instance of URLValidator */
    public function __construct() {
        
    }

    public function onCommand($action, &$object) {
        if("validatenumeric"!=strtolower($action))
            return false;
        //object should be of type ValidationItem...
        if(!($object instanceof ValidationItem))
            return false;
     
	    if(is_numeric($object->getStringValue())==1){
			$object->setValid();
		}
        
        //this just means that this was the class we wanted to call
        return true;
    }
    
}




?>