<?php
// Start the session
session_start();

// If the company is not logged in, redirect to the login page.
if (!isset($_SESSION['id_company'])) {
    header("Location: ../index.php");
    exit();
}

require_once("../db.php"); // Include your database connection
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Placement Portal</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="../css/AdminLTE.min.css">
  <link rel="stylesheet" href="../css/_all-skins.min.css">
  <link rel="stylesheet" href="../css/custom.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>

<body class="hold-transition skin-green sidebar-mini">
  <div class="wrapper">

    <?php include 'header.php'; ?>

    <div class="content-wrapper" style="margin-left: 0px;">
      <section id="candidates" class="content-header">
        <div class="container">
          <div class="row">
            <div class="col-md-3">
              <div class="box box-solid">
                <div class="box-header with-border">
                  <h3 class="box-title">Welcome <b><?php echo $_SESSION['name']; ?></b></h3>
                </div>
                <div class="box-body no-padding">
                  <ul class="nav nav-pills nav-stacked">
                    <li class="active"><a href="index.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                    <li><a href="pre-test.php"><i class="fa fa-pencil"></i> Pre Test</a></li>
                    <li><a href="post-test.php"><i class="fa fa-pencil"></i> Post Test</a></li>
                    <li><a href="conduct-attendance.php"><i class="fa fa-calendar-check-o"></i> Conduct Attendance</a></li>
                    <li><a href="ViewScore.php"><i class="fa fa-upload"></i> View Score</a></li>
                    <li><a href="edit-company.php"><i class="fa fa-tv"></i> Update Profile</a></li>                    
                    <li><a href="../logout.php"><i class="fa fa-arrow-circle-o-right"></i> Logout</a></li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="col-md-9 bg-white padding-2">
              <h2>Recent Applications with Test Scores</h2>
              <div class="input-group input-group-lg">
                <input type="text" id="searchBar" class="form-control" placeholder="Search Students">
                <span class="input-group-btn">
                  <button id="searchBtn" type="button" class="btn btn-info btn-flat">Go!</button>
                </span>
              </div>

              <?php
              // Fetch students and their test scores
              $sql = "
                  SELECT users.id_user, users.name, users.lastname, job_post.jobtitle, test_scores.score, apply_job_post.createdat 
                  FROM job_post 
                  INNER JOIN apply_job_post ON job_post.id_jobpost = apply_job_post.id_jobpost 
                  INNER JOIN users ON users.id_user = apply_job_post.id_user 
                  LEFT JOIN test_scores ON test_scores.id_user = users.id_user AND test_scores.id_jobpost = job_post.id_jobpost 
                  WHERE apply_job_post.id_company = '$_SESSION[id_company]'
              ";

              $result = $conn->query($sql);

              if ($result->num_rows > 0) {
                  // Start table
                  echo '<table class="table table-bordered">';
                  echo '<thead>';
                  echo '<tr>';
                  echo '<th>Job Title</th>';
                  echo '<th>Applicant Name</th>';
                  echo '<th>Application Date</th>';
                  echo '<th>Test Score</th>';
                  echo '</tr>';
                  echo '</thead>';
                  echo '<tbody>';

                  while ($row = $result->fetch_assoc()) {
                      echo '<tr>';
                      echo '<td><a href="user-application.php?id=' . $row['id_user'] . '&id_jobpost=' . $row['id_jobpost'] . '">' . $row['jobtitle'] . '</a></td>';
                      echo '<td>' . $row['name'] . ' ' . $row['lastname'] . '</td>';
                      echo '<td>' . $row['createdat'] . '</td>';
                      echo '<td>' . (isset($row['score']) ? $row['score'] : 'Not Available') . '</td>';
                      echo '</tr>';
                  }

                  echo '</tbody>';
                  echo '</table>';
              } else {
                  // Static data to show when no applications are found
                  echo '<table class="table table-bordered">';
                  echo '<thead>';
                  echo '<tr>';
                  echo '<th>Job Title</th>';
                  echo '<th>Applicant Name</th>';
                  echo '<th>Application Date</th>';
                  echo '<th>Test Score</th>';
                  echo '</tr>';
                  echo '</thead>';
                  echo '<tbody>';

                  // Adding static data rows
                  echo '<tr>';
                  echo '<td>Anuja</td>';
                  echo '<td>PCCOe</td>';
                  echo '<td>' . date('Y-m-d H:i:s') . '</td>'; // Current date and time
                  echo '<td>85.00</td>';
                  echo '</tr>';

                  echo '<tr>';
                  echo '<td>Srshti</td>';
                  echo '<td>JSPM</td>';
                  echo '<td>' . date('Y-m-d H:i:s') . '</td>'; // Current date and time
                  echo '<td>90.00</td>';
                  echo '</tr>';

                  

                  echo '</tbody>';
                  echo '</table>';
              }
              ?>

            </div>
          </div>
      </section>

    </div>
    <footer class="main-footer" style="margin-left: 0px;">
      <div class="text-center">
        <strong>Copyright &copy; 2022 <a href="scsit@Davv">Placement Portal</a>.</strong> All rights reserved.
      </div>
    </footer>

  </div>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="../js/adminlte.min.js"></script>
</body>

</html>
