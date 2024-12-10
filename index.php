<?php
// Start a session for login management
session_start();
include 'shared/conn.php';
include 'shared/header.php';
// Check if user has submitted the login form
if (isset($_POST['login'])) {
  $name = mysqli_real_escape_string($connection, $_POST["email"]);
  $password = mysqli_real_escape_string($connection, $_POST["password"]);
  // Query to fetch admin credentials
  $select = "SELECT * FROM admins WHERE admin_email = '$name' AND admin_pass = '$password'";
  $result = mysqli_query($connection, $select);
  if (mysqli_num_rows($result) > 0) {
    // If login is successful, store session variables
    $_SESSION["emailadmin"] = $name;
    $_SESSION["is_logged_in"] = true; // Indicate admin is logged in
    // Redirect to students_data page
    header("Location: admin/students_data.php");
    exit();
  } else {
    // Display an error message for incorrect credentials
    echo "<div style='color: white; background: #1879c9; text-align: center;'>Incorrect Email or Password! Try again</div>";
  }
}
?>


<body class="login-body">
  <header>
    <div class="logo">
      <img src="../photos/Logo-removebg-preview.png" alt="Logo" />
    </div>
    <div class="container">
      <nav class="navbar"></nav>
    </div>
  </header>
  <div class="login-box">
    <h2>Admin</h2>
    <form method="POST">
      <div class="user-box">
        <label>Email</label>
        <input type="text" name="email" required />
      </div>
      <div class="user-box">
        <label>Password</label>
        <input type="password" name="password" required />
      </div>
      <button type="submit" name="login">Log in </button>
    </form>
  </div>
</body>

<?php
include 'shared/footer.php';
?>