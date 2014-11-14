<?php
namespace qus\validation\managers;

use qus\validation\core\ValidatorCommandChain;
use qus\validation\managers\ValidationXMLManager;
use qus\validation\exceptions\XMLNodeNotConfiguredException;


/**
 * ValidationManager - validates the submitted form
 * 
 * @author	Dave Meikle
 * 
 * @copyright 2007 - 2014
 */
class ValidatorManager{

    private $filepath;


    private $pageElements;


    /** default constructor
     * 
     * @param string	optional path to xml file
     */
    public function __construct($xmlFilePath='') {
        if(strlen($xmlFilePath) == 0) {
                //look for it in our default project path
                $this->filepath=$_SERVER['DOCUMENT_ROOT'].dirname($_SERVER['PHP_SELF'])."/validation-rules.xml";
        } else {
                $this->filepath = $xmlFilePath;
        }		
    }

    /**
     * getPageElements 
     * 
     * @return array 	- list of all page elements used in validation.
     * 					  useful if you want to prune posted items that
     * 					  are not in the list, for security concerns
     */
    public function getPageElements() {
        return $this->pageElements;
    }

    /**
     * validationForm - the entry point for this class
     * 
     * @param array 	the values to validate
     * @param string	the page uri to check
     * 
     * @return array
     */
    public function validateForm($form,$uri){
        if(!is_array($form)) {
                throw new \InvalidArgumentException('form should be instance of array',5070);
        }
        $cmd = new ValidatorCommandChain();

        $vxm = new ValidationXMLManager();
        $vxm->loadXML($this->filepath);

        $rules = $vxm->getRulesByPage($uri);

        if(is_null($rules)) {
                throw new XMLNodeNotConfiguredException('no matching uri for ' . $uri);
        }

        $results = array();

        $keys = array_keys($rules);

        //pass this to form level so we can access these later if we need to
        $this->pageElements = $keys;

        for($i = 0; $i < count($keys); $i++){
            $key = $keys[$i];

            //load the validationItem with values with an encapsulated result flag
            //get the key of the rules array, pass it in as the form field name

            //1 item may have more than 1 validation - eg: Required, String
            $thisRule = $rules[$key];
            $tests = explode(",", $thisRule);

            for($j = 0;$j < count($tests); $j++){

                //this will send the item out, then we check it's 'isValid()' property to see if it passed.
                $passed = $cmd->runCommand("validate".trim($tests[$j]), $form[$key]);

                if(!$passed){
                        //add this form's field name and test performed to the list	
                        $results[$key] = trim($tests[$j]);
                        break;//stop after the item fails its first test
                }
            }
        }

        return $results;
    }

}

