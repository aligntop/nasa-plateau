<?php

declare (strict_types=1);

namespace Nasa\Domain\Model;

use Nasa\Domain\Exception\OutOfThePlateauException;

class Position
{

    private const NORTH = 'N';
    private const WEST = 'W';
    private const SOUTH = 'S';
    private const EAST = 'E';

    /** @var int */
    private $x;

    /** @var int */
    private $y;

    /** @var string */
    private $orientation;

    /**
     * Position constructor.
     * @param int $x
     * @param int $y
     * @param string $orientation
     */
    public function __construct(
        int $x,
        int $y,
        string $orientation
    )
    {
        $this->x = $x;
        $this->y = $y;
        $this->orientation = $orientation;
    }

    public function getX(): int
    {
        return $this->x;
    }

    public function getY(): int
    {
        return $this->y;
    }

    public function getOrientation(): string
    {
        return $this->orientation;
    }

    public function updatePosition(
        Movement $movement,
        int $width,
        int $height
    ): void
    {
        $movement->isInstruction(Movement::M)
            ?
            $this->progress($width, $height)
            :
            $this->updateOrientation($movement);
    }

    private function progress(int $width, int $height): void
    {

        $decisions = [
            self::NORTH => [0, 1],
            self::EAST => [1, 0],
            self::SOUTH => [0, -1],
            self::WEST => [-1, 0],
        ];

        list($x, $y) = $decisions[$this->getOrientation()];
        $this->x += $x;
        $this->y += $y;

        $this->checkOutOfPlateau($width, $height);

    }

    private function checkOutOfPlateau(int $width, int $height): void
    {
        if (
            $this->x < 0 || $this->y < 0
            ||
            $this->x > $width || $this->y > $height
        ) {
            throw new OutOfThePlateauException();
        }
    }

    private function updateOrientation(Movement $movement): void
    {

        $decisions = [
            Movement::L => [
                self::NORTH => self::WEST,
                self::EAST => self::NORTH,
                self::SOUTH => self::EAST,
                self::WEST => self::SOUTH
            ],
            Movement::R => [
                self::NORTH => self::EAST,
                self::EAST => self::SOUTH,
                self::SOUTH => self::WEST,
                self::WEST => self::NORTH
            ]
        ];

        $this->orientation = $decisions[$movement->getInstruction()][$this->getOrientation()];

    }

}