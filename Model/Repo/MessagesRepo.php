<?php
/**
 * Created by PhpStorm.
 * User: Mohsen
 * Date: 4/23/2021
 * Time: 6:19 PM
 */

include_once $_SERVER['DOCUMENT_ROOT']."/ContactUs/Model/db/DBProvider.php";
include_once $_SERVER['DOCUMENT_ROOT']."/ContactUs/Model/Entities/TicketMessages.php";

class MessagesRepo
{


    public function getAll($ticketId){
        $database=DBProvider::getInstance();
        $getAllTicketsPrepare=$database->prepare("Select * from ticketmessages WHERE TicketId='$ticketId'");
        $getAllTicketsPrepare->execute();
        $queryResult=$getAllTicketsPrepare->FETCHALL(PDO::FETCH_ASSOC);
        $result=array();
        foreach ($queryResult as $item) {

            $messageId=(int)$item["MessageId"];
            $studentId=$item["studentId"];
            $coworkerId=$item["CoworkerId"];
            $messageSendType=$item["MessageSendType"];
            $messageText=$item["MessageText"];
            $messageSendDate=$item["MessageSendDate"];
            $isMessageaFile=$item["isMessageaFile"]==1?true:false;
            $ticketId=$item["TicketId"];
            $ticketMessageObj=new TicketMessages($messageId,$studentId,$coworkerId,$messageSendType,$messageText,$messageSendDate,$isMessageaFile);
            $ticketMessageObj->setTicketId($ticketId);
            $result[]=$ticketMessageObj;
        }

        return $result;
    }

    public function addNewMessage($stdId,$coworkerId,$messageSendType,$messageText,$messageSendDate,$ismessageAFile,$ticketId)
    {

        $dbConnection=DBProvider::getInstance();
        $query=$coworkerId!=null?"INSERT INTO ticketmessages(studentId,CoworkerId,MessageSendType,MessageText,MessageSendDate,isMessageaFile,TicketId)VALUES(NULL,'$coworkerId','$messageSendType','$messageText','$messageSendDate','$ismessageAFile','$ticketId');":"INSERT INTO ticketmessages(studentId,CoworkerId,MessageSendType,MessageText,MessageSendDate,isMessageaFile,TicketId)VALUES('$stdId',NULL,'$messageSendType','$messageText','$messageSendDate','$ismessageAFile','$ticketId');";
        $insertNewTicketMessagePrepare= $dbConnection->prepare($query);
        if($insertNewTicketMessagePrepare->execute()){
            $insertedMessage=new TicketMessages($dbConnection->lastInsertId(),$stdId,$coworkerId,$messageSendType,$messageText,$messageSendDate,$ismessageAFile);
            $insertedMessage->setTicketId($ticketId);
            return $insertedMessage;
        }
        return false;
    }



}