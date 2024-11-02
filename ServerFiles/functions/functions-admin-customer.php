<?php
function renderCustomerTable($host, $dbname, $user, $password)
{
    // Create an instance of the Customer class
    $customerClass = new Customer($host, $dbname, $user, $password);
    $customers = $customerClass->getCustomers();

    // Start output buffering
    ob_start();
    ?>
    <table class="table table-striped table-bordered">
        <div style="text-align: right; padding: 15px;">
            <a href="?cat=customer&action=add" class="btn btn-primary"><i class="bi bi-file-plus"></i> Add Customer</a>
        </div>
        <thead class="thead-dark">
            <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Address</th>
                <th>Postcode</th>
                <th>City</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Edit</th>
                <th>Delete</th> <!-- New column for actions -->
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($customers as $customer) {
                echo "<tr>";
                echo "<td class='align-middle'>" . htmlspecialchars($customer['CustomerFirstName']) . "</td>";
                echo "<td class='align-middle'>" . htmlspecialchars($customer['CustomerLastName']) . "</td>";
                echo "<td class='align-middle'>" . htmlspecialchars($customer['CustomerAddress']) . "</td>";
                echo "<td class='align-middle'>" . htmlspecialchars($customer['CustomerPostCode']) . "</td>";
                echo "<td class='align-middle'>" . htmlspecialchars($customer['CustomerCity']) . "</td>";
                echo "<td class='align-middle'>" . htmlspecialchars($customer['CustomerEmail']) . "</td>";
                echo "<td class='align-middle'>" . htmlspecialchars($customer['CustomerPhone']) . "</td>";
                echo "<td class='align-middle' style='width: 10%'>";
                echo "<a href='?cat=customer&action=edit&customerId=" . $customer['CustomerID'] . "'class='btn btn-primary'><i class='bi bi-pencil-square'></i> Edit</a>"; // Länk för att redigera
                echo "</td>";
                echo "<td class='align-middle' style='width: 10%'>";
                echo "<a href='?cat=customer&action=delete&customerId=" . $customer['CustomerID'] . "'class='btn btn-danger'><i class='bi bi-trash'></i> Delete</a>"; // Länk för att redigera
                echo "</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
    <?php
    // Return the buffered content
    return ob_get_clean();
}


function renderAddCustomerForm($host, $dbname, $user, $password)
{
    // Create an instance of the Customer class
    $customerClass = new Customer($host, $dbname, $user, $password);

    // Start output buffering
    ob_start();
    ?>
    <div class="container mt-4">
        <h2>Add Customer</h2>
        <form method="post" action="">
            <div class="row mb-3">
                <label for="firstName" class="col-sm-2 col-form-label">First Name:</label>
                <div class="col-sm-10">
                    <input type="text" id="firstName" name="firstName" class="form-control" required>
                </div>
            </div>
            <div class="row mb-3">
                <label for="lastName" class="col-sm-2 col-form-label">Last Name:</label>
                <div class="col-sm-10">
                    <input type="text" id="lastName" name="lastName" class="form-control" required>
                </div>
            </div>
            <div class="row mb-3">
                <label for="address" class="col-sm-2 col-form-label">Address:</label>
                <div class="col-sm-10">
                    <input type="text" id="address" name="address" class="form-control" required>
                </div>
            </div>
            <div class="row mb-3">
                <label for="postCode" class="col-sm-2 col-form-label">Postcode:</label>
                <div class="col-sm-10">
                    <input type="text" id="postCode" name="postCode" class="form-control" required>
                </div>
            </div>
            <div class="row mb-3">
                <label for="city" class="col-sm-2 col-form-label">City:</label>
                <div class="col-sm-10">
                    <input type="text" id="city" name="city" class="form-control" required>
                </div>
            </div>
            <div class="row mb-3">
                <label for="email" class="col-sm-2 col-form-label">Email:</label>
                <div class="col-sm-10">
                    <input type="email" id="email" name="email" class="form-control" required>
                </div>
            </div>
            <div class="row mb-3">
                <label for="phone" class="col-sm-2 col-form-label">Phone:</label>
                <div class="col-sm-10">
                    <input type="text" id="phone" name="phone" class="form-control" required>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Add Customer</button>
        </form>
    </div>
    <?php

    // Handle form submission
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        try {
            $firstName = SanitizeInput($_POST['firstName']);
            $lastName = SanitizeInput($_POST['lastName']);
            $address = SanitizeInput($_POST['address']);
            $postCode = SanitizeInput($_POST['postCode']);
            $city = SanitizeInput($_POST['city']);
            $email = SanitizeEmail($_POST['email']);
            $phone = SanitizeInput($_POST['phone']);

            // Add the customer to the database
            $addedRows = $customerClass->addCustomer($firstName, $lastName, $address, $postCode, $city, $email, $phone);
            if ($addedRows > 0) {
                echo "<div class='alert alert-success mt-3'>Customer added successfully!</div>";
            } else {
                echo "<div class='alert alert-danger mt-3'>Failed to add customer.</div>";
            }
        } catch (Exception $e) {
            echo "<div class='alert alert-danger mt-3'>Error: " . $e->getMessage() . "</div>";
        }
    }

    // Return the buffered content
    return ob_get_clean();
}

