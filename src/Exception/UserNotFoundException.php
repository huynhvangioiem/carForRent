<?php

namespace Tlait\CarForRent\Exception;

use Exception;
use Throwable;

class UserNotFoundException extends Exception
{
    public function __construct($message = "User not found", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
