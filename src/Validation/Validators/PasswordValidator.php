<?php

namespace Validation\Validators;

use Validation\Factory\FlyweightValidatorInterface;

/**
 * Description of PasswordValidator
 *
 * @author davem
 */
class PasswordValidator extends AbstractValidator implements FlyweightValidatorInterface {
   
    
    /** Creates a new instance of StringValidatorCommand */
    public function __construct() {
        parent::__construct("/^[0-9!@#$%\^\&*\_\-\+\=a-zA-Z\\s-\']+$/");
    }

    /**
     * method validate
     * 
     * @param string 		action
     * @param ValidationItem 	object
     * 
     * @return boolean
     */
    public function validate($value) {
        return $this->checkValidChars($value);
    }

}


