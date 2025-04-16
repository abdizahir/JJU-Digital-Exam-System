<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>JJU Digital Exam System Proposal</title>
    <!-- <link rel="stylesheet" type="text/css" href="css/style.css?v=<?php echo time(); ?>"> -->
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/style.css?v=<?php echo time(); ?>">
    <?php if(@$_GET['w'])
      {echo'<script>alert("'.$_GET['w'].'");</script>';};
    ?>
  </head>
  <body class="login-page-body">
    <main class="login-page">
      <div class="logo">
        <img src="img/Jijiga_University.png" alt="Jijiga_University logo" />
        <h1>JJU Digital Exam System</h1>
      </div>
      <div class="form">
        <h2 class="form-signin-heading">Please login</h2>
        <form class="register-form" action="login.php?q=index.php" method="POST">
          <input type="text" name="email" placeholder="Email"/>
          <input type="password" name="password" placeholder="password"/>
          <input type="submit" name="login" value="Login" class="btn btn-primary w-100" />
          <p class="message">Teacher <a href="#">Sign In</a></p>
        </form>
        <form class="login-form" action="head.php?q=index.php" method="POST">
          <input type="text" name="uname" placeholder="Email" />
          <input type="password" name="password" placeholder="password" />
          <input type="submit" name="login" value="Login" class="btn btn-primary w-100" />
          <p class="message">Student <a href="#">Login</a></p>
        </form>
      </div>
    </main>
    <script src="js/jquery-3.7.1.slim.js"></script>
    <script src="js/script.js"></script>
  </body>
</html>
