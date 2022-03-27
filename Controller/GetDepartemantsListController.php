<?php
/**
 * Created by PhpStorm.
 * User: Mohsen
 * Date: 5/14/2021
 * Time: 11:01 PM
 */

include_once $_SERVER['DOCUMENT_ROOT'] . "/ContactUs/Model/Repo/DepartemantsRepo.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/ContactUs/Model/Repo/UserRepo.php";

include $_SERVER['DOCUMENT_ROOT'] . "/ContactUs/Controller/BaseController.php";

class GetDepartemantsListController extends BaseController
{

    public function getDepartemantsList($token){
        $departemantsRepo=new DepartemantsRepo();
        $userRepo=new UserRepo();
        if($userRepo->checkTokenAvailability($token))
        {
            $departemantsList=$departemantsRepo->getDepartemantsList();
            $departemantsResult=array();
            foreach ($departemantsList as $departemantObj)
            {
                if($departemantObj instanceof AdministrativeDepartemant)
                {
                    $temp["DepartemantId"]=$departemantObj->getAdministrativeDepartemantId();
                    $temp["DepartemantName"]=$departemantObj->getAdministrativeDepartemantName();
                    $departemantsResult[]=$temp;
                }
            }
            header("Content-Type:application/json");
            $result["success"] = true;
            $result["departemantsList"]=$departemantsResult;
            echo json_encode($departemantsResult);
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