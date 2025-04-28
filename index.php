<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>JJU Digital Exam System Proposal</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link rel="stylesheet" href="css/style.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="css/bootstrap.min.css?v=<?php echo time(); ?>">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>
    <nav class="navbar navbar-fixed-top">
        <div class="main-header slide-top">
            <img src="img/Jijiga_University.png" alt="Jijiga University logo" />
            <h1>JIGJIGA UNIVERSITY</h1>
        </div>
        <div class="login-container slide-top">
            <button class="secondary-button" type="button" data-toggle="modal" data-target="#myModal">Login</button>
        </div>
    </nav>

    <main>
        <!------------------------ LOGIN MODAL  ------------------------------>
        <div class="modal fade" id="myModal">
            <div class="modal-dialog">
                <div class="modal-content title1">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span class="fa fa-close" style="color: #3d52a0; font-size: 30px;"></span>
                        </button>
                        <h4 class="modal-title title1 text-center border-b">
                            LOGIN
                        </h4>
                    </div>
                    <div class="modal-body">
                        <form id="login-form" class="form-horizontal" action="login.php?q=index.php" method="POST">
                            <fieldset>
                                <!-- Text input-->
                                <div class="form-group">
                                    <label class="col-md-3 control-label" for="email"
                                        style='color:#3d52a0'>Email:</label>
                                    <div class="col-md-6">
                                        <input id="email" type="email" name="email" placeholder="Enter your Email..."
                                            class="form-control input-md" focus required">

                                    </div>
                                </div>
                                <!-- Password input-->
                                <div class="form-group">
                                    <label class="col-md-3 control-label" for="password"
                                        style='color:#3d52a0'>Password:</label>
                                    <div class="col-md-6">
                                        <input id="password" type="password" name="password"
                                            placeholder="Enter your Password..." class="form-control input-md" required>
                                    </div>
                                </div>
                                <div id="error-message" class=""></div>
                                <div class="modal-footer">
                                    <button type="secondary-button" class="btn btn-default"
                                        data-dismiss="modal">Close</button>
                                    <button type="submit" class="primary-button">Log in</button>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
        <!--sign in modal closed-->

        <!-- first  section -->
        <section class="first-section section-container text-center">
            <!-- TODO: ADD AN IMAGE TO THIS SECTION -->
            <h1 class="slide">JJU Online Exam System</h1>
            <p class="slide">e-EXAMINATION</p>
        </section>

        <!-- second section -->
        <section class="second-section section-panel slide section-container bg-grey">
            <div class="row">
                <div class="col-sm-4">
                    <span class="fa fa-globe logo"></span>
                </div>
                <div class="col-sm-8">
                    <h2 class="section-header">Our Values</h2>
                    <br />
                    <p class="strong">
                        <strong>MISSION:</strong> Our mission is using one platform for
                        examinations. Reduce paperwork and offering quick and accurate results.
                    </p>
                    <br />
                    <p class="strong">
                        <strong>VISION:</strong> Our vision of Online Exam System is more popularly
                        helps for our modern age system. It helps us to use the present technology
                        into examiantion system . It can be helpful for quick and accurate
                        results.Through it helps for only limited sector of people , it is cost
                        efficient , eco friendly and so on.
                    </p>
                </div>
            </div>
        </section>

        <!-- (Services Section) -->
        <section id="services" class="section-container section-panel slideanim text-center">
            <h2 class="section-header">SERVICES</h2>
            <h4>What we offer</h4>
            <br /> <br />
            <div class="row slideanim offer-section">
                <div class="col-sm-4">
                    <span class="fa fa-user-plus logo-small"></span>
                    <h4>e Examination</h4>
                    <p>Multiple users One platform</p>
                </div>
                <div class="col-sm-4">
                    <span class="fa fa-usd logo-small"></span>
                    <h4>COST OPTIMISED</h4>
                    <p>Reduces paper work</p>
                </div>
                <div class="col-sm-4">
                    <span class="fa fa-user logo-small"></span>
                    <h4>USER SATISFACTION</h4>
                    <p>User satisfaction is our satisfaction..</p>
                </div>
            </div>
            <br /><br />
            <div class="row slideanim offer-section">
                <div class="col-sm-4">
                    <span class="fa fa-leaf logo-small"></span>
                    <h4>GREEN</h4>
                    <p>Eco friendly</p>
                </div>
                <div class="col-sm-4">
                    <span class="fa fa-certificate logo-small"></span>
                    <h4>CERTIFIED</h4>
                    <p>Certified from the government of India..</p>
                </div>
                <div class="col-sm-4">
                    <span class="fa fa-envelope logo-small"></span>
                    <h4>CONTACT US</h4>
                    <p>Contact us directly for help..</p>
                </div>
            </div>
        </section>

        <!-- Container (Portfolio Section) -->
        <!-- TODO: Add images for each developer -->
        <section id="developers" class="section-container section-panel slideanim text-center bg-grey">
            <h2 class="section-header">Developers</h2>
            <h4>Who are we</h4>
            <br /> <br />
            <div class="developers">
                <div class="row text-center slideanim developer-box">

                    <img src="https://placehold.co/150" alt="name" />
                    <p class="developers-names" style='color:#3d52a0'>Abdilahi Mohamed Abdi</p>
                    <p class="light-color">IT Student</p>
                </div>
                <div class="row text-center slideanim developer-box">

                    <img src="https://placehold.co/150" alt="name" />
                    <p class="developers-names" style='color:#3d52a0'>Ahmed Abdulrahman Abdilahi</p>
                    <p class="light-color">IT Student</p>
                </div>
                <div class="row text-center slideanim developer-box">

                    <img src="https://placehold.co/150" alt="name" />
                    <p class="developers-names" style='color:#3d52a0'>Mohamed Nour Ahmed</p>
                    <p class="light-color">IT Student</p>
                </div>
                <div class="row text-center slideanim developer-box">

                    <img src="https://placehold.co/150" alt="name" />
                    <p class="developers-names" style='color:#3d52a0'>Muktar Hashi Ali</p>
                    <p class="light-color">IT Student</p>
                </div>
                <div class="row text-center slideanim developer-box">

                    <img src="https://placehold.co/150" alt="name" />
                    <p class="developers-names" style='color:#3d52a0'>Abdirashed Ahmed Ali</p>
                    <p class="light-color">IT Student</p>
                </div>
            </div>
        </section>

        <!-- About Section -->
        <section id="about" class="section-container slideanim section-panel">
            <div class="about-section">
                <div class="col-sm-8 justify">
                    <h2 class="section-header">About</h2>
                    <br /> <br />
                    <p class="slideanim about-text">
                        Teachers often spend countless hours preparing, managing, and grading exams.
                        Traditionally, teachers had to create exam questions manually, print out
                        test papers, and then grade them by hand. This process not only takes a lot
                        of time but also increases the chances of mistakes. For example, misprinted
                        questions, lost papers, or errors in marking can affect the fairness and
                        accuracy of exam results. Such issues add extra stress on teachers and can
                        distract them from focusing on their main goal—teaching. A digital exam
                        system offers a modern solution to these problems.
                    </p>
                    <br />
                    <p class="slideanim">
                        With a digital system, teachers can create exams quickly using pre-designed
                        templates and question sets. Instead of spending hours formatting and
                        printing, they can prepare exams in just few minutes. Once the exam is
                        ready, it can be sent out to students through a digital platform, reducing
                        the need for paper and the risk of lost or damaged test papers.
                    </p>
                </div>
                <div class="about-logo slideanim">
                    <span class="fa fa-signal logo"></span>
                </div>
            </div>
        </section>
        <!-- Container (Contact Section) -->
        <div id="contact" class="section-container section-panel slideanim bg-grey">
            <h2 class="text-center section-header">CONTACT</h2>
            <div class="contact-container slideanim" style="margin-top: 1rem">
                <div>
                    <p class="bigger-text" style="margin: 1rem 0 1.5rem 0">
                        Contact us and we'll get back to you within 24 hours.
                    </p>
                    <p class="bigger-text">
                        <span class="fa fa-map-marker" style='color:#3d52a0'></span> Jigjiga, ETHIOPIA
                    </p>
                    <p class="bigger-text"><span class="fa fa-phone" style='color:#3d52a0'></span> +251 93 906 0805</p>
                    <p class="bigger-text">
                        <span class="fa fa-envelope" style='color:#3d52a0'></span> contact@gmail.com
                    </p>
                </div>
                <div class="col-sm-7 form-container">
                    <form>
                        <div class="row">
                            <div class="col-sm-6 form-group">
                                <input class="form-control" id="name" name="name" placeholder="Name" type="text"
                                    required />
                            </div>
                            <div class="col-sm-6 form-group">
                                <input class="form-control" id="email" name="email" placeholder="Email" type="email"
                                    required />
                            </div>
                            <div class="col-sm-6 form-group">
                                <input class="form-control" id="email1" name="subject" placeholder="subject" type="text"
                                    required />
                            </div>
                        </div>
                        <textarea class="form-control contact-txt" id="comments" name="feedback" placeholder="Comment"
                            rows="4"></textarea><br />
                        <div class="row">
                            <div class="col-sm-12 form-group">
                                <button class="pull-right primary-button" name="submit" input type="submit"
                                    style="font-size: 18px;">
                                    send
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>

    <footer class="footer">
        <div class="footer-section logo">
            <div style="display: flex; gap: 10px; align-items: center">
                <img src="img/Jijiga_University.png" alt="Jijiga University" />
                <h2>Jigjiga University</h2>
            </div>
            <p style="margin: 0.5rem 0">Empowering Education for the Future</p>
        </div>
        <div class="footer-container">
            <div class="links">
                <h3>Quick Links</h3>
                <ul>
                    <li><a href="#">HOME</a></li>
                    <li><a href="#">EXAM</a></li>
                    <li><a href="#">GRADE</a></li>
                    <li><a href="#developers">DEVELOPERS</a></li>
                    <li><a href="#about">ABOUT</a></li>
                    <li><a href="#contact">CONTACT</a></li>
                    <li><a href="#services">SERVICES</a></li>
                </ul>
            </div>

            <div class="contact">
                <h3>Contact Us</h3>
                <div>
                    <p>Email: info@jju.edu.et</p>
                    <p>Phone: +251 93 906 0805</p>
                    <p>Address: Jigjiga, Ethiopia</p>
                </div>
            </div>

            <div class="social">
                <h3>Follow Us</h3>
                <div class="social-icons">
                    <a href="#"><span class="fa fa-facebook"></span></a>
                    <a href="#"><span class="fa fa-twitter"></span></a>
                    <a href="#"><span class="fa fa-linkedin"></span></a>
                    <a href="#"><span class="fa fa-youtube-play"></span></a>
                </div>
            </div>
        </div>

        <div class="footer-bottom">
            <p>&copy; 2025 Jigjiga University. All rights reserved.</p>
        </div>
    </footer>

    <script src="js/jquery-3.7.1.slim.js"></script>
    <script src="js/script.js"></script>
</body>

</html>