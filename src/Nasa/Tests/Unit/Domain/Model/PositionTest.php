<?php

declare (strict_types=1);

namespace Nasa\Tests\Unit\Domain\Model;

use Nasa\Domain\Model\Movement;
use Nasa\Domain\Model\Position;
use Nasa\Infrastructure\Transformers\PositionTransformer;
use PHPUnit\Framework\TestCase;

class PositionTest extends TestCase
{

    public function testCreation()
    {

        $x = mt_rand();
        $y = mt_rand();
        $orientation = ['N', 'S', 'W', 'E'][mt_rand(0, 3)];

        $position = new Position($x, $y, $orientation);

        $this->assertEquals($x, $position->getX());
        $this->assertEquals($y, $position->getY());
        $this->assertEquals($orientation, $position->getOrientation());

    }

    /**
     * @dataProvider getDataStraight
     * @dataProvider getDataLeftRight
     */
    public function testProgress(string $initialPosition, string $movement, string $expectedPosition): void
    {

        // Let's assume that the plateau is 10x10 in this test
        $width = 10;
        $height = 10;

        $position = PositionTransformer::stringToPosition($initialPosition);
        $position->updatePosition(new Movement($movement), $width, $height);
        $this->assertEquals($expectedPosition, PositionTransformer::positionToString($position));

    }

    public function getDataStraight(): array
    {
        return [
            ['1 1 N', 'M', '1 2 N'],
            ['1 1 E', 'M', '2 1 E'],
            ['1 1 S', 'M', '1 0 S'],
            ['1 1 W', 'M', '0 1 W'],
        ];
    }

    public function getDataLeftRight(): array
    {
        return [
            ['0 0 E', 'L', '0 0 N'],
            ['0 0 E', 'R', '0 0 S'],
            ['0 0 N', 'L', '0 0 W'],
            ['0 0 N', 'R', '0 0 E'],
            ['0 0 W', 'L', '0 0 S'],
            ['0 0 W', 'R', '0 0 N'],
            ['0 0 S', 'L', '0 0 E'],
            ['0 0 S', 'R', '0 0 W'],
        ];
    }

    /**
     * @dataProvider getDataOutOfPlateau
     * @expectedException \Nasa\Domain\Exception\OutOfThePlateauException
     */
    public function testProgressThrowsException(
        int $width,
        int $height,
        string $initialPosition,
        string $movement
    ): void
    {
        $position = PositionTransformer::stringToPosition($initialPosition);
        $position->updatePosition(new Movement($movement), $width, $height);
    }

    public function getDataOutOfPlateau(): array
    {
        return [
            [5, 5, '5 5 N', 'M'],
        ];
    }

}