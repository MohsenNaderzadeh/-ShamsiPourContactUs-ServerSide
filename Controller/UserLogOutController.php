<?php
/**
 * Created by PhpStorm.
 * User: Mohsen
 * Date: 4/22/2021
 * Time: 7:20 PM
 */

include $_SERVER['DOCUMENT_ROOT'] . "/ContactUs/Controller/BaseController.php";
include $_SERVER['DOCUMENT_ROOT'] . "/ContactUs/Model/Repo/UserRepo.php";

class UserLogOutController extends BaseController
{
    function logOut($token)
    {
        header("Content-Type:application/json");
        $userRepo = new UserRepo();

        if($userRepo->checkTokenAvailability($token))
        {
            if ($userRepo->setUserTokenNull($token)) {
                $result["success"] = true;
                echo json_encode($result);
            } else {
                http_response_code(500);
                $result["success"] = false;
                $result["message"] = "خطا در انجام عملیات";
                echo json_encode($result);
            }
        }else
        {
            header("Content-Type:application/json");
            http_response_code(401);
            $result["success"] = false;
            $result["message"]="لطفا مجددا به حساب کاربری خود وارد شوید";
            echo json_encode($result);
        }

    }


}