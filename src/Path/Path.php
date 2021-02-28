<?php


namespace App\Path;


use App\Data\PositionData\PositionData;
use App\Mover\Moves\Down;
use App\Mover\Moves\Left;
use App\Mover\Moves\Right;
use App\Mover\Moves\Up;

class Path
{
    /**
     * @var PositionData
     */
    private $positionData;
    private $labyrinth;

    public function __construct($labyrinth, PositionData $positionData)
    {
        $this->labyrinth = $labyrinth;
        $this->positionData = $positionData;
    }


    public function reachedEnd()
    {
        if ($this->positionData->getPosAX() == $this->positionData->getPosBX() && $this->positionData->getPosAY() == $this->positionData->getPosBY()) {
            return true;
        }
        return false;
    }

    public function isStuck()
    {
        if (!Up::canMove($this->labyrinth, $this->positionData)
            && !Down::canMove($this->labyrinth, $this->positionData)
            && !Left::canMove($this->labyrinth, $this->positionData)
            && !Right::canMove($this->labyrinth, $this->positionData)) {
            return true;
        }
        return false;
    }

    public function lookAround()
    {
        if (Up::canMove($this->labyrinth, $this->positionData)) {
            $this->positionData->setPosAX($this->positionData->getPosAX() + Up::X);
            $this->positionData->setPosAY($this->positionData->getPosAY() + Up::Y);
        }
    }


}