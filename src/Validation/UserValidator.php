<?php

namespace Tlait\CarForRent\Validation;

use Exception;
use PhpParser\Node\Expr\Cast\Object_;
use Tlait\CarForRent\Exception\ValidationException;
use Tlait\CarForRent\Transfer\TransferInterface;

class UserValidator implements ValidationInterface
{

    public function validate(TransferInterface $transfer): bool
    {
        $this->requiredValidate($transfer);
        return true;
    }

    protected function requiredValidate(TransferInterface $transfer)
    {
        if (empty($transfer->getUsername())) {
            throw new ValidationException('username is required');
//            return false;
        }
        if (empty($transfer->getPassword())) {
            throw new ValidationException('password is required');
//            return false;
        }
    }
}
