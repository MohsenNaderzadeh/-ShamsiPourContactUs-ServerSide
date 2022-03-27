<?php
/**
 * Created by PhpStorm.
 * User: Mohsen
 * Date: 7/18/2021
 * Time: 7:38 AM
 */

include_once $_SERVER['DOCUMENT_ROOT'] . "/ContactUs/Model/Repo/TicketRepo.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/ContactUs/Utils/Utils.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/ContactUs/Controller/BaseController.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/ContactUs/Model/Repo/UserRepo.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/ContactUs/Model/Repo/MessagesRepo.php";
class GetClosedTicketsListByStudentController extends  BaseController
{

    function getAllClosedTicketsList($token){
        $ticketRepo = new TicketRepo();
        $userRepo = new UserRepo();
        $messagesRepo=new MessagesRepo();
        if($userRepo->checkTokenAvailability($token))
        {
            header("Content-Type:application/json");
            $userId= $userRepo->getUserId($token);
            if($userId!=0)
            {
                $ticketsList=$ticketRepo->getAllClosedTickets($userId);
                $tickets=array();
                foreach ($ticketsList as $ticketItem )
                {
                    if($ticketItem instanceof Ticket)
                    {
                        $temp["TicketId"]=$ticketItem->getTicketId();
                        $temp["TicketTitle"]=$ticketItem->getTicketTitle();
                        $temp["TicketRelatedAdministrativeDepartemantId"]=$ticketItem->getTicketRelatedAdministrativeDepartemantId();
                        $temp["TicketOwnerId"]=$ticketItem->getTicketOwnerId();
                        $temp["TicketSubmitDate"]=$ticketItem->getTicketSubmitDate();
                        $temp["TicketStatus"]=$ticketItem->getTicketStatus();
                        $holeItems=$messagesRepo->getAll((int)$ticketItem->getTicketId());
                        if(sizeof($holeItems)>0)
                        {
                            $lastItem=end($holeItems);
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

                        $tickets[]=$temp;
                    }
                }
                $result["success"]=true;
                $result["tickets"]=$tickets;
                $result["ticketsLenght"]=sizeof($ticketsList);
                $result["pageNumber"]=1;
                echo json_encode($result);
            }else
            {
                http_response_code(500);
                $result["success"] = false;
                echo json_encode($result);
            }
        }else
        {
            header("Content-Type:application/json");
            http_response_code(401);
            $result["success"] = false;
            $result["message"]="لطفا مجددا به حساب کاربری خود وارد شوید";
            echo json_encode($result);
        }
    }
}