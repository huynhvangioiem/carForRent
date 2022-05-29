<?php

namespace Tlait\CarForRent\Validation;

use Tlait\CarForRent\Transfer\TransferInterface;

class UserValidator implements ValidationInterface
{
    /**
     * @param  TransferInterface $transfer
     * @return array
     * if success with return empty array, else return array with error message
     */
    public function validate(TransferInterface $transfer): array
    {
        $errorRequiredValidate = $this->requiredValidate($transfer);
        if (!empty($errorRequiredValidate)) {
            return $errorRequiredValidate;
        }
        $errorMaxLengthValidate = $this->maxLengthValidate($transfer);
        if (!empty($errorMaxLengthValidate)) {
            return $errorMaxLengthValidate;
        }
        return [];
    }

    /**
     * @param  TransferInterface $transfer
     * @return array
     * if success with return empty array, else return array with error message
     */
    protected function requiredValidate(TransferInterface $transfer): array
    {
        $error = array();
        if (empty($transfer->getUsername())) {
            $error = array_merge($error, array('username' => "Username is required!"));
        }
        if (empty($transfer->getPassword())) {
            $error = array_merge($error, array('password' => "Password is required!"));
        }
        return $error;
    }

    /**
     * @param  TransferInterface $transfer
     * @return array
     * if success with return empty array, else return array with error message
     */
    protected function maxLengthValidate(TransferInterface $transfer): array
    {
        $error = [];
        if (strlen($transfer->getUserName()) > 50) {
            $error = array_merge($error, array('username' => "User name must not exceed 50 characters!"));
        }
        if (strlen($transfer->getPassword()) > 16) {
            $error = array_merge($error, array('password' => "Password must not exceed 16 characters!"));
        }
        return $error;
    }
}
