<?php

require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../Models/subscriptionModel.php';

class SubscriptionControls
{
    private $conn;

    public function __construct()
    {
        $this->conn = Config::getConnection(); // Get PDO connection
    }

    public function getAllSubscriptions()
    {
        $stmt = $this->conn->prepare("SELECT * FROM subscriptions");
        $stmt->execute();
        $subscriptions = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $subscriptions;
    }

    public function getSubscriptionById($subscription_id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM subscriptions WHERE subscription_id = :subscription_id");
        $stmt->execute(['subscription_id' => $subscription_id]);
        $subscription = $stmt->fetch(PDO::FETCH_ASSOC);

        return $subscription;
    }



    public function getSubscriptionFeatures($subscription_id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM subscription_features WHERE subscription_id = :subscription_id");
        $stmt->execute(['subscription_id' => $subscription_id]);
        $features = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $features;
    }


    public function createSubscription($plan_name, $duration, $price, $description, $subscription_status, $card)
    {

        $subs = new SubscriptionControls();

        $id = $subs->generateSubsId(7);

        $stmt = $this->conn->prepare("INSERT INTO subscriptions (subscription_id, plan_name, duration, price, description, subscription_status, card) 
                                        VALUES (:subscription_id, :plan_name, :duration, :price, :description, :subscription_status, :card)");
        $stmt->execute([
            'plan_name' => $plan_name,
            'duration' => $duration,
            'price' => $price,
            'description' => $description,
            'subscription_status' => $subscription_status,
            'card' => $card,
            'subscription_id' => $id
        ]);
        return $this->conn->lastInsertId();
    }

    public function updateSubscription($subscription_id, $plan_name, $duration, $price, $description, $subscription_status, $card)
    {
        $stmt = $this->conn->prepare("UPDATE subscriptions SET plan_name = :plan_name, duration = :duration, price = :price, description = :description, subscription_status = :subscription_status, card = :card WHERE subscription_id = :subscription_id");
        return $stmt->execute([
            'plan_name' => $plan_name,
            'duration' => $duration,
            'price' => $price,
            'description' => $description,
            'subscription_status' => $subscription_status,
            'card' => $card,
            'subscription_id' => $subscription_id
        ]);
    }

    public function deleteSubscription($subscription_id)
    {
        $stmt = $this->conn->prepare("DELETE FROM subscriptions WHERE subscription_id = :subscription_id");
        return $stmt->execute(['subscription_id' => $subscription_id]);
    }


    public function searchSubscription($searchTerm)
    {
        $tableName = "subscriptions";

        // Prepare SQL statement to select profiles based on search term
        $sql = "SELECT * FROM $tableName 
                WHERE subscription_id LIKE :searchTerm
                OR plan_name LIKE :searchTerm 
                OR duration LIKE :searchTerm 
                OR price LIKE :searchTerm 
                OR description LIKE :searchTerm 
                OR subscription_status LIKE :searchTerm 
                OR card LIKE :searchTerm";

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


    //#################################################################
    //#################################################################


    public function generateSubsId($id_length)
    {
        // Fetch all subscription plans
        $sql = "SELECT plan_name FROM subscriptions";
        $stmt = $this->conn->query($sql);
        $plans = $stmt->fetchAll(PDO::FETCH_COLUMN);

        // Randomly select a plan name
        $random_plan = $plans[array_rand($plans)];

        // Extract three random characters from the plan name
        $random_chars = substr(str_shuffle($random_plan), 0, 3);

        // Generate the subscription ID
        $subscription_id = "1-$random_chars-SUBS";

        // Check if the generated ID already exists
        do {
            $current_id = $subscription_id . $this->generateId($id_length - strlen($subscription_id));
        } while ($this->subsExists($current_id));

        return $current_id;
    }


    public function subsExists($id)
    {
        $tableName = "subscriptions";

        $sql = "SELECT COUNT(*) as count FROM $tableName WHERE subscription_id = :subscription_id";
        try {
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':subscription_id', $id);
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
