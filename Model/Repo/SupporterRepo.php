<?php
/**
 * Created by PhpStorm.
 * User: Mohsen
 * Date: 4/22/2021
 * Time: 10:54 PM
 */
include_once $_SERVER['DOCUMENT_ROOT']."/ContactUs/Model/db/DBProvider.php";
class SupporterRepo
{

    public function checkSupporterAvailability($userName,$password){
        $database=DBProvider::getInstance();
        $getSupporterPrepare=$database->prepare("Select * from `universitycoworkers` WHERE  `CoWorkerPersoneliCode`='$userName' AND `CoWorkerNationalCode`='$password';");
        $getSupporterPrepare->execute();
        $result=$getSupporterPrepare->FETCHALL(PDO::FETCH_ASSOC);
        if(sizeof($result)>0)
        {
            return true;
        }
        return false;
    }
    public function checkTokenAvailability($token){
        $database=DBProvider::getInstance();
        $tokenPrepare=$database->prepare("Select * from `universitycoworkers` WHERE `token`='$token';");
        $tokenPrepare->execute();
        $result=$tokenPrepare->FETCHALL(PDO::FETCH_ASSOC);
        if(sizeof($result)>0)
        {
            return true;
        }
        return false;
    }

    public function updateSupporterToken($token,$supporterUserName){
        $database=DBProvider::getInstance();
        $updateTokenPrepare=$database->prepare("UPDATE `universitycoworkers` SET `token`='$token' WHERE `CoWorkerPersoneliCode`='$supporterUserName'");
        if($updateTokenPrepare->execute())
        {
            return true;
        }else
        {
            return false;
        }
    }
    public function  setSupporterTokenNull($token)
    {
        $database = DBProvider::getInstance();
        $setUserTokenNullPrepare = $database->prepare("UPDATE `universitycoworkers` SET `token`=NULL WHERE `token`='$token'");
        if ($setUserTokenNullPrepare->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function getSupporterId($token){
        $database=DBProvider::getInstance();
        $getUserIdPrepare=$database->prepare("Select CoWorkerId from universitycoworkers where token='$token'");
        $getUserIdPrepare->execute();
        $result=$getUserIdPrepare->FETCHALL(PDO::FETCH_ASSOC);
        return $result[0]["CoWorkerId"]!=null?$result[0]["CoWorkerId"]:0;
    }
    public function getDepartemantId($supporterId){
        $database=DBProvider::getInstance();
        $getUserIdPrepare=$database->prepare("Select administrativedepartemantId from universitycoworkers where CoWorkerId='$supporterId'");
        $getUserIdPrepare->execute();
        $result=$getUserIdPrepare->FETCHALL(PDO::FETCH_ASSOC);
        return $result[0]["administrativedepartemantId"]!=null?$result[0]["administrativedepartemantId"]:0;
    }
}