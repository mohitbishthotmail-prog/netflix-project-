<?php
$conn = mysqli_connect("localhost", "root", "", "workshop") or die("DB connection failed");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $username = trim($_POST['username']);
    $email    = trim($_POST['email']);
    $password = trim($_POST['password']);

    if (!empty($username) && !empty($email) && !empty($password)) {
        $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $msg = "Email already registered!";
        } else {
            $hashed = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $username, $email, $hashed);

            if ($stmt->execute()) {
                header("Location: login.php");
                exit;  // stop further execution
            } else {
                $msg = "Something went wrong. Try again.";
            }
        }
        $stmt->close();
    } else {
        $msg = "All fields are required!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Netflix India - Sign Up</title>
  <link href="assets/style/style.css" rel="stylesheet">
</head>
<body>
<body class="body">
  

    <div class="signup-page">
      <div class="signup_container">
        <div class="signup_label">Sign Up</div>
        <?php if(isset($msg)) { ?>
          <div class="error"><?php echo $msg; ?></div>
        <?php } ?>

        <form method="post" onsubmit="return valid();">
          <div class="field_label">Username</div>
          <div class="field_value">
            <input type="text" id="username" name="username" placeholder="Enter Username">
            <div class="error" id="error_username"></div>
          </div>

          <div class="field_label">Email</div>
          <div class="field_value">
            <input type="text" id="email" name="email" placeholder="Enter Email">
            <div class="error" id="error_email"></div>
          </div>

          <div class="field_label">Password</div>
          <div class="field_value">
            <input type="password" id="password" name="password" placeholder="Enter Password">
            <div class="error" id="error_password"></div>
          </div>

          <button type="submit" class="btn-netflix">Sign Up</button>

          <div class="login-link">
            Already have an account? <a href="login.php">Login now</a>
          </div>
        </form>
      </div>
    </div>
  </div> 
</body>


  <script>
    function valid() {
      let username = document.getElementById("username").value.trim();
      let email = document.getElementById("email").value.trim();
      let password = document.getElementById("password").value.trim();
      let valid = true;

      if(username === "") {
        document.getElementById("error_username").innerHTML = "Please enter your Username";
        valid = false;
      } else {
        document.getElementById("error_username").innerHTML = "";
      }

      if(email === "") {
        document.getElementById("error_email").innerHTML = "Please enter your Email";
        valid = false;
      } else {
        document.getElementById("error_email").innerHTML = "";
      }

      if(password === "") {
        document.getElementById("error_password").innerHTML = "Please enter your Password";
        valid = false;
      } else {
        document.getElementById("error_password").innerHTML = "";
      }

      return valid;
    }
  </script>

</body>
</html>
