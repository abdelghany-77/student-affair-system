<?php
include '../shared/conn.php';
include '../shared/headers.php';
include '../shared/navs.php';
// Start session to access session variables
session_start();

// Check if the admin is logged in
if (!isset($_SESSION["is_logged_in"]) || $_SESSION["is_logged_in"] !== true) {
  // Redirect to login page if not logged in
  header("Location: ../index.php");
  exit();
}

// Insert operation
if (isset($_POST['submit'])) {
  $studentName = $_POST['studentName'];
  $studentEmail = $_POST['studentEmail'];
  $studentPhone = $_POST['studentPhone'];
  $nationalid = $_POST['nationalid'];
  $studentDate = $_POST['studentDate'];
  $studentGpa = $_POST['studentGpa'];
  $gender = $_POST['gender'];
  $level = $_POST['level'];
  $Dep = $_POST['Dep'];

  // SQL query to insert data into the students table
  $insert = "INSERT INTO students 
    (name, email, phone, national_id, dob, gpa, gender, level, Dep) 
    VALUES ('$studentName', '$studentEmail', '$studentPhone', '$nationalid', '$studentDate',
    '$studentGpa', '$gender', '$level','$Dep')";

  $checkInsert = mysqli_query($connection, $insert);

  if ($checkInsert) {
    echo "<div style='color: green; text-align: center;'>Successfully inserted!</div>";
  } else {
    echo "<div style='color: red; text-align: center;'>Failed to insert: " . mysqli_error($connection) . "</div>";
  }
}
?>
<title>Add Courses</title>

<div class="insert-box">
  <h2>Register New Course</h2>
  <form method="POST" action="">
    <div class="user-box">
      <input type="text" name="studentName" required value="" />
      <label for="studentName">Name</label>
    </div>
    <div class="user-box">
      <input type="email" name="studentEmail" required value="" />
      <label for="studentEmail">Email</label>
    </div>
    <div class="user-box">
      <input type="text" name="studentPhone" required value="" />
      <label for="studentPhone">Phone Number</label>
    </div>
    <div class="user-box">
      <input type="number" name="nationalid" required value="" />
      <label for="nationalid">National ID</label>
    </div>
    <div class="user-box">
      <input type="date" name="studentDate" required value="" />
      <label for="studentDate">Date of Birth</label>
    </div>
    <div class="user-box">
      <input type="number" name="studentGpa" required value="" step="0.01" max="4" />
      <label for="studentGpa">GPA</label>
    </div>
    <div class="user-box">
      <label>Gender: </label>
      <br>
      <select id="studentGender" name="gender">
        <option value="Male">Male</option>
        <option value="Female">Female</option>
      </select>
    </div>
    <br>
    <div class="user-box">
      <label for="studentLevel">Level: </label>
      <br>
      <select id="studentLevel" name="level">
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        <option value="graduated">Graduated</option>
      </select>
    </div>
    <br>
    <div class="user-box">
      <label for="studentDep">Department: </label>
      <br>
      <select id="studentDep" name="Dep">
        <option value="Genral">General</option>
        <option value="Computer Science">Computer Science(CS)</option>
        <option value="Information System">Information System(IS)</option>
        <option value="Information Technology">Information Technology (IT)</option>
        <option value="Cyber Security">Cyber Security</option>
        <option value="Data Science">Data Science</option>
      </select>
    </div>
    <br>
    <br>
    <button type="submit" name="submit">Submit</button>
    <button type="reset">Reset</button>
  </form>
</div>

<?php
include '../shared/footer.php';
?>