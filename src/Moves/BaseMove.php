<?php


namespace App\Moves;


use App\Data\PositionData\PositionData;

abstract class BaseMove implements MoveInterface
{
    public const X = 0;
    public const Y = 0;
    public const OPPOSITE_MOVE = null;

    public static function canMove($labyrinth, PositionData $positionData, $moves, $positionsUsed)
    {
        $lastMove = end($moves);
        if ($lastMove == static::OPPOSITE_MOVE) {
            return false;
        }

        $currentX = $positionData->getPosAX() - 1;
        $currentY = $positionData->getPosAY() - 1;

        $newX = $currentX + static::X;
        $newY = $currentY + static::Y;

        if (isset($labyrinth[$newX])
            && isset($labyrinth[$newX][$newY])
            && ($labyrinth[$newX][$newY] === 0 || $labyrinth[$newX][$newY] === 'B')
            && !isset($positionsUsed[$newX + 1][$newY + 1])) {
            return true;
        }
        return false;
    }

}