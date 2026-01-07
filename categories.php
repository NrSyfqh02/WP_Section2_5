<?php
include 'auth.php';
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['add'])) {
        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $conn->query("INSERT INTO categories (name) VALUES ('$name')");
    }
    if (isset($_POST['delete'])) {
        $id = $_POST['id'];
        $conn->query("DELETE FROM categories WHERE id=$id");
    }
}

$categories = $conn->query("SELECT * FROM categories");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Manage Categories</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body>
    <nav class="navbar navbar-dark bg-dark px-3">
        <span class="navbar-brand">Manage Categories</span>
        <a href="dashboard.php" class="btn btn-outline-light btn-sm">Back to Dashboard</a>
    </nav>
    <div class="container mt-4">
        <h4>Add Category</h4>
        <form method="POST" class="mb-4">
            <input class="form-control mb-2" type="text" name="name" placeholder="Category Name" required>
            <button class="btn btn-success" type="submit" name="add">Add Category</button>
        </form>
        <h4>Category List</h4>
        <table class="table table-striped">
            <thead>
                <tr><th>Name</th><th>Actions</th></tr>
            </thead>
            <tbody>
                <?php while ($category = $categories->fetch_assoc()) { ?>
                    <tr>
                        <td><?php echo $category['name']; ?></td>
                        <td>
                            <form method="POST" style="display:inline;">
                                <input type="hidden" name="id" value="<?php echo $category['id']; ?>">
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