<?php

//To Handle Session Variables on This Page
session_start();

//Including Database Connection From db.php file to avoid rewriting in all files
require_once("db.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include 'php/head.php'; ?>
    <title>Placement Portal</title>
</head>

<body>

    <?php include 'php/header.php'; ?>
    
    <section id="faq" class="faq">
        <div class="container-fluid" data-aos="fade-up">

            <div class="row gy-4">

                <div class="col-lg-7 d-flex flex-column justify-content-center align-items-stretch order-2 order-lg-1">

                    <div class="content px-xl-5">
                        <h3>Frequently Asked <strong>Questions</strong></h3>
                        <p>
                            Any queries or doubts regarding the <strong>Placement Portal</strong> will be addressed here. Students might get confused regarding the portal and may have queries to be solved.
                        </p>
                    </div>

                    <div class="accordion accordion-flush px-xl-5" id="faqlist">

                        <div class="accordion-item" data-aos="fade-up" data-aos-delay="200">
                            <h3 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-content-1">
                                    <i class="bi bi-question-circle question-icon"></i>
                                    What is the objective of this portal?
                                </button>
                            </h3>
                            <div id="faq-content-1" class="accordion-collapse collapse" data-bs-parent="#faqlist">
                                <div class="accordion-body">
                                    The Placement Cell plays a crucial role in locating job opportunities for undergraduates and postgraduates passing out from the college by keeping in touch with reputed firms and industrial establishments.
                                </div>
                            </div>
                        </div><!-- # Faq item-->

                        <div class="accordion-item" data-aos="fade-up" data-aos-delay="300">
                            <h3 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-content-2">
                                    <i class="bi bi-question-circle question-icon"></i>
                                    Do you find any problem during login or registration?
                                </button>
                            </h3>
                            <div id="faq-content-2" class="accordion-collapse collapse" data-bs-parent="#faqlist">
                                <div class="accordion-body">
                                    Try logging in using your correct credentials. If you have any trouble during registration, you can reach out to us via the contact page.
                                </div>
                            </div>
                        </div><!-- # Faq item-->

                        <div class="accordion-item" data-aos="fade-up" data-aos-delay="400">
                            <h3 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-content-3">
                                    <i class="bi bi-question-circle question-icon"></i>
                                    How much time do I need to wait for the account approval?
                                </button>
                            </h3>
                            <div id="faq-content-3" class="accordion-collapse collapse" data-bs-parent="#faqlist">
                                <div class="accordion-body">
                                    Once the Training and Placement Officer approves your candidature, you will be able to log in successfully using your credentials.
                                </div>
                            </div>
                        </div><!-- # Faq item-->

                        <div class="accordion-item" data-aos="fade-up" data-aos-delay="500">
                            <h3 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-content-4">
                                    <i class="bi bi-question-circle question-icon"></i>
                                    What types of training opportunities are available?
                                </button>
                            </h3>
                            <div id="faq-content-4" class="accordion-collapse collapse" data-bs-parent="#faqlist">
                                <div class="accordion-body">
                                    We offer various training opportunities, including internships, workshops, and industry projects, to enhance your skills and employability.
                                </div>
                            </div>
                        </div><!-- # Faq item-->

                        <div class="accordion-item" data-aos="fade-up" data-aos-delay="600">
                            <h3 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-content-5">
                                    <i class="bi bi-question-circle question-icon"></i>
                                    How should I prepare for the placement interviews?
                                </button>
                            </h3>
                            <div id="faq-content-5" class="accordion-collapse collapse" data-bs-parent="#faqlist">
                                <div class="accordion-body">
                                    We recommend practicing common interview questions, enhancing your resume, and participating in mock interviews provided by the placement cell.
                                </div>
                            </div>
                        </div><!-- # Faq item-->

                        <div class="accordion-item" data-aos="fade-up" data-aos-delay="700">
                            <h3 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-content-6">
                                    <i class="bi bi-question-circle question-icon"></i>
                                    Can I apply for multiple companies at the same time?
                                </button>
                            </h3>
                            <div id="faq-content-6" class="accordion-collapse collapse" data-bs-parent="#faqlist">
                                <div class="accordion-body">
                                    Yes, you are encouraged to apply for multiple companies to increase your chances of securing a job.
                                </div>
                            </div>
                        </div><!-- # Faq item-->

                    </div>

                </div>

                <div class="col-lg-5 align-items-stretch order-1 order-lg-2 img" style='background-image: url("assets/img/faqq.jpg");'>&nbsp;</div>
            </div>

        </div>
    </section>

    <?php include 'php/footer.php'; ?>

</body>

</html>
