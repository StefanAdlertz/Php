<?php
session_start();

class ShopCategory
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
        $stmt = $this->db->query("SELECT CategoryID, CategoryName FROM CATEGORY ORDER BY CategoryNavOrder");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

class ShopProduct
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

    public function getProducts($categoryId)
    {
        $stmt = $this->db->query("SELECT ProductID, ProductName, ProductDescription, ProductPrice, CategoryID FROM PRODUCT WHERE CategoryID=$categoryId");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

class ShoppingCart
{
    public function __construct()
    {
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }
    }

    public function addCart($product_id, $product_name, $product_price)
    {
        $cart_item = [
            'id' => $product_id,
            'name' => $product_name,
            'price' => $product_price,
            'quantity' => 1
        ];

        $found = false;
        foreach ($_SESSION['cart'] as &$item) {
            if ($item['id'] == $product_id) {
                $item['quantity']++;
                $found = true;
                break;
            }
        }

        if (!$found) {
            $_SESSION['cart'][] = $cart_item;
        }
    }

    public function emptyCart()
    {
        $_SESSION['cart'] = [];
    }

    public function viewCart()
    {
        echo "<h2>Shopping Cart</h2>";
        if (!empty($_SESSION['cart'])) {
            echo "<ul>";
            foreach ($_SESSION['cart'] as $item) {
                echo "<li>{$item['name']} - \${$item['price']} x {$item['quantity']}</li>";
            }
            echo "</ul>";
        } else {
            echo "<p>Your cart is empty.</p>";
        }

        echo "<a href='cart.php?action=empty_cart' class='btn btn-secondary'>Empty Cart</a><br />";
    }
}

$cart = new ShoppingCart();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $return_url = $_POST['return_url'];

    $cart->addCart($product_id, $product_name, $product_price);

    header("Location: $return_url");
    exit();
}

if (isset($_GET['action'])) {
    switch ($_GET['action']) {
        case 'empty_cart':
            $cart->emptyCart();
            header("Location: https://adlertz.se/shop/");
            exit();
        case 'view':
            $cart->viewCart();
            break;
    }
}
