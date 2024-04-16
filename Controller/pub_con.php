<?php

try {
    require '../../../config.php';
} catch (Exception $e) {
    //die('Error:' . $e->getMessage());
}





class pubCon{


    public function generateId($id_length){
        $numbers = '0123456789';
        $numbers_length = strlen($numbers);
        $random_id = '';

        // Generate random ID
        for ($i = 0; $i < $id_length; $i++) {
            $random_id .= $numbers[rand(0, $numbers_length - 1)];
        }

        return (string) $random_id; // Ensure the return value is a string
    }

    public function pubExists($id, $db) {
        $sql = "SELECT COUNT(*) as count FROM publicite WHERE id = :id";
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

    public function generatepubId($id_length) {
        $db = config::getConnexion();
    
        do {
            $current_id = $this->generateId($id_length);
        } while ($this->pubExists($current_id, $db));
    
        return $current_id;
    }


    public function listpub()
    {
        $sql = "SELECT * FROM publicite";

        $db = config::getConnexion();
        try {
            $liste = $db->query($sql);
            return $liste;
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    public function addpub($pub)
    {
        $sql = "INSERT INTO publicite(id, titre, contenu, objectif ,dure ,budget) VALUES (:id, :titre, :contenu, :objectif, :dure, :budget)";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute(
               [
                'id' => $pub->get_id(), 
                'titre' => $pub->get_titre(), 
                'contenu' => $pub->get_contenu(), 
                'objectif' => $pub->get_objectif(), 
                'dure' => $pub->get_dure(),
                'budget' => $pub->get_budget()
                ]
            );
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    function updatepub($pub, $id)
    {
        try {
            $db = config::getConnexion();
            $query = $db->prepare("UPDATE publicite SET titre = :titre, contenu = :contenu, objectif = :objectif, dure = :dure, budget = :budget WHERE id = :id");
            $query->execute([
                'id' => $id, 
                'titre' => $pub->get_titre(),
                'contenu' => $pub->get_contenu(),
                'objectif' => $pub->get_objectif(),
                'dure' => $pub->get_dure(),
                'budget' => $pub->get_budget()
            ]);
            echo $query->rowCount() . " records UPDATED successfully <br>";
        } catch (PDOException $e) {
            $e->getMessage();
            echo($e);
        }
    }
    

    public function deletepub($id)
    {
        $sql = "DELETE FROM publicite WHERE id = :id";
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


    public function sortpub($by){

        
        $sql = "SELECT * publicite";
        
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

    public function searchpub($by, $keyword ){

        if ($by == "everything"){
            $sql = "SELECT * publicite WHERE titre LIKE '%$keyword%' OR contenu LIKE '%$keyword%' OR budget LIKE '%$keyword%' OR id LIKE '%$keyword%'";
        }
        else{
            $sql = "SELECT * publicite WHERE $by LIKE '%$keyword%'";
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

    public function titreExists($titre) {
        $db = config::getConnexion();

        $sql = "SELECT COUNT(*) as count FROM publicite WHERE titre = :titre";
        try {
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':titre', $titre);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result['count'] > 0;
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }


    public function getpub($id)
    {
        $sql = "SELECT * FROM publicite WHERE id = $id";
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

    public function searchpubSorted($by, $keyword){

        if ($by == "everything"){
            $sql = "SELECT * publicite WHERE titre LIKE '%$keyword%' OR contenu LIKE '%$keyword%' OR budget LIKE '%$keyword%' OR id LIKE '%$keyword%'";
        }
        else{
            $sql = "SELECT * FROM publicite WHERE $by LIKE '%$keyword%'";
        }

       

        // add order by
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