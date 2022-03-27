<?php
/**
 * Created by PhpStorm.
 * User: Mohsen
 * Date: 7/18/2021
 * Time: 7:34 AM
 */



include $_SERVER['DOCUMENT_ROOT'] . "/ContactUs/Controller/GetClosedTicketsListBySupporterController.php";


$controller=new GetClosedTicketsListBySupporterController();

$headers = apache_request_headers();

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($headers["supporter_auth"]))
{
    $token=$headers["supporter_auth"];
    $controller->getAll($token);
}else
{
    $controller->requiredParametersAreNotSet();
}