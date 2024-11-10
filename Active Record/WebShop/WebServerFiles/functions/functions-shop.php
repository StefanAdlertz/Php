<?php

function displayLinks()
{
    $product = new Product('localhost', 'your_dbname', 'your_username', 'your_password');
    $products = $product->getProducts();

    foreach ($products as $item) {
        echo "
            <div class='book-frame'>
                <div class='book-card'>
                    <img src='images/{$item['ProductID']}.png' class='card-img-top' alt='{$item['ProductName']}'>
                    <div class='card-body'>
                        <h5 class='card-title'>{$item['ProductName']}</h5>
                        <p class='card-text'>Price: \${$item['ProductPrice']}</p>
                    </div>
                </div>
            </div>
        ";
    }
}

function displayProducts()
{
    $product = new Product('localhost', 'your_dbname', 'your_username', 'your_password', );
    $products = $product->getProducts();

    foreach ($products as $item) {
        echo "
            <div class='book-frame'>
                <div class='book-card'>
                    <img src='images/{$item['ProductID']}.png' class='card-img-top' alt='{$item['ProductName']}'>
                    <div class='card-body'>
                        <h5 class='card-title'>{$item['ProductName']}</h5>
                        <p class='card-text'>Price: \${$item['ProductPrice']}</p>
                    </div>
                </div>
            </div>
        ";
    }
}

?>