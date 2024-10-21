<?php
session_start();

if (isset($_SESSION['id_user']) || isset($_SESSION['id_company'])) {
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Placement Portal</title>
    <link href="img/logo.png" rel="icon">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="css/AdminLTE.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/iCheck/1.0.2/skins/square/blue.css">
    <script src="https://cdn.tailwindcss.com"></script>

    <?php include 'php/head.php'; ?>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

    <style>
        body {
            font-size: 18px; /* Default font size for body */
        }

        .login-box-msg {
            font-size: 2rem; /* Increase the size of login message */
        }

        .form-control {
            font-size: 1.2rem; /* Larger input field text */
        }

        .btn-signin {
            font-size: 1.2rem; /* Larger button text */
        }

        .bg-blue-200 {
            background-color: #90caf9 !important; /* Adjust background color */
        }

        .bg-blue-100 {
            background-color: #e3f2fd !important; /* Adjust background color */
        }

        .text-black {
            color: #333 !important; /* Darker text color for contrast */
        }

        #successMessage {
            font-size: 1.1rem; /* Larger success message text */
        }
    </style>
</head>

<body class="hold-transition login-page bg-blue-100 text-white">

    <?php include 'php/header.php'; ?>

    <div class="login-box hello">
        <div class="login-logo">
            <a href="index.php" class="text-black text-3xl"><b>Placement Portal</b></a>
        </div>
        
        <div class="login-box-body bg-blue-200 text-black p-4 rounded-lg shadow-lg">
            <p class="login-box-msg">Student Login</p>

            <form method="post" action="checklogin.php" class="text-xl">
                <div class="form-group has-feedback">
                    <input type="email" class="form-control" name="email" placeholder="Email" required>
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="password" class="form-control" name="password" placeholder="Password" required>
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                
                <div class="row">
                    <div class="col-xs-8">
                        <a href="#">Forgot your password?</a>
                    </div>
                    <div class="col-xs-4">
                        <button type="submit" class="btn btn-signin flex mx-auto mt-6 text-white bg-indigo-500 border-0 py-2 px-5 focus:outline-none hover:bg-indigo-600 rounded">Sign In</button>
                    </div>
                </div>
            </form>

            <br>

            <!-- Success/Error Messages -->
            <div class="text-center">
                <?php if (isset($_SESSION['registerCompleted'])): ?>
                    <p id="successMessage">You Have Registered Successfully! Your Account Approval Is Pending By Placement-Officer</p>
                    <?php unset($_SESSION['registerCompleted']); endif; ?>

                <?php if (isset($_SESSION['loginError'])): ?>
                    <p>Invalid Email/Password! Try Again!</p>
                    <?php unset($_SESSION['loginError']); endif; ?>

                <?php if (isset($_SESSION['userActivated'])): ?>
                    <p>Your Account Is Active. You Can Login</p>
                    <?php unset($_SESSION['userActivated']); endif; ?>

                <?php if (isset($_SESSION['loginActiveError'])): ?>
                    <p><?php echo $_SESSION['loginActiveError']; ?></p>
                    <?php unset($_SESSION['loginActiveError']); endif; ?>
            </div>
        </div>

        <a class="text-xl text-black" href="register-candidates.php" style="font-size:20px ; margin-top :10px">Not Register - Create new account</a>
    </div>

    <!-- jQuery 3 -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <!-- AdminLTE App -->
    <script src="js/adminlte.min.js"></script>
    <!-- iCheck -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/iCheck/1.0.2/icheck.min.js"></script>
    <script>
        $(function() {
            $('input').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue',
                increaseArea: '20%' // optional
            });
        });

        $(function() {
            $("#successMessage:visible").fadeOut(8000);
        });
    </script>

    <?php include 'php/footer.php'; ?>
</body>

</html>
