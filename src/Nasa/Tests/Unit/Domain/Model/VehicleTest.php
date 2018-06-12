<?php

declare(strict_types=1);

namespace Nasa\Tests\Unit\Domain\Model;

use Nasa\Domain\Model\Movement;
use Nasa\Domain\Model\Position;
use Nasa\Domain\Model\Vehicle;
use PHPUnit\Framework\TestCase;

class VehicleTest extends TestCase
{

    public function testVehicleCreation(): void
    {

        $id = mt_rand();
        $width = mt_rand();
        $height = mt_rand();

        $m1 = new Movement(Movement::L);
        $m2 = new Movement(Movement::R);
        $movements = [$m1, $m2];

        $position = $this->prophesize(Position::class);
        $position->updatePosition($m1, $width, $height)->shouldBeCalledTimes(1);
        $position->updatePosition($m2, $width, $height)->shouldBeCalledTimes(1);

        $vehicle = new Vehicle($id, $position->reveal());
        $vehicle->executeMovements($movements, $width, $height);

        $this->assertEquals($id, $vehicle->getId());

    }

}