<?php
/**
 * Created by PhpStorm.
 * User: Mohsen
 * Date: 5/25/2021
 * Time: 10:08 AM
 */
include $_SERVER['DOCUMENT_ROOT'] . "/ContactUs/Controller/GetAllSupporterInboxTicketsController.php";

$controller=new GetAllSupporterInboxTicketsController();

$headers = apache_request_headers();

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($headers["supporter_auth"])) {
    $token = $headers["supporter_auth"];
    $controller->getAll($token);
} else {
    $controller->requiredParametersAreNotSet();
}

