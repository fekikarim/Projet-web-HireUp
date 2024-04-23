<?php

require_once __DIR__ . '/../../config.php';




class JobController
{
    private $conn;

    public function __construct()
    {
        $this->conn = config::getConnexion(); // Get PDO connection
    }

    // Create a new job
    // Create a new job
    public function createJob($job_id, $title, $company, $location, $description, $salary, $category)
    {
        try {
            // Fetch the id_category based on the selected category
            $stmt = $this->conn->prepare("SELECT id_category FROM category WHERE name_category = ?");
            $stmt->execute([$category]);
            $categoryResult = $stmt->fetch(PDO::FETCH_ASSOC);
            $categoryID = $categoryResult['id_category'];

            // Get the current date and time
            $date_posted = date("Y-m-d H:i:s");

            // Insert the job into the database
            $stmt = $this->conn->prepare("INSERT INTO jobs (id, title, company, location, description, salary, date_posted, id_category) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->execute([$job_id, $title, $company, $location, $description, $salary, $date_posted, $categoryID]);

            return "New job created successfully";
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    }


    // Read a job by ID
    public function readJob($id)
    {
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
    public function getAllJobs()
    {
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
    public function updateJob($id, $title, $company, $location, $description, $salary, $category)
    {
        try {

            // Fetch the id_category based on the selected category
            $stmt = $this->conn->prepare("SELECT id_category FROM category WHERE name_category = ?");
            $stmt->execute([$category]);
            $categoryResult = $stmt->fetch(PDO::FETCH_ASSOC);
            $categoryID = $categoryResult['id_category'];

            $stmt = $this->conn->prepare("UPDATE jobs SET title=?, company=?, location=?, description=?, salary=? , id_category=? WHERE id=?");
            $stmt->execute([$title, $company, $location, $description, $salary, $categoryID, $id]);
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    }

    // Delete a job
    public function deleteJob($id)
    {
        try {
            $stmt = $this->conn->prepare("DELETE FROM jobs WHERE id=?");
            $stmt->execute([$id]);
            return "Job deleted successfully";
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    }

    public function getJobById($id)
    {
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
    public function getJobs()
    {
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


    public function generateCategoryOptions()
    {
        // Fetching the blog IDs from the database
        $sql = "SELECT id_category, name_category FROM category";

        $db = config::getConnexion();

        try {
            $stmt = $db->query($sql);

            // Generating the <option> tags
            $options = '';
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $options .= '<option value="' . $row['name_category'] . '">' . $row['name_category'] . '</option>';
            }

            return $options;
        } catch (PDOException $e) {
            die('Error:' . $e->getMessage());
        }
    }

    public function generateCategoryOptionsselected($nom)
    {
        // Fetching the blog IDs from the database
        $sql = "SELECT id_category, name_category FROM category";

        $db = config::getConnexion();

        try {
            $stmt = $db->query($sql);

            // Generating the <option> tags
            $options = '';
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                if ($nom == $row['name_category']) {
                    $options .= '<option selected value="' . $row['name_category'] . '">' . $row['name_category'] . '</option>';
                } else {

                    $options .= '<option value="' . $row['name_category'] . '">' . $row['name_category'] . '</option>';
                }
            }

            return $options;
        } catch (PDOException $e) {
            die('Error:' . $e->getMessage());
        }
    }

    // Fetch job data including category information
    public function getAllJobsWithCategory()
    {
        try {
            $stmt = $this->conn->prepare("SELECT jobs.*, category.name_category AS category_name FROM jobs INNER JOIN category ON jobs.id_category = category.id_category ORDER BY jobs.date_posted");
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    }

    // Get company id by category
    public function getCompanyIdByCategory($category)
    {
        try {
            $stmt = $this->conn->prepare("SELECT id_company FROM company WHERE category = ?");
            $stmt->execute([$category]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result['id_company'] ?? null;
        } catch (PDOException $e) {
            return false;
        }
    }
}
