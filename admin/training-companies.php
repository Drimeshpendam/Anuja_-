<?php
session_start();

// Check if the user is not logged in
if (!isset($_SESSION['id_user']) && !isset($_SESSION['id_company'])) {
    // Redirect to login-company.php if not logged in
    header("Location: login-company.php");
    exit();
}

// Include the database connection
require_once("db.php");

// Your page content goes here
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Registered Training Companies - Placement Portal</title>
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
            <h1>Registered Training Companies</h1>
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
                        <h3>Training Companies Overview</h3>
                        <div class="row margin-top-20">
                            <div class="col-md-12">
                                <div class="box box-primary">
                                    <div class="box-header with-border">
                                        <h3 class="box-title">Registered Training Companies</h3>
                                    </div>
                                    <div class="box-body">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Company Name</th>
                                                    <th>Course Offered</th>
                                                    <th>Budget</th>
                                                    <th>Email</th>
                                                    <th>Phone</th>
                                                    <th>Brochure</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php
// Fetch registered training companies from the database
$companies_sql = "SELECT `companyname`, `contactno`, `email`, `course_offered`, `budget`, `brochure` FROM company;";
$companies_result = $conn->query($companies_sql);

if ($companies_result->num_rows > 0) {
    while ($company = $companies_result->fetch_assoc()) {
        echo "<tr>
                <td>{$company['companyname']}</td>
                <td>{$company['course_offered']}</td>
                <td>{$company['budget']}</td>
                <td>{$company['email']}</td>
                <td>{$company['contactno']}</td>
                <td><a href='{$company['brochure']}' target='_blank'>View Brochure</a></td>
                <td>
                    <form method='POST' action='approve_reject_company.php' style='display:inline;'>
                        <input type='hidden' name='company_name' value='{$company['companyname']}'>
                        <button type='submit' name='action' value='approve' class='btn btn-success btn-sm'>Approve</button>
                        <button type='submit' name='action' value='reject' class='btn btn-danger btn-sm'>Reject</button>
                    </form>
                </td>
              </tr>";
    }
} else {
    echo "<tr><td colspan='7'>No records found</td></tr>";
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
