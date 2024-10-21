<?php
session_start();

if (empty($_SESSION['id_admin'])) {
    header("Location: index.php");
    exit();
}

require_once("../db.php");
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Attendance Monitoring - Placement Portal</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/AdminLTE.min.css">
    <link rel="stylesheet" href="../css/_all-skins.min.css">
    <link rel="stylesheet" href="../css/custom.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body class="hold-transition skin-green sidebar-mini">

    <?php include 'header.php'; ?>

    <div class="content-wrapper">
        <section class="content-header">
            <h1>Attendance Monitoring</h1>
        </section>

        <section class="content">
            <div class="container">
                <div class="row">
                    <div class="col-md-3">
                        <div class="box box-solid">
                            <div class="box-header with-border">
                                <h3 class="box-title">Welcome <b>Admin</b></h3>
                            </div>
                            <div class="box-body no-padding">
                                <ul class="nav nav-pills nav-stacked">
                                    <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                                    
                                    <li><a href="applications.php"><i class="fa fa-address-card-o"></i> Students Profile</a></li>
                                    <li><a href="companies.php"><i class="fa fa-arrow-circle-o-right"></i> Co-Ordinators</a></li>
                                    <li class="active"><a href="attendance.php"><i class="fa fa-calendar-check-o"></i> Attendance Monitoring</a></li>
                                    <li><a href="training-companies.php"><i class="fa fa-building"></i> Training Companies Registered</a></li>
                                    <li><a href="student-scores.php"><i class="fa fa-trophy"></i> Display Scores of Students</a></li>
                                    <li><a href="../logout.php"><i class="fa fa-arrow-circle-o-right"></i> Logout</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9 bg-white padding-2">
                        <h3>Attendance Summary</h3>
                        <div class="row margin-top-20">
                            <div class="col-md-12">
                                <div class="box box-primary">
                                    <div class="box-header with-border">
                                        <h3 class="box-title">Attendance Statistics</h3>
                                    </div>
                                    <div class="box-body">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Student ID</th>
                                                    <th>Student Name</th>
                                                    <th>Total Classes</th>
                                                    <th>Classes Attended</th>
                                                    <th>Attendance Percentage</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                // Summary of attendance percentage for each student
                                                $summary_sql = "
                                                    SELECT s.id AS student_id, s.name, COUNT(a.id) AS total_classes, 
                                                    SUM(CASE WHEN a.status = 'Present' THEN 1 ELSE 0 END) AS classes_attended
                                                    FROM students s
                                                    LEFT JOIN attendance a ON s.id = a.student_id
                                                    GROUP BY s.id
                                                ";
                                                $summary_result = $conn->query($summary_sql);
                                                while ($summary_row = $summary_result->fetch_assoc()) {
                                                    $total_classes = $summary_row['total_classes'];
                                                    $classes_attended = $summary_row['classes_attended'];
                                                    $attendance_percentage = $total_classes > 0 ? round(($classes_attended / $total_classes) * 100, 2) : 0;

                                                    echo "<tr>
                                                            <td>{$summary_row['student_id']}</td>
                                                            <td>{$summary_row['name']}</td>
                                                            <td>{$total_classes}</td>
                                                            <td>{$classes_attended}</td>
                                                            <td>{$attendance_percentage}%</td>
                                                          </tr>";
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <footer class="main-footer">
        <div class="text-center">
            <strong>Copyright &copy; 2022 <a href="learningfromscratch.online">Placement Portal</a>.</strong> All rights reserved.
        </div>
    </footer>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="../js/adminlte.min.js"></script>
</body>

</html>
