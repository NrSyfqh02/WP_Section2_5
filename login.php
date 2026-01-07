<?php
session_start();
include "db.php";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM admins WHERE email=? AND password=SHA2(?,256)");
    $stmt->bind_param("ss", $email, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $_SESSION['admin_logged_in'] = true;  // Fixed session variable
        header("Location: dashboard.php");
        exit();
    } else {
        $error = "Invalid email or password";
    }
}
?>
<!doctype html>
<html>
<head>
<title>Admin Login</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>

<body class="bg-light">
<div class="container col-md-4 mt-5">
<div class="card p-4 shadow">
<h4 class="text-center">Admin Login</h4>

<?php if (isset($error)) echo "<div class='alert alert-danger'>$error</div>"; ?>

<form method="post">
<input class="form-control mb-2" type="email" name="email" placeholder="Email" required>
<input class="form-control mb-3" type="password" name="password" placeholder="Password" required>
<button class="btn btn-dark w-100" type="submit">Login</button>
</form>

</div>
</div>
</body>
</html>