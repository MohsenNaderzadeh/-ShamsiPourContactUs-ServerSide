<?php
/**
 * Created by PhpStorm.
 * User: Mohsen
 * Date: 7/18/2021
 * Time: 7:34 AM
 */



include $_SERVER['DOCUMENT_ROOT'] . "/ContactUs/Controller/GetClosedTicketsListByStudentController.php";


$controller=new GetClosedTicketsListByStudentController();

$headers = apache_request_headers();

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($headers["Authorization"]))
{
    $token=$headers["Authorization"];
    $controller->getAllClosedTicketsList($token);
}else
{
    $controller->requiredParametersAreNotSet();
}