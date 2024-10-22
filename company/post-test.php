<?php
// Start the session
session_start();

// If the company is not logged in, redirect to the login page.
if (!isset($_SESSION['id_company'])) {
    header("Location: ../index.php");
    exit();
}

require_once("../db.php"); // Ensure you have a db.php file to establish the database connection

// Handle form submission for adding questions
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_question'])) {
    $id_company = $_SESSION['id_company'];
    $test_title = $_POST['test_title'];
    $question = $_POST['question'];
    $option_a = $_POST['option_a'];
    $option_b = $_POST['option_b'];
    $option_c = $_POST['option_c'];
    $option_d = $_POST['option_d'];
    $correct_option = $_POST['correct_option'];

    // Prepare and execute the SQL statement to save the question
    $sql = "INSERT INTO test_questions (id_company, test_title, question, option_a, option_b, option_c, option_d, correct_option) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("isssssss", $id_company, $test_title, $question, $option_a, $option_b, $option_c, $option_d, $correct_option);

    if ($stmt->execute()) {
        $success_message = "Question added successfully!";
    } else {
        $error_message = "Error adding question.";
    }

    $stmt->close();
}

// Fetch tests conducted
$sql_tests = "SELECT * FROM tests WHERE id_company = ?";
$stmt_tests = $conn->prepare($sql_tests);
$stmt_tests->bind_param("i", $_SESSION['id_company']);
$stmt_tests->execute();
$result_tests = $stmt_tests->get_result();
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Placement Portal</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="../css/AdminLTE.min.css">
  <link rel="stylesheet" href="../css/_all-skins.min.css">
  <link rel="stylesheet" href="../css/custom.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700">
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
              <h2>Manage Tests</h2>

              <!-- Display success/error messages -->
              <?php if (isset($success_message)): ?>
                  <div class="alert alert-success"><?php echo $success_message; ?></div>
              <?php endif; ?>

              <?php if (isset($error_message)): ?>
                  <div class="alert alert-danger"><?php echo $error_message; ?></div>
              <?php endif; ?>

              <!-- Form for adding questions -->
              <form method="post">
                  <div class="form-group">
                      <label for="test_title">Test Title:</label>
                      <input type="text" class="form-control" id="test_title" name="test_title" required>
                  </div>
                  <div class="form-group">
                      <label for="question">Question:</label>
                      <textarea class="form-control" id="question" name="question" required></textarea>
                  </div>
                  <div class="form-group">
                      <label for="option_a">Option A:</label>
                      <input type="text" class="form-control" id="option_a" name="option_a" required>
                  </div>
                  <div class="form-group">
                      <label for="option_b">Option B:</label>
                      <input type="text" class="form-control" id="option_b" name="option_b" required>
                  </div>
                  <div class="form-group">
                      <label for="option_c">Option C:</label>
                      <input type="text" class="form-control" id="option_c" name="option_c" required>
                  </div>
                  <div class="form-group">
                      <label for="option_d">Option D:</label>
                      <input type="text" class="form-control" id="option_d" name="option_d" required>
                  </div>
                  <div class="form-group">
                      <label for="correct_option">Correct Option:</label>
                      <select class="form-control" id="correct_option" name="correct_option" required>
                          <option value="A">A</option>
                          <option value="B">B</option>
                          <option value="C">C</option>
                          <option value="D">D</option>
                      </select>
                  </div>
                  <button type="submit" name="add_question" class="btn btn-success">Add Question</button>
              </form>

              <h2>Conducted Tests</h2>
              <table class="table table-bordered">
                  <thead>
                      <tr>
                          <th>Test Title</th>
                          <th>Date Conducted</th>
                          <th>Actions</th>
                      </tr>
                  </thead>
                  <tbody>
                      <?php while ($test = $result_tests->fetch_assoc()): ?>
                          <tr>
                              <td><?php echo htmlspecialchars($test['test_title']); ?></td>
                              <td><?php echo htmlspecialchars($test['date_conducted']); ?></td>
                              <td>
                                  <form method="post" style="display:inline;">
                                      <button type="submit" name="start_test" value="<?php echo $test['id']; ?>" class="btn btn-primary btn-xs">Start Test</button>
                                  </form>
                                  <form method="post" style="display:inline;">
                                      <button type="submit" name="end_test" value="<?php echo $test['id']; ?>" class="btn btn-danger btn-xs">End Test</button>
                                  </form>
                              </td>
                          </tr>
                      <?php endwhile; ?>
                  </tbody>
              </table>

              <h2>Recent Applications</h2>
              <div class="input-group input-group-lg">
                  <input type="text" id="searchBar" class="form-control" placeholder="Search Students">
                  <span class="input-group-btn">
                      <button id="searchBtn" type="button" class="btn btn-info btn-flat">Go!</button>
                  </span>
              </div>

              <?php
              $sql = "SELECT * FROM job_post INNER JOIN apply_job_post ON job_post.id_jobpost=apply_job_post.id_jobpost INNER JOIN users ON users.id_user=apply_job_post.id_user WHERE apply_job_post.id_company='$_SESSION[id_company]'";
              $result = $conn->query($sql);
              if ($result->num_rows > 0) {
                  while ($row = $result->fetch_assoc()) {
              ?>
                  <div class="attachment-block clearfix padding-2">
                      <h4 class="attachment-heading"><a href="user-application.php?id=<?php echo $row['id_user']; ?>&id_jobpost=<?php echo $row['id_jobpost']; ?>"><?php echo $row['jobtitle'] . ' @ (' . $row['firstname'] . ' ' . $row['lastname'] . ')'; ?></a></h4>
                      <div class="attachment-text padding-2">
                          <div class="pull-left"><i class="fa fa-calendar"></i> <?php echo $row['createdat']; ?></div>
                          <?php
                          if ($row['status'] == 0) {
                              echo '<div class="pull-right"><strong class="text-orange">Placed</strong></div>';
                          } else if ($row['status'] == 1) {
                              echo '<div class="pull-right"><strong class="text-red">Rejected</strong></div>';
                          } else if ($row['status'] == 2) {
                              echo '<div class="pull-right"><strong class="text-green">Applied</strong></div>';
                          }
                          ?>
                      </div>
                  </div>
              <?php
                  }
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
