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
    <title>My Applications - Placement Portal</title>
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
                                        <li class="active"><a href="index.php"><i class="fa fa-address-card-o"></i> My Applications</a></li>
                                        <li><a href="mailbox.php"><i class="fa fa-envelope"></i> Mailbox</a></li>
                                        <li><a href="settings.php"><i class="fa fa-gear"></i> Settings</a></li>
                                        <li><a href="take-test.php"><i class="fa fa-pencil"></i> Take Test</a></li>
                                        <li><a href="view-scores.php"><i class="fa fa-bar-chart"></i> View Scores</a></li>
                                        <li><a href="view-attendance.php"><i class="fa fa-calendar-check-o"></i> View Attendance</a></li>
                                        <li><a href="../logout.php"><i class="fa fa-arrow-circle-o-right"></i> Logout</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-9 bg-white padding-2">
                            <h2>My Applications</h2>
                            <p>Below you will find the applications you have submitted.</p>

                            <?php
                            $sql = "SELECT * FROM applications WHERE user_id='$_SESSION[id_user]'";
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo "<div class='attachment-block clearfix padding-2'>";
                                    echo "<h4 class='attachment-heading'><a href='view-application.php?id={$row['id']}'>Application for {$row['job_title']}</a></h4>";
                                    echo "<div class='attachment-text padding-2'>";
                                    echo "<div class='pull-left'><i class='fa fa-calendar'></i> {$row['submitted_date']}</div>";
                                    
                                    if ($row['status'] == 'accepted') {
                                        echo "<div class='pull-right'><strong class='text-green'>Accepted</strong></div>";
                                    } else if ($row['status'] == 'rejected') {
                                        echo "<div class='pull-right'><strong class='text-red'>Rejected</strong></div>";
                                    } else {
                                        echo "<div class='pull-right'><strong class='text-orange'>Pending</strong></div>";
                                    }
                                    echo "</div></div></div>";
                                }
                            } else {
                                echo "<div class='alert alert-info'>No applications found.</div>";
                            }
                            ?>
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
