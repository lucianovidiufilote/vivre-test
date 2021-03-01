<?php


namespace App\PathFinder;


use App\Data\PositionData\PositionData;
use App\Data\PositionData\PositionInitialData;
use App\Path\Path;

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

        /**
         * Detect all paths
         * Save to $this->paths
         */
        $this->start($path);

        /**
         * Detect the shortest path
         */
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
            $this->setPath($result);
        }
        else {
            $this->setPath(null);
        }
    }


    /**
     * Recursive function for detecting all paths
     * While being on a position, generate all possible paths
     * If you get stuck, abandon path
     * If you do not get stuck, save path to $this->paths
     *
     * @todo: optimize algo, maybe use existing one
     *
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
     * @param mixed $labyrinth
     */
    public function setLabyrinth($labyrinth)
    {
        $this->labyrinth = $labyrinth;
    }


    /**
     * @param mixed $positionInitialData
     */
    public function setPositionInitialData($positionInitialData)
    {
        $this->positionInitialData = $positionInitialData;
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