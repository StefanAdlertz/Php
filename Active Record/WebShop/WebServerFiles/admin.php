<?php
// DB
include 'database/database.php';
// Classes
include 'class/class-admin-category.php';
include 'class/class-admin-customer.php';
include 'class/class-admin-product.php';
// Functions
include 'functions/functions-admin-category.php';
include 'functions/functions-admin-customer.php';
include 'functions/functions-admin-product.php';
include 'functions/functions-admin-service.php';
?>

<!DOCTYPE html>
<html lang="sv">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://adlertz.se/shop/css/bootstrap-wide.min.css">
    <!-- Bootstrap ICONS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <!-- CSS -->
    <link rel="stylesheet" href="css/styles-admin-shop.css">
    <!-- Abel Font -->
    <link href="https://fonts.googleapis.com/css2?family=Abel&display=swap" rel="stylesheet">
    <title>Web Shop Admin</title>
</head>

<body>
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark container-fluid w-100">
            <button class="navbar-toggler me-auto" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a class="navbar-brand mx-3" href="https://adlertz.se/shop/admin.php">Web Shop Admin</a>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item mx-2">
                        <a class="nav-link my-0"
                            href="https://adlertz.se/shop/admin.php?cat=customer&action=list">Customers</a>
                    </li>
                    <li class="nav-item mx-2">
                        <a class="nav-link my-0"
                            href="https://adlertz.se/shop/admin.php?cat=category&action=list">Category</a>
                    </li>
                    <li class="nav-item mx-2">
                        <a class="nav-link my-0" href="https://adlertz.se/shop/admin.php?cat=product&action=list">Product</a>
                    </li>
                </ul>
            </div>
        </nav>

        <div class="content mt-3">
            <?php

            if (isset($_GET['action'])) {
                $action = $_GET['action'];
                $cat = $_GET['cat'];

                switch ($cat) {
                    case 'customer':
                        switch ($action) {
                            case 'add':
                                echo renderAddCustomerForm($host, $dbname, $user, $password);
                                break;
                            case 'edit':
                                $customerId = (int) $_GET['customerId'];
                                echo renderEditCustomerForm($host, $dbname, $user, $password, $customerId);
                                break;
                            case 'delete':
                                $customerId = (int) $_GET['customerId'];
                                echo renderDeleteCustomerForm($host, $dbname, $user, $password, $customerId);
                                break;
                            case 'list':
                                echo renderCustomerTable($host, $dbname, $user, $password);
                                break;
                            default:
                                echo "<div class='alert alert-warning'>No valid action provided.</div>";
                        }
                        break;

                    case 'category':
                        switch ($action) {
                            case 'add':
                                echo renderAddCategoryForm($host, $dbname, $user, $password);
                                break;
                            case 'edit':
                                $categoryId = (int) $_GET['categoryId'];
                                echo renderEditCategoryForm($host, $dbname, $user, $password, $categoryId);
                                break;
                            case 'delete':
                                $categoryId = (int) $_GET['categoryId'];
                                echo renderDeleteCategoryForm($host, $dbname, $user, $password, $categoryId);
                                break;
                            case 'list':
                                echo renderCategoryTable($host, $dbname, $user, $password);
                                break;
                            default:
                                echo "<div class='alert alert-warning'>No valid action provided.</div>";
                        }
                        break;

                    case 'product':
                        switch ($action) {
                            case 'add':
                                echo renderAddProductForm($host, $dbname, $user, $password);
                                break;
                            case 'edit':
                                $categoryId = (int) $_GET['productId'];
                                echo renderEditProductForm($host, $dbname, $user, $password, $categoryId);
                                break;
                            case 'delete':
                                $categoryId = (int) $_GET['productId'];
                                echo renderDeleteProductForm($host, $dbname, $user, $password, $categoryId);
                                break;
                            case 'list':
                                echo renderProductTable($host, $dbname, $user, $password);
                                break;
                            default:
                                echo "<div class='alert alert-warning'>No valid action provided.</div>";
                        }
                        break;
                }
            } else {
                echo getFirstPage();
            }

            ?>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>