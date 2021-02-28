<?php


namespace App\Data\PositionData;


use App\Data\BaseData;

abstract class BasePositionData extends BaseData implements PositionDataInterface
{
    protected $posAX;
    protected $posAY;
    protected $posBX;
    protected $posBY;

    /**
     * @return mixed
     */
    public function getPosAX()
    {
        return $this->posAX;
    }

    /**
     * @return mixed
     */
    public function getPosAY()
    {
        return $this->posAY;
    }

    /**
     * @return mixed
     */
    public function getPosBX()
    {
        return $this->posBX;
    }

    /**
     * @return mixed
     */
    public function getPosBY()
    {
        return $this->posBY;
    }
}