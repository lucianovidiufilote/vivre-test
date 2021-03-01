<?php


namespace App\Path;


use App\Data\PositionData\PositionData;
use App\Data\PositionData\PositionInitialData;

class PathFinder
{
    /**
     * @var Path $path
     */
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
    /**
     * @var array
     */
    private $paths;

    public function findPath()
    {
        /**
         * First path
         */
        $path = new Path($this->labyrinth, $this->positionData, $this->positionInitialData);
        $this->start($path);

        if (!empty($this->paths)) {
            $bestPath = [];
            /**
             * @var Path $path
             */
            foreach ($this->paths as $path) {
                $bestPath[count($path->getMoves())] = $path;
            }

            ksort($bestPath);
            $result = reset($bestPath);
            //print_r($result);die;
            $this->setPath($result);
        }
        else {
            $this->setPath(null);
        }
    }


    /**
     * @param Path $path
     * @return mixed
     */
    private function start(Path $path)
    {
        if ($path->reachedEnd()) {
            $this->paths[] = $path;
            return $path;
        }

        if ($path->isStuck()){
            return false;
        }

        $output = $path->lookAround();
        foreach ($output as $path) {
            $this->start($path);
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