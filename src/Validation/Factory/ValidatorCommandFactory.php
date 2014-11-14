<?php

namespace Validation\Factory;



/**
 * Description of ValidatorCommandFactory
 *
 * @author davem
 */
class ValidatorCommandFactory {
    
    private $validators = array();
    
    public function getValidator($validatorName, array $params) {
        if(!array_key_exists($validatorName, $this->validators)) {
            $validator = 'Validation\\Validators\\' . $validatorName . 'Validator';
            $this->validators[$validatorName] = new $validator();
        }
        
        return $this->validators[$validatorName]->setParams($params);
    }
}
