<?php

/**
 * Created by PhpStorm.
 * User: RAYMARTHINKPAD
 * Date: 2017-08-27
 * Time: 2:59 PM
 */
class Diagram
{
    private $_diagramId;
    private $_diagram;
    private $_vehicleId;

    /**
     * @return mixed
     */
    public function getDiagramId()
    {
        return $this->_diagramId;
    }

    /**
     * @param mixed $diagramId
     */
    public function setDiagramId($diagramId)
    {
        $this->_diagramId = $diagramId;
    }

    /**
     * @return mixed
     */
    public function getDiagram()
    {
        return $this->_diagram;
    }

    /**
     * @param mixed $diagram
     */
    public function setDiagram($diagram)
    {
        $this->_diagram = $diagram;
    }

    /**
     * @return mixed
     */
    public function getVehicleId()
    {
        return $this->_vehicleId;
    }

    /**
     * @param mixed $vehicleId
     */
    public function setVehicleId($vehicleId)
    {
        $this->_vehicleId = $vehicleId;
    }



}