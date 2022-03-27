<?php
/**
 * Created by PhpStorm.
 * User: Mohsen
 * Date: 5/22/2021
 * Time: 7:09 PM
 */


include $_SERVER['DOCUMENT_ROOT'] . "/ContactUs/Controller/CloseTicketBySupporterController.php";


$controller=new CloseTicketBySupporterController();

$headers = apache_request_headers();


if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST["ticketId"]) && isset($headers["supporter_auth"]))
{
    $token=$headers["supporter_auth"];
    $ticketId=$_POST["ticketId"];
    $controller->closeTicket($ticketId,$token);
}else
{
    $controller->requiredParametersAreNotSet();
}
