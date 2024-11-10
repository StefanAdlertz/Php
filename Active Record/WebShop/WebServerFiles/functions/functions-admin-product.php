<?php

function renderProductTable($host, $dbname, $user, $password)
{
    $productClass = new Product($host, $dbname, $user, $password);
    $products = $productClass->getProducts();

    ob_start();
?>
    <div class="container">
        <div style="text-align: right; padding: 15px;">
            <a href="?cat=product&action=add" class="btn btn-primary rounded">
                <i class="bi bi-file-plus"></i> Add Product
            </a>
        </div>
        <div class="table-responsive"> <!-- Added responsive wrapper -->
            <table class="table table-striped table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>Product Name</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th>Category ID</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($products as $product) {
                        echo "<tr>";
                        echo "<td class='align-middle' style='width: 30%'>" . htmlspecialchars($product['ProductName']) . "</td>";
                        echo "<td class='align-middle' style='width: 30%'>" . htmlspecialchars(substr($product['ProductDescription'], 0, 24)) . "</td>";
                        echo "<td class='align-middle' style='width: 10%'>" . htmlspecialchars($product['ProductPrice']) . "</td>";
                        echo "<td class='align-middle' style='width: 10%'>" . htmlspecialchars($product['CategoryID']) . "</td>";

                        echo "<td class='align-middle' style='width: 10%'>";
                        echo "<a href='?cat=product&action=edit&productId=" . $product['ProductID'] . "' class='btn btn-primary rounded'><i class='bi bi-pencil-square'></i> Edit</a>";
                        echo "</td>";
                        echo "<td class='align-middle' style='width: 10%'>";
                        echo "<a href='?cat=product&action=delete&productId=" . $product['ProductID'] . "' class='btn btn-danger rounded'><i class='bi bi-trash'></i> Delete</a>";
                        echo "</td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
<?php
    return ob_get_clean();
}

function renderAddProductForm($host, $dbname, $user, $password)
{
    $productClass = new Product($host, $dbname, $user, $password);

    $categoryClass = new Category($host, $dbname, $user, $password);
    $categories = $categoryClass->getCategories();

    ob_start();
?>
    <div class="container mt-4">
        <h2>Add Product</h2>
        <form method="post" action="">
            <div class="row mb-3">
                <label for="productName" class="col-sm-2 col-form-label">Productname:</label>
                <div class="col-sm-10">
                    <input type="text" id="productName" name="productName" class="form-control" required>
                </div>
            </div>
            <div class="row mb-3">
                <label for="productDescription" class="col-sm-2 col-form-label">Productdescription:</label>
                <div class="col-sm-10">
                    <textarea id="productDescription" name="productDescription" class="form-control" required></textarea>
                </div>
            </div>
            <div class="row mb-3">
                <label for="productPrice" class="col-sm-2 col-form-label">Productprice:</label>
                <div class="col-sm-10">
                    <input type="number" step="0.01" id="productPrice" name="productPrice" class="form-control" required>
                </div>
            </div>
            <div class="row mb-3">
                <label for="categoryId" class="col-sm-2 col-form-label">Category ID:</label>
                <div class="col-sm-10">

                    <select id="categoryId" name="categoryId" class="form-control">
                        <option value="" selected><- Please select a category -></option>
                        <?php foreach ($categories as $category): ?>
                            <option value="<?php echo $category['CategoryID']; ?>">
                                <?php echo $category['CategoryName']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <button type="submit" class="btn btn-primary rounded">Add Product</button>
        </form>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            try {
                $productName = SanitizeInput($_POST['productName']);
                $productDescription = SanitizeInput($_POST['productDescription']);
                $productPrice = SanitizeInput($_POST['productPrice']);
                $categoryId = SanitizeInput($_POST['categoryId']);

                $addedRows = $productClass->addProduct($productName, $productDescription, $productPrice, $categoryId);
                if ($addedRows > 0) {
                    echo "<div class='alert alert-success mt-3'>Product added successfully.</div>";
                } else {
                    echo "<div class='alert alert-danger mt-3'>Failed to add product.</div>";
                }
            } catch (Exception $e) {
                echo "<div class='alert alert-danger mt-3'>Error: " . $e->getMessage() . "</div>";
            }
        }

        ?>
    </div>
<?php
    return ob_get_clean();
}

