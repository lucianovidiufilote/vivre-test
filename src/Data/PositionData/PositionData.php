<?php

namespace App\Data\PositionData;

class PositionData extends BasePositionData
{
    /**
     * @param mixed $posAX
     */
    public function setPosAX($posAX)
    {
        $this->posAX = $posAX;
    }

    /**
     * @param mixed $posAY
     */
    public function setPosAY($posAY)
    {
        $this->posAY = $posAY;
    }

    /**
     * @param mixed $posBX
     */
    public function setPosBX($posBX)
    {
        $this->posBX = $posBX;
    }

    /**
     * @param mixed $posBY
     */
    public function setPosBY($posBY)
    {
        $this->posBY = $posBY;
    }


}