<?php

class art{

    private $id, $titre, $contenu, $auteur, $date_art, $categorie;


    public function __construct($id, $titre, $contenu, $auteur, $date_art, $categorie){
        $this->id = $id;
        $this->titre = $titre;
        $this->contenu = $contenu;
        $this->auteur = $auteur;
        $this->date_art = $date_art;
        $this->categorie = $categorie;
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


    public function set_auteur($val){
        $this->auteur= $val;
    }

    public function get_auteur(){
        return $this->auteur;
    }


    public function set_date_art($val){
        $this->date_art = $val;
    }

    public function get_date_art(){
        return $this->date_art;
    }

    public function set_categorie($val){
        $this->categorie = $val;
    }

    public function get_categorie(){
        return $this->categorie;
    }

   
    

}



?>