<?php

$conn = new PDO('pgsql:host=localhost;dbname=postgres', 'postgres', '1308');

class User
{
    private static $instance = null;
    private $username, $userid, $loggedin;

    public function __construct()
    {
        $this->username = null;
        $this->userid = null;
        $this->loggedin = false;
    }

    public static function GetInstance()
    {
        if (is_null(self::$instance)) {
            self::$instance = new User();
        }
        return self::$instance;
    }

    function login($username, $password)
    {
        global $conn;
        $request = $conn->prepare("SELECT password FROM users WHERE username = :username");
        $request->execute(array('username' => $username));
        $results = $request->fetch();
        if (password_verify($password, $results['password'])) {
            $request = $conn->prepare("SELECT userid, username FROM users WHERE username = :username ORDER BY userid LIMIT 1");
            $request->execute(array('username' => $username));
            $results = $request->fetch();
            $this->username = $results['username'];
            $this->userid = $results['userid'];
            $this->loggedin = true;
            return true;
        }
        return false;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function setUsername($username)
    {
        $this->username = $username;
    }

    public function getUserid()
    {
        return $this->userid;
    }

    public function setUserid($userid)
    {
        $this->userid = $userid;
    }

    public function getLoggedin()
    {
        return $this->loggedin;
    }

    public function setLoggedin($loggedin)
    {
        $this->loggedin = $loggedin;
    }

}