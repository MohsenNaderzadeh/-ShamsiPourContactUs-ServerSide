<?php
/**
 * Created by PhpStorm.
 * User: Mohsen
 * Date: 4/21/2021
 * Time: 1:46 PM
 */

class User
{
    private $stdId;
    private $stdName;
    private $stdFamilyName;
    private $stdNationalCode;
    private $stdUniversityCode;
    private $stdMajorCode;
    private  $stdGrade;
    private  $stdRegDate;
    private  $stdEmail;
    private  $stdPhoneNumber;

    /**
     * User constructor.
     * @param $stdId
     * @param $stdName
     * @param $stdFamilyName
     * @param $stdNationalCode
     * @param $stdUniversityCode
     * @param $stdMajorCode
     * @param $stdGrade
     * @param $stdRegDate
     * @param $stdEmail
     * @param $stdPhoneNumber
     */
    public function __construct($stdId, $stdName, $stdFamilyName, $stdNationalCode, $stdUniversityCode, $stdMajorCode, $stdGrade, $stdRegDate, $stdEmail, $stdPhoneNumber)
    {
        $this->stdId = $stdId;
        $this->stdName = $stdName;
        $this->stdFamilyName = $stdFamilyName;
        $this->stdNationalCode = $stdNationalCode;
        $this->stdUniversityCode = $stdUniversityCode;
        $this->stdMajorCode = $stdMajorCode;
        $this->stdGrade = $stdGrade;
        $this->stdRegDate = $stdRegDate;
        $this->stdEmail = $stdEmail;
        $this->stdPhoneNumber = $stdPhoneNumber;
    }

    public function getStdId():Int
    {
        return $this->stdId;
    }



    public function setStdId($stdId): void
    {
        $this->stdId = $stdId;
    }


    public function getStdName():string
    {
        return $this->stdName;
    }


    public function setStdName($stdName): void
    {
        $this->stdName = $stdName;
    }


    public function getStdFamilyName():string
    {
        return $this->stdFamilyName;
    }


    public function setStdFamilyName($stdFamilyName): void
    {
        $this->stdFamilyName = $stdFamilyName;
    }


    public function getStdNationalCode()
    {
        return $this->stdNationalCode;
    }


    public function setStdNationalCode($stdNationalCode): void
    {
        $this->stdNationalCode = $stdNationalCode;
    }


    public function getStdUniversityCode()
    {
        return $this->stdUniversityCode;
    }



    public function setStdUniversityCode($stdUniversityCode): void
    {
        $this->stdUniversityCode = $stdUniversityCode;
    }


    public function getStdMajorCode()
    {
        return $this->stdMajorCode;
    }


    public function setStdMajorCode($stdMajorCode): void
    {
        $this->stdMajorCode = $stdMajorCode;
    }

    public function getStdGrade()
    {
        return $this->stdGrade;
    }


    public function setStdGrade($stdGrade): void
    {
        $this->stdGrade = $stdGrade;
    }


    public function getStdRegDate()
    {
        return $this->stdRegDate;
    }


    public function setStdRegDate($stdRegDate): void
    {
        $this->stdRegDate = $stdRegDate;
    }


    public function getStdEmail()
    {
        return $this->stdEmail;
    }


    public function setStdEmail($stdEmail): void
    {
        $this->stdEmail = $stdEmail;
    }


    public function getStdPhoneNumber()
    {
        return $this->stdPhoneNumber;
    }


    public function setStdPhoneNumber($stdPhoneNumber): void
    {
        $this->stdPhoneNumber = $stdPhoneNumber;
    }


}