<?php


namespace App\Mover\Moves;


use App\Data\PositionData\PositionData;

abstract class BaseMove implements MoveInterface
{
    public const X = 0;
    public const Y = 0;

    public static function canMove($labyrinth, PositionData $positionData)
    {
        $currentX = $positionData->getPosAX();
        $currentY = $positionData->getPosAY();

        if ($labyrinth[$currentX + static::X] != 'b' && $labyrinth[$currentY + static::Y] != 'b') {
            return true;
        }
        return false;
    }

}