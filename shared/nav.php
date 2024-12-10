<?php
include 'conn.php';
include 'header.php';
?>
<!-- start Nav -->
<header>
  <div class="logo">
    <img src="../photos/Logo-removebg-preview.png" alt="logo" />
  </div>
  <div class="containerr">
    <nav class="navbar">
      <ul>
        <li>
          <a href="../admin/add_student.php"><i class="fa fa-user-plus"></i> Add New student</a>
        </li>
        <li>
          <a href="../admin/students_data.php"><i class="fa fa-folder"></i> Students Data</a>
        </li>
        <li>
          <a href="../admin/add_course.php"><i class="fa fa-plus"></i> Add new course</a>
        </li>
        <li>
          <a href="../admin/courses_review.php"><i class="fa fa-folder"></i> Courses review</a>
        </li>
      </ul>
    </nav>
  </div>
  <div class="logout-btn-container">
    <a href="../shared/logout.php" class="logout-btn">
      Logout
      <em class="uil uil-sign-out-alt button_icon"></em>

    </a>
  </div>
</header>
<!-- End Nav -->