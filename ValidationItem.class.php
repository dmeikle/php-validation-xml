<?
class ValidationItem {
    
   private $validateThis="";
    
   private $isValid=false;
   
   public function __construct($validateThis){
       $this->validateThis=$validateThis;
   }
   public function setValid(){
       $this->isValid=true;
   }
   public function getIsValid(){
       return $this->isValid;
   }
   public function getStringValue(){
       return $this->validateThis;
   }
  
}


?>