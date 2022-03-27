<?php
/**
 * Created by PhpStorm.
 * User: Mohsen
 * Date: 4/21/2021
 * Time: 2:41 PM
 */
class DBProvider
{
    private static $dbConnection=null;
    private  const DB_NAME="shamsipourcontactus";
    private  const DB_USERNAME="root";
    private  const DB_PASSWORD="";
    private  const DB_HOST="localhost";

    public static function getInstance(){
        if(self::$dbConnection==null) {
            try {
                self::$dbConnection = new PDO("mysql:host=" . self::DB_HOST . ";dbname=" . self::DB_NAME.";charset=utf8", self::DB_USERNAME, self::DB_PASSWORD);
                self::$dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                throw $e;
            }
        }
        return self::$dbConnection;
    }


}