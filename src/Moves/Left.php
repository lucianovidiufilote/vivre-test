<?php


namespace App\Moves;


class Left extends BaseMove
{
    public const X = 0;
    public const Y = -1;
    public const OPPOSITE_MOVE = Right::class;
}