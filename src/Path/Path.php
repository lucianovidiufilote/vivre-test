<?php


namespace App\Path;


use App\Data\PositionData\PositionData;
use App\Data\PositionData\PositionInitialData;
use App\Moves\Down;
use App\Moves\Left;
use App\Moves\Right;
use App\Moves\Up;
use ReflectionClass;

class Path
{
    /**
     * @var PositionData
     */
    private $positionData;
    private $labyrinth;
    private $moves = [];
    private $positionsUsed;
    /**
     * @var PositionInitialData
     */
    private $positionInitialData;

    public function __construct($labyrinth, PositionData $positionData, PositionInitialData $positionInitialData)
    {
        $this->labyrinth = $labyrinth;
        $this->positionData = $positionData;
        $this->positionInitialData = $positionInitialData;
    }


    /**
     * Check if A reached B
     * @return bool
     */
    public function reachedEnd()
    {
        if ($this->positionData->getPosAX() == $this->positionData->getPosBX()
            && $this->positionData->getPosAY() == $this->positionData->getPosBY()) {
            return true;
        }
        return false;
    }

    /**
     * Check if the player can move from the current position
     * @return bool
     */
    public function isStuck()
    {
        $up = Up::canMove($this->labyrinth, $this->positionData, $this->moves, $this->positionsUsed);
        $down = Down::canMove($this->labyrinth, $this->positionData, $this->moves, $this->positionsUsed);
        $left = Left::canMove($this->labyrinth, $this->positionData, $this->moves, $this->positionsUsed);
        $right = Right::canMove($this->labyrinth, $this->positionData, $this->moves, $this->positionsUsed);
        if (!$up
            && !$down
            && !$left
            && !$right) {
            return true;
        }
        return false;
    }

    /**
     * Generate all possible moves based on the position the player is currently located
     * @return array
     */
    public function lookAround()
    {
        /**
         * Each class has its own coordinates changes
         */
        $moves = [
            Up::class,
            Down::class,
            Left::class,
            Right::class
        ];
        $output = [];

        foreach ($moves as $move) {
            if ($move::canMove($this->labyrinth, $this->positionData, $this->moves, $this->positionsUsed)) {
                $newPosData = clone $this->positionData;
                $newPosData->setPosAX($this->positionData->getPosAX() + $move::X);
                $newPosData->setPosAY($this->positionData->getPosAY() + $move::Y);
                $newPath = new Path($this->labyrinth, $newPosData, $this->positionInitialData);
                $newPath->moves = $this->moves;
                $newPath->moves[] = $move;
                if (!isset($this->positionsUsed[$newPosData->getPosAX()][$newPosData->getPosAY()])) {
                    $this->positionsUsed[$newPosData->getPosAX()][$newPosData->getPosAY()] = 0;
                }
                $this->positionsUsed[$newPosData->getPosAX()][$newPosData->getPosAY()]++;
                $newPath->positionsUsed = $this->positionsUsed;
                $output[] = $newPath;
            }
        }
        return $output;
    }

    /**
     * @return array
     */
    public function getMoves(): array
    {
        return $this->moves;
    }

    /**
     * Return an array of coordinates for each move
     * Ex: [[1,1], [1,2]]
     * @return array
     */
    public function getSteps()
    {
        $this->positionInitialData;
        $output = [];
        $i = 0;
        $output[0] = [
            $this->positionInitialData->getPosAX(),
            $this->positionInitialData->getPosAY()
        ];
        foreach ($this->moves as $move) {
            $output[++$i] = [
                $output[$i - 1][0] + $move::X,
                $output[$i - 1][1] + $move::Y
            ];
        }
        return $output;
    }

    /**
     * Return an array of string representation of moves
     * Ex: ['up', 'down', 'left']
     * @return array
     * @throws \ReflectionException
     */
    public function getStringMoves()
    {
        $output = [];
        foreach ($this->moves as $move) {
            $output[] = (new ReflectionClass($move))->getShortName();
        }
        return $output;
    }


}