<?php
namespace validation\exceptions;

/**
 * Create a class for Unauthorized Access
 */
class XMLNodeNotConfiguredException extends \Exception
{
    // Redefine the exception so message isn't optional
    public function __construct($message, $code = 5060, Exception $previous = null) {
        // some code

        // make sure everything is assigned properly
        parent::__construct($message, $code, $previous);
    }

    // custom string representation of object
    public function __toString() {
        return __CLASS__ . ": [{$this->code}]: {$this->message}\n";
    }

}

