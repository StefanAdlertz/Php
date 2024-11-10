<?php
session_start();

// Include
include 'database/database.php';
include 'class/class-shop.php';
include 'functions/functions-shop.php';

//Set color on Cart
if ($isCartEmpty = empty($_SESSION['cart'])) {
    $cartcolor = "lightgray";
} else {
    $cartcolor = "lightgreen";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Web Shop</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://adlertz.se/shop/css/bootstrap.min.css">
    <!-- Bootstrap ICONS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <!-- Google Abel font -->
    <link href="https://fonts.googleapis.com/css2?family=Abel&display=swap" rel="stylesheet">
    <style>
        body {
            background-color: #afc5c8;
            width: 1200px;
            height: 1800px;
            margin: 0 auto;
            font-family: 'Abel', sans-serif;
        }

        .navbar {
            border-bottom: 0.5px solid darkgray;
            border-left: 0.5px solid darkgray;
            border-right: 0.5px solid darkgray;
            border-radius: 0 0 5px 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
            margin-bottom: 10px;
        }

        .allproducts {
            display: flex;
            flex-direction: row;
            align-items: flex-start;
            justify-content: center;
            align-items: flex-start;
            flex-wrap: wrap;
        }

        .productbox {
            width: calc(33.0% - 20px);
            height: 523px;
            margin: 10px 10px;
            background-color: #ffffff;
            padding: 0px;
            border: 0.5px solid #e4d2a0;
            text-align: center;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
            transition: transform 0.5s ease;
        }

        .productbox:hover {
            transform: translateY(-2px);
        }

        .productimage {
            display: flex;
            justify-content: center;
            max-width: 100%;
            padding: 0px;
            margin: 0px;
        }

        .productimage img {
            width: 100%;
            height: auto;
            border-top-left-radius: 5px;
            border-top-right-radius: 5px;
        }

        .producttitle {
            text-align: left;
            padding: 15px;
            height: 70px;
        }

        .productprice {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px;
            height: 50px;
            margin-top: 15px;
        }

        .productdescription {
            opacity: 0;
            visibility: hidden;
            padding: 15px;
            text-align: left;
            background-color: #ffffff;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
            border: 1px solid #e4d2a0;
            border-radius: 5px;
            margin-top: 35px;
            transition: opacity 0.5s ease, visibility 0.5s ease;
            width: 100%;
            position: relative;
        }

        .productbox:hover .productdescription {
            opacity: 1;
            visibility: visible;
            padding-top: 25px;
            left: 0;
            width: initial;
        }

        #cartcontent {
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.3s ease;
            background-color: #333;
            color: #ffffff;
            text-transform: none;
            width: 800px;
            height: auto;
            padding: 10px;
            border-radius: 0 0 5px 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
            position: absolute;
            top: 100%;
            right: 0;
            z-index: 1000;
        }

        #carthover:hover+#cartcontent {
            opacity: 1;
            visibility: visible;
        }
    </style>
</head>

<script>
    const isCartEmpty = <?php echo json_encode($isCartEmpty); ?>;
</script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const cartHover = document.getElementById("carthover");
        const cartContent = document.getElementById("cartcontent");

        cartHover.addEventListener("mouseenter", function() {
            cartContent.style.opacity = "1";
            cartContent.style.visibility = "visible";
        });

        cartContent.addEventListener("click", function() {
            cartContent.style.opacity = "0"; // Hide the cart content
            cartContent.style.visibility = "hidden"; // Make it hidden
        });
    });
</script>

<body>
    <div class="container-fluid">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark container-fluid w-100">
            <a class="navbar-brand" href="#"></a>
            <button class="navbar-toggler me-auto" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <?php
                    $categoryObj = new ShopCategory($host, $dbname, $user, $password);
                    $categories = $categoryObj->getCategories();

                    foreach ($categories as $category): ?>
                        <li class="nav-item mx-2">
                            <a class="nav-link" href="https://adlertz.se/shop/index.php?id=<?php echo $category['CategoryID']; ?>">
                                <?php echo htmlspecialchars($category['CategoryName']); ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <div class="mx-3" style="display: flex;">

                <div><a id="carthover" class="nav-link mx-2"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill=<?php echo $cartcolor ?> class="bi bi-cart" viewBox="0 0 16 16">
                            <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5M3.102 4l1.313 7h8.17l1.313-7zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4m7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4m-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2m7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2" />
                        </svg></a></div>

                <div></div><a class="nav-link mx-2" href="https://adlertz.se/shop/admin.php" target="_blank"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="lightgray" class="bi bi-person-circle" viewBox="0 0 16 16">
                        <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0" />
                        <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1" />
                    </svg></a>
            </div>
            <div class="lead bg-dark" id="cartcontent">
                <?php

                if (!empty($_SESSION['cart'])) {
                    echo "<ul>";
                    $totalprice = 0;
                    foreach ($_SESSION['cart'] as $item) {
                        $totalprice += $item['price'];
                        echo "<li>{$item['quantity']} X {$item['name']} - \${$item['price']}</li>";
                    }
                    echo "</ul>";
                } else {
                    echo "<ul>Your cart is empty.</ul>";
                    echo "<ul>Close</ul>";
                }
                if ($_SESSION['cart'] != []) {
                    echo "<ul>Total Price: \${$totalprice}<br /></ul>";
                    echo "<ul><a style='color: lightgray' href='cart.php?action=empty_cart'>Empty Cart</a><br /></ul>";
                    echo "<ul>Close</ul>";
                }

                ?>
            </div>
        </nav>
    </div>


    <?php

    $categoryId = isset($_GET['id']) ? $_GET['id'] : 5;
    $current_url = "https://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

    $product = new ShopProduct($host, $dbname, $user, $password);
    $products = $product->getProducts($categoryId);

    echo "<div class='allproducts'>";
    foreach ($products as $item) {

        echo "
        <div class='productbox'>
            <div class='productimage'>
                <img src='images/{$item['ProductID']}.png' alt='' />
            </div>
            <div class='producttitle'>
                <p class='lead'>{$item['ProductName']}</p>
            </div>
            <div class='productprice mt-3 d-flex justify-content-between'>
                <p class='lead'>Price: \${$item['ProductPrice']}</p>
                <form method='post' action='cart.php'>
                        <input type='hidden' name='product_id' value='{$item['ProductID']}'>
                        <input type='hidden' name='product_name' value='{$item['ProductName']}'>
                        <input type='hidden' name='product_price' value='{$item['ProductPrice']}'>
                        <input type='hidden' name='return_url' value='{$current_url}'>
                        <input type='hidden' name='return_url' value='{$current_url}'>
                        <button type='submit' class='btn btn-outline-primary rounded mb-2'>
                    <svg xmlns='http://www.w3.org/2000/svg' width='17' height='17' fill='currentColor' class='bi bi-cart-plus mb-1' viewBox='0 0 17 17'>
                        <path d='M9 5.5a.5.5 0 0 0-1 0V7H6.5a.5.5 0 0 0 0 1H8v1.5a.5.5 0 0 0 1 0V8h1.5a.5.5 0 0 0 0-1H9z'/>
                        <path d='M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1zm3.915 10L3.102 4h10.796l-1.313 7zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0m7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0'/>
                    </svg>
                    Buy</button>
                    </form>
            </div>
            <div class='productdescription'>
                <p>{$item['ProductDescription']}</p>
            </div>
        </div>
        ";
    }
    echo "</div>";
    ?>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    </div>
</body>

</html>