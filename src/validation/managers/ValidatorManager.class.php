<?php

class ValidatorManager{
	
	public function validateForm($form,$uri){
		$filepath=$_SERVER['DOCUMENT_ROOT'].dirname($_SERVER['PHP_SELF'])."/validation-rules.xml";
		$cmd=new ValidatorCommandChain();
		
		$vxm=new ValidationXMLManager();
		$vxm->loadXML($filepath);
		
		$rules=$vxm->getRulesByPage($uri);
		$results=array();
		
			$keys=array_keys($rules);
		
		for($i=0;$i<count($keys);$i++){
			$key=$keys[$i];
		
			//load the validationItem with values with an encapsulated result flag
			//get the key of the rules array, pass it in as the form field name
			
			//1 item may have more than 1 validation - eg: Required, String
			$thisRule=$rules[$key];
			$tests=explode(",",$thisRule);
		
			for($j=0;$j<count($tests);$j++){
				$passed=$cmd->runCommand("validate".trim($tests[$j]), $form[$key]);//this will send the item out, then we check it's 'isValid()' property to see if it passed.
				if(!$passed){
					$results[$key]=trim($tests[$j]);//add this form's field name and test performed to the list	
					break;//stop after the item fails its first test
				}
			}
		}
		
		return $results;
	}
	
}

