<?php


namespace App\Mover\Moves;


use App\Data\PositionData\PositionData;

abstract class BaseMove implements MoveInterface
{
    public const X = 0;
    public const Y = 0;

    public static function canMove($labyrinth, PositionData $positionData)
    {
        $currentX = $positionData->getPosAX() - 1;
        $currentY = $positionData->getPosAY() - 1;

        if (isset($labyrinth[$currentX + static::X])
            && isset($labyrinth[$currentY + static::Y])
            && $labyrinth[$currentX + static::X] != 'b'
            && $labyrinth[$currentY + static::Y] != 'b') {
            return true;
        }
        return false;
    }

}