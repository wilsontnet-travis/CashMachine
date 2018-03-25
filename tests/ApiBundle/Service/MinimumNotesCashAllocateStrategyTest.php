<?php

namespace Tests\ApiBundle\Test\Service;

use ApiBundle\Exception\InvalidArgumentException;
use ApiBundle\Exception\NoteUnavailableException;
use ApiBundle\Service\MinimumNotesCashAllocateStrategy;
use PHPUnit\Framework\TestCase;

class MinimumNotesCashAllocateStrategyTest extends TestCase
{
    /**
     * @dataProvider getTestProcessDataProvider
     *
     * @param int|null $input
     * @param array    $availableNotes
     * @param array    $expected
     */
    public function testProcess(?int $input, array $availableNotes, array $expected)
    {
        $testStrategy = new MinimumNotesCashAllocateStrategy($availableNotes);
        $actual = $testStrategy->process($input);
        $this->assertEquals($expected, $actual);
    }

    /**
     * @return array
     */
    public function getTestProcessDataProvider(): array
    {
        return [
            '#1 - should return same amount of notes twice' => [
                100,
                [10, 20, 50],
                [50, 50],
            ],
            '#2 - should return all amount of notes' => [
                80,
                [10, 20, 50],
                [50, 20, 10],
            ],
            '#3 - test 5 dollar note with random seq of notes' => [
                35,
                [20, 5, 10],
                [20, 10, 5],
            ],
            '#4 - test 1 dollar note' => [
                23,
                [10, 2, 1],
                [10, 10, 2, 1],
            ],
            '#5 - test a bigger number' => [
                560,
                [100, 50, 20, 10],
                [100, 100, 100, 100, 100, 50, 10],
            ],
            '#6 - Test NULL should return empty array' => [
                null,
                [10, 20, 50],
                [],
            ],
        ];
    }

    /**
     * @dataProvider getTestExceptionDataProvider
     *
     * @param mixed      $input
     * @param array      $availableNotes
     * @param \Exception $expected
     */
    public function testShouldThrowException($input, array $availableNotes, \Exception $expected)
    {
        $testStrategy = new MinimumNotesCashAllocateStrategy($availableNotes);
        $this->setExpectedException(get_class($expected));
        $testStrategy->process($input);
    }

    /**
     * @return array
     */
    public function getTestExceptionDataProvider(): array
    {
        return [
            '#1 - should throw NoteUnavailableException' => [
                55,
                [10],
                new NoteUnavailableException(),
            ],
            '#2 - should throw InvalidArgumentException when -ve input' => [
                -10,
                [10, 20, 50],
                new InvalidArgumentException('Input must be greater than 0!'),
            ],
            '#3 - should throw InvalidArgumentException when non integer input' => [
                80.1244,
                [10, 20, 50],
                new InvalidArgumentException('Input must be integer!!'),
            ],
            '#4 - should throw InvalidArgumentException when non integer input' => [
                'abcdef',
                [10, 20, 50],
                new InvalidArgumentException('Input must be integer!!'),
            ],
        ];
    }
}
