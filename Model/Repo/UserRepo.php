<?php
/**
 * Created by PhpStorm.
 * User: Mohsen
 * Date: 4/21/2021
 * Time: 5:04 PM
 */

include_once $_SERVER['DOCUMENT_ROOT']."/ContactUs/Model/db/DBProvider.php";
include_once $_SERVER['DOCUMENT_ROOT']."/ContactUs/Model/Entities/User.php";


class UserRepo
{
    public function checkUserAvailability($userName,$password){
        $database=DBProvider::getInstance();
        $getUserPrepare=$database->prepare("Select * from `shamsi_students` WHERE  `StudentUniversityCode`='$userName' AND `StudentNationalCode`='$password';");
        $getUserPrepare->execute();
        $result=$getUserPrepare->FETCHALL(PDO::FETCH_ASSOC);
        if(sizeof($result)>0)
        {
            return true;
        }
        return false;
    }
    public function checkTokenAvailability($token){
        $database=DBProvider::getInstance();
        $tokenPrepare=$database->prepare("Select * from `shamsi_students` WHERE `stdToken`='$token';");
        $tokenPrepare->execute();
        $result=$tokenPrepare->FETCHALL(PDO::FETCH_ASSOC);
        if(sizeof($result)>0)
        {
            return true;
        }
        return false;
    }

    public function checkUserIdAvailability($studentId){
        $database=DBProvider::getInstance();
        $tokenPrepare=$database->prepare("Select * from `shamsi_students` WHERE `StudentId`='$studentId';");
        $tokenPrepare->execute();
        $result=$tokenPrepare->FETCHALL(PDO::FETCH_ASSOC);
        if(sizeof($result)>0)
        {
            return true;
        }
        return false;
    }
    public function updateUserToken($token,$userUserName){
        $database=DBProvider::getInstance();
        $updateTokenPrepare=$database->prepare("UPDATE `shamsi_students` SET `stdToken`='$token' WHERE `StudentUniversityCode`='$userUserName'");
        if($updateTokenPrepare->execute())
        {
            return true;
        }else
        {
            return false;
        }
    }
    public function setUserTokenNull($token){
        $database=DBProvider::getInstance();
        $setUserTokenNullPrepare=$database->prepare("UPDATE `shamsi_students` SET `stdToken`=NULL WHERE `stdToken`='$token'");
        if($setUserTokenNullPrepare->execute())
        {
            return true;
        }else
        {
            return false;
        }
    }
    public function getUserId($token){
        $database=DBProvider::getInstance();
        $getUserIdPrepare=$database->prepare("Select StudentId from shamsi_students where stdToken='$token'");
        $getUserIdPrepare->execute();
        $result=$getUserIdPrepare->FETCHALL(PDO::FETCH_ASSOC);
        return $result[0]["StudentId"]!=null?$result[0]["StudentId"]:0;
    }
    public function getUserInfo($ownerId):array
    {
        $database=DBProvider::getInstance();
        $getAllTicketsPrepare=$database->prepare("Select * from shamsi_students JOIN majors ON shamsi_students.StudentMajor=majors.MajorId JOIN grades ON shamsi_students.StudentGrade=grades.GradeId where StudentId='$ownerId'");
        $getAllTicketsPrepare->execute();
        $queryResult=$getAllTicketsPrepare->FETCHALL(PDO::FETCH_ASSOC);
        $result=array();
        foreach ($queryResult as $user)
        {
            $temp["StudentId"]=(int)$user["StudentId"];
            $temp["StudentName"]=$user["StudentName"];
            $temp["StudentLastName"]=$user["StudentLastName"];
            $temp["StudentNationalCode"]=$user["StudentNationalCode"];
            $temp["StudentUniversityCode"]=$user["StudentUniversityCode"];
            $temp["MajorName"]=$user["MajorName"];
            $temp["GradeName"]=$user["GradeName"];
            $result[]=$temp;
        }
        return $result;
    }
}