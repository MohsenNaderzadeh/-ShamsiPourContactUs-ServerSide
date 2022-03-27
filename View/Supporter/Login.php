<?php
/**
 * Created by PhpStorm.
 * User: Mohsen
 * Date: 4/22/2021
 * Time: 10:20 PM
 */
include $_SERVER['DOCUMENT_ROOT'] . "/ContactUs/Controller/SupporterLoginController.php";

$controller = new SupporterLoginController();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['username']) && isset($_POST["password"])) {
    $userName = $_POST['username'];
    $password = $_POST["password"];
    $controller->authenticate($userName, $password);
} else {
    $controller->requiredParametersAreNotSet();
}