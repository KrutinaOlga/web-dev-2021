<?php

class DB
{
    private $db;
    private static $_instance;


    public static function getInstance()
    {
        if (self::$_instance == null) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    public function __construct()
    {
        $this->db = new mysqli("127.0.0.1", "root", "", "website");
    }

    public function getGuns()
    {
        $result = $this->db->query("SELECT * FROM guns");
        $guns_list = [];

        while ($row = mysqli_fetch_array($result)) {
            $n = new NewGun();
            $n = $this->fillModel($n, $row);
            $guns_list[] = $n;
        }
        return $guns_list;
    }

    public function saveGunsItem($item)
    {
        $this->db->query("INSERT INTO guns (title,image_link,description) VALUES('$item->title','$item->image_link', '$item->description')");
    }

    private function fillModel($model, $data)
    {
        $vars = get_class_vars(get_class($model));
        foreach ($vars as $key => $value) {
            if (isset($data[$key])) {
                $model->{$key} = $data[$key];
            }
        }
        return $model;
    }

    public function signIn($email, $password)
    {
        $result = $this->db->query("SELECT * FROM users WHERE email = '$email' LIMIT 1");
        if ($result->num_rows == 0) {
            return false;
        }
        $password_hash = md5($password);
        $user = mysqli_fetch_array($result);
        if ($user['password'] != $password_hash) {
            return false;
        }

        $session = new NewUserSession();
        $session->user_id = $user['ID'];
        $session->ID = uniqid("", true);
        $session->ip = $_SERVER['REMOTE_ADDR'];
        $this->db->query("INSERT INTO user_session (ID, user_id, ip) VALUES('$session->ID', '$session->user_id', '$session->ip')");
        return $session->ID;

    }

    public function getUser($id)
    {
        $result = $this->db->query("SELECT * FROM users WHERE ID = '$id' LIMIT 1");
        if ($result->num_rows == 0) {
            return false;
        }
        /** @var NewUser $user */
        $user = $this->fillModel(new NewUser(), mysqli_fetch_array($result));
        return $user;
    }

    public function checkToken($token)
    {
        $result = $this->db->query("SELECT * FROM user_session WHERE ID='$token' LIMIt 1");
        if ($result->num_rows == 0) {
            return false;
        }
        $session = mysqli_fetch_array($result);

        return $this->getUser($session['user_id']);
    }

}

?>