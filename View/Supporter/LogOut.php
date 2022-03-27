<?php
/**
 * Created by PhpStorm.
 * User: Mohsen
 * Date: 4/22/2021
 * Time: 10:20 PM
 */
include $_SERVER['DOCUMENT_ROOT'] . "/ContactUs/Controller/SupporterLogOutController.php";
$headers = apache_request_headers();

if ($_SERVER['REQUEST_METHOD'] == 'PUT' && isset($headers["supporter_auth"])) {
    $logOutController = new SupporterLogOutController();
    $token = $headers["supporter_auth"];
    $logOutController->logOut($token);
} else {
    $logOutController->requiredParametersAreNotSet();
}