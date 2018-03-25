<?php

namespace ApiBundle\Service;

use ApiBundle\Exception\InvalidArgumentException;
use ApiBundle\Exception\NoteUnavailableException;
use ApiBundle\Service\Interfaces\CashAllocateStrategyInterface;

class MinimumNotesCashAllocateStrategy implements CashAllocateStrategyInterface
{
    /**
     * @var array
     */
    private $availableNotes;

    /**
     * @param array $availableNotes
     */
    public function __construct(
        array $availableNotes
    ) {
        $this->availableNotes = $availableNotes;
        // make sure the array is sort acs
        rsort($this->availableNotes, SORT_NUMERIC);
    }

    /**
     * {@inheritdoc}
     */
    public function process($input): array
    {
        if (null === $input) {
            return [];
        }

        $this->validateInput($input);
        $result = [];
        $this->generateNoteAllocation($input, $result);

        return $result;
    }

    /**
     * @param int   $value
     * @param array $result_notes
     *
     * @throws NoteUnavailableException
     */
    private function generateNoteAllocation(int $value, array &$result_notes)
    {
        if (0 === $value) {
            return; // exit case
        }

        foreach ($this->availableNotes as $note) {
            if ($value >= $note) {
                $result_notes[] = $note;
                // keep going until the amount is Zero or less than smallest note
                return $this->generateNoteAllocation($value - $note, $result_notes);
            }
        }

        // if value less than smallest note means we don't have suitable notes for this input
        throw new NoteUnavailableException();
    }

    /**
     * @param mixed $input
     *
     * @throws InvalidArgumentException
     */
    private function validateInput($input)
    {
        if (false === filter_var($input, FILTER_VALIDATE_INT)) {
            throw new InvalidArgumentException('Input must be integer!');
        } else {
            if ((int) $input < 0) {
                throw new InvalidArgumentException('Input must be greater than 0!');
            }
        }
    }
}
