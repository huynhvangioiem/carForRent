<?php

namespace Tlait\CarForRent\Exception;

use Exception;
use Throwable;

class PasswordInvalidException extends Exception
{
    public function __construct($message = "Invalid password", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
