<?php

declare (strict_types=1);

namespace Nasa\Domain\Model;

use Nasa\Domain\Exception\InvalidMovementException;

class Movement
{

    public const L = 'L';
    public const R = 'R';
    public const M = 'M';

    /** @var string */
    private $instruction;

    public function __construct(string $instruction)
    {

        if ( ! in_array($instruction, [self::L, self::M, self::R])) {
            throw new InvalidMovementException();
        }

        $this->instruction = $instruction;
    }

    public function getInstruction(): string
    {
        return $this->instruction;
    }

    public function isInstruction(string $instruction): bool
    {
        return $instruction === $this->instruction;
    }

}