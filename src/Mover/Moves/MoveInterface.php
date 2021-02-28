<?php


namespace App\Mover\Moves;


use App\Data\PositionData\PositionData;

interface MoveInterface
{
    public static function canMove($labyrinth, PositionData $positionData);
}