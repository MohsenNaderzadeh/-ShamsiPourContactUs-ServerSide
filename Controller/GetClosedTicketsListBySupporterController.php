<?php
/**
 * Created by PhpStorm.
 * User: Mohsen
 * Date: 7/18/2021
 * Time: 11:39 PM
 */

include_once $_SERVER['DOCUMENT_ROOT'] . "/ContactUs/Model/Repo/TicketRepo.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/ContactUs/Utils/Utils.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/ContactUs/Controller/BaseController.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/ContactUs/Model/Repo/SupporterRepo.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/ContactUs/Model/Repo/MessagesRepo.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/ContactUs/Model/Repo/SupporterInboxTicketsRepo.php";

class GetClosedTicketsListBySupporterController extends BaseController
{
    function getAll($token){
        $supporterRepo=new SupporterRepo();
        $messagesRepo=new MessagesRepo();
        if($supporterRepo->checkTokenAvailability($token))
        {
            $supporterId=$supporterRepo->getSupporterId($token);
            if($supporterId!=0)
            {
                $supporterInboxTicketsRepo=new SupporterInboxTicketsRepo();
                $result=$supporterInboxTicketsRepo->getAllClosedTickets($supporterId);

                $ticketsList=array();
                foreach ($result as $ticket)
                {
                    if($ticket instanceof SupporterInboxTickets)
                    {
                        $temp["TicketId"]=(int)$ticket->getTicketId();
                        $temp["TicketTitle"]=$ticket->getTicketTitle();
                        $temp["TicketRelatedAdministrativeDepartemantId"]=(int)$ticket->getTicketRelatedAdministrativeDepartemantId();
                        $temp["TicketOwnerId"]=(int)$ticket->getTicketOwnerId();
                        $temp["TicketSubmitDate"]=$ticket->getTicketSubmitDate();
                        $temp["TicketStatus"]=(int)$ticket->getTicketStatus();
                        $temp["TicketInBoxId"]=(int)$ticket->getTicketInboxId();
                        $temp["AddedDate"]=$ticket->getTicketAddedDateToSupporterInbox();
                        $allOfMessages=$messagesRepo->getAll((int)$ticket->getTicketId());
                        if(sizeof($allOfMessages)>0)
                        {
                            $lastItem=end($allOfMessages);
                            if($lastItem instanceof TicketMessages)
                            {
                                $lastMessageTemp["MessageId"]=$lastItem->getMessageId();
                                $lastMessageTemp["studentId"]=(int)$lastItem->getStdId();
                                $lastMessageTemp["CoworkerId"]=$lastItem->getCoworkerId();
                                $lastMessageTemp["MessageSendType"]=(int)$lastItem->getMessageSendType();
                                $lastMessageTemp["MessageText"]=$lastItem->getMessageText();
                                $lastMessageTemp["messageSendDate"]=$lastItem->getMessageSendDate();
                                $lastMessageTemp["isMessageaFile"]=$lastItem->getisMessageAFile()==1?true:false;
                                $lastMessageTemp["TicketId"]=(int)$lastItem->getTicketId();
                                $temp["TicketLastMessage"]=$lastMessageTemp;
                            }
                        }else
                        {
                            $lastMessageTemp=[];
                            $temp["TicketLastMessage"]=$lastMessageTemp;
                        }
                        $ticketsList[]=$temp;
                    }
                }
                header("Content-Type:application/json");
                $responseResult["success"]=true;
                $responseResult["supporterId"]=(int)$supporterId;
                $responseResult["supporterTickets"]=$ticketsList;
                $responseResult["ticketCount"]=sizeof($ticketsList);
                echo json_encode($responseResult);
            }
            else
            {
                header("Content-Type:application/json");
                http_response_code(500);
                $responseResult["success"] = false;
                $responseResult["message"] = "خطا در انجام عملیات";
                echo json_encode($responseResult);

            }
        }else
        {
            header("Content-Type:application/json");
            http_response_code(401);
            $responseResult["success"] = false;
            $responseResult["message"] = "لطفا مجددا به حساب کاربری خود وارد شوید";
            echo json_encode($responseResult);

        }
    }
}