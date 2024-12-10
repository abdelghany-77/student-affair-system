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

// Delete 
if (isset($_GET['deleteid'])) {
  $student_id = $_GET['deleteid'];

  // Ensure no output is sent before this
  $delete = "DELETE FROM students WHERE id = $student_id";
  $checkDelete = mysqli_query($connection, $delete);

  if ($checkDelete) {
    // Redirect to refresh the page
    header("Location: students_data.php");
    exit(); // Stop further execution after redirection
  } else {
    echo "<div style='color: red;'>Failed to delete the student!</div>";
  }
}

// Initialize search variable
$searchTerm = '';
if (isset($_POST['search'])) {
  $searchTerm = $_POST['studentId'];  // Get the student ID from search input
}

// Fetch students' data from the database with optional filtering by student ID
$query = "SELECT * FROM students";
if ($searchTerm != '') {
  $query .= " WHERE id = $searchTerm";  // Filter by student ID
}
$result = mysqli_query($connection, $query);

// Check if there are any records
if (mysqli_num_rows($result) > 0) {

  // Search form
  echo '<form method="POST" action="">
            <input type="text" name="studentId" placeholder="Enter year" value="' . $searchTerm . '" />
            <button type="submit" name="search">Search <em class="uil uil-search button_icon"></em></button>
          </form>';

  // Table for displaying student data
  echo '<table class="table" style="width:99%" id="myTable">
            <thead>
              <tr>
                <th id="studentId">ID</th>
                <th id="studentName">Student Name</th>
                <th id="studentEmail">Email</th>
                <th id="studentPhone">Phone Number</th>
                <th id="studentNationalId">National ID</th>
                <th  id="studentDate">Birth Day</th>
                <th id="studentGpa">GPA</th>
                <th id="studentGender">Gender</th>
                <th id="studentLevel">Level</th>
                <th id="studentDep">Department</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody id="Body">';

  // Output the data of each row
  while ($row = mysqli_fetch_assoc($result)) {
    echo '<tr>
                <td>' . $row['id'] . '</td>
                <td>' . $row['name'] . '</td>
                <td>' . $row['email'] . '</td>
                <td>' . $row['phone'] . '</td>
                <td>' . $row['national_id'] . '</td>
                <td>'  . $row['dob'] . '</td>
                <td>' . $row['gpa'] . '</td>
                <td>' . $row['gender'] . '</td>
                <td>' . $row['level'] . '</td>
                <td>' . $row['Dep'] . '</td>
                <td>
                    <a href="edit_student.php?editid=' . $row['id'] . '" class="buttonE"> Edit  <em class="uil uil-edit button_icon"></em> </a>
                    <a href="students_data.php?deleteid=' . $row['id'] . '" class="buttonD" onclick="return confirm(\'Are you sure you want to delete this student?\');">
                    Delete <em class="uil uil-trash button_icon"></em></a>
                </td>
              </tr>';
  }

  echo '</tbody>
          </table>';
} else {
  echo "<div style='text-align: center;'>No students found in the database.</div>";
}




include '../shared/footer.php';