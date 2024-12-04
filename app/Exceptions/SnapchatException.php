<?php

namespace App\Exceptions;

use Exception;

class SnapchatException extends Exception
{    
    public function __construct($message, $status =400) {
        $this->message = $message;
        $this->code = $status;
    }
}
