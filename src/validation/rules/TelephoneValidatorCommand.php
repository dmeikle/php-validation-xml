<?

namespace rules;

use ValidatorCommand;


class TelephoneValidatorCommand extends ValidatorCommand{
    
    /** Creates a new instance of URLValidator */
    public function __construct() {
        parent::__construct("^([0-9])+(\\-|\\s|\\+)?([0-9])+(\\-|\\s|\\+)?([0-9])(\\s)?((ext|x)?([0-9])+)?$^");
    }

    public function onCommand($action, &$object) {
        if("validatetelephone"!=strtolower($action))
            return false;
        //object should be of type ValidationItem...
        if(!($object instanceof ValidationItem))
            return false;
      
	    //the object contains a pass/fail flag within it...
        $this->checkValidChars($object);
        
        //this just means that this was the class we wanted to call
        return true;
    }
    
}




?>