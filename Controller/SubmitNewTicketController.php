<?php
/**
 * Created by PhpStorm.
 * User: Mohsen
 * Date: 4/23/2021
 * Time: 6:36 PM
 */

include_once $_SERVER['DOCUMENT_ROOT'] . "/ContactUs/Model/Repo/TicketRepo.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/ContactUs/Utils/Utils.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/ContactUs/Controller/BaseController.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/ContactUs/Model/Repo/UserRepo.php";

class SubmitNewTicketController extends BaseController
{
    function submitNewTicket($token, $ticketTitle, $ticketRelatedAdministrativeDepartemantId)
    {
        $responseResult = null;
        $ticketRepo = new TicketRepo();
        $userRepo = new UserRepo();
        if ($userRepo->checkTokenAvailability($token)) {

                $userId=$userRepo->getUserId($token);
                $result = $ticketRepo->submitNewTicket($ticketTitle, $ticketRelatedAdministrativeDepartemantId,$userId,strval(Utils::getPersianDate()));
                if ($result != false) {
                    header("Content-Type:application/json");
                    $responseResult["success"] = true;
                    $ticketInfo = array();
                    $ticketInfo["TicketId"] =(int) $result->getTicketId();
                    $ticketInfo["TicketTitle"] = $result->getTicketTitle();
                    $ticketInfo["TicketRelatedAdministrativeDepartemantId"] =(int) $result->getTicketRelatedAdministrativeDepartemantId();
                    $ticketInfo["TicketOwnerId"] =(int) $result->getTicketOwnerId();
                    $ticketInfo["TicketSubmitDate"] = $result->getTicketSubmitDate();
                    $ticketInfo["TicketStatus"] = $result->getTicketStatus();
                    $responseResult["ticketInfo"] = $ticketInfo;
                    echo json_encode($responseResult);


            } else {
                header("Content-Type:application/json");
                http_response_code(500);
                $responseResult["success"] = false;
                $responseResult["message"] = "خطا در انجام عملیات";
            }
        } else {
            header("Content-Type:application/json");
            http_response_code(401);
            $result["success"] = false;
            $result["message"]="لطفا مجددا به حساب کاربری خود وارد شوید";
            echo json_encode($result);
        }
    }
}