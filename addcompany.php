<?php

// To Handle Session Variables on This Page
session_start();

// Including Database Connection From db.php file to avoid rewriting in all files
require_once("db.php");

// If user clicked register button
if (isset($_POST)) {

    // Escape Special Characters In String First
    $companyname = mysqli_real_escape_string($conn, $_POST['company_name']);
    $contactno = mysqli_real_escape_string($conn, $_POST['contactno']);
    $website = mysqli_real_escape_string($conn, $_POST['website']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    
    $country = mysqli_real_escape_string($conn, $_POST['country']);
    $state = mysqli_real_escape_string($conn, $_POST['state']);
    $city = mysqli_real_escape_string($conn, $_POST['city']);
    
    $aboutme = mysqli_real_escape_string($conn, $_POST['aboutme']);
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $course_offered = mysqli_real_escape_string($conn, $_POST['course_offered']);
    $budget = mysqli_real_escape_string($conn, $_POST['budget']);

    // Encrypt Password
    $password = base64_encode(strrev(md5($password)));

    // SQL query to check if email already exists
    $sql = "SELECT email FROM company WHERE email='$email'";
    $result = $conn->query($sql);

    // If email not found, insert new data
    if ($result->num_rows == 0) {

        // Variable to catch upload errors
        $uploadOk = true;

        // Folder where you want to save your image and brochure
        $folder_dir = "uploads/logo/";
        $brochure_dir = "uploads/brochures/";

        // Handle image upload
        $base = basename($_FILES['image']['name']);
        $imageFileType = pathinfo($base, PATHINFO_EXTENSION);
        $imageFile = uniqid() . "." . $imageFileType;
        $filename = $folder_dir . $imageFile;

        if (file_exists($_FILES['image']['tmp_name'])) {
            if ($imageFileType == "jpg" || $imageFileType == "png") {
                if ($_FILES['image']['size'] < 500000) { // 5MB limit
                    move_uploaded_file($_FILES["image"]["tmp_name"], $filename);
                } else {
                    $_SESSION['uploadError'] = "Wrong Size. Max Size Allowed: 5MB";
                    $uploadOk = false;
                }
            } else {
                $_SESSION['uploadError'] = "Wrong Format. Only jpg & png Allowed";
                $uploadOk = false;
            }
        } else {
            $_SESSION['uploadError'] = "Something Went Wrong. File Not Uploaded. Try Again.";
            $uploadOk = false;
        }

        // Handle brochure upload
        $brochureFile = basename($_FILES['brochure']['name']);
        $brochureFileType = pathinfo($brochureFile, PATHINFO_EXTENSION);
        $brochureFileName = uniqid() . "." . $brochureFileType;
        $brochureFilename = $brochure_dir . $brochureFileName;

        if (file_exists($_FILES['brochure']['tmp_name'])) {
            if ($brochureFileType == "pdf" || $brochureFileType == "doc" || $brochureFileType == "docx") {
                if ($_FILES['brochure']['size'] < 5000000) { // 5MB limit
                    move_uploaded_file($_FILES["brochure"]["tmp_name"], $brochureFilename);
                } else {
                    $_SESSION['uploadError'] = "Brochure Too Large. Max Size Allowed: 5MB";
                    $uploadOk = false;
                }
            } else {
                $_SESSION['uploadError'] = "Wrong Format. Only pdf, doc, and docx Allowed";
                $uploadOk = false;
            }
        } else {
            $_SESSION['uploadError'] = "Something Went Wrong. Brochure Not Uploaded. Try Again.";
            $uploadOk = false;
        }

        // If there is any error then redirect back
        if ($uploadOk == false) {
            header("Location: register-company.php");
            exit();
        }

        // SQL new registration insert query
        $sql = "INSERT INTO company (name, companyname, country, state, city, contactno, website, email, password, aboutme, logo, course_offered, budget, brochure) 
                VALUES ('$name', '$companyname', '$country', '$state', '$city', '$contactno', '$website', '$email', '$password', '$aboutme', '$imageFile', '$course_offered', '$budget', '$brochureFileName')";

        if ($conn->query($sql) === TRUE) {
            // If data inserted successfully then set session variables and redirect
            $_SESSION['registerCompleted'] = true;
            header("Location: login-company.php");
            exit();
        } else {
            // If data failed to insert, show error
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        // If email found in database, show error
        $_SESSION['registerError'] = true;
        header("Location: register-company.php");
        exit();
    }

    // Close database connection
    $conn->close();
} else {
    // Redirect them back to register page if they didn't click register button
    header("Location: register-company.php");
    exit();
}
