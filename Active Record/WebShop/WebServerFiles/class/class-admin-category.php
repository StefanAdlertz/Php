<?php
class Category
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
        return $this->db;
    }

    public function getCategories()
    {
        $stmt = $this->db->query("SELECT CategoryID, CategoryName, CategoryNavOrder FROM CATEGORY ORDER BY CategoryNavOrder");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updateCategory($categoryId, $categoryName, $categoryNavOrder)
    {
        try {
            $stmt = $this->db->prepare("UPDATE CATEGORY SET CategoryName = ?, CategoryNavOrder = ? WHERE CategoryID = ?");
            $stmt->execute([$categoryName, $categoryNavOrder, $categoryId]);
            return $stmt->rowCount();
        } catch (PDOException $e) {
            echo "Error updating category: " . $e->getMessage();
            return false;
        }
    }

    public function deleteCategory($categoryId)
    {
        try {
            $stmt = $this->db->prepare("DELETE FROM CATEGORY WHERE CategoryID = ?");
            $stmt->execute([$categoryId]);
            return $stmt->rowCount();
        } catch (PDOException $e) {
            echo "Error deleting category: " . $e->getMessage();
            return false;
        }
    }

    public function addCategory($categoryName, $categoryNavOrder)
    {
        try {
            $stmt = $this->db->prepare("INSERT INTO CATEGORY (CategoryName, CategoryNavOrder) VALUES (?, ?)");
            $stmt->execute([$categoryName, $categoryNavOrder]);
            return $stmt->rowCount();
        } catch (PDOException $e) {
            echo "Error when trying to add Category: " . $e->getMessage();
            return false;
        }
    }
}
