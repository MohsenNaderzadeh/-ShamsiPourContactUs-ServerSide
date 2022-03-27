<?php
/**
 * Created by PhpStorm.
 * User: Mohsen
 * Date: 5/17/2021
 * Time: 8:21 AM
 */
include_once $_SERVER['DOCUMENT_ROOT']. "/ContactUs/Controller/BaseController.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/ContactUs/Model/Repo/UserRepo.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/ContactUs/Model/Repo/MessagesRepo.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/ContactUs/Model/Repo/TicketRepo.php";

class GetStudentTicketMessageController extends BaseController
{
    public function getAll($token,$ticketId){
        $userRepo=new UserRepo();
        $messagesRepo=new MessagesRepo();
        $ticketRepo=new TicketRepo();
        if($userRepo->checkTokenAvailability($token))
        {
            if($ticketRepo->checkTicketIdisValid($ticketId))
            {
                header("Content-Type:application/json");
                $messagesList=$messagesRepo->getAll($ticketId);
                $messages=array();
                if(sizeof($messagesList)>0)
                {
                    foreach ($messagesList as $messageItem )
                    {
                        if($messageItem instanceof TicketMessages)
                        {
                            $temp["MessageId"]=(int)$messageItem->getMessageId();
                            $temp["studentId"]=(int)$messageItem->getStdId();
                            $temp["CoworkerId"]=(int)$messageItem->getCoworkerId();
                            $temp["MessageSendType"]=(int)$messageItem->getMessageSendType();
                            $temp["MessageText"]=$messageItem->getMessageText();
                            $temp["MessageSendDate"]=$messageItem->getMessageSendDate();
                            $temp["isMessageaFile"]=$messageItem->getisMessageAFile()==1?true:false;
                            $messages[]=$temp;
                        }
                    }
                }
                $result["success"]=true;
                $result["ticketId"]=(int)$ticketId;
                $result["messages"]=$messages;
                $result["messagesCount"]=sizeof($messages);
                $result["pageNumber"]=1;
                echo json_encode($result);
            }else
            {
                header("Content-Type:application/json");
                http_response_code(500);
                $result["success"]=false;
                $result["message"]="خطا در انجام عملیات";
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