function renderEditProductForm($host, $dbname, $user, $password, $productId = null)
{
    $productClass = new Product($host, $dbname, $user, $password);

    $product = null;
    if ($productId) {
        $products = $productClass->getProducts();
        foreach ($products as $p) {
            if ($p['ProductID'] == $productId) {
                $product = $p;
                break;
            }
        }
    }

    $categoryClass = new Category($host, $dbname, $user, $password);
    $categories = $categoryClass->getCategories();

    ob_start();
?>
    <div class="container mt-4">
        <h2>Edit Product</h2>
        <form method="post" action="">
            <div class="row mb-3">
                <label for="productId" class="col-sm-2 col-form-label">Product ID:</label>
                <div class="col-sm-10">
                    <input type="number" id="productId" name="productId" class="form-control"
                        value="<?php echo $product ? htmlspecialchars($product['ProductID']) : ''; ?>" required readonly>
                </div>
            </div>
            <div class="row mb-3">
                <label for="productName" class="col-sm-2 col-form-label">Product Name:</label>
                <div class="col-sm-10">
                    <input type="text" id="productName" name="productName" class="form-control"
                        value="<?php echo $product ? htmlspecialchars($product['ProductName']) : ''; ?>" required>
                </div>
            </div>
            <div class="row mb-3">
                <label for="productDescription" class="col-sm-2 col-form-label">Product Description:</label>
                <div class="col-sm-10">
                    <textarea id="productDescription" name="productDescription" class="form-control"
                        required><?php echo $product ? htmlspecialchars($product['ProductDescription']) : ''; ?></textarea>
                </div>
            </div>
            <div class="row mb-3">
                <label for="productPrice" class="col-sm-2 col-form-label">Productprice:</label>
                <div class="col-sm-10">
                    <input type="number" step="0.01" id="productPrice" name="productPrice" class="form-control"
                        value="<?php echo $product ? htmlspecialchars($product['ProductPrice']) : ''; ?>" required>
                </div>
            </div>
            <div class="row mb-3">
                <label for="categoryId" class="col-sm-2 col-form-label">Category ID:</label>
                <div class="col-sm-10">

                    <select id="categoryId" name="categoryId" class="form-control">
                        <?php foreach ($categories as $category): ?>
                            <option value="<?php echo htmlspecialchars($category['CategoryID']); ?>" <?php if ($category['CategoryID'] == $product['CategoryID']) {
                                                                                                            echo 'selected';
                                                                                                        } ?>>
                                <?php echo htmlspecialchars($category['CategoryName']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <button type="submit" class="btn btn-primary rounded">Update product</button>
        </form>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            try {
                $productId = (int) $_POST['productId'];
                $productName = SanitizeInput($_POST['productName']);
                $productDescription = SanitizeInput($_POST['productDescription']);
                $productPrice = (float) SanitizeInput($_POST['productPrice']);
                $categoryId = SanitizeInput((int) $_POST['categoryId']);

                $updatedRows = $productClass->updateProduct($productId, $productName, $productDescription, $productPrice, $categoryId);
                if ($updatedRows > 0) {
                    echo "<div class='alert alert-success mt-3'>Product updated successfully to:<br>Product Id: $productId<br>Product Name: $productName<br>Product Price: $productPrice<br>Category Id: $categoryId<br><br>Product Description: $productDescription</div>";
                    exit();
                } else {
                    echo "<div class='alert alert-warning mt-3'>No product was found with the given ID or no changes were made.</div>";
                }
            } catch (Exception $e) {
                echo "<div class='alert alert-danger mt-3'>Error: " . $e->getMessage() . "</div>";
            }
        }
        ?>
    </div>
<?php
    return ob_get_clean();
}

function renderDeleteProductForm($host, $dbname, $user, $password, $productId = null)
{
    $productClass = new Product($host, $dbname, $user, $password);

    ob_start();
?>
    <div class="container mt-4">
        <h2>Delete Product</h2>
        <form method="post" action="">
            <div class="mb-3">
                <label for="productId" class="form-label">Product ID:</label>
                <input type="number" id="productId" name="productId" class="form-control"
                    value="<?php echo htmlspecialchars($productId); ?>" required readonly>
            </div>
            <button type="submit" class="btn btn-danger rounded">Delete Product</button>
        </form>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $productId = (int) $_POST['productId'];

            $deletedRows = $productClass->deleteProduct($productId);
            if ($deletedRows > 0) {
                echo "<div class='alert alert-success mt-3'>Product removed successfully.</div>";
                header("Location: ?cat=product&action=list");
                exit();
            } else {
                echo "<div class='alert alert-warning mt-3'>No product was found with the given ID.</div>";
            }
        }
        ?>
    </div>
<?php
    return ob_get_clean();
}

?>