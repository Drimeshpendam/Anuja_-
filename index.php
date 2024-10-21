<?php

// To Handle Session Variables on This Page
session_start();

// Including Database Connection From db.php file to avoid rewriting in all files
require_once("db.php");
?>
<!DOCTYPE html>
<html lang="en">
<title>Home</title>

<head>
    <?php include 'php/head.php'; ?>
</head>

<body>

    <!-- header starts -->
    <?php include 'php/header.php'; ?>
    <!-- header ends -->

    <section id="hero-animated" class="hero-animated d-flex align-items-center">
        <div class="container d-flex flex-column justify-content-center align-items-center text-center position-relative" data-aos="zoom-out">
            <img src="assets/img/hero-carousel/hero-carousel-3.svg" class="img-fluid animated">
            <h2>Welcome to <span>PCCOE Placement Cell</span></h2>
            <p>Your Journey to Success Begins Here.</p>
            <div class="d-flex">
                <a href="login.php" class="btn-get-started scrollto">Login</a>
            </div>
        </div>
    </section>

    <main id="main">

        <!-- ======= Call To Action Section ======= -->
        <section id="cta" class="cta">
            <div class="container" data-aos="zoom-out">

                <div class="row g-5">

                    <div class="col-lg-8 col-md-6 content d-flex flex-column justify-content-center order-last order-md-first">
                        <h3>CRTP Training and Placement <em>Portal</em></h3>
                        <p>The Placement Cell at PCCOE plays a crucial role in locating job opportunities for undergraduates and postgraduates. We maintain strong connections with reputed firms and industries to facilitate placements for our students.</p>
                        <a class="cta-btn align-self-start" href="#">Get Started</a>
                    </div>

                    <div class="col-lg-4 col-md-6 order-first order-md-last d-flex align-items-center">
                        <div class="img">
                            <img src="assets/img/feature-7.jpg" alt="" class="img-fluid">
                        </div>
                    </div>

                </div>

            </div>
        </section><!-- End Call To Action Section -->

        <!-- ======= Clients Section ======= -->
        <section id="clients" class="clients">
            <div class="container" data-aos="zoom-out">

                <div class="clients-slider swiper">
                    <div class="swiper-wrapper align-items-center">
                        <div class="swiper-slide"><img src="assets/img/clients/client-1.svg" class="img-fluid" alt=""></div>
                        <div class="swiper-slide"><img src="assets/img/clients/client-2.png" class="img-fluid" alt=""></div>
                        <div class="swiper-slide"><img src="assets/img/clients/client-3.png" class="img-fluid" alt=""></div>
                        <div class="swiper-slide"><img src="assets/img/clients/client-4.png" class="img-fluid" alt=""></div>
                        <div class="swiper-slide"><img src="assets/img/clients/client-5.png" class="img-fluid" alt=""></div>
                        <div class="swiper-slide"><img src="assets/img/clients/client-6.png" class="img-fluid" alt=""></div>
                        <div class="swiper-slide"><img src="assets/img/clients/client-7.png" class="img-fluid" alt=""></div>
                        <div class="swiper-slide"><img src="assets/img/clients/client-8.png" class="img-fluid" alt=""></div>
                    </div>
                </div>

            </div>
        </section><!-- End Clients Section -->

        <!-- ======= Features Section ======= -->
        <section id="objectives" class="features" name="objectives">
            <div class="container" data-aos="fade-up">
                <div class="tab-content">
                    <div class="tab-pane active show" id="tab-1">
                        <div class="row gy-4">
                            <div class="col-lg-8 order-2 order-lg-1" data-aos="fade-up" data-aos-delay="100">
                                <h3>Objectives</h3>
                                <p class="fst-italic">Our Placement Portal serves various objectives:</p>
                                <ul>
                                    <li><i class="bi bi-check-circle-fill"></i> Preparing students to meet industry recruitment processes.</li>
                                    <li><i class="bi bi-check-circle-fill"></i> Motivating students to develop technical knowledge and soft skills.</li>
                                    <li><i class="bi bi-check-circle-fill"></i> Producing world-class professionals with excellent analytical and communication skills.</li>
                                </ul>
                            </div>
                            <div class="col-lg-4 order-1 order-lg-2 text-center" data-aos="fade-up" data-aos-delay="200">
                                <img src="assets/img/features-1.svg" alt="" class="img-fluid">
                            </div>
                        </div>
                    </div>
                    <!-- End Tab Content -->

                    <section id="statistics" class="content-header">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12 text-center latest-job margin-bottom-20">
                                    <h1>Our Statistics</h1>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-3 col-xs-6">
                                    <div class="small-box bg-aqua">
                                        <div class="inner">
                                            <?php
                                            $sql = "SELECT * FROM job_post";
                                            $result = $conn->query($sql);
                                            $totalno = $result->num_rows > 0 ? $result->num_rows : 0;
                                            ?>
                                            <h3><?php echo $totalno; ?></h3>
                                            <p>Total Drives</p>
                                        </div>
                                        <div class="icon"><i class="ion ion-ios-paper"></i></div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-xs-6">
                                    <div class="small-box bg-green">
                                        <div class="inner">
                                            <?php
                                            $sql = "SELECT * FROM company WHERE active='1'";
                                            $result = $conn->query($sql);
                                            $totalno = $result->num_rows > 0 ? $result->num_rows : 0;
                                            ?>
                                            <h3><?php echo $totalno; ?></h3>
                                            <p>Job Offers</p>
                                        </div>
                                        <div class="icon"><i class="ion ion-briefcase"></i></div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-xs-6">
                                    <div class="small-box bg-yellow">
                                        <div class="inner">
                                            <?php
                                            $sql = "SELECT * FROM users WHERE resume!=''";
                                            $result = $conn->query($sql);
                                            $totalno = $result->num_rows > 0 ? $result->num_rows : 0;
                                            ?>
                                            <h3><?php echo $totalno; ?></h3>
                                            <p>CVs/Resumes</p>
                                        </div>
                                        <div class="icon"><i class="ion ion-ios-list"></i></div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-xs-6">
                                    <div class="small-box bg-red">
                                        <div class="inner">
                                            <?php
                                            $sql = "SELECT * FROM users WHERE active='1'";
                                            $result = $conn->query($sql);
                                            $totalno = $result->num_rows > 0 ? $result->num_rows : 0;
                                            ?>
                                            <h3><?php echo $totalno; ?></h3>
                                            <p>Daily Users</p>
                                        </div>
                                        <div class="icon"><i class="ion ion-person-stalker"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <!-- ======= F.A.Q Section ======= -->
                </div><!-- End #main -->

                <!-- ======= Footer ======= -->
                <?php include 'php/footer.php'; ?>
                <!-- End Footer -->
            </div>
        </section>
    </main>

</body>
</html>
