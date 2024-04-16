<?php

try {
    require '../../../config.php';
} catch (Exception $e) {
    //die('Error:' . $e->getMessage());
}





class artcon{


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

    public function artExists($id, $db) {
        $sql = "SELECT COUNT(*) as count FROM article WHERE id = :id";
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

    public function generateartId($id_length) {
        $db = config::getConnexion();
    
        do {
            $current_id = $this->generateId($id_length);
        } while ($this->artExists($current_id, $db));
    
        return $current_id;
    }


    public function listart()
    {
        $sql = "SELECT * FROM article";

        $db = config::getConnexion();
        try {
            $liste = $db->query($sql);
            return $liste;
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    public function addart($art)
    {
        $sql = "INSERT INTO article(id, titre, contenu, auteur ,date_art ,categorie) VALUES (:id, :titre, :contenu, :auteur, :date_art, :categorie)";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute(
               [
                'id' => $art->get_id(), 
                'titre' => $art->get_titre(), 
                'contenu' => $art->get_contenu(), 
                'auteur' => $art->get_auteur(), 
                'date_art' => $art->get_date_art(),
                'categorie' => $art->get_categorie(),
                ]
            );
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    function updateart($art, $id)
    {
        try {
            $db = config::getConnexion();
            $query = $db->prepare("UPDATE article SET titre = :titre, contenu = :contenu, auteur = :auteur, date_art = :date_art, categorie = :categorie WHERE id = :id");
            $query->execute([
                'id' => $id, 
                'titre' => $art->get_titre(),
                'contenu' => $art->get_contenu(),
                'auteur' => $art->get_auteur(),
                'date_art' => $art->get_date_art(),
                'categorie' => $art->get_categorie()
            ]);
            echo $query->rowCount() . " records UPDATED successfully <br>";
        } catch (PDOException $e) {
            $e->getMessage();
            echo($e);
        }
    }
    

    public function deleteart($id)
    {
        $sql = "DELETE FROM article WHERE id = :id";
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


    public function sortart($by){

        
        $sql = "SELECT * article";
        
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

    public function searchart($by, $keyword ){

        if ($by == "everything"){
            $sql = "SELECT * article WHERE titre LIKE '%$keyword%' OR contenu LIKE '%$keyword%' OR categorie LIKE '%$keyword%' OR id LIKE '%$keyword%'";
        }
        else{
            $sql = "SELECT * article WHERE $by LIKE '%$keyword%'";
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

        $sql = "SELECT COUNT(*) as count FROM article WHERE titre = :titre";
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


    public function getart($id)
{
    $sql = "SELECT * FROM article WHERE id = :id";
    $db = config::getConnexion();

    try {
        $query = $db->prepare($sql);
        $query->bindParam(':id', $id);
        $query->execute();
        $art = $query->fetch(PDO::FETCH_ASSOC);
        return $art;
    } catch (Exception $e) {
        die('Error: ' . $e->getMessage());
    }
}


    public function searchartSorted($by, $keyword){

        if ($by == "everything"){
            $sql = "SELECT * article WHERE titre LIKE '%$keyword%' OR contenu LIKE '%$keyword%' OR categorie LIKE '%$keyword%' OR id LIKE '%$keyword%'";
        }
        else{
            $sql = "SELECT * FROM article WHERE $by LIKE '%$keyword%'";
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