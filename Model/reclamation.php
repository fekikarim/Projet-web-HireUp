<?php

class Reclamation{

    private $id, $sujet, $description, $date_creation, $statut, $id_user;


    public function __construct($id, $sujet, $description, $date_creation, $statut, $id_user){
        $this->id = $id;
        $this->sujet = $sujet;
        $this->description = $description;
        $this->date_creation = $date_creation;
        $this->statut = $statut;
        $this->id_user = $id_user;
        
    }

    public function set_id($val){
        $this->id = $val;
    }

    public function get_id(){
        return $this->id;
    }

    public function set_sujet($val){
        $this->sujet = $val;
    }

    public function get_sujet(){
        return $this->sujet;
    }

    public function set_description($val){
        $this->description = $val;
    }

    public function get_description(){
        return $this->description;
    }


    public function set_date_creation($val){
        $this->date_creation = $val;
    }

    public function get_date_creation(){
        return $this->date_creation;
    }


    public function set_statut($val){
        $this->statut = $val;
    }

    public function get_statut(){
        return $this->statut;
    }

    public function set_id_user($val){
        $this->id_user = $val;
    }

    public function get_id_user(){
        return $this->id_user;
    }

   
    

}



?>