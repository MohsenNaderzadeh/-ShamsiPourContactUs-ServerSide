<?php
/**
 * Created by PhpStorm.
 * User: Mohsen
 * Date: 5/14/2021
 * Time: 11:00 PM
 */
include $_SERVER['DOCUMENT_ROOT'] . "/ContactUs/Controller/GetDepartemantsListController.php";
$getDepartemantsListController=new GetDepartemantsListController();
$headers = apache_request_headers();
if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($headers["Authorization"])){

    $token=$headers["Authorization"];
    $getDepartemantsListController->getDepartemantsList($token);
}else
{
    $getDepartemantsListController->requiredParametersAreNotSet();
}

