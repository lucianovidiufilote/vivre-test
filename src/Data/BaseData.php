<?php


namespace App\Data;


use ReflectionException;

abstract class BaseData
{
    public function __construct($json)
    {
        try {
            $this->populateFromJson($json);
        } catch (\Exception $exception) {
            return false;
        }
    }

    /**
     * Takes the received JSON and distributes its values to the class' properties
     * @param $json
     */
    private function populateFromJson($json)
    {
        $reflectionObject = new \ReflectionObject($this);
        $properties = $reflectionObject->getProperties();
        $data = json_decode($json, true);
        foreach ($properties as $property){
            $property->setAccessible(true);
            $property->setValue($this, $data[$property->getName()]);
            $property->setAccessible(false);
        }
    }

}