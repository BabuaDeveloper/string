<?php

namespace App\Exceptions;

use Exception;

class TikTokException extends Exception
{    
    public function __construct($message, $status =400) {
        $this->message = $message;
        $this->code = $status;
    }
}
