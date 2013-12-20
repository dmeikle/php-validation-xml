<?php
namespace exceptions;

class InvalidInstanceException extends \Exception
{
	public function __construct($message, $code = 1110, Exception $previous = null) {
       
        // make sure everything is assigned properly
        parent::__construct($message, $code, $previous);
    }

    // custom string representation of object
    public function __toString() {
        return __CLASS__ . ": [{$this->code}]: {$this->message}\n";
    }
}
	

