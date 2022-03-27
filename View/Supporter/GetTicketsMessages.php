<?php
/**
 * Created by PhpStorm.
 * User: Mohsen
 * Date: 5/17/2021
 * Time: 8:18 AM
 */


include_once $_SERVER['DOCUMENT_ROOT'] . "/ContactUs/Controller/GetStudentsTicketsMessagesBySupporter.php";

$controller=new GetStudentsTicketsMessagesBySupporter();
$headers = apache_request_headers();
if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($headers["supporter_auth"]) && isset($_GET["ticketId"])) {

    $token=$headers["supporter_auth"];
    $ticketId=$_GET["ticketId"];
    $controller->getAll($token,$ticketId);
}

