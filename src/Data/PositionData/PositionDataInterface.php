<?php


namespace App\Data\PositionData;


interface PositionDataInterface
{
    /**
     * @return mixed
     */
    public function getPosAX();

    /**
     * @return mixed
     */
    public function getPosAY();

    /**
     * @return mixed
     */
    public function getPosBX();

    /**
     * @return mixed
     */
    public function getPosBY();
}