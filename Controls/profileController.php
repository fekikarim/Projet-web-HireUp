<?php

require_once __DIR__ . '/../config.php';

class ProfileC
{
    private $conn;

    public function __construct()
    {
        $this->conn = Config::getConnection(); // Get PDO connection
    }

    public function listProfile()
    {
        $tableName = "profile";

        $query = $this->conn->query("SELECT * FROM $tableName"); // Requête pour sélectionner tous les profiles
        $profiles = $query->fetchAll(); // Récupérer tous les résultats

        return $profiles; // Retourner les profiles
    }

    public function deleteProfile($id)
    {
        $tableName = "profile";

        // Préparez et exécutez la requête DELETE
        $query = $this->conn->prepare("DELETE FROM $tableName WHERE profile_id = :profile_id");
        $query->execute(['profile_id' => $id]);
    }


    public function addProfile($id, $profile_first_name, $profile_family_name, $profile_userid, $profile_phone_number, $profile_region, $profile_city, $profile_bio, $profile_current_position, $profile_education, $profile_subscription, $profile_auth, $profile_acc_verif, $profile_photo, $profile_cover)
    {
        $tableName = "profile";

        // Préparez et exécutez la requête INSERT
        $query = $this->conn->prepare("INSERT INTO $tableName 
                                    (profile_id, profile_first_name, profile_family_name, profile_userid, profile_phone_number, profile_region, profile_city, profile_bio, profile_current_position, profile_education, profile_subscription, profile_auth, profile_acc_verif, profile_photo, profile_cover) 
                                VALUES (:profile_id, :profile_first_name, :profile_family_name, :profile_userid, :profile_phone_number, :profile_region, :profile_city, :profile_bio, :profile_current_position, :profile_education, :profile_subscription, :profile_auth, :profile_acc_verif, :profile_photo, :profile_cover)");
        $query->execute([
            'profile_id' => $id,
            'profile_first_name' => $profile_first_name,
            'profile_family_name' => $profile_family_name,
            'profile_userid' => $profile_userid,
            'profile_phone_number' => $profile_phone_number,
            'profile_region' => $profile_region,
            'profile_city' => $profile_city,
            'profile_bio' => $profile_bio,
            'profile_current_position' => $profile_current_position,
            'profile_education' => $profile_education,
            'profile_subscription' => $profile_subscription,
            'profile_auth' => $profile_auth,
            'profile_acc_verif' => $profile_acc_verif,
            'profile_photo' => $profile_photo,
            'profile_cover' => $profile_cover
        ]);
    }


    public function updateProfile($id, $profile_first_name, $profile_family_name, $profile_phone_number, $profile_region, $profile_city, $profile_bio, $profile_current_position, $profile_education, $profile_subscription, $profile_auth, $profile_acc_verif, $profile_photo, $profile_cover)
    {
        $tableName = "profile";

        // Préparez et exécutez la requête UPDATE
        $query = $this->conn->prepare("UPDATE $tableName SET profile_first_name = :profile_first_name , profile_family_name = :profile_family_name , profile_phone_number = :profile_phone_number , profile_region = :profile_region , profile_city = :profile_city , profile_bio = :profile_bio , profile_current_position = :profile_current_position , profile_education = :profile_education , profile_subscription = :profile_subscription , profile_auth = :profile_auth , profile_acc_verif = :profile_acc_verif , profile_photo = :profile_photo , profile_cover = :profile_cover WHERE profile_id = :profile_id");
        $query->execute(['profile_id' => $id, 'profile_first_name' => $profile_first_name, 'profile_family_name' => $profile_family_name, 'profile_phone_number' => $profile_phone_number, 'profile_region' => $profile_region, 'profile_city' => $profile_city, 'profile_bio' => $profile_bio, 'profile_current_position' => $profile_current_position, 'profile_education' => $profile_education, 'profile_subscription' => $profile_subscription, 'profile_auth' => $profile_auth, 'profile_acc_verif' => $profile_acc_verif, 'profile_photo' => $profile_photo, 'profile_cover' => $profile_cover]);
    }

    public function updateProfileWithoutImage($id, $profile_first_name, $profile_family_name, $profile_phone_number, $profile_region, $profile_city, $profile_bio, $profile_current_position, $profile_education, $profile_subscription, $profile_auth, $profile_acc_verif)
    {
        $conn = $this->conn;

        $tableName = "profile";

        // Préparez et exécutez la requête UPDATE sans changer les photos
        $query = $conn->prepare("UPDATE $tableName SET 
        profile_first_name = :profile_first_name , 
        profile_family_name = :profile_family_name , 
        profile_phone_number = :profile_phone_number , 
        profile_region = :profile_region , 
        profile_city = :profile_city , 
        profile_bio = :profile_bio , 
        profile_current_position = :profile_current_position , 
        profile_education = :profile_education , 
        profile_subscription = :profile_subscription , 
        profile_auth = :profile_auth , 
        profile_acc_verif = :profile_acc_verif 
        WHERE profile_id = :profile_id");

        $query->execute([
            'profile_id' => $id,
            'profile_first_name' => $profile_first_name,
            'profile_family_name' => $profile_family_name,
            'profile_phone_number' => $profile_phone_number,
            'profile_region' => $profile_region,
            'profile_city' => $profile_city,
            'profile_bio' => $profile_bio,
            'profile_current_position' => $profile_current_position,
            'profile_education' => $profile_education,
            'profile_subscription' => $profile_subscription,
            'profile_auth' => $profile_auth,
            'profile_acc_verif' => $profile_acc_verif
        ]);
    }



    // Update profile picture function
    public function updateProfilePicture($id, $profile_photo_data)
    {
        try {

            $tableName = "profile";
            // Prepare SQL statement to update profile picture
            $sql = "UPDATE $tableName SET profile_photo = :profile_photo WHERE profile_id = :profile_id";
            $stmt = $this->conn->prepare($sql);

            // Bind parameters
            $stmt->bindParam(':profile_id', $id, PDO::PARAM_STR);
            $stmt->bindParam(':profile_photo', $profile_photo_data, PDO::PARAM_LOB);

            // Execute the query
            $stmt->execute();

            // Check if the update was successful
            if ($stmt->rowCount() > 0) {
                return true; // Return true if update successful
            } else {
                return false; // Return false if update failed
            }
        } catch (PDOException $e) {
            // Handle database errors
            echo "Error: " . $e->getMessage();
            return false; // Return false if an error occurred
        }
    }



    // Update profile cover function
    public function updateProfileCover($id, $profile_cover_data)
    {
        try {

            $tableName = "profile";
            // Prepare SQL statement to update profile cover
            $sql = "UPDATE $tableName SET profile_cover = :profile_cover WHERE profile_id = :profile_id";
            $stmt = $this->conn->prepare($sql);

            // Bind parameters
            $stmt->bindParam(':profile_id', $id, PDO::PARAM_STR);
            $stmt->bindParam(':profile_cover', $profile_cover_data, PDO::PARAM_LOB);

            // Execute the query
            $stmt->execute();

            // Check if the update was successful
            if ($stmt->rowCount() > 0) {
                return true; // Return true if update successful
            } else {
                return false; // Return false if update failed
            }
        } catch (PDOException $e) {
            // Handle database errors
            echo "Error: " . $e->getMessage();
            return false; // Return false if an error occurred
        }
    }


    public function updateProfileAttribute($id, $attribute, $value)
    {
        $tableName = "profile";

        // Prepare and execute the UPDATE query based on the attribute
        switch ($attribute) {
            case 'region':
                $query = $this->conn->prepare("UPDATE $tableName SET profile_region = :value WHERE profile_id = :id");
                break;
            case 'city':
                $query = $this->conn->prepare("UPDATE $tableName SET profile_city = :value WHERE profile_id = :id");
                break;
            case 'bio':
                $query = $this->conn->prepare("UPDATE $tableName SET profile_bio = :value WHERE profile_id = :id");
                break;
            case 'current_position':
                $query = $this->conn->prepare("UPDATE $tableName SET profile_current_position = :value WHERE profile_id = :id");
                break;
            case 'education':
                $query = $this->conn->prepare("UPDATE $tableName SET profile_education = :value WHERE profile_id = :id");
                break;
            case 'subscription':
                $query = $this->conn->prepare("UPDATE $tableName SET profile_subscription = :value WHERE profile_id = :id");
                break;
            case 'phone_number':
                $query = $this->conn->prepare("UPDATE $tableName SET profile_phone_number = :value WHERE profile_id = :id");
                break;
            case 'gender':
                //$query = $this->conn->prepare("UPDATE $tableName SET profile_gender = :value WHERE profile_id = :id");
                break;
            case 'birthday':
                //$query = $this->conn->prepare("UPDATE $tableName SET profile_birthday = :value WHERE profile_id = :id");
                break;
            default:
                // Handle unknown attribute
                return false;
        }

        // Bind parameters and execute the query
        $query->execute(['id' => $id, 'value' => $value]);

        // Check if the update was successful
        return $query->rowCount() > 0;
    }


    public function updateProfileNamesBio($id, $first_name, $family_name, $bio)
    {
        $tableName = "profile";

        // Prepare and execute the UPDATE query
        $query = $this->conn->prepare("UPDATE $tableName SET profile_first_name = :first_name, profile_family_name = :family_name, profile_bio = :bio WHERE profile_id = :id");
        $query->execute(['id' => $id, 'first_name' => $first_name, 'family_name' => $family_name, 'bio' => $bio]);

        // Check if the update was successful
        return $query->rowCount() > 0;
    }

    public function updateProfileDetailsImage($id, $first_name, $family_name, $profile_region, $profile_city, $profile_bio, $profile_current_position, $profile_education, $profile_photo_data, $profile_cover_data)
    {
        $tableName = "profile";

        // Prepare and execute the UPDATE query
        $query = $this->conn->prepare("UPDATE $tableName SET 
            profile_first_name = :first_name, 
            profile_family_name = :family_name, 
            profile_region = :profile_region , 
            profile_city = :profile_city , 
            profile_bio = :profile_bio , 
            profile_current_position = :profile_current_position , 
            profile_education = :profile_education,
            profile_photo = :profile_photo, 
            profile_cover = :profile_cover
            WHERE profile_id = :id");
        $query->execute([
            'id' => $id, 'first_name' => $first_name,
            'family_name' => $family_name,
            'profile_region' => $profile_region,
            'profile_city' => $profile_city,
            'profile_bio' => $profile_bio,
            'profile_current_position' => $profile_current_position,
            'profile_education' => $profile_education,
            'profile_photo' => $profile_photo_data,
            'profile_cover' => $profile_cover_data
        ]);

        // Check if the update was successful
        return $query->rowCount() > 0;
    }

    public function updateProfileDetailsWithoutImage($id, $first_name, $family_name, $profile_region, $profile_city, $profile_bio, $profile_current_position, $profile_education)
    {
        $tableName = "profile";

        // Prepare and execute the UPDATE query
        $query = $this->conn->prepare("UPDATE $tableName SET 
            profile_first_name = :first_name, 
            profile_family_name = :family_name, 
            profile_region = :profile_region , 
            profile_city = :profile_city , 
            profile_bio = :profile_bio , 
            profile_current_position = :profile_current_position , 
            profile_education = :profile_education
            WHERE profile_id = :id");
        $query->execute([
            'id' => $id, 'first_name' => $first_name,
            'family_name' => $family_name,
            'profile_region' => $profile_region,
            'profile_city' => $profile_city,
            'profile_bio' => $profile_bio,
            'profile_current_position' => $profile_current_position,
            'profile_education' => $profile_education
        ]);

        // Check if the update was successful
        return $query->rowCount() > 0;
    }

    public function updateProfileNamesBioPictures($id, $first_name, $family_name, $bio, $profile_photo_data, $profile_cover_data)
    {
        $tableName = "profile";

        // Prepare and execute the UPDATE query
        $query = $this->conn->prepare("UPDATE $tableName SET profile_first_name = :first_name, profile_family_name = :family_name, profile_bio = :bio, profile_photo = :profile_photo, profile_cover = :profile_cover WHERE profile_id = :id");
        $query->execute([
            'id' => $id,
            'first_name' => $first_name,
            'family_name' => $family_name,
            'bio' => $bio,
            'profile_photo' => $profile_photo_data,
            'profile_cover' => $profile_cover_data
        ]);

        // Check if the update was successful
        return $query->rowCount() > 0;
    }



    // Function to search profiles based on a search term
    public function searchProfiles($searchTerm)
    {
        $tableName = "profile";

        // Prepare SQL statement to select profiles based on search term
        $sql = "SELECT * FROM $tableName 
                WHERE profile_id LIKE :searchTerm
                OR profile_first_name LIKE :searchTerm 
                OR profile_family_name LIKE :searchTerm 
                OR profile_userid LIKE :searchTerm 
                OR profile_phone_number LIKE :searchTerm 
                OR profile_region LIKE :searchTerm 
                OR profile_city LIKE :searchTerm 
                OR profile_bio LIKE :searchTerm 
                OR profile_current_position LIKE :searchTerm 
                OR profile_education LIKE :searchTerm 
                OR profile_subscription LIKE :searchTerm 
                OR profile_auth LIKE :searchTerm 
                OR profile_acc_verif LIKE :searchTerm";

        // Prepare the SQL statement
        $stmt = $this->conn->prepare($sql);

        // Bind parameters
        $searchTerm = "%{$searchTerm}%"; // Add wildcard characters
        $stmt->bindParam(':searchTerm', $searchTerm, PDO::PARAM_STR);

        // Execute the query
        $stmt->execute();

        // Fetch all matching profiles
        $profiles = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Return the profiles
        return $profiles;
    }


    public function getProfileById($id)
    {
        $tableName = "profile";

        // Préparez et exécutez la requête SELECT
        $query = $this->conn->prepare("SELECT * FROM $tableName WHERE profile_id = :profile_id");
        $query->execute(['profile_id' => $id]);

        // Récupérer le résultat sous forme de tableau associatif
        $profile = $query->fetch();

        return $profile;
    }

    public function generateId($id_length)
    {
        $numbers = '0123456789';
        $numbers_length = strlen($numbers);
        $random_id = '';

        // Generate random ID
        for ($i = 0; $i < $id_length; $i++) {
            $random_id .= $numbers[rand(0, $numbers_length - 1)];
        }

        return (string) $random_id; // Ensure the return value is a string
    }

    public function generateUserId($id_length)
    {
        $numbers = '0123456789';
        $numbers_length = strlen($numbers);
        $random_id = '';

        // Generate random ID
        for ($i = 0; $i < $id_length; $i++) {
            $random_id .= $numbers[rand(0, $numbers_length - 1)];
        }

        return (string) $random_id; // Ensure the return value is a string
    }

    public function profileUserIdExists($userid)
    {
        $tableName = "profile";

        $sql = "SELECT COUNT(*) as count FROM $tableName WHERE profile_userid = :profile_userid";
        try {
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':profile_userid', $userid);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result['count'] > 0;
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    public function profileExists($id)
    {
        $tableName = "profile";

        $sql = "SELECT COUNT(*) as count FROM $tableName WHERE profile_id = :profile_id";
        try {
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':profile_id', $id);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result['count'] > 0;
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    public function generateProfileId($id_length)
    {
        do {
            $current_id = $this->generateId($id_length);
        } while ($this->profileExists($current_id));

        return $current_id;
    }

    public function generateProfileUserId($id_length)
    {
        do {
            $current_id = $this->generateUserId($id_length);
        } while ($this->profileUserIdExists($current_id));

        return $current_id;
    }


    
    
}
