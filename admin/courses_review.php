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

// Delete course
if (isset($_GET['deleteid'])) {
  $course_id = $_GET['deleteid'];

  // Prevent SQL injection by checking if the ID is numeric
  if (is_numeric($course_id)) {
    // Prepare and execute the delete query
    $delete_query = "DELETE FROM courses WHERE id = ?";
    $stmt = mysqli_prepare($connection, $delete_query);
    mysqli_stmt_bind_param($stmt, "i", $course_id);

    if (mysqli_stmt_execute($stmt)) {
      header("Location: courses_data.php"); // Redirect to the page after deletion
      exit();
    } else {
      echo "<div style='color: red;'>Failed to delete the course!</div>";
    }

    mysqli_stmt_close($stmt);
  } else {
    echo "<div style='color: red;'>Invalid course ID.</div>";
  }
}

// Initialize search variable
$searchTerm = '';
if (isset($_POST['search'])) {
  $searchTerm = $_POST['courseId'];  // Get the course ID from search input
}

// Fetch courses' data from the database with optional filtering by course ID
$query = "SELECT * FROM courses";
if ($searchTerm != '') {
  if (is_numeric($searchTerm)) {
    $query .= " WHERE id = $searchTerm";  // Filter by course ID if it's numeric
  } else {
    echo "<div style='color: red;'>Please enter a valid course ID.</div>";
  }
}
$result = mysqli_query($connection, $query);

// Check if there are any records
if (mysqli_num_rows($result) > 0) {

  // Search form
  echo '<form method="POST" action="">
            <input type="text" name="courseId" placeholder="Enter Course ID" value="' . htmlspecialchars($searchTerm) . '" />
            <button type="submit" name="search">Search <em class="uil uil-search button_icon"></em></button>
          </form>';

  // Table for displaying course data
  echo '<table class="table" style="width:99%" id="myTable">
            <thead>
              <tr>
                <th id="courseId">ID</th>
                <th id="courseName">Course Name</th>
                <th id="courseInstructor">Instructor</th>
                <th id="courseCredits">Credits</th>
                <th id="courseDepartment">Department</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody id="Body">';

  // Output the data of each row
  while ($row = mysqli_fetch_assoc($result)) {
    echo '<tr>
                <td>' . $row['id'] . '</td>
                <td>' . htmlspecialchars($row['course_name']) . '</td>
                <td>' . htmlspecialchars($row['instructor']) . '</td>
                <td>' . htmlspecialchars($row['credits']) . '</td>
                <td>' . htmlspecialchars($row['department']) . '</td>
                <td>
                    <a href="edit_course.php?editid=' . $row['id'] . '" class="buttonE"> Edit <em class="uil uil-edit button_icon"></em> </a>
                    <a href="courses_data.php?deleteid=' . $row['id'] . '" class="buttonD" onclick="return confirm(\'Are you sure you want to delete this course?\');">
                    Delete <em class="uil uil-trash button_icon"></em></a>
                </td>
              </tr>';
  }

  echo '</tbody>
          </table>';
} else {
  echo "<div style='text-align: center;'>No courses found in the database.</div>";
}

include '../shared/footer.php';