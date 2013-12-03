<?


class RequiredValidatorCommand extends ValidatorCommand{
    
    /** Creates a new instance of URLValidator */
    public function __construct() {
        
    }

    public function onCommand($action, &$object) {
        if("validaterequired"!=strtolower($action))
            return false;
        //object should be of type ValidationItem...
        if(!($object instanceof ValidationItem))
            return false;
		
	    //the object contains a pass/fail flag within it...
       if(strlen($object->getStringValue())>0){
	   		$object->setValid();
	   }
        //this just means that this was the class we wanted to call
        return true;
    }
    
}




?>