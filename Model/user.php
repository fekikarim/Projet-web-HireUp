<?php

class User{

    private $id, $user_name, $email, $password, $role;


    public function __construct($id, $user_name, $email, $password, $role){
        $this->id = $id;
        $this->user_name = $user_name;
        $this->email = $email;
        $this->password = $password;
        $this->role = $role;
    }

    public function set_id($val){
        $this->id = $val;
    }

    public function get_id(){
        return $this->id;
    }

    public function set_user_name($val){
        $this->user_name = $val;
    }

    public function get_user_name(){
        return $this->user_name;
    }

    public function set_email($val){
        $this->email = $val;
    }

    public function get_email(){
        return $this->email;
    }


    public function set_password($val){
        $this->password = $val;
    }

    public function get_password(){
        return $this->password;
    }


    public function set_role($val){
        $this->role = $val;
    }

    public function get_role(){
        return $this->role;
    }
    

}



?>