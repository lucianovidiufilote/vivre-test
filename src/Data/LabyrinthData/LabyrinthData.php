<?php


namespace App\Data\LabyrinthData;

use App\Data\BaseData;
use App\Data\Immutable;

class LabyrinthData extends BaseData
{
    use Immutable;

    private $dimX;
    private $dimY;
    private $brickDensity;

    /**
     * @return mixed
     */
    public function getDimX()
    {
        return $this->dimX;
    }

    /**
     * @return mixed
     */
    public function getDimY()
    {
        return $this->dimY;
    }

    /**
     * @return mixed
     */
    public function getBrickDensity()
    {
        return $this->brickDensity;
    }


}