<?php


namespace App\Moves;


class Right extends BaseMove
{
    public const X = 0;
    public const Y = 1;
    public const OPPOSITE_MOVE = Left::class;
}