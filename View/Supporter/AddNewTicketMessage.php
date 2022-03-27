<?php
/**
 * Created by PhpStorm.
 * User: Mohsen
 * Date: 5/17/2021
 * Time: 10:58 AM
 */

include $_SERVER['DOCUMENT_ROOT'] . "/ContactUs/Controller/AddNewSupporterTicketMessageController.php";
include $_SERVER['DOCUMENT_ROOT'] . "/ContactUs/Utils/Utils.php";

$addNewSupporterTicketMessageController = new AddNewSupporterTicketMessageController();
$headers = apache_request_headers();
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($headers["supporter_auth"]) && isset($_POST["CoworkerId"])&& isset($_POST["MessageSendType"]) && isset($_POST["MessageText"]) && isset($_POST["TicketId"]))
{
    $token=$headers["supporter_auth"];
    $coworkerId=$_POST["CoworkerId"];
    $messageSendType=$_POST["MessageSendType"];
    $messageText=$_POST["MessageText"];
    $ticketId=$_POST["TicketId"];
    $addNewSupporterTicketMessageController->addNewMessage(null,$coworkerId,$messageSendType,$messageText,Utils::getPersianDate(),0,$ticketId,$token);
}
else
{
    $addNewSupporterTicketMessageController->requiredParametersAreNotSet();
}

