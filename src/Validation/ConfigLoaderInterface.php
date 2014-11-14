<?php


namespace Validation;

/**
 *
 * @author davem
 */
interface ConfigLoaderInterface {
   
    public function loadConfig($filepath);
    
    public function getConfig();
    
    public function getNode($key);
}
