<?php

namespace Tlait\CarForRent\Validation;

use Exception;
use Tlait\CarForRent\Transfer\TransferInterface;

interface ValidationInterface
{
    /**
     * @param TransferInterface $transfer
     * @return bool
     * @throws Exception
     */
    public function validate(TransferInterface $transfer): bool;
}
