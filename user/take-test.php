<?php
session_start();
require_once("../db.php");

if (empty($_SESSION['id_user'])) {
    header("Location: ../index.php");
    exit();
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Take Test - Placement Portal</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/AdminLTE.min.css">
    <link rel="stylesheet" href="../css/_all-skins.min.css">
    <link rel="stylesheet" href="../css/custom.css">
</head>

<body class="hold-transition skin-green sidebar-mini">
    <div class="wrapper">
        <?php include 'header.php'; ?>

        <div class="content-wrapper" style="margin-left: 0;">
            <section id="candidates" class="content-header">
                <div class="container">
                    <div class="row">
                        <div class="col-md-3">
                            <div id="star" class="box box-solid">
                                <div class="box-header with-border">
                                    <h3 class="box-title">Welcome <b><?php echo $_SESSION['name']; ?></b></h3>
                                </div>
                                <div class="box-body no-padding">
                                    <ul class="nav nav-pills nav-stacked">
                                        <li><a href="edit-profile.php"><i class="fa fa-user"></i> Edit Profile</a></li>
                                        <li><a href="index.php"><i class="fa fa-address-card-o"></i> My Applications</a></li>
                                        <li><a href="mailbox.php"><i class="fa fa-envelope"></i> Mailbox</a></li>
                                        <li><a href="settings.php"><i class="fa fa-gear"></i> Settings</a></li>
                                        <li><a href="take-test.php"><i class="fa fa-pencil"></i> Take Test</a></li>
                                        <li><a href="view-scores.php"><i class="fa fa-bar-chart"></i> View Scores</a></li>
                                        <li class="active"><a href="view-attendance.php"><i class="fa fa-calendar-check-o"></i> View Attendance</a></li>
                                        <li><a href="../logout.php"><i class="fa fa-arrow-circle-o-right"></i> Logout</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-9 bg-white padding-2">
                            <h2>Take a Test</h2>
                            <p>Choose a test below:</p>
                            <!-- Sample Test Selection -->
                            <ul class="list-group">
                                <li class="list-group-item">
                                    <a href="test.php?id=1">Test 1: Sample Test</a>
                                </li>
                                <li class="list-group-item">
                                    <a href="test.php?id=2">Test 2: Sample Test</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <!-- /.content-wrapper -->

        <footer class="main-footer" style="margin-left: 0;">
            <div class="text-center">
                <strong>Copyright &copy; 2022 <a href="learningfromscratch.online">Placement Portal</a>.</strong> All rights reserved.
            </div>
        </footer>
    </div>
    <!-- ./wrapper -->

    <!-- jQuery 3 -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../js/adminlte.min.js"></script>
</body>

</html>
