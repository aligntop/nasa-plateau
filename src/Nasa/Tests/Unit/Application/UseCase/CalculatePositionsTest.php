<?php

declare (strict_types=1);

namespace Nasa\Tests\Unit\Application\UseCase;

use Nasa\Infrastructure\Transformers\PositionTransformer;
use Nasa\Application\UseCase\CalculatePositions;
use Nasa\Domain\Model\Position;
use PHPUnit\Framework\TestCase;

class CalculatePositionsTest extends TestCase
{

    /**
     * @dataProvider getTestDataCreation
     */
    public function testCreation(
        int $width,
        int $height,
        array $initialPositions,
        array $movements,
        array $expected
    ) {

        $calculatePositionsUseCase = new CalculatePositions();
        $resultPosition = $calculatePositionsUseCase->exec(
            $width,
            $height,
            $initialPositions,
            $movements
        );

        $resultPositionString = array_map(
            function ( Position $position) {
                return PositionTransformer::positionToString($position);
            },
            $resultPosition
        );

        $this->assertEquals($expected, $resultPositionString);

    }

    public function getTestDataCreation(): array
    {
        return [
            [ 5, 5, ['1 2 N', '3 3 E'], ['LMLMLMLMM', 'MMRMMRMRRM'], ['1 3 N', '5 1 E']],
        ];
    }

}