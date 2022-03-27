<?php
/**
 * Created by PhpStorm.
 * User: Mohsen
 * Date: 5/17/2021
 * Time: 8:18 AM
 */


include_once $_SERVER['DOCUMENT_ROOT'] . "/ContactUs/Controller/GetStudentTicketMessageController.php";

$controller=new GetStudentTicketMessageController();
$headers = apache_request_headers();
if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($headers["Authorization"]) && isset($_GET["ticketId"])) {

    $token=$headers["Authorization"];
    $ticketId=$_GET["ticketId"];
    $controller->getAll($token,$ticketId);
}

