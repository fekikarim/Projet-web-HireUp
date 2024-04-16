<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/web/HireUp_try0/config.php';




class JobController {
    private $conn;

    public function __construct() {
        $this->conn = config::getConnexion(); // Get PDO connection
    }

    // Create a new job
    public function createJob($job_id,$title, $company, $location, $description, $salary) {
        try {

            $date_posted = date("Y-m-d H:i:s");

            $stmt = $this->conn->prepare("INSERT INTO jobs (id ,title, company, location, description, salary, date_posted) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmt->execute([$job_id ,$title, $company, $location, $description, $salary, $date_posted]);
            return "New job created successfully";
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    }

    // Read a job by ID
    public function readJob($id) {
        try {
            $stmt = $this->conn->prepare("SELECT * FROM jobs WHERE id=?");
            $stmt->execute([$id]);
            $result = $stmt->fetch();
            return $result ? $result : "Job not found";
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    }

    // Read all jobs
    public function getAllJobs() {
        try {
            $stmt = $this->conn->prepare("SELECT * FROM jobs ORDER BY date_posted ");
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    }

    // Update a job
    public function updateJob($id, $title, $company, $location, $description, $salary) {
        try {

            $stmt = $this->conn->prepare("UPDATE jobs SET title=?, company=?, location=?, description=?, salary=? WHERE id=?");
            $stmt->execute([$title, $company, $location, $description, $salary, $id]);
           
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    }

    // Delete a job
    public function deleteJob($id) {
        try {
            $stmt = $this->conn->prepare("DELETE FROM jobs WHERE id=?");
            $stmt->execute([$id]);
            return "Job deleted successfully";
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    }

    public function getJobById($id) {
        try {
            $stmt = $this->conn->prepare("SELECT * FROM jobs WHERE id=?");
            $stmt->execute([$id]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result ? $result : "Job not found";
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    }

    // Get all jobs
    public function getJobs() {
        try {
            $stmt = $this->conn->prepare("SELECT * FROM jobs");
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
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


    public function jobExists($id)
    {
        $tableName = "jobs";

        $sql = "SELECT COUNT(*) as count FROM $tableName WHERE id = :id";
        try {
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result['count'] > 0;
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }


    public function generateJobId($id_length)
    {
        do {
            $current_id = $this->generateId($id_length);
        } while ($this->jobExists($current_id));

        return $current_id;
    }

}


?>
