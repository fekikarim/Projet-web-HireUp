<?php

require '../../../config.php';



class recCon{

    private $tab_name;

    public function __construct($tab_name){
        $this->tab_name = $tab_name;
    }

    public function generateId($id_length){
        //generatre a random number
        $numbers = '0123456789';
        $numbers_length = strlen($numbers);
        $random_id = '';

        // Generate random ID
        for ($i = 0; $i < $id_length; $i++) {
            $random_id .= $numbers[rand(0, $numbers_length - 1)];
        }

        return (string) $random_id; // Ensure the return value is a string
    }

    public function recExists($id, $db) {
        $sql = "SELECT COUNT(*) as count FROM $this->tab_name WHERE id = :id";
        try {
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result['count'] > 0;
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    public function generateRecId($id_length) {
        $db = config::getConnexion();
    
        do {
            $current_id = $this->generateId($id_length);
        } while ($this->recExists($current_id, $db));
    
        return $current_id;
    }

    public function getRec($id)
    {
        $sql = "SELECT * FROM $this->tab_name WHERE id = $id";
        $db = config::getConnexion();

        try {
            $query = $db->prepare($sql);
            $query->execute();
            $event = $query->fetch();
            return $event;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    public function listRect()
    {
        $sql = "SELECT * FROM $this->tab_name";

        $db = config::getConnexion();
        try {
            $liste = $db->query($sql);
            return $liste;
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    public function addRec($rec) 
    {
        $sql = "INSERT INTO $this->tab_name(id, sujet, description, date_creation, statut, id_user) VALUES (:id, :sujet, :description, :date_creation, :statut, :id_user)";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute(
               [
                'id' => $rec->get_id(), 
                'sujet' => $rec->get_sujet(), 
                'description' => $rec->get_description(), 
                'date_creation' => $rec->get_date_creation(), 
                'statut' => $rec->get_statut(),
                'id_user' => $rec->get_id_user()
                ]
            );
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function updateRec($rec, $id)
    {
        try {
            $db = config::getConnexion();
            $query = $db->prepare("UPDATE $this->tab_name SET sujet = :sujet, description = :description, date_creation = :date_creation, statut = :statut, id_user = :id_user WHERE id = :id");
            $query->execute(['id' => $id, 'sujet' => $rec->get_sujet(), 'description' => $rec->get_description(), 'date_creation' => $rec->get_date_creation(), 'statut' => $rec->get_statut(), 'id_user' => $rec->get_id_user()]);
            echo $query->rowCount() . " records UPDATED successfully <br>";
        } catch (PDOException $e) {
            $e->getMessage();
            echo($e);
        }
    }

    public function deleteRec($id)
    {
        $sql = "DELETE FROM $this->tab_name WHERE id = :id";
        $db = config::getConnexion();
        $req = $db->prepare($sql);
        $req->bindValue(':id', $id);

        try {
            $req->execute();
            return true;
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
            return false;
        }
    }

    public function sortRec($by){

        
        $sql = "SELECT * FROM $this->tab_name";
        
        if ($by == "everything"){
            $sql .= " ORDER BY id";
        }
        else{
            $sql .= " ORDER BY $by";
        }

        $db = config::getConnexion();
        try {
            $db = config::getConnexion();
            $query = $db->prepare($sql);
            $query->execute();
        
            $liste = $query->fetchAll(PDO::FETCH_ASSOC);
            //echo "SQL Query: " . $query->queryString;
            return $liste;
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }        

    }

    public function searchRec($by, $keyword){

        if ($by == "everything"){
            $sql = "SELECT * FROM $this->tab_name WHERE sujet LIKE '%$keyword%' OR description LIKE '%$keyword%' OR date_creation LIKE '%$keyword%' OR statut LIKE '%$keyword%' OR id_user LIKE '%$keyword%' OR id LIKE '%$keyword%'";
        }
        else{
            $sql = "SELECT * FROM $this->tab_name WHERE $by LIKE '%$keyword%'";
        }

        $db = config::getConnexion();
        try {
            $db = config::getConnexion();
            $query = $db->prepare($sql);
            $query->execute();
        
            $liste = $query->fetchAll(PDO::FETCH_ASSOC);
            //echo "SQL Query: " . $query->queryString;
            return $liste;
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }        

    }

    public function searchRecSorted($by, $keyword){

        if ($by == "everything"){
            $sql = "SELECT * FROM $this->tab_name WHERE sujet LIKE '%$keyword%' OR description LIKE '%$keyword%' OR date_creation LIKE '%$keyword%' OR statut LIKE '%$keyword%' OR id_user LIKE '%$keyword%' OR id LIKE '%$keyword%'";
        }
        else{
            $sql = "SELECT * FROM $this->tab_name WHERE $by LIKE '%$keyword%'";
        }

        // add order by//recherche avec tri
        if ($by == "everything"){
            $sql .= " ORDER BY id";
        }
        else{
            $sql .= " ORDER BY $by";
        }

        $db = config::getConnexion();
        try {
            $db = config::getConnexion();
            $query = $db->prepare($sql);
            $query->execute();
        
            $liste = $query->fetchAll(PDO::FETCH_ASSOC);
            //echo "SQL Query: " . $query->queryString;
            return $liste;
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }        

    }

}



?>