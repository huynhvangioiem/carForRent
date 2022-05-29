<?php

namespace Tlait\CarForRent\Transfer;

interface TransferInterface
{
    public function formArray(array $params): TransferInterface;
}
