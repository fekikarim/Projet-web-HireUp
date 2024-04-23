<?php

require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../Models/subsFeaturesModel.php';

class SubsFeaturesControls
{
    private $conn;

    public function __construct()
    {
        $this->conn = Config::getConnection(); // Get PDO connection
    }

    public function getAllFeatures()
    {
        $stmt = $this->conn->prepare("SELECT * FROM subscription_features");
        $stmt->execute();
        $features = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $features;
    }

    public function getFeatureById($feature_id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM subscription_features WHERE feature_id = :feature_id");
        $stmt->execute(['feature_id' => $feature_id]);
        $feature = $stmt->fetch(PDO::FETCH_ASSOC);

        return $feature;
    }

    public function createFeature($subscription_id, $feature_name, $description)
    {
        $feature = new SubsFeaturesControls();

        $feature_id = $feature->generateFeatId(7);

        $stmt = $this->conn->prepare("INSERT INTO subscription_features (feature_id, subscription_id, feature_name, description) VALUES (:feature_id, :subscription_id, :feature_name, :description)");
        $stmt->execute([
            'feature_id' => $feature_id,
            'subscription_id' => $subscription_id,
            'feature_name' => $feature_name,
            'description' => $description
        ]);

        return $feature_id; // Return the ID of the newly created feature
    }

    public function updateFeature($feature_id, $subscription_id, $feature_name, $description)
    {
        $stmt = $this->conn->prepare("UPDATE subscription_features SET subscription_id = :subscription_id, feature_name = :feature_name, description = :description WHERE feature_id = :feature_id");
        $stmt->execute([
            'feature_id' => $feature_id,
            'subscription_id' => $subscription_id,
            'feature_name' => $feature_name,
            'description' => $description
        ]);

        return $stmt->rowCount(); // Return the number of rows affected by the update
    }

    public function deleteFeature($feature_id)
    {
        $stmt = $this->conn->prepare("DELETE FROM subscription_features WHERE feature_id = :feature_id");
        $stmt->execute(['feature_id' => $feature_id]);

        return $stmt->rowCount(); // Return the number of rows affected by the deletion
    }




    public function searchFeatures($searchTerm)
    {
        $tableName = "subscription_features";

        // Prepare SQL statement to select profiles based on search term
        $sql = "SELECT * FROM $tableName 
                WHERE feature_id LIKE :searchTerm
                OR feature_name LIKE :searchTerm 
                OR subscription_id LIKE :searchTerm 
                OR description LIKE :searchTerm";

        // Prepare the SQL statement
        $stmt = $this->conn->prepare($sql);

        // Bind parameters
        $searchTerm = "%{$searchTerm}%"; // Add wildcard characters
        $stmt->bindParam(':searchTerm', $searchTerm, PDO::PARAM_STR);

        // Execute the query
        $stmt->execute();

        // Fetch all matching subscriptions
        $subscriptions = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Return the subscriptions
        return $subscriptions;
    }



    public function generateSubsOptions()
    {
        try {
            // Fetching the subscription IDs and plan names from the database
            $sql = "SELECT subscription_id, plan_name FROM subscriptions";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();

            // Generating the <option> tags
            $options = '';
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $options .= '<option value="' . $row['plan_name'] . '">' . $row['plan_name'] . '</option>';
            }

            return $options;
        } catch (PDOException $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    public function generateSubsOptionsUpdate($selectedsubscription_id)
    {
        try {
            // Fetching the subscription IDs and plan names from the database
            $sql = "SELECT subscription_id, plan_name FROM subscriptions";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();

            // Generating the <option> tags
            $options = '';
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $selected = ($row['subscription_id'] === $selectedsubscription_id) ? 'selected' : '';
                $options .= '<option value="' . $row['plan_name'] . '" ' . $selected . '>' . $row['plan_name'] . '</option>';
            }

            return $options;
        } catch (PDOException $e) {
            die('Error: ' . $e->getMessage());
        }
    }





    public function getSubscriptionIdByPlanName($plan_name)
    {
        // Query the database to fetch subscription_id based on plan_name
        $sql = "SELECT subscription_id FROM subscriptions WHERE plan_name = :plan_name";

        try {
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':plan_name', $plan_name);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($result) {
                return $result['subscription_id'];
            } else {
                return null; // Return null if plan_name not found
            }
        } catch (PDOException $e) {
            die('Error:' . $e->getMessage());
        }
    }



    //#####################################################################################


    public function generateFeatId($id_length)
    {
        // Fetch all subscription plans
        $sql = "SELECT feature_name FROM subscription_features";
        $stmt = $this->conn->query($sql);
        $plans = $stmt->fetchAll(PDO::FETCH_COLUMN);

        // Randomly select a plan name
        $random_plan = $plans[array_rand($plans)];

        // Extract three random characters from the plan name
        $random_chars = substr(str_shuffle($random_plan), 0, 3);

        // Generate the feature ID
        $feature_id = "1-$random_chars-FEAT";

        // Check if the generated ID already exists
        do {
            $current_id = $feature_id . $this->generateId($id_length - strlen($feature_id));
        } while ($this->featExists($current_id));

        return $current_id;
    }


    public function featExists($id)
    {
        $tableName = "subscription_features";

        $sql = "SELECT COUNT(*) as count FROM $tableName WHERE  feature_id = :feature_id";
        try {
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':feature_id', $id);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result['count'] > 0;
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
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
}
