<?php
/**
 * Created by PhpStorm.
 * User: Mohsen
 * Date: 6/30/2021
 * Time: 6:38 AM
 */

include $_SERVER['DOCUMENT_ROOT'] . "/ContactUs/Controller/AddTicketToInboxController.php";

$controller=new AddTicketToInboxController();

$headers = apache_request_headers();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($headers["supporter_auth"]) && isset($_POST["ticketId"])) {
    $token = $headers["supporter_auth"];
    $ticketId=$_POST["ticketId"];
    $controller->addTicketToInbox($ticketId,$token);
} else {
    $controller->requiredParametersAreNotSet();
}