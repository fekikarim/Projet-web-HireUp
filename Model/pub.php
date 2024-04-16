<?php

class Pub{

    private $id, $titre, $contenu, $objectif, $dure, $budget;


    public function __construct($id, $titre, $contenu, $objectif, $dure, $budget){
        $this->id = $id;
        $this->titre = $titre;
        $this->contenu = $contenu;
        $this->objectif = $objectif;
        $this->dure = $dure;
        $this->budget = $budget;
    }

    public function set_id($val){
        $this->id = $val;
    }

    public function get_id(){
        return $this->id;
    }

    public function set_titre($val){
        $this->titre = $val;
    }

    public function get_titre(){
        return $this->titre;
    }

    public function set_contenu($val){
        $this->contenu = $val;
    }

    public function get_contenu(){
        return $this->contenu;
    }


    public function set_objectif($val){
        $this->objectif = $val;
    }

    public function get_objectif(){
        return $this->objectif;
    }


    public function set_dure($val){
        $this->dure = $val;
    }

    public function get_dure(){
        return $this->dure;
    }

    public function set_budget($val){
        $this->budget = $val;
    }

    public function get_budget(){
        return $this->budget;
    }

   
    

}



?>