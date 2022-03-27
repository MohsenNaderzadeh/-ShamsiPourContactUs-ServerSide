<?php
/**
 * Created by PhpStorm.
 * User: Mohsen
 * Date: 4/22/2021
 * Time: 11:04 PM
 */

class Supporter
{
    private $supporterId;
    private $supporterName;
    private $supporterLastName;
    private $supporterNationalCode;
    private $supporterPeroneliCode;
    private $supporterEmail;
    private $supporterPhoneNumber;
    private $supporterDepartementId;
    private $supporterPost;
    private $supporterToken;


    public function getSupporterId()
    {
        return $this->supporterId;
    }


    public function setSupporterId($supporterId): void
    {
        $this->supporterId = $supporterId;
    }

    public function getSupporterName()
    {
        return $this->supporterName;
    }


    public function setSupporterName($supporterName): void
    {
        $this->supporterName = $supporterName;
    }


    public function getSupporterLastName()
    {
        return $this->supporterLastName;
    }


    public function setSupporterLastName($supporterLastName): void
    {
        $this->supporterLastName = $supporterLastName;
    }


    public function getSupporterNationalCode()
    {
        return $this->supporterNationalCode;
    }


    public function setSupporterNationalCode($supporterNationalCode): void
    {
        $this->supporterNationalCode = $supporterNationalCode;
    }


    public function getSupporterPeroneliCode()
    {
        return $this->supporterPeroneliCode;
    }


    public function setSupporterPeroneliCode($supporterPeroneliCode): void
    {
        $this->supporterPeroneliCode = $supporterPeroneliCode;
    }


    public function getSupporterEmail()
    {
        return $this->supporterEmail;
    }


    public function setSupporterEmail($supporterEmail): void
    {
        $this->supporterEmail = $supporterEmail;
    }


    public function getSupporterPhoneNumber()
    {
        return $this->supporterPhoneNumber;
    }


    public function setSupporterPhoneNumber($supporterPhoneNumber): void
    {
        $this->supporterPhoneNumber = $supporterPhoneNumber;
    }


    public function getSupporterDepartementId()
    {
        return $this->supporterDepartementId;
    }


    public function setSupporterDepartementId($supporterDepartementId): void
    {
        $this->supporterDepartementId = $supporterDepartementId;
    }


    public function getSupporterPost()
    {
        return $this->supporterPost;
    }


    public function setSupporterPost($supporterPost): void
    {
        $this->supporterPost = $supporterPost;
    }


    public function getSupporterToken()
    {
        return $this->supporterToken;
    }


    public function setSupporterToken($supporterToken): void
    {
        $this->supporterToken = $supporterToken;
    }


}