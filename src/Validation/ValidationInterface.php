<?php

namespace Tlait\CarForRent\Validation;

use Tlait\CarForRent\Transfer\TransferInterface;

interface ValidationInterface
{
    /**
     * @param  TransferInterface $transfer
     * @return array
     */
    public function validate(TransferInterface $transfer): array;
}
