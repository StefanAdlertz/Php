<?php
class Product
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

    public function getProducts()
    {
        $stmt = $this->db->query("SELECT ProductID, ProductName, ProductDescription, ProductPrice, CategoryID FROM PRODUCT");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updateProduct($productId, $productName, $productDescription, $productPrice, $categoryId)
    {
        try {
            $stmt = $this->db->prepare("UPDATE PRODUCT SET ProductName = ?, ProductDescription = ?, ProductPrice = ?, CategoryID = ? WHERE ProductID = ?");
            $stmt->execute([$productName, $productDescription, $productPrice, $categoryId, $productId]);
            return $stmt->rowCount();
        } catch (PDOException $e) {
            echo "Error updating product: " . $e->getMessage();
            return false;
        }
    }

    public function deleteProduct($productId)
    {
        try {
            $stmt = $this->db->prepare("DELETE FROM PRODUCT WHERE ProductID = ?");
            $stmt->execute([$productId]);
            return $stmt->rowCount();
        } catch (PDOException $e) {
            echo "Error deleting product: " . $e->getMessage();
            return false;
        }
    }

    public function addProduct($productName, $productDescription, $productPrice, $categoryId)
    {
        try {
            $stmt = $this->db->prepare("INSERT INTO PRODUCT (ProductName, ProductDescription, ProductPrice, CategoryID) VALUES (?, ?, ?, ?)");
            $stmt->execute([$productName, $productDescription, $productPrice, $categoryId]);
            return $stmt->rowCount();
        } catch (PDOException $e) {
            echo "Error when trying to add Product: " . $e->getMessage();
            return false;
        }
    }
}