function renderEditCustomerForm($host, $dbname, $user, $password, $customerId = null)
{
    $customerClass = new Customer($host, $dbname, $user, $password);

    // Fetch customer information if customerId is provided
    if ($customerId) {
        $customers = $customerClass->getCustomers();
        $customer = null;
        foreach ($customers as $c) {
            if ($c['CustomerID'] == $customerId) {
                $customer = $c;
                break;
            }
        }
    }

    // Start output buffering
    ob_start();
    ?>
    <div class="container mt-4">
        <h2>Edit Customer</h2>
        <form method="post" action="">
            <div class="row mb-3">
                <label for="customerId" class="col-sm-2 col-form-label">Customer ID:</label>
                <div class="col-sm-10">
                    <input type="number" id="customerId" name="customerId" class="form-control"
                        value="<?php echo $customer ? htmlspecialchars($customer['CustomerID']) : ''; ?>" required readonly>
                </div>
            </div>
            <div class="row mb-3">
                <label for="firstName" class="col-sm-2 col-form-label">First Name:</label>
                <div class="col-sm-10">
                    <input type="text" id="firstName" name="firstName" class="form-control"
                        value="<?php echo $customer ? htmlspecialchars($customer['CustomerFirstName']) : ''; ?>" required>
                </div>
            </div>
            <div class="row mb-3">
                <label for="lastName" class="col-sm-2 col-form-label">Last Name:</label>
                <div class="col-sm-10">
                    <input type="text" id="lastName" name="lastName" class="form-control"
                        value="<?php echo $customer ? htmlspecialchars($customer['CustomerLastName']) : ''; ?>" required>
                </div>
            </div>
            <div class="row mb-3">
                <label for="address" class="col-sm-2 col-form-label">Address:</label>
                <div class="col-sm-10">
                    <input type="text" id="address" name="address" class="form-control"
                        value="<?php echo $customer ? htmlspecialchars($customer['CustomerAddress']) : ''; ?>" required>
                </div>
            </div>
            <div class="row mb-3">
                <label for="postCode" class="col-sm-2 col-form-label">Postcode:</label>
                <div class="col-sm-10">
                    <input type="text" id="postCode" name="postCode" class="form-control"
                        value="<?php echo $customer ? htmlspecialchars($customer['CustomerPostCode']) : ''; ?>" required>
                </div>
            </div>
            <div class="row mb-3">
                <label for="city" class="col-sm-2 col-form-label">City:</label>
                <div class="col-sm-10">
                    <input type="text" id="city" name="city" class="form-control"
                        value="<?php echo $customer ? htmlspecialchars($customer['CustomerCity']) : ''; ?>" required>
                </div>
            </div>
            <div class="row mb-3">
                <label for="email" class="col-sm-2 col-form-label">Email:</label>
                <div class="col-sm-10">
                    <input type="email" id="email" name="email" class="form-control"
                        value="<?php echo $customer ? htmlspecialchars($customer['CustomerEmail']) : ''; ?>" required>
                </div>
            </div>
            <div class="row mb-3">
                <label for="phone" class="col-sm-2 col-form-label">Phone:</label>
                <div class="col-sm-10">
                    <input type="text" id="phone" name="phone" class="form-control"
                        value="<?php echo $customer ? htmlspecialchars($customer['CustomerPhone']) : ''; ?>" required>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Update Customer</button>
        </form>

        <?php
        // Handle form submission
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            try {
                $customerId = (int) $_POST['customerId'];
                $firstName = SanitizeInput($_POST['firstName']);
                $lastName = SanitizeInput($_POST['lastName']);
                $address = SanitizeInput($_POST['address']);
                $postCode = SanitizeInput($_POST['postCode']);
                $city = SanitizeInput($_POST['city']);
                $email = SanitizeEmail($_POST['email']);
                $phone = SanitizeInput($_POST['phone']);

                // Update the customer in the database
                $updatedRows = $customerClass->updateCustomer($customerId, $firstName, $lastName, $address, $postCode, $city, $email, $phone);
                if ($updatedRows > 0) {
                    echo "<div class='alert alert-success mt-3'>Customer updated successfully to:<br>First Name: $firstName<br>Last Name: $lastName<br>Address: $address<br>Post Code: $postCode<br>City $city<br>E-Mail: $email<br>Phone: $phone</div>";
                } else {
                    echo "<div class='alert alert-warning mt-3'>No customer was found with the given ID or no changes were made.</div>";
                }
            } catch (Exception $e) {
                echo "<div class='alert alert-danger mt-3'>Error: " . $e->getMessage() . "</div>";
            }
        }
        ?>
    </div>
    <?php

    // Return the buffered content
    return ob_get_clean();
}

function renderDeleteCustomerForm($host, $dbname, $user, $password, $customerId = null)
{
    $customerClass = new Customer($host, $dbname, $user, $password);

    // Start output buffering
    ob_start();
    ?>
    <div class="container mt-4">
        <h2>Delete Customer</h2>
        <form method="post" action="">
            <div class="mb-3">
                <label for="customerId" class="form-label">Customer ID:</label>
                <input type="number" id="customerId" name="customerId" class="form-control"
                    value="<?php echo htmlspecialchars($customerId); ?>" required>
            </div>
            <button type="submit" class="btn btn-danger">Delete Customer</button>
        </form>

        <?php
        // Handle form submission
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $customerId = (int) $_POST['customerId'];

            // Delete the customer from the database
            $deletedRows = $customerClass->deleteCustomer($customerId);
            if ($deletedRows > 0) {
                echo "<div class='alert alert-success mt-3'>Customer deleted successfully.</div>";
            } else {
                echo "<div class='alert alert-warning mt-3'>No customer was found with the given ID.</div>";
            }
        }
        ?>
    </div>
    <?php

    // Return the buffered content
    return ob_get_clean();
}

?>