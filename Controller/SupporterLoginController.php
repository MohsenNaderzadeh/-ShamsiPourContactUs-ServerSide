<?php
/**
 * Created by PhpStorm.
 * User: Mohsen
 * Date: 4/22/2021
 * Time: 10:22 PM
 */
include $_SERVER['DOCUMENT_ROOT']."/ContactUs/Model/Repo/SupporterRepo.php";
include $_SERVER['DOCUMENT_ROOT']."/ContactUs/Services/Token/SimpleTokenGenerator.php";
include $_SERVER['DOCUMENT_ROOT']."/ContactUs/Controller/BaseController.php";

class SupporterLoginController extends BaseController
{
    function authenticate($userName,$password){
        $supporterRepo=new SupporterRepo();
        $result=null;
        if($supporterRepo->checkSupporterAvailability($userName,$password)){
            $simpleTokenGenerator=new SimpleTokenGenerator();
            $supporterToken=$simpleTokenGenerator->generateToken();
            if($supporterRepo->updateSupporterToken($supporterToken,$userName))
            {
                header("Content-Type:application/json");
                $result["success"]=true;
                $result["token"]=$supporterToken;
                echo json_encode($result);
            }else
            {
                header("Content-Type:application/json");
                http_response_code(500);
                $result["success"]=false;
                $result["message"]="خطا در انجام عملیات";
                echo json_encode($result);
            }
        }else {
            http_response_code(401);
            header("Content-Type:application/json");
            $result["success"] = false;
            $result["message"] = "نام کاربری یا رمز عبور اشتباه است.";
            echo json_encode($result);
        }
    }

}