<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>JJU Digital Exam System Proposal</title>
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
    />
    <link rel="stylesheet" href="css/style.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="css/homepage.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="css/bootstrap.min.css?v=<?php echo time(); ?>">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  </head>
  <body>
      <nav class="navbar-fixed-top p-3">
        <div class="container-fluid container-header">
          <div class="main-header">
            <img src="img/Jijiga_University.png" alt="Jijiga University logo" />
            <a  href="homepage.php?=0">JIGJIGA UNIVERSITY</a>
          </div>
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
          </div>
          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav d-flex">
              <li class=""><a href="homepage.php?q=0">HOME</a></li>
              <li class=""><a href="teacher.php?q=0">TEACHER</a></li>
              <li class=""><a href="#services">SERVICES</a></li>
              <li class=""><a href="#developers">DEVELOPERS</a></li>
              <li class=""><a href="#about">ABOUT</a></li>
              <li class=""><a href="#contact">CONTACT</a></li>
              <li class=""><a href="logout.php?q=teacher.php">LOGOUT</a></li>
              
              <!-- <li class="more">
                <span class="more-btn fa fa-bars"></span>
                <ul class="dropdown"></ul>
              </li> -->
            </ul>
          </div>
        </div>
      </nav>
    <main>
    <div class="container-fluid"></div>
      <!-- first  section -->
      <section class="first-section text-center">
        <h1>JJU Online Exam System</h1>
        <p>e-EXAMINATION</p>
      </section>

      <!-- second section -->
      <section class="second-section container-fluid bg-grey">
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
      <section id="services" class="container-fluid text-center">
        <h2 class="section-header">SERVICES</h2>
        <h4 style="color: #964734">What we offer</h4>
        <br />
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
      <section id="developers" class="container-fluid text-center bg-grey">
        <h2 class="section-header">Developers</h2>
        <br />
        <h4 style="color: #964734">Who are we</h4>
        <div class="developers">
          <div class="row text-center slideanim developer-box">
            <div class="thumbnail">
              <img src="https://placehold.co/150" alt="name" />
              <p><strong>Abdilahi Mohamed Abdi</strong></p>
              <p class="light-color">IT Student</p>
            </div>
          </div>
          <div class="row text-center slideanim developer-box">
            <div class="thumbnail">
              <img src="https://placehold.co/150" alt="name" />
              <p><strong>Ahmed Abdulrahman Abdilahi</strong></p>
              <p class="light-color">IT Student</p>
            </div>
          </div>
          <div class="row text-center slideanim developer-box">
            <div class="thumbnail">
              <img src="https://placehold.co/150" alt="name" />
              <p><strong>Mohamed Nour Ahmed</strong></p>
              <p class="light-color">IT Student</p>
            </div>
          </div>
          <div class="row text-center slideanim developer-box">
            <div class="thumbnail">
              <img src="https://placehold.co/150" alt="name" />
              <p><strong>Muktar Hashi Ali</strong></p>
              <p class="light-color">IT Student</p>
            </div>
          </div>
          <div class="row text-center slideanim developer-box">
            <div class="thumbnail">
              <img src="https://placehold.co/150" alt="name" />
              <p><strong>Abdirashed Ahmed Ali</strong></p>
              <p class="light-color">IT Student</p>
            </div>
          </div>
        </div>
      </section>

      <!-- About Section -->
      <section id="about" class="container-fluid">
        <div class="row">
          <div class="col-sm-8 justify">
            <h2 class="section-header">About</h2>
            <br />
            <h4>
              Teachers often spend countless hours preparing, managing, and grading exams.
              Traditionally, teachers had to create exam questions manually, print out
              test papers, and then grade them by hand. This process not only takes a lot
              of time but also increases the chances of mistakes. For example, misprinted
              questions, lost papers, or errors in marking can affect the fairness and
              accuracy of exam results. Such issues add extra stress on teachers and can
              distract them from focusing on their main goal—teaching. A digital exam
              system offers a modern solution to these problems.
            </h4>
            <br />
            <p>
              With a digital system, teachers can create exams quickly using pre-designed
              templates and question sets. Instead of spending hours formatting and
              printing, they can prepare exams in just few minutes. Once the exam is
              ready, it can be sent out to students through a digital platform, reducing
              the need for paper and the risk of lost or damaged test papers.
            </p>
          </div>
          <div class="col-sm-4">
            <span class="fa fa-signal logo"></span>
          </div>
        </div>
      </section>
      <!-- Container (Contact Section) -->
      <div id="contact" class="container-fluid bg-grey">
        <h2 class="text-center section-header">CONTACT</h2>
        <div class="contact-container" style="margin-top: 1rem">
          <div>
            <p class="bigger-text" style="margin: 1rem 0 1.5rem 0">
              Contact us and we'll get back to you within 24 hours.
            </p>
            <p class="bigger-text">
              <span class="fa fa-map-marker"></span> Jigjiga, ETHIOPIA
            </p>
            <p class="bigger-text"><span class="fa fa-phone"></span> +251 93 906 0805</p>
            <p class="bigger-text">
              <span class="fa fa-envelope"></span> contact@gmail.com
            </p>
          </div>
          <div class="col-sm-7 slideanim form-container">
            <form>
              <div class="row">
                <div class="col-sm-6 form-group">
                  <input
                    class="form-control"
                    id="name"
                    name="name"
                    placeholder="Name"
                    type="text"
                    required
                  />
                </div>
                <div class="col-sm-6 form-group">
                  <input
                    class="form-control"
                    id="email"
                    name="email"
                    placeholder="Email"
                    type="email"
                    required
                  />
                </div>
                <div class="col-sm-6 form-group">
                  <input
                    class="form-control"
                    id="email1"
                    name="subject"
                    placeholder="subject"
                    type="text"
                    required
                  />
                </div>
              </div>
              <textarea
                class="form-control contact-txt"
                id="comments"
                name="feedback"
                placeholder="Comment"
                rows="4"
              ></textarea
              ><br />
              <div class="row">
                <div class="col-sm-12 form-group">
                  <button class="btn-submit pull-right" name="submit" input type="submit">
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
        <p style="margin: 0.3rem 0">Empowering Education for the Future</p>
      </div>
      <div class="footer-container">
        <div class="footer-section links">
          <h3>Quick Links</h3>
          <!-- TODO: fix this (not showing all items) -->
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

        <div class="footer-section contact">
          <h3>Contact Us</h3>
          <p>Email: info@jju.edu.et</p>
          <p>Phone: +251 93 906 0805</p>
          <p>Address: Jigjiga, Ethiopia</p>
        </div>

        <div class="footer-section social">
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
