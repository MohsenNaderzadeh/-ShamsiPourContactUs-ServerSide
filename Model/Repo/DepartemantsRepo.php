<?php
/**
 * Created by PhpStorm.
 * User: Mohsen
 * Date: 5/14/2021
 * Time: 10:49 PM
 */

include_once $_SERVER['DOCUMENT_ROOT']."/ContactUs/Model/Entities/AdministrativeDepartemant.php";
include_once $_SERVER['DOCUMENT_ROOT']."/ContactUs/Model/db/DBProvider.php";

class DepartemantsRepo
{


    public function getDepartemantsList():array {
        $database=DBProvider::getInstance();
        $getDepartemantsListPrepare=$database->prepare("Select * from administrativedepartments");
        $getDepartemantsListPrepare->execute();
        $queryResult=$getDepartemantsListPrepare->FETCHALL(PDO::FETCH_ASSOC);
        $result=array();

        foreach ($queryResult as $item) {
            $departemantId=(int)$item["DepartemantId"];
            $departemantName=$item["DepartemantName"];
            $departemantObj=new AdministrativeDepartemant($departemantId,$departemantName);
            $result[]=$departemantObj;
        }

        return $result;
    }

    public function isDepartemantIdAvailable($departemantId){
        $database=DBProvider::getInstance();
        $ticketPrepare=$database->prepare("Select * from `administrativedepartments` WHERE `DepartemantId`='$departemantId';");
        $ticketPrepare->execute();
        $result=$ticketPrepare->FETCHALL(PDO::FETCH_ASSOC);
        if(sizeof($result)>0)
        {
            return true;
        }
        return false;
    }
}