<?php

declare (strict_types=1);

namespace Nasa\Domain\Factory;

use Nasa\Domain\Exception\IncorrectInputException;
use Nasa\Domain\Model\Plateau;
use Nasa\Domain\Model\Vehicle;
use Nasa\Infrastructure\Transformers\PositionTransformer;

class PlateauFactory
{

    /**
     * PlateauFactory constructor.
     * @param int   $width
     * @param int   $height
     * @param array $positions Example [ '1 2 N', '4 2 W' ]
     *
     * @return Plateau
     * @throws IncorrectInputException
     */
    public static function create(
        int $width,
        int $height,
        array $positions
    ): Plateau
    {

        $vehicles = [];
        for ( $i = 0; $i < count($positions); $i++) {
            $vehicles[$i] = new Vehicle(
                (int) $i,
                PositionTransformer::stringToPosition($positions[$i])
            );
        }

        return new Plateau($width, $height, $vehicles);

    }

}