<?php

Class UserModel
{
    private $db_con;
    public function __construct(){
        $this->db_con=new MyDatabase();
    }
    public function addUser($name,$email,$password){
        $password=$password."Saltyy#@1921";
        $hash_password=password_hash($password,PASSWORD_DEFAULT);

        $paramType="sss";
        $paramValue=array(
            $name,
            $email,
            $hash_password
        );

        $sql="INSERT INTO `users` (name,email,password) VALUES (?,?,?)";
        $data=$this->db_con->insert($sql,$paramType,$paramValue);
       
        return $data;
    }

    public function loginUser($email,$password){
        $password=$password."Saltyy#@1921";
        
        $paramType="s";
        $paramValue=array(
            $email
        );

        $sql="SELECT id,name,email,password FROM `users` WHERE email=(?)";
        $data=$this->db_con->select($sql,$paramType,$paramValue);

        if ($data['success']) {
            if (!password_verify($password, $data['password'])) 
            {
                $data2["success"]=false;
                $data2["message"]="Invalid Credential !";
                return $data2;
            }

           return $data;
            
        } else {
            $data2["success"]=false;
            $data2["message"]="Either Invalid Credential or some technical issue !";
            return $data2;
        }
        
       
    }

    public function editUser($name,$email,$user_id){

        $result=$this->db->db_query("UPDATE users SET name=$name,email=$email WHERE id=$user_id");
        return $result;
    }

    public function getUser($user_id){

        $result=$this->db->db_query("SELECT id,name,email,user_id,created_at FROM users WHERE id=$user_id");
        return $result;
    }


}