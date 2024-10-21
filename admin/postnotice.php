<?php
session_start();
require_once("../db.php");

if (isset($_POST['submit'])) {
    $subject = $_POST['subject'];
    $notice = $_POST['input'];
    $audience = $_POST['audience'];

    $folder_dir = "../uploads/resume/";
    $base = basename($_FILES['resume']['name']);
    $resumeFileType = pathinfo($base, PATHINFO_EXTENSION);
    $file = uniqid() . "." . $resumeFileType;
    $filename = $folder_dir . $file;

    if (file_exists($_FILES['resume']['tmp_name'])) {
        move_uploaded_file($_FILES["resume"]["tmp_name"], $filename);
    }

    $hash = md5(uniqid());
    $sql = "INSERT INTO notice(subject, notice, audience, resume, hash, `date`) VALUES ('$subject', '$notice', '$audience', '$file', '$hash', NOW())";

    if ($conn->query($sql) === TRUE) {
        include 'sendmail.php';
        header("Location: postnotice.php");
        exit();
    }
}
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
    <link rel="stylesheet" href="css/AdminLTE.min.css">
    <link rel="stylesheet" href="css/_all-skins.min.css">
    <link rel="stylesheet" href="css/custom.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700">
    <style>
        body {
            background-color: white;
        }

        .centre {
            margin: 20px;
            padding: 20px;
            border: 2px solid black;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        #subject {
            width: 100%;
            margin-bottom: 15px;
        }

        .option {
            width: 100%;
            margin-bottom: 15px;
        }

        .input {
            height: 200px;
            width: 100%;
            border-radius: 5px;
            background-color: white;
            margin-bottom: 15px;
        }

        .btn-submit {
            width: 100%;
        }

        @media screen and (max-width: 768px) {
            .centre {
                width: 90%;
            }
        }
    </style>
</head>

<body class="hold-transition skin-green sidebar-mini">
    <?php include 'header.php'; ?>

    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-md-6">
                <section>
                    <div class="alert alert-success alert-dismissible" style="display: none;" id="truemsg">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h4><i class="icon fa fa-check"></i> Success!</h4>
                        New Notice Successfully added
                    </div>

                    <form action="" method="POST" enctype="multipart/form-data" class="centre">
                        <h4><strong>Post a new notice</strong></h4>

                        <input id="subject" placeholder="Subject" type="text" name="subject" required>
                        
                        <div class="form-group">
                            <input type="file" name="resume" class="btn btn-primary">
                        </div>

                        <div class="form-group">
                            <textarea class="input" name="input" id="input" placeholder="Notice" required></textarea>
                        </div>

                        <div class="form-group">
                            <label>Audience</label>
                            <select class="form-control option" name="audience">
                                <option value="All Students">All Students</option>
                                <option value="Co-ordinators">Co-ordinators</option>
                            </select>
                        </div>

                        <button class="btn btn-primary btn-submit" id="submit" name="submit" type="submit">NOTIFY</button>
                    </form>
                </section>
            </div>

            <div class="col-xs-12 col-md-6">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Posted Notice</h3>
                    </div>
                    <div class="box-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Subject</th>
                                    <th>Notice</th>
                                    <th>Audience</th>
                                    <th>File</th>
                                    <th>Date and Time</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sql = "SELECT * FROM notice";
                                $result = $conn->query($sql);
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                ?>
                                        <tr>
                                            <td><?php echo $row['subject']; ?></td>
                                            <td><?php echo $row['notice']; ?></td>
                                            <td><?php echo $row['audience']; ?></td>
                                            <td>
                                                <?php if ($row['resume'] != '') { ?>
                                                    <a href="../uploads/resume/<?php echo $row['resume']; ?>" download="<?php echo 'Notice'; ?>">
                                                        <i class="fa fa-file"></i>
                                                    </a>
                                                <?php } else { ?>
                                                    No Resume Uploaded
                                                <?php } ?>
                                            </td>
                                            <td><?php echo $row['date']; ?></td>
                                            <td>
                                                <a id="delete" href="deletenotice.php?id=<?php echo $row['id']; ?>">
                                                    <i class="fa fa-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                <?php
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="main-footer">
        <div class="text-center">
            <strong>Copyright &copy; 2022 Placement Portal</strong> All rights reserved.
        </div>
    </footer>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="../js/adminlte.min.js"></script>
</body>

</html>
