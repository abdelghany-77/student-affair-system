<?php
include '../shared/conn.php';
include '../shared/header.php';
include '../shared/nav.php';

// Start session to access session variables
session_start();

// Check if the admin is logged in
if (!isset($_SESSION["is_logged_in"]) || $_SESSION["is_logged_in"] !== true) {
  // Redirect to login page if not logged in
  header("Location: ../index.php");
  exit();
}

// Get the course ID from the URL (editid parameter)
$course_id = $_GET['editid'];

// Fetch the course data from the database
$update = "SELECT * FROM courses WHERE course_id = $course_id";
$select_update = mysqli_query($connection, $update);
$row = mysqli_fetch_assoc($select_update);

// Get the current values for the course to populate the form
$code = $row['code'];
$name = $row['name'];
$hours = $row['hours'];
$year = $row['year'];
$grade = $row['grade'];
$term_work = $row['term_work'];
$exam_work = $row['exam_work'];
$result = $row['result'];
$level = $row['level'];
$term = $row['term'];

// Update course data after form submission
if (isset($_POST['update'])) {
  $code = $_POST['code'];
  $name = $_POST['name'];
  $hours = $_POST['hours'];
  $year = $_POST['year'];
  $grade = $_POST['grade'];
  $term_work = $_POST['term_work'];
  $exam_work = $_POST['exam_work'];
  $level = $_POST['level'];
  $term = $_POST['term'];

  // Update query to modify the course's data
  $update_query = "UPDATE courses SET 
        code = '$code',
        name = '$name',
        hours = $hours,
        year = '$year',
        grade = $grade,
        term_work = $term_work,
        exam_work = $exam_work,
        level = '$level',
        term = '$term'
        WHERE course_id = $course_id";

  // Execute the update query
  if (mysqli_query($connection, $update_query)) {
    header("Location: courses_data.php"); // Redirect to the courses data page
    exit();  // Stop further code execution
  } else {
    echo "Error: " . mysqli_error($connection);  // If there's an error
  }
}

?>

<div class="insert-box">
  <h2>Edit Course</h2>
  <form method="POST" action="">
    <div class="user-box">
      <input type="text" name="code" required value="<?php echo $code; ?>" />
      <label for="code">Course Code</label>
    </div>
    <div class="user-box">
      <input type="text" name="name" required value="<?php echo $name; ?>" />
      <label for="name">Course Name</label>
    </div>
    <div class="user-box">
      <input type="number" name="hours" required value="<?php echo $hours; ?>" />
      <label for="hours">Credit Hours</label>
    </div>
    <div class="user-box">
      <input type="number" name="year" required value="<?php echo $year; ?>" />
      <label for="year">Academic Year</label>
    </div>
    <div class="user-box">
      <input type="number" name="grade" required value="<?php echo $grade; ?>" />
      <label for="grade">Grade</label>
    </div>
    <div class="user-box">
      <input type="number" name="term_work" required value="<?php echo $term_work; ?>" />
      <label for="term_work">Term Work</label>
    </div>
    <div class="user-box">
      <input type="number" name="exam_work" required value="<?php echo $exam_work; ?>" />
      <label for="exam_work">Exam Work</label>
    </div>
    <div class="user-box">
      <label for="level">Level: </label>
      <br>
      <select id="level" name="level">
        <option value="1" <?php if ($level == "1") echo "selected"; ?>>1</option>
        <option value="2" <?php if ($level == "2") echo "selected"; ?>>2</option>
        <option value="3" <?php if ($level == "3") echo "selected"; ?>>3</option>
        <option value="4" <?php if ($level == "4") echo "selected"; ?>>4</option>
      </select>
    </div>
    <div class="user-box">
      <label for="term">Term: </label>
      <br>
      <select id="term" name="term">
        <option value="1" <?php if ($term == "1") echo "selected"; ?>>First Term</option>
        <option value="2" <?php if ($term == "2") echo "selected"; ?>>Second Term</option>
      </select>
    </div>
    <br><br>
    <button type="submit" name="update">Save<em class="uil uil-save button_icon"></em></button>
  </form>
</div>

<?php
include '../shared/footer.php';
?>