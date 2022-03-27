<?php
/**
 * Created by PhpStorm.
 * User: Mohsen
 * Date: 5/14/2021
 * Time: 10:42 PM
 */

class AdministrativeDepartemant
{
    private $_administrativeDepartemantId;
    private $_administrativeDepartemantName;

    /**
     * AdministrativeDepartemant constructor.
     * @param $_administrativeDepartemantId
     * @param $_administrativeDepartemantName
     */
    public function __construct($_administrativeDepartemantId, $_administrativeDepartemantName)
    {
        $this->_administrativeDepartemantId = $_administrativeDepartemantId;
        $this->_administrativeDepartemantName = $_administrativeDepartemantName;
    }

    /**
     * @return mixed
     */
    public function getAdministrativeDepartemantId()
    {
        return $this->_administrativeDepartemantId;
    }

    /**
     * @param mixed $administrativeDepartemantId
     */
    public function setAdministrativeDepartemantId($administrativeDepartemantId): void
    {
        $this->_administrativeDepartemantId = $administrativeDepartemantId;
    }

    /**
     * @return mixed
     */
    public function getAdministrativeDepartemantName()
    {
        return $this->_administrativeDepartemantName;
    }

    /**
     * @param mixed $administrativeDepartemantName
     */
    public function setAdministrativeDepartemantName($administrativeDepartemantName): void
    {
        $this->_administrativeDepartemantName = $administrativeDepartemantName;
    }


}