<?php

declare (strict_types=1);

namespace Nasa\Infrastructure\Transformers;

use Nasa\Domain\Model\Position;

class PositionTransformer
{

    public static function positionToString(Position $positionObj): string
    {
        return sprintf(
            '%s %s %s',
            $positionObj->getX(),
            $positionObj->getY(),
            $positionObj->getOrientation()
        );
    }

    /**
     * Returns a Position when string is in this format 'int int str'
     *
     * @param string $positionString
     * @return Position
     */
    public static function stringToPosition(string $positionString): Position
    {
        list($x, $y, $orientation) = explode(' ', $positionString);
        return new Position((int) $x, (int) $y, (string) $orientation);
    }
}