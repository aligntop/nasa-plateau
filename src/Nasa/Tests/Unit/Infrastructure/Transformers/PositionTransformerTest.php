<?php

declare (strict_types=1);

namespace Nasa\Tests\Unit\Infrastructure\Transformers;

use Nasa\Domain\Model\Position;
use Nasa\Infrastructure\Transformers\PositionTransformer;
use PHPUnit\Framework\TestCase;

class PositionTransformerTest extends TestCase
{

    public function testTransformFromString(): void
    {

        $x = mt_rand();
        $y = mt_rand();
        $orientation = 'N';

        $string = sprintf('%s %s %s', $x, $y, $orientation);
        $position = PositionTransformer::stringToPosition($string);

        $this->assertEquals($x, $position->getX());
        $this->assertEquals($y, $position->getY());
        $this->assertEquals($orientation, $position->getOrientation());

    }

    public function testTransformFromPosition(): void
    {

        $x = mt_rand();
        $y = mt_rand();
        $orientation = 'N';
        $expectedString = sprintf('%s %s %s', $x, $y, $orientation);

        $position = new Position($x, $y, $orientation);
        $string = PositionTransformer::positionToString($position);

        $this->assertEquals($expectedString, $string);

    }

}