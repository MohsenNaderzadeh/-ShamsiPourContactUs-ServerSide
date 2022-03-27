<?php
/**
 * Created by PhpStorm.
 * User: Mohsen
 * Date: 7/2/2021
 * Time: 10:05 PM
 */

include_once $_SERVER['DOCUMENT_ROOT'] . "/ContactUs/Controller/BaseController.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/ContactUs/Model/Repo/UserRepo.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/ContactUs/Model/Repo/SupporterRepo.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/ContactUs/Model/Repo/MessagesRepo.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/ContactUs/Model/Repo/TicketRepo.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/ContactUs/Model/Repo/DepartemantsRepo.php";
class GetDepartemantsTicketsListController extends BaseController
{

    public function  getAll($token){
        $userRepo=new SupporterRepo();
        $messageRepo=new MessagesRepo();
        $ticketRepo=new TicketRepo();
        $departemantsRepo=new DepartemantsRepo();
        if($userRepo->checkTokenAvailability($token))
        {
            $supporterId=$userRepo->getSupporterId($token);
            if($supporterId!=0)
            {
                $departemantId=$userRepo->getDepartemantId($supporterId);
                if($departemantsRepo->isDepartemantIdAvailable($departemantId))
                {
                    $result=$ticketRepo->getDepartemantsOpenTickets($departemantId);
                    $tickets=array();
                    foreach ($result as $ticketItem )
                    {
                        if($ticketItem instanceof Ticket)
                        {
                            $temp["TicketId"]=$ticketItem->getTicketId();
                            $temp["TicketTitle"]=$ticketItem->getTicketTitle();
                            $temp["TicketRelatedAdministrativeDepartemantId"]=$ticketItem->getTicketRelatedAdministrativeDepartemantId();
                            $temp["TicketOwnerId"]=$ticketItem->getTicketOwnerId();
                            $temp["TicketSubmitDate"]=$ticketItem->getTicketSubmitDate();
                            $temp["TicketStatus"]=$ticketItem->getTicketStatus();
                            $holeItems=$messageRepo->getAll((int)$ticketItem->getTicketId());
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
                    header("Content-Type:application/json");
                    $responseResult["success"] = true;
                    $responseResult["ticketsList"] = $tickets;
                    echo json_encode($responseResult);

                }else
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
                http_response_code(500);
                $responseResult["success"] = false;
                $responseResult["message"] = "خطا در انجام عملیات";
                echo json_encode($responseResult);
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