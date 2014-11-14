<?php
namespace qus\validation\core;

use qus\validation\rules\Command;

/**
 * CommandChain - contains the list of possible commands to execute
 * 
 * @author	Dave Meikle
 * 
 * @copyright 2007 - 2014
 */
class CommandChain
{
	protected $_commands = array();
	
	
	/**
	 * addCommand 		- adds the command object to the list of choices
	 * 
	 * @param Command	- the object to add
	 */
	public function addCommand(Command $cmd) {		
		$this->_commands[] = $cmd;		
	}
	
	/**
	 * runCommand	- the entry point for the validation from the page to be validated
	 * 
	 * @param string	name of command
	 * @param string 	input to validate
	 * 
	 */
	public function runCommand($name, &$args) {
            $name= preg_replace('/[^A-Za-z]/', '',$name);//mitigate SQL injection  

            foreach($this->_commands as $cmd) { 
                    if ($cmd->onCommand($name, $args)) {
                        
                    return;
    	  	}        
            }
  	}
}
