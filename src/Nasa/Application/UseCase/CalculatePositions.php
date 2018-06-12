<?php

declare (strict_types=1);

namespace Nasa\Application\UseCase;

use Nasa\Domain\Factory\PlateauFactory;
use Nasa\Domain\Model\Movement;
use Nasa\Domain\Model\Position;
use Nasa\Domain\Model\Vehicle;
use Nasa\Infrastructure\Views\PositionTrasnformer;

class CalculatePositions {

    /**
     * @param int $width
     * @param int $height
     * @param array $positions
     * @param array $movements like [ 'LMMLRMMRMLMLLRRM', ... ]
     * @return Position[]
     */
    public function exec(int $width, int $height, array $positions, array $movements): array
    {

        $plateau = PlateauFactory::create($width, $height, $positions);

        $movements = array_map(
            function ($movementsPerVehicle) {
                return array_map(
                    function (string $instruction) {
                        return new Movement($instruction);
                    },
                    str_split($movementsPerVehicle)
                );
            },
            $movements
        );

        $plateau->executeMovements($movements);

        return (array_map(function (Vehicle $vehicle) {
            return $vehicle->getPosition();
        }, $plateau->getVehicles()));

    }

}
