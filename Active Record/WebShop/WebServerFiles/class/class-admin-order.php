<?php
class Order
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

    public function getOrders()
    {
        $stmt = $this->db->query("SELECT OrderID, OrderDate, OrderCustomerID, OrderProductID, OrderProductQuantity, OrderTotalPrice FROM `ORDER`");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updateOrder($orderId, $orderDate, $customerId, $productId, $quantity, $totalPrice)
    {
        try {
            $stmt = $this->db->prepare("UPDATE `ORDER` SET OrderDate = ?, OrderCustomerID = ?, OrderProductID = ?, OrderProductQuantity = ?, OrderTotalPrice = ? WHERE OrderID = ?");
            $stmt->execute([$orderDate, $customerId, $productId, $quantity, $totalPrice, $orderId]);
            return $stmt->rowCount(); // Return the number of affected rows
        } catch (PDOException $e) {
            echo "Error updating order: " . $e->getMessage();
            return false; // Return false on error
        }
    }

    public function deleteOrder($orderId)
    {
        try {
            $stmt = $this->db->prepare("DELETE FROM `ORDER` WHERE OrderID = ?");
            $stmt->execute([$orderId]);
            return $stmt->rowCount(); // Return the number of affected rows
        } catch (PDOException $e) {
            echo "Error deleting order: " . $e->getMessage();
            return false; // Return false on error
        }
    }

    public function addOrder($orderDate, $customerId, $productId, $quantity, $totalPrice)
    {
        try {
            $stmt = $this->db->prepare("INSERT INTO `ORDER` (OrderDate, OrderCustomerID, OrderProductID, OrderProductQuantity, OrderTotalPrice) VALUES (?, ?, ?, ?, ?)");
            $stmt->execute([$orderDate, $customerId, $productId, $quantity, $totalPrice]);
            return $stmt->rowCount(); // Return the number of affected rows
        } catch (PDOException $e) {
            echo "Error adding order: " . $e->getMessage();
            return false; // Return false on error
        }
    }
}
?>