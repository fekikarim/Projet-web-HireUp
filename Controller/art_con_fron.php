<?php

try {
    require '../../config.php';
} catch (Exception $e) {
    //die('Error:' . $e->getMessage());
}





class artCon{


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
                'categorie' => $art->get_categorie()
                ]
            );
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
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

}




   


?>