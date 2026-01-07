<?php include "auth.php"; ?>
<!doctype html>
<html>
<head>
<title>Admin Dashboard</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>

<body>
<nav class="navbar navbar-dark bg-dark px-3">
<span class="navbar-brand">Admin Dashboard</span>
<a href="logout.php" class="btn btn-outline-light btn-sm">Logout</a>
</nav>

<div class="container mt-4">
<div class="row g-3">
<div class="col-md-6">
<a class="btn btn-primary w-100 p-3" href="products.php">Manage Products</a>
</div>
<div class="col-md-6">
<a class="btn btn-success w-100 p-3" href="categories.php">Manage Categories</a>
</div>
</div>
</div>
</body>
</html>