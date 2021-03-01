<?php


namespace App\Mover\Moves;


use App\Data\PositionData\PositionData;

class Up extends BaseMove
{
    public const X = -1;
    public const Y = 0;
    public const OPPOSITE_MOVE = Down::class;
}