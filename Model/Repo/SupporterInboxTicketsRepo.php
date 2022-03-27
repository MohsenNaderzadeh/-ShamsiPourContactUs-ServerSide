<?php
/**
 * Created by PhpStorm.
 * User: Mohsen
 * Date: 5/24/2021
 * Time: 8:19 AM
 */
include_once $_SERVER['DOCUMENT_ROOT']."/ContactUs/Model/db/DBProvider.php";
include_once $_SERVER['DOCUMENT_ROOT']."/ContactUs/Model/Entities/Ticket.php";
include_once $_SERVER['DOCUMENT_ROOT']."/ContactUs/Model/Entities/SupporterInboxTickets.php";
class SupporterInboxTicketsRepo
{

    public function getAll($supporterId){
    $database=DBProvider::getInstance();
    $getAllSupporterInboxTicketsPrepare=$database->prepare("SELECT * FROM supporterticketsinbox JOIN students_tickets ON supporterticketsinbox.TicketId=students_tickets.TicketId WHERE supporterticketsinbox.SupporterId='$supporterId' And students_tickets.TicketStatus=8 OR students_tickets.TicketStatus=2");
    $getAllSupporterInboxTicketsPrepare->execute();
    $queryResult=$getAllSupporterInboxTicketsPrepare->FETCHALL(PDO::FETCH_ASSOC);
    $result=array();
    foreach ($queryResult as $ticket)
    {
        $ticketInboxId=$ticket["InboxTicketId"];
        $ticketId=$ticket["TicketId"];
        $ticketTitle=$ticket["TicketTitle"];
        $ticketRelatedAdministrativeDepartemantId=(int)$ticket["TicketRelatedAdministrativeDepartemantId"];
        $ticketOwnerId=(int)$ticket["TicketOwnerId"];
        $ticketSubmitDate=$ticket["TicketSubmitDate"];
        $ticketStatus=(int)$ticket["TicketStatus"];
        $ticketSupporterId=(int)$ticket["SupporterId"];
        $ticketAddedDate=$ticket["AddedDate"];
        $ticketObj=new SupporterInboxTickets($ticketId,$ticketTitle,$ticketRelatedAdministrativeDepartemantId,$ticketOwnerId,$ticketSubmitDate,$ticketStatus,$ticketInboxId,$ticketSupporterId,$ticketAddedDate);
        $result[]=$ticketObj;
    }
    return $result;
}

    public function getAllClosedTickets($supporterId){
        $database=DBProvider::getInstance();
        $getAllSupporterInboxTicketsPrepare=$database->prepare("SELECT * FROM supporterticketsinbox JOIN students_tickets ON supporterticketsinbox.TicketId=students_tickets.TicketId WHERE supporterticketsinbox.SupporterId='$supporterId' And students_tickets.TicketStatus=4 OR students_tickets.TicketStatus=5");
        $getAllSupporterInboxTicketsPrepare->execute();
        $queryResult=$getAllSupporterInboxTicketsPrepare->FETCHALL(PDO::FETCH_ASSOC);
        $result=array();
        foreach ($queryResult as $ticket)
        {
            $ticketInboxId=$ticket["InboxTicketId"];
            $ticketId=$ticket["TicketId"];
            $ticketTitle=$ticket["TicketTitle"];
            $ticketRelatedAdministrativeDepartemantId=(int)$ticket["TicketRelatedAdministrativeDepartemantId"];
            $ticketOwnerId=(int)$ticket["TicketOwnerId"];
            $ticketSubmitDate=$ticket["TicketSubmitDate"];
            $ticketStatus=(int)$ticket["TicketStatus"];
            $ticketSupporterId=(int)$ticket["SupporterId"];
            $ticketAddedDate=$ticket["AddedDate"];
            $ticketObj=new SupporterInboxTickets($ticketId,$ticketTitle,$ticketRelatedAdministrativeDepartemantId,$ticketOwnerId,$ticketSubmitDate,$ticketStatus,$ticketInboxId,$ticketSupporterId,$ticketAddedDate);
            $result[]=$ticketObj;
        }
        return $result;
    }
    public function addTicket($ticketId,$supporterId,$addedDate){
        $database=DBProvider::getInstance();
        $addTicketToInboxPrepare=$database->prepare("INSERT INTO supporterticketsinbox(SupporterId,TicketId,AddedDate)VALUES('$supporterId','$ticketId','$addedDate');");
        if($addTicketToInboxPrepare->execute()){
            $getAllSupporterInboxTicketsPrepare=$database->prepare("SELECT * FROM supporterticketsinbox JOIN students_tickets ON supporterticketsinbox.TicketId=students_tickets.TicketId WHERE supporterticketsinbox.TicketId='$ticketId'");
            $getAllSupporterInboxTicketsPrepare->execute();
            $queryResult=$getAllSupporterInboxTicketsPrepare->FETCHALL(PDO::FETCH_ASSOC);
            foreach ($queryResult as $ticket)
            {
                $ticketInboxId=(int)$ticket["InboxTicketId"];
                $ticketSupporterOwnerId=(int)$ticket["SupporterId"];
                $ticketAddedDate=$ticket["AddedDate"];
                $ticketId=(int)$ticket["TicketId"];
                $ticketTitle=$ticket["TicketTitle"];
                $ticketRelatedAdministrativeDepartemantId=(int)$ticket["TicketRelatedAdministrativeDepartemantId"];
                $ticketOwnerId=(int)$ticket["TicketOwnerId"];
                $ticketSubmitDate=$ticket["TicketSubmitDate"];
                $ticketStatus=(int)$ticket["TicketStatus"];
                $ticketObj=new SupporterInboxTickets($ticketId,$ticketTitle,$ticketRelatedAdministrativeDepartemantId,$ticketOwnerId,$ticketSubmitDate,$ticketStatus,$ticketInboxId,$ticketSupporterOwnerId,$ticketAddedDate);
            }
            return $ticketObj;
        }else
        {
            return false;
        }

    }
    public function isRepeativeTicket($ticketId){
        $database=DBProvider::getInstance();
        $ticketPrepare=$database->prepare("Select * from `supporterticketsinbox` WHERE `TicketId`='$ticketId';");
        $ticketPrepare->execute();
        $result=$ticketPrepare->FETCHALL(PDO::FETCH_ASSOC);
        if(sizeof($result)>0)
        {
            return true;
        }
        return false;
    }
}