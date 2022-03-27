<?php
/**
 * Created by PhpStorm.
 * User: Mohsen
 * Date: 8/13/2021
 * Time: 10:22 PM
 */


include $_SERVER['DOCUMENT_ROOT'] . "/ContactUs/Controller/GetTicketOwnerInfoController.php";

$controller=new GetTicketOwnerInfoController();

$headers = apache_request_headers();


if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET["ownerId"]) && isset($headers["supporter_auth"]))
{
    $token=$headers["supporter_auth"];
    $ownerId=$_GET["ownerId"];
    $controller->getTicketOwnerInfo($token,$ownerId);
}else
{
    $controller->requiredParametersAreNotSet();
}