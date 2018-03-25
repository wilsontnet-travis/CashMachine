<?php

namespace ApiBundle\Service\Interfaces;

use ApiBundle\Exception\InvalidArgumentException;
use ApiBundle\Exception\NoteUnavailableException;

interface CashAllocateStrategyInterface
{
    /**
     * @param mixed $input
     *
     * @return array
     *
     * @throws NoteUnavailableException
     * @throws InvalidArgumentException
     */
    public function process($input): array;
}
