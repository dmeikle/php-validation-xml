<?php
namespace validation\core;

use validation\core\ValidationItem;

abstract class Command {
    
    public abstract function onCommand($action, ValidationItem &$object);
    
    
}

