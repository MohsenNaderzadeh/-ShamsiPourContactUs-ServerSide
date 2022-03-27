<?php
/**
 * Created by PhpStorm.
 * User: Mohsen
 * Date: 4/22/2021
 * Time: 7:20 PM
 */

include_once $_SERVER['DOCUMENT_ROOT'] . "/ContactUs/Controller/UserLogOutController.php";

$logOutController = new UserLogOutController();
$headers = apache_request_headers();
if ($_SERVER['REQUEST_METHOD'] == 'PUT' && isset($headers["Authorization"])) {
        $token = $headers["Authorization"];
        $logOutController->logOut($token);
}
else
{
    $logOutController->requiredParametersAreNotSet();
}
