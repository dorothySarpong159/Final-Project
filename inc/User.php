<?php
class User{
    private $db;
    public function __construct($db_connection){
        $this->db = $db_connection;
    }

    public function findByUsername($username){
        try{
            $stmt = $this->db->prepare("SELECT * FROM users WHERE username = ?");
            $stmt->execute([$username]);
            return $stmt->fetch();
        }catch (PDOException $e){
            return false;
        }
    }

    public function register($username, $email, $password, $confirm_password){
        if(empty($username) || empty($email) || empty($password) || empty($confirm_password)){
            return "All fields are required to continue";
        }

        if($this->findByUsername($username)){
            return "Username already taken";
        }

        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            return "Invalid email address";
        }

        if($password !== $confirm_password){
            return "Password does not match";
        }

        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        try{
            $stmt = $this->db->prepare("INSERT INTO users(username, email, password) VALUES (?, ?, ?)");
            $stmt->execute([$username, $email, $hashed_password]);
            return "User Created";
        }catch(PDOException $e){
            return "Unable to create a user" . $e->getMessage();
        }
    }
   
        public function login($username, $password){
            if(empty($username) || empty($password)){
                return false;
            }
            $user = $this->findByUsername($username);
            if($user && password_verify($password, $user['password'])){
                return $user;
            }else{
                return false;
            }
    }
}

?>