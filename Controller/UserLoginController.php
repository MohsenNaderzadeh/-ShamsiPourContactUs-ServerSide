<?php
/**
 * Created by PhpStorm.
 * User: Mohsen
 * Date: 4/21/2021
 * Time: 5:08 PM
 */
include $_SERVER['DOCUMENT_ROOT']."/ContactUs/Services/Token/SimpleTokenGenerator.php";
include $_SERVER['DOCUMENT_ROOT']."/ContactUs/Controller/BaseController.php";

include $_SERVER['DOCUMENT_ROOT']."/ContactUs/Model/Repo/UserRepo.php";


class UserLoginController extends BaseController
{

    function authenticate($userUserName,$userPassword){
        $userRepo=new UserRepo();
        $result=null;
        if($userRepo->checkUserAvailability($userUserName,$userPassword)){
            $simpleTokenGenerator=new SimpleTokenGenerator();
            $userToken=$simpleTokenGenerator->generateToken();
            if($userRepo->updateUserToken($userToken,$userUserName)){
                header("Content-Type:application/json");
                    $result["success"]=true;
                    $result["token"]=$userToken;
                    echo json_encode($result);
            }else
            {
                http_response_code(500);
                header("Content-Type:application/json");
                $result["success"]=false;
                $result["message"]="خطا در انجام عملیات";
                echo json_encode($result);
            }
        }else
        {
            header("Content-Type:application/json");
            $result["success"]=false;
            $result["message"]="نام کاربری یا رمز عبور اشتباه است.";
            echo json_encode($result);
        }
    }




}