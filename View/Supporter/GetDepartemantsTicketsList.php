<?php
/**
 * Created by PhpStorm.
 * User: Mohsen
 * Date: 7/2/2021
 * Time: 10:04 PM
 */


include $_SERVER['DOCUMENT_ROOT'] . "/ContactUs/Controller/GetDepartemantsTicketsListController.php";

$controller=new GetDepartemantsTicketsListController();

$headers = apache_request_headers();

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($headers["supporter_auth"]))  {
$token = $headers["supporter_auth"];
    $controller->getAll($token);
} else {
    $controller->requiredParametersAreNotSet();
}

