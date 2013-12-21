<?php
namespace validation\core;

use validation\core\ValidationItem;


/**
 * Command - abstract base class for the command objects
 * 
 * @author	Dave Meikle
 * 
 * @copyright 2007 - 2014
 */
abstract class Command {
    
	/**
     * method onCommand - used by the command chain
     * 
     * @param string 			action
     * @param ValidationItem 	object
	 * 
	 * @return boolean
     */
    public abstract function onCommand($action, ValidationItem &$object);
    
    
}

