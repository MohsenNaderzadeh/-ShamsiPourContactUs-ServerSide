<?php
/**
 * Created by PhpStorm.
 * User: Mohsen
 * Date: 6/30/2021
 * Time: 6:40 AM
 */

include_once $_SERVER['DOCUMENT_ROOT'] . "/ContactUs/Controller/BaseController.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/ContactUs/Model/Repo/UserRepo.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/ContactUs/Model/Repo/TicketRepo.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/ContactUs/Model/Repo/SupporterInboxTicketsRepo.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/ContactUs/Model/Repo/SupporterRepo.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/ContactUs/Utils/Utils.php";

class AddTicketToInboxController extends BaseController
{

    function addTicketToInbox($ticketId,$token){
        $supporterRepo=new SupporterRepo();
        $ticketRepo=new TicketRepo();
        if($supporterRepo->checkTokenAvailability($token))
        {
            if($ticketRepo->checkTicketIdisValid($ticketId))
            {
                $supporterInboxTicketsRepo=new SupporterInboxTicketsRepo();
                if(!$supporterInboxTicketsRepo->isRepeativeTicket($ticketId))
                {
                    $supporterRepo=new SupporterRepo();
                    $supporterId=$supporterRepo->getSupporterId($token);
                    $result=$supporterInboxTicketsRepo->addTicket($ticketId,$supporterId,Utils::getPersianDate());
                    if($result!=false)
                    {

                        header("Content-Type:application/json");
                        $ticketUpdateStatusStat=$ticketRepo->updateTicketStatus($ticketId,8);
                        if($ticketUpdateStatusStat)
                        {
                        $updatedTicket=$ticketRepo->getTicket($ticketId);
                        $responseResult["success"] = true;

                        $addedTicket = array();
                        $addedTicket["InboxTicketId"]=(int)$result->getTicketInboxId();
                        $addedTicket["SupporterId"]=(int)$result->getSupporterOwnerTicketId();
                        $addedTicket["TicketId"]=(int)$result->getTicketId();

                        $addedTicket["AddedDate"]=$result->getTicketAddedDateToSupporterInbox();
                        $addedTicket["TicketTitle"]=$result->getTicketTitle();
                        $addedTicket["TicketRelatedAdministrativeDepartemantId"]=$result->getTicketRelatedAdministrativeDepartemantId();
                        $addedTicket["TicketOwnerId"]=$result->getTicketOwnerId();
                        $addedTicket["ticketSubmitDate"]=$result->getTicketSubmitDate();
                        $addedTicket["TicketStatus"]=(int)$updatedTicket->getTicketStatus();

                        $responseResult["addedTicket"]=$addedTicket;

                            echo json_encode($responseResult);
                        }else
                        {
                            header("Content-Type:application/json");
                            http_response_code(500);
                            $responseResult["success"] = false;
                            $responseResult["message"] = "خطا در انجام عملیات";
                            echo json_encode($responseResult);
                        }



                    }else{
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
                    $responseResult["message"] = "این تیکت قبلا در سیستم توسط اپراتور دیگری ثبت گردیده است لطفا تیکت دیگری را جهت پاسخگویی انتخاب کنید";
                    echo json_encode($responseResult);
                }

            }else{
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