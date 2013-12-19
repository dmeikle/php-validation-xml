<?


namespace rules;

use ValidatorCommand;

class DateValidatorCommand extends ValidatorCommand{
    
    /** Creates a new instance of URLValidator */
    public function __construct() {
        parent::__construct("^([a-zA-Z0-9_\\-\\.]+)@((\\[[0-9]{1,3}\\.[0-9]{1,3}\\.[0-9]{1,3}\\.)|(([a-zA-Z0-9\\-]+\\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\\]?)$^");
    }

    public function onCommand($action, &$object) {
        if("validatedate"!=strtolower($action))
            return false;
        //object should be of type ValidationItem...
        if(!($object instanceof ValidationItem))
            return false;
      
	    //the object contains a pass/fail flag within it...
	    if($this->isDate($object->getValue()))
			$object->setValid();
        
        //this just means that this was the class we wanted to call
        return true;
    }
    private static function isDate($string)
	  {
	    $t = strtotime($string);
	    $m = date('m',$t);
	    $d = date('d',$t);
	    $y = date('Y',$t);
	    return checkdate ($m, $d, $y);
	  }
}




?>