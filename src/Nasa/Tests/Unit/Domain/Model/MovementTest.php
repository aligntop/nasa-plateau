<?php

declare(strict_types=1);

namespace Nasa\Tests\Unit\Domain\Model;

use Nasa\Domain\Model\Movement;
use PHPUnit\Framework\TestCase;

class MovementTest extends TestCase
{

    public function testCreatingAMovement(): void
    {

        $m = new Movement('M');
        $this->assertEquals('M', $m->getInstruction());
        $this->assertTrue($m->isInstruction('M'));

    }

    /**
     * @expectedException \Nasa\Domain\Exception\InvalidMovementException
     */
    public function testCreatingAMovementThrowsException(): void
    {
        new Movement('U');
    }

}