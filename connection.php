<?php
class connection{
    private static PDO $connection;
    private static $servername="localhost";
    private static $dbname="survey_bwp501";
    private static $username="root";
    private static $password="";
	/**
	 * @return mixed
	 */
	public static function getConnection() {
		return self::$connection;
	}
    public static function CloseConnection(){
        self::$connection=null;
    }

	/**
	 * @param mixed $connection 
	 * @return self
	 */
	public static function setConnection() {
        $dsn="mysql:host=".self::$servername.";dbname=".self::$dbname.";charset=UTF8";
        self::$connection= new PDO($dsn,self::$username,self::$password);
	}
}