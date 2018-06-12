<?php

declare (strict_types=1);

namespace Nasa\Domain\Model;

use Nasa\Domain\Exception\IncorrectInputException;

class Plateau
{

    /** @var int */
    private $height;

    /** @var int */
    private $width;

    /** @var Vehicle[] */
    private $vehicles;

    /**
     * Plateau constructor.
     * @param int       $width
     * @param int       $height
     * @param Vehicle[] $vehicles
     */
    public function __construct(
        int $width,
        int $height,
        array $vehicles
    ) {
        $this->width = $width;
        $this->height = $height;
        $this->vehicles = array_values($vehicles);
    }

    public function getHeight(): int
    {
        return $this->height;
    }

    public function getWidth(): int
    {
        return $this->width;
    }

    /**
     * @return Vehicle[]
     */
    public function getVehicles(): array
    {
        return $this->vehicles;
    }

    public function getAmountOfVehicles(): int
    {
        return count($this->vehicles);
    }

    /**
     * @param Movement[] $movements
     *
     * @throws IncorrectInputException
     */
    public function executeMovements(array $movements): void
    {

        if ( count($movements) !== $this->getAmountOfVehicles() ) {
            throw new IncorrectInputException();
        }

        for ( $i = 0; $i < count($movements); $i++) {
            $this->vehicles[$i]->executeMovements($movements[$i], $this->getWidth(), $this->getHeight());
        }

    }

}