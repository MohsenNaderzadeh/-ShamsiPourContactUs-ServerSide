<?php
/**
 * Created by PhpStorm.
 * User: Mohsen
 * Date: 4/22/2021
 * Time: 10:23 PM
 */
include_once $_SERVER['DOCUMENT_ROOT']."/ContactUs/Model/Repo/SupporterRepo.php";

include_once $_SERVER['DOCUMENT_ROOT']."/ContactUs/Controller/BaseController.php";

class SupporterLogOutController extends BaseController
{

    function logOut($token){
        header("Content-Type:application/json");
        $supporterRepo=new SupporterRepo();
        if($supporterRepo->checkTokenAvailability($token))
        {
            if($supporterRepo->setSupporterTokenNull($token))
            {
                $result["success"]=true;
                echo json_encode($result);
            }else
            {
                http_response_code(500);
                $result["success"]=false;
                $result["message"]="خطا در انجام عملیات";
                echo json_encode($result);
            }

        }else{
            header("Content-Type:application/json");
            http_response_code(401);
            $result["success"] = false;
            $result["message"]="لطفا مجددا به حساب کاربری خود وارد شوید";
            echo json_encode($result);
        }
    }

}