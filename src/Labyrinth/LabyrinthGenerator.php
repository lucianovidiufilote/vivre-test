<?php


namespace App\Labyrinth;


use App\Data\LabyrinthData\LabyrinthData;
use App\Data\PositionData\PositionInitialData;

class LabyrinthGenerator
{
    private $labyrinth;

    /**
     * @var LabyrinthData $labyrinthData
     */
    private $labyrinthData;

    /**
     * @var PositionInitialData $positionInitialData
     */
    private $positionInitialData;

    /**
     * @return PositionInitialData
     */
    public function getPositionInitialData()
    {
        return $this->positionInitialData;
    }

    /**
     * @param PositionInitialData $positionInitialData
     */
    public function setPositionInitialData($positionInitialData)
    {
        $this->positionInitialData = $positionInitialData;
    }

    /**
     * Generate one dim array with 0
     * Fill the array with brickDensity number of bricks
     * Shuffle the bricks
     * Generate matrix based on the one dim array
     * Put A and B in the matrix
     */
    public function generate()
    {
        $totalSize = $this->labyrinthData->getDimX() * $this->labyrinthData->getDimY();
        /**
         * Generate one dim array with 0
         */
        $oneDimensionalMaze = array_fill(0, $totalSize, 0);

        /**
         * Number of bricks to add
         * 2 is for A and B
         */
        $numberOfBricks = round((($totalSize) * $this->labyrinthData->getBrickDensity()) / 100);

        /**
         * Fill the array with brickDensity number of bricks
         */
        for ($i = 0; $i < $numberOfBricks; $i++) {
            $oneDimensionalMaze[$i] = 'b';
        }

        /**
         * Shuffle the bricks
         */
        shuffle($oneDimensionalMaze);

        /**
         * Generate matrix based on the one dim array
         */
        $index = 0;
        for ($i = 0; $i < $this->labyrinthData->getDimX(); $i++) {
            for ($j = 0; $j < $this->labyrinthData->getDimX(); $j++) {
                $this->labyrinth[$i][$j] = $oneDimensionalMaze[$index];
                $index++;
            }
        }

        /**
         * Add A and B
         */
        $this->labyrinth[$this->positionInitialData->getPosAX() - 1][$this->positionInitialData->getPosAY() - 1] = 'A';
        $this->labyrinth[$this->positionInitialData->getPosBX() - 1][$this->positionInitialData->getPosBY() - 1] = 'B';
    }

    /**
     * @return mixed
     */
    public function getLabyrinthData()
    {
        return $this->labyrinthData;
    }

    /**
     * @param mixed $labyrinthData
     */
    public function setLabyrinthData($labyrinthData)
    {
        $this->labyrinthData = $labyrinthData;
    }

    /**
     * @return mixed
     */
    public function getLabyrinth()
    {
        return $this->labyrinth;
    }

    /**
     * @param mixed $labyrinth
     */
    public function setLabyrinth($labyrinth)
    {
        $this->labyrinth = $labyrinth;
    }


}