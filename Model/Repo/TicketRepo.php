<?php
/**
 * Created by PhpStorm.
 * User: Mohsen
 * Date: 4/23/2021
 * Time: 2:38 PM
 */

include_once $_SERVER['DOCUMENT_ROOT']."/ContactUs/Model/db/DBProvider.php";
include $_SERVER['DOCUMENT_ROOT']."/ContactUs/Model/Entities/Ticket.php";


class TicketRepo
{
    public function submitNewTicket($ticketTitle,$ticketRelatedAdministrativeDepartemantId,$ticketOwnerId,$ticketSubmitDate){
        $dbConnection=DBProvider::getInstance();
        $insertNewTicketPrepare= $dbConnection->prepare("INSERT INTO students_tickets(TicketTitle,TicketRelatedAdministrativeDepartemantId,TicketOwnerId,TicketSubmitDate)VALUES('$ticketTitle','$ticketRelatedAdministrativeDepartemantId','$ticketOwnerId','$ticketSubmitDate');");
        if($insertNewTicketPrepare->execute()){
            $insertedTicket=new Ticket($dbConnection->lastInsertId(),$ticketTitle,$ticketRelatedAdministrativeDepartemantId,$ticketOwnerId,$ticketSubmitDate,1);
            return $insertedTicket;
        }
        return false;
    }

    public function getAllTickets($ownerId):array
{
    $database=DBProvider::getInstance();
    $getAllTicketsPrepare=$database->prepare("Select * from students_tickets where TicketOwnerId='$ownerId' And TicketStatus=1 OR TicketStatus=2 OR TicketStatus=3 OR  TicketStatus=8");
    $getAllTicketsPrepare->execute();
    $queryResult=$getAllTicketsPrepare->FETCHALL(PDO::FETCH_ASSOC);
    $result=array();
    foreach ($queryResult as $ticket)
    {
        $ticketId=(int)$ticket["TicketId"];
        $ticketTitle=$ticket["TicketTitle"];
        $ticketRelatedAdministrativeDepartemantId=(int)$ticket["TicketRelatedAdministrativeDepartemantId"];
        $ticketOwnerId=(int)$ticket["TicketOwnerId"];
        $ticketSubmitDate=$ticket["TicketSubmitDate"];
        $ticketStatus=(int)$ticket["TicketStatus"];
        $ticketObj=new Ticket($ticketId,$ticketTitle,$ticketRelatedAdministrativeDepartemantId,$ticketOwnerId,$ticketSubmitDate,$ticketStatus);
        $result[]=$ticketObj;
    }
    return $result;
}
    public function getAllClosedTickets($ownerId):array
    {
        $database=DBProvider::getInstance();
        $getAllTicketsPrepare=$database->prepare("Select * from students_tickets where TicketOwnerId='$ownerId' And TicketStatus=4 OR TicketStatus=5");
        $getAllTicketsPrepare->execute();
        $queryResult=$getAllTicketsPrepare->FETCHALL(PDO::FETCH_ASSOC);
        $result=array();
        foreach ($queryResult as $ticket)
        {
            $ticketId=(int)$ticket["TicketId"];
            $ticketTitle=$ticket["TicketTitle"];
            $ticketRelatedAdministrativeDepartemantId=(int)$ticket["TicketRelatedAdministrativeDepartemantId"];
            $ticketOwnerId=(int)$ticket["TicketOwnerId"];
            $ticketSubmitDate=$ticket["TicketSubmitDate"];
            $ticketStatus=(int)$ticket["TicketStatus"];
            $ticketObj=new Ticket($ticketId,$ticketTitle,$ticketRelatedAdministrativeDepartemantId,$ticketOwnerId,$ticketSubmitDate,$ticketStatus);
            $result[]=$ticketObj;
        }
        return $result;
    }

