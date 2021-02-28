<?php

namespace App;

use App\Data\LabyrinthData\LabyrinthData;
use App\Data\PositionData\PositionData;
use App\Data\PositionData\PositionInitialData;
use App\Labyrinth\LabyrinthGenerator;
use App\Path\PathFinder;


class MightyMaze
{
    /**
     * @var LabyrinthData $labyrinthData
     */
    private $labyrinthData;
    /**
     * @var PositionInitialData $positionInitialData
     */
    private $positionInitialData;
    /**
     * @var PositionData $positionData
     */
    private $positionData;
    /**
     * @var LabyrinthGenerator
     */
    private $labyrinthGenerator;
    /**
     * @var PathFinder
     */
    private $pathFinder;

    public function __construct(LabyrinthGenerator $labyrinthGenerator, PathFinder $pathFinder)
    {
        $this->labyrinthGenerator = $labyrinthGenerator;
        $this->pathFinder = $pathFinder;
    }

    public function run($json = null)
    {
        $json = '{"dimX": 10, "dimY": 10, "posAX": 2, "posAY": 2, "posBX": 7, "posBY": 8, "brickDensity": 50}';
        $this->setInitialData($json);
        $this->generateLabyrinth();
        $this->findPath();
    }

    public function setInitialData($json)
    {
        $this->labyrinthData = new LabyrinthData($json);
        $this->positionInitialData = new PositionInitialData($json);
        $this->positionData = new PositionData($json);
    }

    public function generateLabyrinth()
    {
        $this->labyrinthGenerator->setLabyrinthData($this->labyrinthData);
        $this->labyrinthGenerator->setPositionInitialData($this->positionInitialData);
        $this->labyrinthGenerator->generate();
        for ($i = 0; $i < count($this->labyrinthGenerator->getLabyrinth()); $i++) {
            for ($j = 0; $j < count($this->labyrinthGenerator->getLabyrinth()[$i]); $j++) {
                echo $this->labyrinthGenerator->getLabyrinth()[$i][$j] . " ";
            }
            echo "<br/>";
        }
    }

    public function findPath()
    {
        $this->pathFinder->setLabyrinth($this->labyrinthGenerator->getLabyrinth());
        $this->pathFinder->setPositionInitialData($this->positionInitialData);
        $this->pathFinder->setPositionData($this->positionData);
        $this->pathFinder->findPath();
    }
}