<?php
/**
 * Created by PhpStorm.
 * User: Mohsen
 * Date: 5/17/2021
 * Time: 10:58 AM
 */

include $_SERVER['DOCUMENT_ROOT'] . "/ContactUs/Controller/AddNewStudentTicketMessageController.php";
include $_SERVER['DOCUMENT_ROOT'] . "/ContactUs/Utils/Utils.php";

$addNewStudentTicketMessageController = new AddNewStudentTicketMessageController();
$headers = apache_request_headers();
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($headers["Authorization"]) && isset($_POST["studentId"])&& isset($_POST["MessageSendType"]) && isset($_POST["MessageText"]) && isset($_POST["TicketId"]))
{
    $token=$headers["Authorization"];
    $stdId=$_POST["studentId"];
    $messageSendType=$_POST["MessageSendType"];
    $messageText=$_POST["MessageText"];
    $ticketId=$_POST["TicketId"];
    $addNewStudentTicketMessageController->addNewMessage($stdId,null,$messageSendType,$messageText,Utils::getPersianDate(),0,$ticketId,$token);
}
else
{
    $addNewStudentTicketMessageController->requiredParametersAreNotSet();
}

