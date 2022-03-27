<?php
/**
 * Created by PhpStorm.
 * User: Mohsen
 * Date: 5/17/2021
 * Time: 11:14 AM
 */

include_once $_SERVER['DOCUMENT_ROOT'] . "/ContactUs/Controller/BaseController.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/ContactUs/Model/Repo/UserRepo.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/ContactUs/Model/Repo/MessagesRepo.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/ContactUs/Model/Repo/TicketRepo.php";
class AddNewStudentTicketMessageController extends BaseController
{


    public function addNewMessage($stdId,$coworkerId,$messageSendType,$messageText,$messageSendDate,$ismessageAFile,$ticketId,$token)
    {
        $userRepo=new UserRepo();
        $messageRepo=new MessagesRepo();
        $ticketRepo=new TicketRepo();
        if($userRepo->checkTokenAvailability($token))
        {
            if($ticketRepo->checkTicketIdisValid($ticketId))
            {
                $result=$messageRepo->addNewMessage($stdId,$coworkerId,$messageSendType,$messageText,$messageSendDate,$ismessageAFile,$ticketId);
                if ($result != false) {
                    header("Content-Type:application/json");
                    $responseResult["success"] = true;
                    $messageInfo = array();
                    $messageInfo["MessageId"] =(int) $result->getMessageId();
                    $messageInfo["studentId"] = (int)$result->getStdId();
                    $messageInfo["CoworkerId"] =$result->getCoworkerId()!=null?$result->getCoworkerId():null;
                    $messageInfo["MessageSendType"] =(int) $result->getMessageSendType();
                    $messageInfo["MessageText"] = $result->getMessageText();
                    $messageInfo["MessageSendDate"] = $result->getMessageSendDate();
                    $messageInfo["isMessageaFile"] = $result->getisMessageAFile()==1?true:false;
                    $messageInfo["TicketId"]=(int)$result->getTicketId();
                    $responseResult["message"]=$messageInfo;
                    echo json_encode($responseResult);
                } else {
                    header("Content-Type:application/json");
                    http_response_code(500);
                    $responseResult["success"] = false;
                    $responseResult["message"] = "خطا در انجام عملیات";
                    echo json_decode($responseResult);
                }
            } else {
                header("Content-Type:application/json");
                http_response_code(500);
                $responseResult["success"] = false;
                $responseResult["message"] = "خطا در انجام عملیات";
                echo json_decode($responseResult);
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