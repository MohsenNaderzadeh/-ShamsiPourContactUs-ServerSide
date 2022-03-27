<?php
/**
 * Created by PhpStorm.
 * User: Mohsen
 * Date: 4/25/2021
 * Time: 2:31 PM
 */


class BaseController
{


    function requiredParametersAreNotSet(){
        header("Content-Type:application/json");
        http_response_code(400);
        $result["success"]=false;
        echo json_encode($result);
    }




}