<?php
/**
 * Created by PhpStorm.
 * User: Mohsen
 * Date: 8/13/2021
 * Time: 7:23 PM
 */
include_once $_SERVER['DOCUMENT_ROOT'] . "/ContactUs/Controller/BaseController.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/ContactUs/Model/Repo/UserRepo.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/ContactUs/Model/Repo/SupporterRepo.php";

class GetTicketOwnerInfoController extends BaseController
{


    function getTicketOwnerInfo($token,$ownerId){
        $userRepo=new UserRepo();
        $supporterRepo=new SupporterRepo();

        if($supporterRepo->checkTokenAvailability($token))
        {
            if($userRepo->checkUserIdAvailability($ownerId))
            {
                $userInfo=$userRepo->getUserInfo($ownerId);
                if($userInfo!=null)
                {

                    header("Content-Type:application/json");
                    $responseResult["success"] = true;
                    $temp["StudentId"]=(int)$userInfo[0]["StudentId"];
                    $temp["StudentName"]=$userInfo[0]["StudentName"];
                    $temp["StudentLastName"]=$userInfo[0]["StudentLastName"];
                    $temp["StudentNationalCode"]=$userInfo[0]["StudentNationalCode"];
                    $temp["StudentUniversityCode"]=$userInfo[0]["StudentUniversityCode"];
                    $temp["MajorName"]=$userInfo[0]["MajorName"];
                    $temp["GradeName"]=$userInfo[0]["GradeName"];
                    $responseResult["ownerInfo"]=$temp;

                    echo json_encode($responseResult);
                }else
                {
                    header("Content-Type:application/json");
                    http_response_code(500);
                    $responseResult["success"] = false;
                    $responseResult["message"] = "خطا در انجام عملیات";
                    echo json_decode($responseResult);
                }

            }else
            {
                header("Content-Type:application/json");
                http_response_code(500);
                $responseResult["success"] = false;
                $responseResult["message"] = "خطا در انجام عملیات";
                echo json_decode($responseResult);
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