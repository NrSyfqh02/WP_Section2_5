<?php
include 'auth.php';
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['add'])) {
        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $description = mysqli_real_escape_string($conn, $_POST['description']);
        $price = $_POST['price'];
        $image = mysqli_real_escape_string($conn, $_POST['image']);
        $category_id = $_POST['category_id'];
        $sizes = mysqli_real_escape_string($conn, $_POST['sizes']);
        $conn->query("INSERT INTO products (name, description, price, image, category_id, sizes) VALUES ('$name', '$description', '$price', '$image', '$category_id', '$sizes')");
    }
    if (isset($_POST['delete'])) {
        $id = $_POST['id'];
        $conn->query("DELETE FROM products WHERE id=$id");
    }
}

$products = $conn->query("SELECT products.*, categories.name AS category_name FROM products JOIN categories ON products.category_id = categories.id");
$categories = $conn->query("SELECT * FROM categories");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Manage Products</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body>
    <nav class="navbar navbar-dark bg-dark px-3">
        <span class="navbar-brand">Manage Products</span>
        <a href="dashboard.php" class="btn btn-outline-light btn-sm">Back to Dashboard</a>
    </nav>
    <div class="container mt-4">
        <h4>Add Product</h4>
        <form method="POST" class="mb-4">
            <input class="form-control mb-2" type="text" name="name" placeholder="Product Name" required>
            <textarea class="form-control mb-2" name="description" placeholder="Description"></textarea>
            <input class="form-control mb-2" type="number" name="price" step="0.01" placeholder="Price" required>
            <input class="form-control mb-2" type="text" name="image" placeholder="Image Path" required>
            <select class="form-control mb-2" name="category_id" required>
                <?php while ($cat = $categories->fetch_assoc()) { echo "<option value='{$cat['id']}'>{$cat['name']}</option>"; } ?>
            </select>
            <input class="form-control mb-2" type="text" name="sizes" placeholder="Sizes (comma-separated)" required>
            <button class="btn btn-primary" type="submit" name="add">Add Product</button>
        </form>
        <h4>Product List</h4>
        <table class="table table-striped">
            <thead>
                <tr><th>Name</th><th>Price</th><th>Category</th><th>Actions</th></tr>
            </thead>
            <tbody>
                <?php while ($product = $products->fetch_assoc()) { ?>
                    <tr>
                        <td><?php echo $product['name']; ?></td>
                        <td>RM<?php echo $product['price']; ?></td>
                        <td><?php echo $product['category_name']; ?></td>
                        <td>
                            <form method="POST" style="display:inline;">
                                <input type="hidden" name="id" value="<?php echo $product['id']; ?>">
                                <button type="submit" name="delete" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>
</html>