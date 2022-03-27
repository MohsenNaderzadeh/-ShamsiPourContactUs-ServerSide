<?php
/**
 * Created by PhpStorm.
 * User: Mohsen
 * Date: 4/24/2021
 * Time: 7:19 PM
 */
include_once $_SERVER['DOCUMENT_ROOT'] . "/ContactUs/Controller/GetTicketsListController.php";
$getTicketsListController=new GetTicketsListController();
$headers = apache_request_headers();
if($_SERVER['REQUEST_METHOD'] == 'GET'
    && isset($headers["Authorization"])){
    $token=$headers["Authorization"];
    $getTicketsListController->getTicketsList($token);
}else
{
    $getTicketsListController->requiredParametersAreNotSet();
}



