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

// Insert operation for adding a course
if (isset($_POST['add_course'])) {
  $code = $_POST['code'];
  $name = $_POST['name'];
  $hours = $_POST['hours'];
  $year = $_POST['year'];
  $grade = $_POST['grade'];
  $term_work = $_POST['term_work'];
  $exam_work = $_POST['exam_work'];
  $result = $_POST['result'];
  $level = $_POST['level'];
  $term = $_POST['term'];

  $insert_course = "INSERT INTO courses (code, name, hours, year, grade, term_work, exam_work, result, level, term) 
                    VALUES ('$code', '$name', $hours, '$year', '$grade', $term_work, $exam_work, '$result', '$level', '$term')";
  $result = mysqli_query($connection, $insert_course);
  if ($result) {
    echo "<div style='color: green; text-align: center;'>Course added successfully!</div>";
  } else {
    echo "<div style='color: red; text-align: center;'>Error adding course: " . mysqli_error($connection) . "</div>";
  }
}
?>

<div class="insert-box">
  <h2>Add New Course</h2>
  <form method="POST" action="">
    <div class="user-box">
      <input type="text" name="code" required />
      <label for="code">Course Code</label>
    </div>
    <div class="user-box">
      <input type="text" name="name" required />
      <label for="name">Course Name</label>
    </div>
    <div class="user-box">
      <input type="number" name="hours" required />
      <label for="hours">Credit Hours</label>
    </div>
    <div class="user-box">
      <input type="number" name="year" required />
      <label for="year">Year</label>
    </div>
    <div class="user-box">
      <input type="number" name="grade" step="0.01" required />
      <label for="grade">Grade</label>
    </div>
    <div class="user-box">
      <input type="number" name="term_work" step="0.01" required />
      <label for="term_work">Term Work</label>
    </div>
    <div class="user-box">
      <input type="number" name="exam_work" step="0.01" required />
      <label for="exam_work">Exam Work</label>
    </div>
    <div class="user-box">
      <select name="result" required>
        <option value="Pass">Pass</option>
        <option value="Fail">Fail</option>
      </select>
      <label for="result">Result</label>
      <br>
    </div>
    <br>
    <div class="user-box">
      <select name="level" required>
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
      </select>
      <label for="level">Level</label>
      <br>
    </div>
    <br>
    <div class="user-box">
      <select name="term" required>
        <br>
        <option value="Fall">Fall</option>
        <option value="Spring">Spring</option>
        <option value="Summer">Summer</option>
      </select>
      <label for="term">Term</label>
      <br>
    </div>
    <br>
    <br>
    <button type="submit" name="add_course">Add Course</button>
    <button type="reset">Reset</button>
  </form>
</div>

<?php
include '../shared/footer.php';
?>