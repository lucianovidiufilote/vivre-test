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
    private $moves;

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
        $output = [];
        if (Up::canMove($this->labyrinth, $this->positionData)) {
            $newPosData = clone $this->positionData;
            $newPosData->setPosAX($this->positionData->getPosAX() + Up::X);
            $newPosData->setPosAY($this->positionData->getPosAY() + Up::Y);
            $newPath = new Path($this->labyrinth, $newPosData);
            $newPath->moves = $this->moves;
            $newPath->moves[] = Up::class;
            $output[] = $newPath;
        }

        if (Down::canMove($this->labyrinth, $this->positionData)) {
            $newPosData = clone $this->positionData;
            $newPosData->setPosAX($this->positionData->getPosAX() + Down::X);
            $newPosData->setPosAY($this->positionData->getPosAY() + Down::Y);
            $newPath = new Path($this->labyrinth, $newPosData);
            $newPath->moves = $this->moves;
            $newPath->moves[] = Down::class;
            $output[] = $newPath;
        }
        if (Right::canMove($this->labyrinth, $this->positionData)) {
            $newPosData = clone $this->positionData;
            $newPosData->setPosAX($this->positionData->getPosAX() + Right::X);
            $newPosData->setPosAY($this->positionData->getPosAY() + Right::Y);
            $newPath = new Path($this->labyrinth, $newPosData);
            $newPath->moves = $this->moves;
            $newPath->moves[] = Right::class;
            $output[] = $newPath;
        }
        if (Left::canMove($this->labyrinth, $this->positionData)) {
            $newPosData = clone $this->positionData;
            $newPosData->setPosAX($this->positionData->getPosAX() + Left::X);
            $newPosData->setPosAY($this->positionData->getPosAY() + Left::Y);
            $newPath = new Path($this->labyrinth, $newPosData);
            $newPath->moves = $this->moves;
            $newPath->moves[] = Left::class;
            $output[] = $newPath;
        }
        return $output;
    }


}