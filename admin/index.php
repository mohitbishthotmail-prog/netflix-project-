<?php
session_start();
ob_start();
include('config.php');

// Redirect if already logged in
if (isset($_SESSION['loged'])) {
    header("Location: index2.php");
    exit();
}

$msg = "";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $email = trim($_POST['email']);
    $password = trim($_POST['pwd']);

    // Prepared statement (prevent SQL injection)
    $stmt = $conn->prepare("SELECT * FROM admin WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if user exists
    if ($row = $result->fetch_assoc()) {
       
       if ($password === $row['password']) {
    session_regenerate_id(true); // optional
    $_SESSION['loged'] = $row['email'];
    header("Location: index2.php");
    exit();
} else {
    $msg = "Invalid password!";
}

    } else {
        $msg = "Email not found!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Admin Login</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap 5 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
   <link href="login.css" rel="stylesheet">
  <style>
   
  </style>
</head>
<body>

<div class="bg"></div>

<div class="container">
  <div class="center-form">
    <h2>Admin Login</h2>

    <?php if (!empty($msg)): ?>
      <div class="alert alert-danger text-center">
        <?php echo htmlspecialchars($msg); ?>
      </div>
    <?php endif; ?>

    <form method="post">
      <div class="mb-3">
        <input type="email" class="form-control" id="email" placeholder="Enter email" name="email" required>
      </div>
      <div class="mb-3">
        <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="pwd" required>
      </div>
      <button type="submit" class="btn btn-dark w-100">Login</button>
    </form>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
