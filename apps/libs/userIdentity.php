<?php
session_start();
class apps_libs_userIdentity
{
    public $username;
    public $password;
    protected $id;
    public function __construct($username = "", $password = "")
    {
        # code...
        $this->username = $username;
        $this->password = $password;
    }
    public function login()
    {
        # code...
        $db = new apps_models_Admin();
        $query = $db->buildQueryParameter([
            "select" => "*",
            "where" => "username = '$this->username' AND password = '$this->password' ",
        ])->select();
        if($query){
            $_SESSION["id"] = $query["id"];
            $_SESSION["username"] = $query["username"];
            $_SESSION["password"] = $query["password"];
            $_SESSION["name"] = $query["name"];
        }
        return false;
    }
    public function logout()
    {
        # code...
        session_unset();
    }
    public function getSESSION($name)
    {
        # code...
        if($name !== null){
            return isset($_SESSION[$name]) ? $_SESSION[$name] : null;
        }
        // return $_SESSION;
    }
    public function isLogin()
    {
        # code...
        if($this->getSESSION("name")){
            return true;
        }
    }
    public function getID()
    {
        # code...
        return $this->getSESSION("id");

    }
}