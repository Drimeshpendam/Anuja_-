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
    <title>Student Test Scores - Placement Portal</title>
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
            <h1>Student Test Scores</h1>
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
                                    
                                    <li><a href="attendance.php"><i class="fa fa-calendar-check-o"></i> Attendance Monitoring</a></li>
                                    <li><a href="training-companies.php"><i class="fa fa-building"></i> Training Companies Registered</a></li>
                                    <li><a href="student-scores.php"><i class="fa fa-trophy"></i> Display Scores of Students</a></li>
                                    <li><a href="../logout.php"><i class="fa fa-arrow-circle-o-right"></i> Logout</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9 bg-white padding-2">
                        <h3>Test Score Overview</h3>
                        <div class="row margin-top-20">
                            <div class="col-md-12">
                                <div class="box box-primary">
                                    <div class="box-header with-border">
                                        <h3 class="box-title">Pre-Test and Post-Test Scores</h3>
                                    </div>
                                    <div class="box-body">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Student Name</th>
                                                    <th>Pre-Test Score</th>
                                                    <th>Post-Test Score</th>
                                                    <th>Score Improvement</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                // Fetch scores for all students
                                                $scores_sql = "
                                                    SELECT s.name, ts.pre_test_score, ts.post_test_score
                                                    FROM students s
                                                    LEFT JOIN test_scores ts ON s.id = ts.student_id
                                                ";
                                                $scores_result = $conn->query($scores_sql);
                                                while ($row = $scores_result->fetch_assoc()) {
                                                    $pre_test_score = $row['pre_test_score'] ?? 0;
                                                    $post_test_score = $row['post_test_score'] ?? 0;
                                                    $score_improvement = $post_test_score - $pre_test_score;

                                                    echo "<tr>
                                                            <td>{$row['name']}</td>
                                                            <td>{$pre_test_score}</td>
                                                            <td>{$post_test_score}</td>
                                                            <td>{$score_improvement}</td>
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
