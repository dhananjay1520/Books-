<?php
// product_update.php

include 'db_connection.php'; // Database connection

// Check if product ID is provided
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Fetch the product details by ID
    $query = "SELECT * FROM products WHERE id = :id";
    $stmt = $pdo->prepare($query);
    $stmt->execute([':id' => $id]);
    $product = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$product) {
        echo "Product not found.";
        exit;
    }
}

// Update product logic
if (isset($_POST['update'])) {
    $pr_name = $_POST['pr_name'];
    $pr_price = $_POST['pr_price'];
    $pr_desc = $_POST['pr_desc'];
    $pr_cate = $_POST['pr_cate'];
    $pr_Qty = $_POST['pr_Qty'];

    // Prepare and execute update query
    $query = "UPDATE products SET pr_name = :pr_name, pr_price = :pr_price, pr_desc = :pr_desc, pr_cate = :pr_cate, pr_Qty = :pr_Qty WHERE id = :id";
    $stmt = $pdo->prepare($query);
    $stmt->execute([
        ':pr_name' => $pr_name,
        ':pr_price' => $pr_price,
        ':pr_desc' => $pr_desc,
        ':pr_cate' => $pr_cate,
        ':pr_Qty' => $pr_Qty,
        ':id' => $id
    ]);

    echo "Product updated successfully!";
    header("Location: product_form.php"); // Redirect back to the product form
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Product</title>
    <link rel="stylesheet" href="styles.css"> <!-- Optional CSS -->
</head>
<body>
    <h2>Update Product</h2>
    <form action="" method="POST">
        <label for="pr_name">Product Name:</label>
        <input type="text" name="pr_name" value="<?= $product['pr_name'] ?>" required><br>

        <label for="pr_price">Price:</label>
        <input type="number" name="pr_price" value="<?= $product['pr_price'] ?>" required><br>

        <label for="pr_desc">Description:</label>
        <textarea name="pr_desc" required><?= $product['pr_desc'] ?></textarea><br>

        <label for="pr_cate">Category:</label>
        <input type="text" name="pr_cate" value="<?= $product['pr_cate'] ?>" required><br>

        <label for="pr_Qty">Quantity:</label>
        <input type="number" name="pr_Qty" value="<?= $product['pr_Qty'] ?>" required><br>

        <input type="submit" name="update" value="Update Product">
    </form>
</body>
</html>
