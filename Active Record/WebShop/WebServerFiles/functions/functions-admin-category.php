<?php
function renderCategoryTable($host, $dbname, $user, $password)
{
    $categoryClass = new Category($host, $dbname, $user, $password);
    $categories = $categoryClass->getCategories();

    ob_start();
?>
    <div class="container">
        <div style="text-align: right; padding: 15px;">
            <a href="?cat=category&action=add" class="btn btn-primary rounded">
                <i class="bi bi-file-plus"></i> Add Category
            </a>
        </div>
        <div class="table-responsive"> <!-- Added responsive wrapper -->
            <table class="table table-striped table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>Category Name</th>
                        <th>Navigation Order</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($categories as $category) {
                        echo "<tr>";
                        echo "<td class='align-middle'>" . htmlspecialchars($category['CategoryName']) . "</td>";
                        echo "<td class='align-middle' style='width: 10%'>" . htmlspecialchars($category['CategoryNavOrder']) . "</td>";

                        echo "<td class='align-middle' style='width: 10%'>";
                        echo "<a href='?cat=category&action=edit&categoryId=" . $category['CategoryID'] . "' class='btn btn-primary rounded'><i class='bi bi-pencil-square'></i> Edit</a>";
                        echo "</td>";
                        echo "<td class='align-middle' style='width: 10%'>";
                        echo "<a href='?cat=category&action=delete&categoryId=" . $category['CategoryID'] . "' class='btn btn-danger rounded'><i class='bi bi-trash'></i> Delete</a>";
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


function renderAddCategoryForm($host, $dbname, $user, $password)
{
    $categoryClass = new Category($host, $dbname, $user, $password);

    ob_start();
?>
    <div class="container mt-4">
        <h2>Add new Category</h2>
        <form method="post" action="">
            <div class="row mb-3">
                <label for="categoryName" class="col-sm-2 col-form-label">Category Name:</label>
                <div class="col-sm-10">
                    <input type="text" id="categoryName" name="categoryName" class="form-control" required>
                </div>
            </div>
            <div class="row mb-3">
                <label for="categoryNavOrder" class="col-sm-2 col-form-label">Navigation Order:</label>
                <div class="col-sm-10">
                    <input type="number" id="categoryNavOrder" name="categoryNavOrder" class="form-control" required>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Add Category</button>
        </form>
    </div>
    <?php

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        try {
            $categoryName = SanitizeInput($_POST['categoryName']);
            $categoryNavOrder = SanitizeInput($_POST['categoryNavOrder']);

            $addedRows = $categoryClass->addCategory($categoryName, $categoryNavOrder);
            if ($addedRows > 0) {
                echo "<div class='alert alert-success mt-3'>Category added successfully.</div>";
            } else {
                echo "<div class='alert alert-danger mt-3'>Failed to add category.</div>";
            }
        } catch (Exception $e) {
            echo "<div class='alert alert-danger mt-3'>Error: " . $e->getMessage() . "</div>";
        }
    }

    return ob_get_clean();
}

function renderEditCategoryForm($host, $dbname, $user, $password, $categoryId = null)
{
    $categoryClass = new Category($host, $dbname, $user, $password);

    if ($categoryId) {
        $categories = $categoryClass->getCategories();
        $category = null;
        foreach ($categories as $c) {
            if ($c['CategoryID'] == $categoryId) {
                $category = $c;
                break;
            }
        }
    }

    ob_start();
    ?>
    <div class="container mt-4">
        <h2>Edit Category</h2>
        <form method="post" action="">
            <div class="row mb-3">
                <label for="categoryId" class="col-sm-2 col-form-label">Category ID:</label>
                <div class="col-sm-10">
                    <input type="number" id="categoryId" name="categoryId" class="form-control"
                        value="<?php echo $category ? htmlspecialchars($category['CategoryID']) : ''; ?>" required readonly>
                </div>
            </div>
            <div class="row mb-3">
                <label for="categoryName" class="col-sm-2 col-form-label">Category Name:</label>
                <div class="col-sm-10">
                    <input type="text" id="categoryName" name="categoryName" class="form-control"
                        value="<?php echo $category ? htmlspecialchars($category['CategoryName']) : ''; ?>" required>
                </div>
            </div>
            <div class="row mb-3">
                <label for="categoryNavOrder" class="col-sm-2 col-form-label">Navigation Order:</label>
                <div class="col-sm-10">
                    <input type="number" id="categoryNavOrder" name="categoryNavOrder" class="form-control"
                        value="<?php echo $category ? htmlspecialchars($category['CategoryNavOrder']) : ''; ?>" required>
                </div>
            </div>
            <button type="submit" class="btn btn-primary rounded">Update Category</button>
        </form>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            try {
                $categoryId = SanitizeInput((int) $_POST['categoryId']);
                $categoryName = SanitizeInput($_POST['categoryName']);
                $categoryNavOrder = SanitizeInput((int) $_POST['categoryNavOrder']);

                $updatedRows = $categoryClass->updateCategory($categoryId, $categoryName, $categoryNavOrder);
                if ($updatedRows > 0) {
                    echo "<div class='alert alert-success mt-3'>Category updated successfully to:<br>Category Id: $categoryId<br>Category Name: $categoryName<br>Category Navigation Order$categoryNavOrder</div>";
                } else {
                    echo "<div class='alert alert-warning mt-3'>No category was found with the given ID or no changes were made.</div>";
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

function renderDeleteCategoryForm($host, $dbname, $user, $password, $categoryId = null)
{
    $categoryClass = new Category($host, $dbname, $user, $password);

    ob_start();
?>
    <div class="container mt-4">
        <h2>Delete Category</h2>
        <form method="post" action="">
            <div class="mb-3">
                <label for="categoryId" class="form-label">Category ID:</label>
                <input type="number" id="categoryId" name="categoryId" class="form-control"
                    value="<?php echo htmlspecialchars($categoryId); ?>" required readonly>
            </div>
            <button type="submit" class="btn btn-danger rounded">Delete Category</button>
        </form>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $categoryId = (int) $_POST['categoryId'];

            $deletedRows = $categoryClass->deleteCategory($categoryId);
            if ($deletedRows > 0) {
                echo "<div class='alert alert-success mt-3'>Category removed successfully</div>";
            } else {
                echo "<div class='alert alert-warning mt-3'>No category was found with the given ID.</div>";
            }
        }
        ?>
    </div>
<?php
    return ob_get_clean();
}

?>