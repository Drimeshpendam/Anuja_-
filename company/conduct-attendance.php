<?php
// Start the session
session_start();

// If the company is not logged in, redirect to the login page.
if (!isset($_SESSION['id_company'])) {
    header("Location: ../index.php");
    exit();
}

require_once("../db.php"); // Include your database connection

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Handle attendance submission
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['attendance_date'])) {
    $attendance_date = $_POST['attendance_date'];
    
    // Check if attendance data exists
    if (isset($_POST['attendance']) && is_array($_POST['attendance'])) {
        $attendance_data = $_POST['attendance'];

        foreach ($attendance_data as $id_user => $status) {
            // Prepare and execute the SQL statement to save attendance
            $sql = "INSERT INTO attendance (id_user, attendance_date, status) VALUES (?, ?, ?) ON DUPLICATE KEY UPDATE status = ?";
            $stmt = $conn->prepare($sql);
            if ($stmt) {
                $stmt->bind_param("isss", $id_user, $attendance_date, $status, $status);
                $stmt->execute();
                $stmt->close();
            }
        }
        
        header("Location: conduct-attendance.php?success=Attendance recorded successfully!");
        exit();
    } else {
        header("Location: conduct-attendance.php?error=No attendance data found.");
        exit();
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Conduct Attendance</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/AdminLTE.min.css">
    <link rel="stylesheet" href="../css/_all-skins.min.css">
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
                        <h2>Conduct Attendance</h2>

                        <!-- Display success/error messages -->
                        <?php if (isset($_GET['success'])): ?>
                            <div class="alert alert-success"><?php echo $_GET['success']; ?></div>
                        <?php endif; ?>

                        <?php if (isset($_GET['error'])): ?>
                            <div class="alert alert-danger"><?php echo $_GET['error']; ?></div>
                        <?php endif; ?>

                        <!-- Attendance Date Form -->
                        <form method="POST">
                            <div class="form-group">
                                <label for="attendance_date">Attendance Date:</label>
                                <input type="date" class="form-control" id="attendance_date" name="attendance_date" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Fetch Students</button>
                        </form>

                        <?php
                        // Fetch students when date is provided
                        // Fetch students when date is provided
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['attendance_date'])) {
    $attendance_date = $_POST['attendance_date'];

    // Fetch students
    $sql = "SELECT * FROM users WHERE role = 'student'"; // Adjust according to your schema
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo '<form method="POST" action="conduct-attendance.php">';
        echo '<input type="hidden" name="attendance_date" value="' . htmlspecialchars($attendance_date) . '">';
        while ($row = $result->fetch_assoc()) {
            echo '<div class="form-group">';
            echo '<label>' . htmlspecialchars($row['firstname'] . ' ' . $row['lastname']) . '</label>';
            echo '<select name="attendance[' . $row['id_user'] . ']" class="form-control">';
            echo '<option value="Present">Present</option>';
            echo '<option value="Absent">Absent</option>';
            echo '</select>';
            echo '</div>';
        }
        echo '<button type="submit" class="btn btn-success">Submit Attendance</button>';
        echo '</form>';
    } else {
        echo '<p>No students found.</p>';
    }
}

                        ?>
                    </div>
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
