<?php
/**
 * Created by PhpStorm.
 * User: Mohsen
 * Date: 5/22/2021
 * Time: 7:09 PM
 */


include $_SERVER['DOCUMENT_ROOT'] . "/ContactUs/Controller/CloseTicketByStudentController.php";


$controller=new CloseTicketByStudentController();

$headers = apache_request_headers();


if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST["ticketId"]) && isset($headers["Authorization"]))
{
    $token=$headers["Authorization"];
    $ticketId=$_POST["ticketId"];
    $controller->closeTicket($ticketId,$token);
}else
{
    $controller->requiredParametersAreNotSet();
}
