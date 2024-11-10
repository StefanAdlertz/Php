<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $return_url = $_POST['return_url'];

    $_SESSION['product_id'] = $product_id;
    $_SESSION['product_name'] = $product_name;
    $_SESSION['product_price'] = $product_price;

    $cart_item = [
        'id' => $product_id,
        'name' => $product_name,
        'price' => $product_price,
        'quantity' => 1
    ];

    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

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
    header("Location: $return_url");
    exit();
}

if (isset($_GET['action']) && $_GET['action'] == 'empty_cart') {
    $_SESSION['cart'] = [];
    header("Location: https://adlertz.se/shop/");
    //echo $current_url = "https://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
}

if (isset($_GET['action']) && $_GET['action'] == 'view') {
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
