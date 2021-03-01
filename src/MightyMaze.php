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

    public function run()
    {
        $json = $_REQUEST[0];
        $this->setInitialData($json);
        $this->generateLabyrinth();
        $this->findPath();

        echo json_encode([
            'labyrinth' => $this->labyrinthGenerator->getLabyrinth(),
            'path'      => is_null($this->pathFinder->getPath()) ? null : $this->pathFinder->getPath()->getSteps()
        ]);
        die;
    }

    public function setInitialData($json)
    {
        $this->labyrinthData = new LabyrinthData($json);
        $this->positionInitialData = new PositionInitialData($json);
        $this->positionData = new PositionData($json);
    }

    public function generateLabyrinth()
    {
//        ob_implicit_flush();
//        ob_start();
        $this->labyrinthGenerator->setLabyrinthData($this->labyrinthData);
        $this->labyrinthGenerator->setPositionInitialData($this->positionInitialData);
        $this->labyrinthGenerator->generate();
//        for ($i = 0; $i < count($this->labyrinthGenerator->getLabyrinth()); $i++) {
//            for ($j = 0; $j < count($this->labyrinthGenerator->getLabyrinth()[$i]); $j++) {
//                echo $this->labyrinthGenerator->getLabyrinth()[$i][$j] . " ";
//            }
//            echo "<br/>";
//        }
//        ob_end_flush();
//        ob_flush();
//        ob_clean();
    }

    public function findPath()
    {
        $this->pathFinder->setLabyrinth($this->labyrinthGenerator->getLabyrinth());
        $this->pathFinder->setPositionInitialData($this->positionInitialData);
        $this->pathFinder->setPositionData($this->positionData);
        $this->pathFinder->findPath();
    }
}