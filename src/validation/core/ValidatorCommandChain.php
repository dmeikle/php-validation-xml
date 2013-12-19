<?php

//this class extends CommandChain rather then simply accessing CommandChain directly since we're not passing in a value
//to save/edit/delete, etc... we're passing in a value to validate and determine whether it's valid (true/false)
// and since the Command.onCommand returns true (meaning, yes, I am the command u want) already, we need to pass in a separate
//object (ValidationItem) as a container we can look into for the final result 
class ValidatorCommandChain extends CommandChain{
	
	 //private $_commands = array();

	function __construct(){
		$this->init();
	}
	
	private function init(){
        $this->addCommand(new AddressValidatorCommand());
        $this->addCommand(new AlphaNumericValidatorCommand());
        $this->addCommand(new AlphabetValidatorCommand());
        $this->addCommand(new BusinessNameValidatorCommand());
        $this->addCommand(new CurrencyValidatorCommand());
        $this->addCommand(new DateValidatorCommand());
        $this->addCommand(new EmailValidatorCommand());
        $this->addCommand(new IPValidatorCommand());
        $this->addCommand(new NumericValidatorCommand());
        $this->addCommand(new StringValidatorCommand());
        $this->addCommand(new TelephoneValidatorCommand());
        $this->addCommand(new URLValidatorCommand());
        $this->addCommand(new RequiredValidatorCommand());
				
    }
	
  

  public function runCommand( $name, &$args )
  {
  	$name=Sanitizer::string($name);//mitigate SQL injection
  	$item = new ValidationItem($args);
		
    foreach( $this->_commands as $cmd )
    { 
      if ( $cmd->onCommand( $name, $item ) )
        return $item->getIsValid();
    }
  }
	
}

