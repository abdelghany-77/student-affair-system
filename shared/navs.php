<?php
include 'conn.php';
include 'headers.php';
?>
<!-- start Nav -->
<header>
  <div class="logo">
    <img src="../photos/navs.png" alt="logo" style="width: 100px; height: 50px;" />
  </div>
  <div class="containerr">
    <nav class="navbar">
      <ul>
        <li>
          <a href="../student/edit.php"><i class="fa fa-user"></i> profile</a>
        </li>
        <li>
          <a href="../student/register_courses.php"><i class="fa fa-plus"></i> Register New course</a>
        </li>
        <li>
          <a href="../student/courses.php"><i class="fa fa-folder"></i> Registered Courses</a>
        </li>
        <li>
          <a href="../student/courses.php"><i class="fa fa-?"></i> Help</a>
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