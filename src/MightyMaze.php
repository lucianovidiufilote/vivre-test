<?php

namespace App;

use App\Data\LabyrinthData\LabyrinthData;
use App\Data\PositionData\PositionData;
use App\Data\PositionData\PositionInitialData;
use App\Labyrinth\LabyrinthGenerator;
use App\PathFinder\PathFinder;


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
            'steps'     => is_null($this->pathFinder->getPath()) ? null : $this->pathFinder->getPath()->getSteps(),
            'moves'     => is_null($this->pathFinder->getPath()) ? null : $this->pathFinder->getPath()->getStringMoves()
        ]);
        exit;
    }


    public function setInitialData($json)
    {
        /**
         * Where the labyrinth input data is stored
         */
        $this->labyrinthData = new LabyrinthData($json);

        /**
         * Where the initial A and B positions are stores
         */
        $this->positionInitialData = new PositionInitialData($json);

        /**
         * Ever-changing position of A
         */
        $this->positionData = new PositionData($json);
    }

    /**
     * Generate the labyrinth
     *
     * @todo: install doctrine/dbal and really save to DB
     */
    public function generateLabyrinth()
    {
        $this->labyrinthGenerator->setLabyrinthData($this->labyrinthData);
        $this->labyrinthGenerator->setPositionInitialData($this->positionInitialData);
        $this->labyrinthGenerator->generate();
    }

    /**
     * Find the shortest path from A to B
     *
     * @todo: install doctrine/dbal and really save to DB
     */
    public function findPath()
    {
        $this->pathFinder->setLabyrinth($this->labyrinthGenerator->getLabyrinth());
        $this->pathFinder->setPositionInitialData($this->positionInitialData);
        $this->pathFinder->setPositionData($this->positionData);
        $this->pathFinder->findPath();
    }
}