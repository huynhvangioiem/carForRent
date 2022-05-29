<?php

namespace Tlait\CarForRent\Validation;

use Tlait\CarForRent\Transfer\TransferInterface;

class CarValidation extends ValidateRules implements ValidationInterface
{
    public function validate(TransferInterface $transfer): array
    {
        $validateData = [
            'name' => $transfer->getName(),
            'description' => $transfer->getDescription(),
            'price' => $transfer->getPrice(),
        ];
        $validateRules = [
            'name' => ["max:50"],
            'description' => ["required"],
            'price' => ["required"],
        ];
        return $this->handleValidate($validateData, $validateRules);
    }
}
