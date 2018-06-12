<?php

declare(strict_types=1);

namespace Nasa\Tests\Unit\Domain\Model;

use Nasa\Domain\Model\Movement;
use Nasa\Domain\Model\Plateau;
use Nasa\Domain\Model\Position;
use Nasa\Domain\Model\Vehicle;
use PHPUnit\Framework\TestCase;

class PlateauTest extends TestCase
{

    /**
     * @expectedException \Nasa\Domain\Exception\IncorrectInputException
     */
    public function testThrowException(): void
    {

        $vehicles = [
            new Vehicle(mt_rand(), new Position(1,1,'W')),
            new Vehicle(mt_rand(), new Position(2,2, 'W'))
        ];

        $movements = [
            new Movement(Movement::L)
        ];

        $plateau = new Plateau(mt_rand(), mt_rand(), $vehicles);
        $plateau->executeMovements($movements);

    }

}