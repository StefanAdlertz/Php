<?php
class Customer
{
    private $db;

    public function __construct($host, $dbname, $user, $password)
    {
        try {
            $this->db = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $password);
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

    public function getDb()
    {
        return $this->db; // Return the database connection
    }

    public function getCustomers()
    {
        $stmt = $this->db->query("SELECT CustomerID, CustomerFirstName, CustomerLastName, CustomerAddress, CustomerPostCode, CustomerCity, CustomerEmail, CustomerPhone FROM CUSTOMER");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updateCustomer($customerId, $firstName, $lastName, $address, $postCode, $city, $email, $phone)
    {
        try {
            $stmt = $this->db->prepare("UPDATE CUSTOMER SET CustomerFirstName = ?, CustomerLastName = ?, CustomerAddress = ?, CustomerPostCode = ?, CustomerCity = ?, CustomerEmail = ?, CustomerPhone = ? WHERE CustomerID = ?");
            // Include $customerId as the last parameter
            $stmt->execute([$firstName, $lastName, $address, $postCode, $city, $email, $phone, $customerId]);
            return $stmt->rowCount(); // Return the number of affected rows
        } catch (PDOException $e) {
            echo "Error updating customer: " . $e->getMessage();
            return false; // Return false on error
        }
    }

    public function deleteCustomer($customerId)
    {
        try {
            $stmt = $this->db->prepare("DELETE FROM CUSTOMER WHERE CustomerID = ?");
            $stmt->execute([$customerId]);
            return $stmt->rowCount(); // Return the number of affected rows
        } catch (PDOException $e) {
            echo "Error deleting customer: " . $e->getMessage();
            return false; // Return false on error
        }
    }

    public function addCustomer($firstName, $lastName, $address, $postCode, $city, $email, $phone)
    {
        try {
            $stmt = $this->db->prepare("INSERT INTO CUSTOMER (CustomerFirstName, CustomerLastName, CustomerAddress, CustomerPostCode, CustomerCity, CustomerEmail, CustomerPhone) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmt->execute([$firstName, $lastName, $address, $postCode, $city, $email, $phone]);
            return $stmt->rowCount(); // Return the number of affected rows
        } catch (PDOException $e) {
            echo "Error when trying to add Customer: " . $e->getMessage();
            return false; // Return false on error
        }
    }
}
?>