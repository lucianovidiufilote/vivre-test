<?php


namespace App\Mover\Moves;


class Down extends BaseMove
{
    public const X = 1;
    public const Y = 0;
    public const OPPOSITE_MOVE = Up::class;
}