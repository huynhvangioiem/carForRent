<?php

namespace Tlait\CarForRent\Exception;

use Exception;
use Throwable;

class ValidationException extends Exception
{

    public function __construct($message = "Invalid input parameters", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
