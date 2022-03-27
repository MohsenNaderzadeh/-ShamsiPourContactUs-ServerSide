<?php
/**
 * Created by PhpStorm.
 * User: Mohsen
 * Date: 4/23/2021
 * Time: 2:11 PM
 */
include $_SERVER['DOCUMENT_ROOT'] . "/ContactUs/Controller/SubmitNewTicketController.php";

$submitNewTicketController = new SubmitNewTicketController();
$headers = apache_request_headers();
if ($_SERVER['REQUEST_METHOD'] == 'POST' &&
    isset($_POST['ticketTitle'])
    && isset($_POST['ticketRelatedAdministrativeDepartemantId'])
    && isset($headers["Authorization"])) {
    $ticketTitle = $_POST['ticketTitle'];
    $ticketRelatedAdministrativeDepartemantId = $_POST['ticketRelatedAdministrativeDepartemantId'];
    $token = $headers["Authorization"];
    $submitNewTicketController->submitNewTicket($token, $ticketTitle, $ticketRelatedAdministrativeDepartemantId);
} else {
    $submitNewTicketController->requiredParametersAreNotSet();
}


