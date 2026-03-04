<?php include_once("header.php"); ?>

<?php
$conn = mysqli_connect("localhost", "root", "", "workshop") or die("Check the database");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Use prepared statement to avoid SQL injection
    $stmt = $conn->prepare("SELECT id, password FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        // Verify hashed password
        if (password_verify($password, $row['password'])) {
            $_SESSION['loged'] = $email; // set session
            header("Location: index.php");
            exit;
        } else {
            $msg = "Invalid Email or Password!";
        }
    } else {
        $msg = "Invalid Email or Password!";
    }
}
?>

<html>
<head>
  <title>Netflix India</title>
  
</head>
<body>

  
  <div class="login-page">
    <div class="login_container">
      <div class="login_label">Login</div>
      <?php if(isset($msg)) { ?>
        <div class="error" style="display:block;"><?php echo $msg; ?></div>
      <?php } ?>
      <form method="post" onsubmit="return valid();">
        
        <div class="field_label">Email</div>
        <div class="field_value">
          <input type="text" id="email" name="email" placeholder="Enter Email or Mobile">
          <div class="error" id="error_email"></div>
        </div>

        <div class="field_label">Password</div>
        <div class="field_value password-wrapper">
          <input type="password" id="password" name="password" placeholder="Enter Password">
          <span class="toggle-password" onclick="togglePass()">👁</span>
          <div class="error" id="error_password"></div>
        </div>

        <button type="submit" class="btn-netflix">Login</button>

        <div class="signup-link">
          New to Netflix? <a href="register.php">Sign up now</a>
        </div>
      </form>
    </div>
  </div>

    <?php include("footer.php"); ?>

  <script>
    function valid() {
      let email = document.getElementById("email").value.trim();
      let password = document.getElementById("password").value.trim();
      let valid = true;

      if(email === "") {
        document.getElementById("error_email").innerHTML = "Please enter your Email or Mobile";
        document.getElementById("error_email").style.display = "block";
        valid = false;
      } else {
        document.getElementById("error_email").style.display = "none";
      }

      if(password === "") {
        document.getElementById("error_password").innerHTML = "Please enter your Password";
        document.getElementById("error_password").style.display = "block";
        valid = false;
      } else {
        document.getElementById("error_password").style.display = "none";
      }

      return valid;
    }

    function togglePass() {
      const passField = document.getElementById("password");
      if (passField.type === "password") {
        passField.type = "text";
      } else {
        passField.type = "password";
      }
    }
  </script>

</body>
</html>
