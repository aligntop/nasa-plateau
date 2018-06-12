<?php

declare (strict_types=1);

namespace Nasa\Domain\Model;

class Vehicle
{

    /** @var int */
    private $id;

    /** @var Position */
    private $position;

    public function __construct(int $id, Position $position)
    {
        $this->id = $id;
        $this->position = $position;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getPosition(): Position
    {
        return $this->position;
    }

    /**
     * @param Movement[] $movements
     * @param int        $width
     * @param int        $height
     */
    public function executeMovements(array $movements, int $width, int $height): void
    {
        for ( $i = 0; $i < count($movements); $i++ ) {
            $this->position->updatePosition($movements[$i], $width, $height);
        }
    }

}