    public function getAllClosedTicketsByStudent($ownerId):array
    {
        $database=DBProvider::getInstance();
        $getAllTicketsPrepare=$database->prepare("Select * from students_tickets where TicketOwnerId='$ownerId' And TicketStatus=4 OR TicketStatus=5");
        $getAllTicketsPrepare->execute();
        $queryResult=$getAllTicketsPrepare->FETCHALL(PDO::FETCH_ASSOC);
        $result=array();
        foreach ($queryResult as $ticket)
        {
            $ticketId=(int)$ticket["TicketId"];
            $ticketTitle=$ticket["TicketTitle"];
            $ticketRelatedAdministrativeDepartemantId=(int)$ticket["TicketRelatedAdministrativeDepartemantId"];
            $ticketOwnerId=(int)$ticket["TicketOwnerId"];
            $ticketSubmitDate=$ticket["TicketSubmitDate"];
            $ticketStatus=(int)$ticket["TicketStatus"];
            $ticketObj=new Ticket($ticketId,$ticketTitle,$ticketRelatedAdministrativeDepartemantId,$ticketOwnerId,$ticketSubmitDate,$ticketStatus);
            $result[]=$ticketObj;
        }
        return $result;
    }
    public function checkTicketIdisValid($ticketId){
        $database=DBProvider::getInstance();
        $getUserIdPrepare=$database->prepare("Select TicketId from students_tickets where TicketId='$ticketId'");
        $getUserIdPrepare->execute();
        $result=$getUserIdPrepare->FETCHALL(PDO::FETCH_ASSOC);
        return sizeof($result)>0?true:false;
    }


    public function updateTicketStatus($ticketId,$ticketStatus){
        $database=DBProvider::getInstance();
        $updateTicketStatus=$database->prepare("UPDATE `students_tickets` SET `TicketStatus`='$ticketStatus' WHERE `TicketId`='$ticketId'");
        if($updateTicketStatus->execute())
        {
            return true;
        }else
        {
            return false;
        }
    }

    public function getTicket($ticketId){
        $database=DBProvider::getInstance();
        $getAllTicketsPrepare=$database->prepare("Select * from students_tickets where TicketId='$ticketId'");
        $getAllTicketsPrepare->execute();
        $queryResult=$getAllTicketsPrepare->FETCHALL(PDO::FETCH_ASSOC);
        if($queryResult!=null)
        {
            $ticketId=(int)$queryResult[0]["TicketId"];
            $ticketTitle=$queryResult[0]["TicketTitle"];
            $ticketRelatedAdministrativeDepartemantId=(int)$queryResult[0]["TicketRelatedAdministrativeDepartemantId"];
            $ticketOwnerId=(int)$queryResult[0]["TicketOwnerId"];
            $ticketSubmitDate=$queryResult[0]["TicketSubmitDate"];
            $ticketStatus=(int)$queryResult[0]["TicketStatus"];
            $resultObject=new Ticket($ticketId,$ticketTitle,$ticketRelatedAdministrativeDepartemantId,$ticketOwnerId,$ticketSubmitDate,$ticketStatus);
            return $resultObject;
        }
        return false;

    }

    public function getDepartemantsOpenTickets($departemantId):array
    {
        $database=DBProvider::getInstance();
        $getAllTicketsPrepare=$database->prepare("SELECT * FROM `students_tickets` WHERE TicketStatus=3 OR TicketStatus=2 OR TicketStatus=1 AND TicketRelatedAdministrativeDepartemantId='$departemantId' ");
        $getAllTicketsPrepare->execute();
        $queryResult=$getAllTicketsPrepare->FETCHALL(PDO::FETCH_ASSOC);
        $result=array();
        foreach ($queryResult as $ticket)
        {
            $ticketId=(int)$ticket["TicketId"];
            $ticketTitle=$ticket["TicketTitle"];
            $ticketRelatedAdministrativeDepartemantId=(int)$ticket["TicketRelatedAdministrativeDepartemantId"];
            $ticketOwnerId=(int)$ticket["TicketOwnerId"];
            $ticketSubmitDate=$ticket["TicketSubmitDate"];
            $ticketStatus=(int)$ticket["TicketStatus"];
            $ticketObj=new Ticket($ticketId,$ticketTitle,$ticketRelatedAdministrativeDepartemantId,$ticketOwnerId,$ticketSubmitDate,$ticketStatus);
            $result[]=$ticketObj;
        }
        return $result;
    }



}