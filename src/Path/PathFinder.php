<?php


namespace App\Path;


use App\Data\PositionData\PositionData;
use App\Data\PositionData\PositionInitialData;
use App\Mover\Moves\Up;

class PathFinder
{
    private $path;

    /**
     * @var array;
     */
    private $labyrinth;
    /**
     * @var PositionInitialData $positionInitialData
     */
    private $positionInitialData;

    /**
     * @var PositionData $positionData
     */
    private $positionData;

    private $paths;

    public function findPath()
    {
        /**
         * First path
         */
        $path = new Path($this->labyrinth, $this->positionData);

        $this->start($path);

    }


    private function start($path)
    {
        while (!$path->reachedEnd()){
            if ($path->isStuck()){
                unset($path);
                break;
            }
            $paths[] = $path->lookAround();
        }
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

    /**
     * @return mixed
     */
    public function getPositionInitialData()
    {
        return $this->positionInitialData;
    }

    /**
     * @param mixed $positionInitialData
     */
    public function setPositionInitialData($positionInitialData)
    {
        $this->positionInitialData = $positionInitialData;
    }

    /**
     * @return mixed
     */
    public function getPositionData()
    {
        return $this->positionData;
    }

    /**
     * @param mixed $positionData
     */
    public function setPositionData($positionData)
    {
        $this->positionData = $positionData;
    }


    /**
     * @return mixed
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * @param mixed $path
     */
    public function setPath($path)
    {
        $this->path = $path;
    }


}