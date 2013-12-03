<?


class BusinessNameValidatorCommand extends ValidatorCommand{
    
    /** Creates a new instance of URLValidator */
    public function __construct() {
        parent::__construct("^[a-zA-Z\\d '&()-,.]+$^");
    }

    public function onCommand($action, &$object) {
        if("validatebusiness"!=strtolower($action))
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