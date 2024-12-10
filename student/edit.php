<?php
include '../shared/conn.php';
include '../shared/headers.php';
include '../shared/navs.php';


// Fetch the student's data from the database
$update = "SELECT * FROM students WHERE id = $id";
$select_update = mysqli_query($connection, $update);
$row = mysqli_fetch_assoc($select_update);

// Get the current values for the student to populate the form
$id = $row['id'];
$name = $row['name'];
$email = $row['email'];
$phone = $row['phone'];
$national_id = $row['national_id'];
$dob = $row['dob'];
$gpa = $row['gpa'];
$gender = $row['gender'];
$level = $row['level'];
$dep = $row['Dep'];

// Update student data after form submission
if (isset($_POST['update'])) {
  $name = $_POST['studentName'];
  $email = $_POST['studentEmail'];
  $phone = $_POST['studentPhone'];
  $national_id = $_POST['nationalid'];
  $dob = $_POST['studentDate'];
  $gpa = $_POST['studentGpa'];
  $gender = $_POST['gender'];
  $level = $_POST['level'];
  $dep = $_POST['Dep'];

  // Update query to modify the student's data
  $update_query = "UPDATE students SET 
        name = '$name',
        email = '$email',
        phone = '$phone',
        national_id = $national_id,
        dob = '$dob',
        gpa = $gpa,
        gender = '$gender',
        level = '$level',
        Dep = '$dep'
        WHERE id = $id";

  // Execute the update query
  if (mysqli_query($connection, $update_query)) {
    header("Location: students_data.php"); // Redirect to the students data page
    exit();  // Stop further code execution
  } else {
    echo "Error: " . mysqli_error($connection);  // If there's an error
  }
}

?>

<div class="insert-box">
  <h2>Edit Student</h2>
  <form method="POST" action="">
    <div class="user-box">
      <input type="text" name="studentName" required value="<?php echo $name; ?>" />
      <label for="studentName">Name</label>
    </div>
    <div class="user-box">
      <input type="email" name="studentEmail" required value="<?php echo $email; ?>" />
      <label for="studentEmail">Email</label>
    </div>
    <div class="user-box">
      <input type="text" name="studentPhone" required value="<?php echo $phone; ?>" />
      <label for="studentPhone">Phone Number</label>
    </div>
    <div class="user-box">
      <input type="number" name="nationalid" required value="<?php echo $national_id; ?>" />
      <label for="nationalid">National ID</label>
    </div>
    <div class="user-box">
      <input type="date" name="studentDate" required value="<?php echo $dob; ?>" />
      <label for="studentDate">Date of Birth</label>
    </div>
    <div class="user-box">
      <input type="number" name="studentGpa" required value="<?php echo $gpa; ?>" step="0.01" max="4" />
      <label for="studentGpa">GPA</label>
    </div>
    <div class="user-box">
      <label>Gender: </label>
      <br>
      <select id="studentGender" name="gender">
        <option value="Male" <?php if ($gender == "Male") echo "selected"; ?>>Male</option>
        <option value="Female" <?php if ($gender == "Female") echo "selected"; ?>>Female</option>
      </select>
    </div>
    <br>
    <div class="user-box">
      <label for="studentLevel">Level: </label>
      <br>
      <select id="studentLevel" name="level">
        <option value="1" <?php if ($level == "1") echo "selected"; ?>>1</option>
        <option value="2" <?php if ($level == "2") echo "selected"; ?>>2</option>
        <option value="3" <?php if ($level == "3") echo "selected"; ?>>3</option>
        <option value="4" <?php if ($level == "4") echo "selected"; ?>>4</option>
        <option value="graduated" <?php if ($level == "graduated") echo "selected"; ?>>Graduated</option>
      </select>
    </div>
    <br>
    <div class="user-box">
      <label for="studentDep">Department: </label>
      <br>
      <select id="studentDep" name="Dep">
        <option value="General" <?php if ($dep == "General") echo "selected"; ?>>General</option>
        <option value="Computer Science" <?php if ($dep == "Computer Science") echo "selected"; ?>>Computer Science (CS)
        </option>
        <option value="Information System" <?php if ($dep == "Information System") echo "selected"; ?>>Information
          System (IS)</option>
        <option value="Information Technology" <?php if ($dep == "Information Technology") echo "selected"; ?>>
          Information Technology (IT)</option>
        <option value="Cyber Security" <?php if ($dep == "Cyber Security") echo "selected"; ?>>Cyber Security</option>
        <option value="Data Science" <?php if ($dep == "Data Science") echo "selected"; ?>>Data Science</option>
      </select>
    </div>
    <br><br>
    <button type="submit" name="update">Save<em class="uil uil-save button_icon"></em></button>
  </form>
</div>

<?php
include '../shared/footer.php';
?>