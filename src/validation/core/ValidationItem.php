<?php
namespace validation\core;


/**
 * class ValidationItem - this is the object we pass through the chain, holding
 * the values to be checked, and containing the flag we check later to see if
 * it passed the validation or not.
 * 
 * @author Dave Meikle
 * 
 * date: 	June 2007
 * lastEdited: December 2013 
 */
 
class ValidationItem {
    
	/** the string to validate */
   private $validateThis="";
    
	/** by default we fail everything */
   private $isValid=false;
   
   public function __construct($validateThis){
       $this->validateThis=$validateThis;
   }
   
   /**
    * setValid - sets the 'I passed validation' flag to true
    */
   public function setValid(){
       $this->isValid=true;
   }
   
   /**
    * getIsValid
    * 
    * @return boolean
    */
   public function getIsValid(){
       return $this->isValid;
   }
   
   /**
    * getStringValue 
    * 
    * @return string - the item to validate
    */
   public function getStringValue(){
       return $this->validateThis;
   }
  
}
