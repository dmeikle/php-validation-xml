<?php
namespace validation\core;


abstract class Command {
    
    public abstract function onCommand($action, &$object);
    
    
}

