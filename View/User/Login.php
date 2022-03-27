<?php
/**
 * Created by PhpStorm.
 * User: Mohsen
 * Date: 4/21/2021
 * Time: 12:29 PM
 */

include_once $_SERVER['DOCUMENT_ROOT'] . "/ContactUs/Controller/UserLoginController.php";

$controller = new UserLoginController();
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['username']) && isset($_POST["password"])) {
    $userName = $_POST['username'];
    $password = $_POST["password"];
    $controller->authenticate($userName, $password);
} else {
    $controller->requiredParametersAreNotSet();
}


