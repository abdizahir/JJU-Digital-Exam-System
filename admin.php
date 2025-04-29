<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
    />
    <link rel="stylesheet" href="css/bootstrap.min.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="css/bootstrap-theme.min.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="css/style.css?v=<?php echo time(); ?>">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>

<?php
    include_once 'dbConnection.php';
    session_start();

    if (! isset($_SESSION['email']) || $_SESSION['role'] !== 'admin') {
        header("Location: index.php");
        exit();
    }

    $name  = $_SESSION['name'];
    $email = $_SESSION['email'];
    $admin_id = $_SESSION['id'];
    ?>
    <nav class="navbar navbar-fixed-top">
        <div class="main-header">
            <img src="img/Jijiga_University.png" alt="Jijiga University logo" />
            <h1>JIGJIGA UNIVERSITY</h1>
        </div>
        &nbsp;&nbsp;&nbsp;&nbsp;
        <div class="flex-row welcome-text">
            <span class="fa fa-user" aria-hidden="true"></span>&nbsp;&nbsp;Welcome,&nbsp;
            <span class="log log1"><?php echo htmlspecialchars($name) ?></span>
        </div>
    </nav>

<!--navigation menu-->
<div id="sidenav" class="right-sidebar side-nav-small" style="overflow: visible;">
            <div class="title1">
                <div class="">
                    <div class="side-nav-header">
                        <b class="sidenav-txt side-nav-text">Admin Dashboard</b>
                        <span id="sidenav-btn" class="glyphicon glyphicon-chevron-right side-nav-button"
                            style="font-size: 16px;" aria-hidden="true"></span>
                    </div>

                    <!-- Navigation Links -->
                     <!-- TODO: add a tooltip -->
                    <div class="" style="padding: 0;" id="">
                        <ul class="side-nav-links">
                            <li <?php if(@$_GET['q']==0) echo'class="active"'; ?>>
                                <a href="admin.php?q=0">
                                    <span class="glyphicon glyphicon-home bigger-icons" aria-hidden="true"></span>
                                    <div class="sidenav-txt side-nav-text">&nbsp;Home</div>
                                    <span class="sr-only">(current)</span>
                                </a>
                            </li>
                        <li <?php if(@$_GET['q']==1) echo'class="active"'; ?>>
                            <a href="admin.php?q=1">
                                <span class="glyphicon glyphicon-star bigger-icons" aria-hidden="true"></span>
                                <div class="sidenav-txt side-nav-text">&nbsp;Scores</div>
                            </a>
                        </li>  
                        <li <?php if(@$_GET['q']==2) echo'class="active"'; ?>>
                            <a href="admin.php?q=2">
                                <span class="glyphicon glyphicon-stats bigger-icons" aria-hidden="true"></span>
                                <div class="sidenav-txt side-nav-text">&nbsp;Ranking</div>
                            </a>
                        </li>

                        <!-- teacher dropdown-->
                        <li class="dropdown <?php if(@$_GET['q']==4 || @$_GET['q']==5) echo'active'; ?>">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Teacher<span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="admin.php?q=4">Add Teacher</a></li>
                                <li><a href="admin.php?q=5">Remove Teacher</a></li>
                            </ul>
                        </li>
                        <!-- teacher dropdown end-->
                        <!-- head dropdown-->
                        <li class="dropdown <?php if(@$_GET['q']==4 || @$_GET['q']==5) echo'active'; ?>">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Head<span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="admin.php?q=6">Add Head</a></li>
                                <li><a href="admin.php?q=7">Remove Head</a></li>
                            </ul>
                        </li>
                        <!-- head dropdown end-->
                        <li>
                            <a href="logout.php?q=admin.php">
                                <span class="glyphicon glyphicon-log-out bigger-icons" aria-hidden="true"></span>
                                <div class="sidenav-txt side-nav-text">&nbsp;Logout</div>
                            </a>
                        </li>
                        </ul>
                    </div><!-- /.navbar-collapse -->
                </div><!-- /.container-fluid -->
            </div>
        </div>
        <!--navigation menu end-->


<div id="main" class="main-container"><!--container start-->
    <div class="row">
        <div class="col-md-12">
            <!-- home Start -->
<?php
if (@$_GET['q'] == 0) {
    $result = mysqli_query($con, "SELECT * FROM exam WHERE email='$email' ORDER BY date DESC") or die('Error');
?>
    <div class="section-panel">
        <table class="t-exam-table table title1" style="border:none">
            <thead>
                <tr style="color:#3d52a0;">
                    <th>No.</th>
                    <th>Topic</th>
                    <th>Total Questions</th>
                    <th>Marks</th>
                    <th>Time Limit</th>
                    <th>Attempted By</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $c = 1;
                while ($row = mysqli_fetch_array($result)) {
                    $title = $row['title'];
                    $total = $row['total'];
                    $mark = $row['mark'];
                    $time = $row['time'];
                    $eid = $row['eid'];

                    $q12 = mysqli_query($con, "SELECT score FROM history WHERE eid='$eid' AND email='$email'") or die('Error98');
                    $rowcount = mysqli_num_rows($q12);

                    $student_query = mysqli_query($con, "SELECT COUNT(DISTINCT email) AS student_count FROM history WHERE eid='$eid'") or die('Error99');
                    $student_data = mysqli_fetch_array($student_query);
                    $student_count = $student_data['student_count'];
                ?>
                    <tr <?php if ($rowcount != 0) echo 'style="color:#99cc32"'; ?>>
                        <td><?php echo $c++; ?></td>
                        <td>
                            <?php echo $title; ?>
                            <?php if ($rowcount != 0) { ?>
                                <span title="This exam has already been solved by you" class="glyphicon glyphicon-ok" aria-hidden="true"></span>
                            <?php } ?>
                        </td>
                        <td><?php echo $total; ?></td>
                        <td><?php echo ($mark * $total); ?></td>
                        <td><?php echo $time; ?> min</td>
                        <td><?php echo $student_count; ?></td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
<?php
}
?>
<!-- Home End -->


            <!--  Score Details Start -->
<?php
if (@$_GET['q'] == 1) {

    $titles_result = mysqli_query($con, "SELECT DISTINCT title FROM exam WHERE email='$email'") or die('Error fetching titles');
    $colleges_result = mysqli_query($con, "SELECT DISTINCT college FROM user") or die('Error fetching colleges');

    $selected_title = isset($_GET['filter_title']) ? $_GET['filter_title'] : '';
    $selected_college = isset($_GET['filter_college']) ? $_GET['filter_college'] : '';

    ?>
    <div class="section-panel s-score-table title">

        <!-- Filter Form -->
        <div class="filter-form-container">
            <form method="GET" action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>" class="form-inline" style="margin-bottom:15px;">
                <input type="hidden" name="q" value="1">
                <div class="form-group" style="margin-right:10px;">
                    <label for="filter_title">Exam Title:</label>
                    <select name="filter_title" id="filter_title" class="form-control">
                        <option value="">All Titles</option>
                        <?php while ($row = mysqli_fetch_array($titles_result)) {
                            $title = $row['title'];
                            $selected = ($title == $selected_title) ? 'selected' : '';
                            echo '<option value="' . htmlspecialchars($title) . '" ' . $selected . '>' . htmlspecialchars($title) . '</option>';
                        } ?>
                    </select>
                </div>
                <div class="form-group" style="margin-right:10px;">
                    <label for="filter_college">College:</label>
                    <select name="filter_college" id="filter_college" class="form-control">
                        <option value="">All Colleges</option>
                        <?php while ($row = mysqli_fetch_array($colleges_result)) {
                            $college = $row['college'];
                            $selected = ($college == $selected_college) ? 'selected' : '';
                            echo '<option value="' . htmlspecialchars($college) . '" ' . $selected . '>' . htmlspecialchars($college) . '</option>';
                        } ?>
                    </select>
                </div>
                <button type="submit" class="primary-button">Filter</button>
                <a href="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>?q=1" class="warn-button btn-container" style="margin-left:5px;">
    Reset
</a>

            </form>
        </div>

        <?php
        // Base query
        $query = "SELECT DISTINCT q.title, u.name, u.college, h.score, h.date 
                  FROM user u, history h, exam q 
                  WHERE q.email='$email' 
                  AND q.eid=h.eid 
                  AND h.email=u.email";

        // Apply filters
        if (!empty($selected_title)) {
            $query .= " AND q.title='" . mysqli_real_escape_string($con, $selected_title) . "'";
        }
        if (!empty($selected_college)) {
            $query .= " AND u.college='" . mysqli_real_escape_string($con, $selected_college) . "'";
        }

        $query .= " ORDER BY q.eid DESC";

        $q = mysqli_query($con, $query) or die('Error197');
        ?>

        <table class="table t-score-table table-striped title1">
            <tr style="color:#3d52a0">
                <td><b>No.</b></td>
                <td><b>Title</b></td>
                <td><b>Name</b></td>
                <td><b>College</b></td>
                <td><b>Score</b></td>
                <td><b>Date</b></td>
            </tr>

            <?php
            $c = 1;
            while ($row = mysqli_fetch_array($q)) {
                $title = $row['title'];
                $name = $row['name'];
                $college = $row['college'];
                $score = $row['score'];
                $date = $row['date'];
                ?>
                <tr>
                    <td><?= $c++ ?></td>
                    <td><?= htmlspecialchars($title) ?></td>
                    <td><?= htmlspecialchars($name) ?></td>
                    <td><?= htmlspecialchars($college) ?></td>
                    <td><?= htmlspecialchars($score) ?></td>
                    <td><?= htmlspecialchars($date) ?></td>
                </tr>
            <?php } ?>

        </table>
    </div>
    <?php
}
// Score Details End

            

            // Ranking Start
if (@$_GET['q'] == 2) {
    $colleges_result = mysqli_query($con, "SELECT DISTINCT college FROM user") or die('Error fetching colleges');

    $selected_college = isset($_GET['filter_college']) ? $_GET['filter_college'] : '';

    echo '<div class="section-panel title">';
    echo '<div class="filter-form-container">';

    // Filter Form
    echo '<form method="GET" action="' . htmlspecialchars($_SERVER['PHP_SELF']) . '" class="form-inline" style="margin-bottom:15px;">
            <input type="hidden" name="q" value="2">
            <div class="form-group" style="margin-right:10px;">
                <label for="filter_college">College:</label>
                <select name="filter_college" id="filter_college" class="form-control">
                    <option value="">All Colleges</option>';

    // college options in the dropdown
    while ($row = mysqli_fetch_array($colleges_result)) {
        $college = $row['college'];
        $selected = ($college == $selected_college) ? 'selected' : '';
        echo '<option value="' . htmlspecialchars($college) . '" ' . $selected . '>' . htmlspecialchars($college) . '</option>';
    }

    echo '</select>
          </div>
          <button type="submit" class="primary-button">Filter</button>
          <a href="' . htmlspecialchars($_SERVER['PHP_SELF']) . '?q=2" class="btn-container" style="margin-left:5px;"><button class="warn-button" style="padding: 8px 15px;">Reset</button></a>
          </form> </div>';

    $query = "SELECT r.email, r.score
              FROM rank r
              ORDER BY r.score DESC";

    if (!empty($selected_college)) {
        $query = "SELECT r.email, r.score
                  FROM rank r, user u
                  WHERE r.email = u.email
                  AND u.college='" . mysqli_real_escape_string($con, $selected_college) . "'
                  ORDER BY r.score DESC";
    }

    $q = mysqli_query($con, $query) or die('Error223');

    // Ranking table
    echo '<table class="table t-ranking-table table-striped title1">
            <tr style="color:#3d52a0;">
            <td><b>Rank</b></td><td>
            <b>Name</b></td>
            <td><b>Gender</b></td>
            <td><b>College</b></td>
            <td><b>Score</b></td>
            </tr>';

    $c = 0;
    while ($row = mysqli_fetch_array($q)) {
        $e = $row['email'];
        $s = $row['score'];

        // Get user data based on the email
        $q12 = mysqli_query($con, "SELECT * FROM user WHERE email='$e'") or die('Error231');
        while ($user_row = mysqli_fetch_array($q12)) {
            $name = $user_row['name'];
            $gender = $user_row['gender'];
            $college = $user_row['college'];
        }

        $c++;
        echo '<tr>
                <td><b>' . $c . '</b></td>
                <td>' . htmlspecialchars($name) . '</td>
                <td>' . htmlspecialchars($gender) . '</td>
                <td>' . htmlspecialchars($college) . '</td>
                <td>' . htmlspecialchars($s) . '</td>
              </tr>';
    }

    echo '</table></div>';
}
// Ranking End


?>
<!--ranking end-->

<!--add admin start-->

<?php
if(@$_GET['q']==4) {
echo ' 
<div class="row">
<span class="title1" style="margin-left:40%;font-size:30px;"><b>Enter Teacher Details</b></span><br /><br />
 <div class="col-md-3"></div><div class="col-md-6">   <form class="form-horizontal title1" name="form" action="signadmin.php?q=admin.php?q=4"  method="POST">
<fieldset>


<!-- email input-->
<div class="form-group">
  <label class="col-md-12 control-label" for="name"></label>  
  <div class="col-md-12">
  <input id="email" name="email" placeholder="Enter Admin Email" class="form-control input-md" type="email">
    
  </div>
</div>



<!-- password input-->
<div class="form-group">
  <label class="col-md-12 control-label" for="total"></label>  
  <div class="col-md-12">
  <input id="password" name="password" placeholder="Enter password" class="form-control input-md" type="password">
    
  </div>
</div>
<!-- name input-->
<div class="form-group">
  <label class="col-md-12 control-label" for="total"></label>  
  <div class="col-md-12">
  <input id="password" name="name" placeholder="Enter Name" class="form-control input-md" type="text">
    
  </div>
</div>

<!-- gender input-->
<div class="form-group">
  <label class="col-md-12 control-label" for="total"></label>  
  <div class="col-md-12 d-flex justify-content-center align-items-center">
  <input id="radio" name="gender" type="radio" value="M">Male
  <input id="radio" name="gender" type="radio" value="F">Female
  </div>
</div>

<!-- college input-->
<div class="form-group">
  <label class="col-md-12 control-label" for="total"></label>  
  <div class="col-md-12">
  <input id="college" name="college" placeholder="Enter college" class="form-control input-md" type="text">
    
  </div>
</div>

<!-- phone input-->
<div class="form-group">
  <label class="col-md-12 control-label" for="total"></label>  
  <div class="col-md-12">
  <input id="phone" name="phone" placeholder="Enter phone" class="form-control input-md" type="text">
    
  </div>
</div>

<div class="form-group">
  <label class="col-md-12 control-label" for=""></label>
  <div class="col-md-12"> 
    <input  type="submit" style="margin-left:45%" class="btn btn-primary" value="Submit" class="btn btn-primary"/>
  </div>
</div>

</fieldset>
</form></div>';



}
?>
<!--add admin end-->


<!--delete admin start-->
<?php if(@$_GET['q']==5) {

$result = mysqli_query($con,"SELECT * FROM user where role ='teacher' ") or die('Error');
echo  '<div class="panel"><table class="table table-striped title1">
<tr><td><b>Email</b></td><td></td></tr>';
$c=1;
while($row = mysqli_fetch_array($result)) {
  
    $email = $row['email'];
  

  echo '<tr><td>'.$email.'</td>
  <td><a title="Delete User" href="update.php?demail1='.$email.'"><b><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></b></a></td></tr>';
}
$c=0;
echo '</table></div>';

}?>
<!--delete admin end-->

<!--add head start-->

<?php
if(@$_GET['q']==6) {
echo ' 
<div class="row">
<span class="title1" style="margin-left:40%;font-size:30px;"><b>Enter Head Details</b></span><br /><br />
 <div class="col-md-3"></div><div class="col-md-6">   <form class="form-horizontal title1" name="form" action="signhead.php?q=admin.php?q=4"  method="POST">
<fieldset>


<!-- email input-->
<div class="form-group">
  <label class="col-md-12 control-label" for="name"></label>  
  <div class="col-md-12">
  <input id="email" name="email" placeholder="Enter Admin Email" class="form-control input-md" type="email">
    
  </div>
</div>



<!-- password input-->
<div class="form-group">
  <label class="col-md-12 control-label" for="total"></label>  
  <div class="col-md-12">
  <input id="password" name="password" placeholder="Enter password" class="form-control input-md" type="password">
    
  </div>
</div>
<!-- name input-->
<div class="form-group">
  <label class="col-md-12 control-label" for="total"></label>  
  <div class="col-md-12">
  <input id="password" name="name" placeholder="Enter Name" class="form-control input-md" type="text">
    
  </div>
</div>

<!-- gender input-->
<div class="form-group">
  <label class="col-md-12 control-label" for="total"></label>  
  <div class="col-md-12 d-flex justify-content-center align-items-center">
  <input id="radio" name="gender" type="radio" value="M">Male
  <input id="radio" name="gender" type="radio" value="F">Female
  </div>
</div>

<!-- college input-->
<div class="form-group">
  <label class="col-md-12 control-label" for="total"></label>  
  <div class="col-md-12">
  <input id="college" name="college" placeholder="Enter college" class="form-control input-md" type="text">
    
  </div>
</div>

<!-- phone input-->
<div class="form-group">
  <label class="col-md-12 control-label" for="total"></label>  
  <div class="col-md-12">
  <input id="phone" name="phone" placeholder="Enter phone" class="form-control input-md" type="text">
    
  </div>
</div>

<div class="form-group">
  <label class="col-md-12 control-label" for=""></label>
  <div class="col-md-12"> 
    <input  type="submit" style="margin-left:45%" class="btn btn-primary" value="Submit" class="btn btn-primary"/>
  </div>
</div>

</fieldset>
</form></div>';



}
?>
<!--add head end-->

<!--delete admin start-->
<?php if(@$_GET['q']==7) {

$result = mysqli_query($con,"SELECT * FROM user where role ='head' ") or die('Error');
echo  '<div class="panel"><table class="table table-striped title1">
<tr><td><b>Email</b></td><td></td></tr>';
$c=1;
while($row = mysqli_fetch_array($result)) {
  
    $email = $row['email'];
  

  echo '<tr><td>'.$email.'</td>
  <td><a title="Delete User" href="update.php?demail1='.$email.'"><b><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></b></a></td></tr>';
}
$c=0;
echo '</table></div>';

}?>
<!--delete admin end-->
            
        </div>
    </div>
</div><!--container closed-->
<script>
    document.addEventListener('DOMContentLoaded', function () {
    const sidebar = document.getElementById('sidenav');
    const button = document.getElementById('sidenav-btn');
    const elements = document.querySelectorAll('.sidenav-txt');
    const main = document.getElementById('main');

    // Media query
    const mediaQuery = window.matchMedia('(min-width: 992px)');

    // Media query change
    function handleMediaQuery(e) {
        if (e.matches) {
            // At least 992px
            sidebar.classList.add('side-nav-big');
            sidebar.classList.remove('side-nav-small');
            button.classList.remove('glyphicon-chevron-right');
            button.classList.add('glyphicon-chevron-left');
            elements.forEach(function(element) {
                element.classList.remove('side-nav-text');
            });
            main.classList.add('move-right');
        } else {
            // Less than 992px
            sidebar.classList.remove('side-nav-big');
            sidebar.classList.add('side-nav-small');
            button.classList.remove('glyphicon-chevron-left');
            button.classList.add('glyphicon-chevron-right');
            elements.forEach(function(element) {
                element.classList.add('side-nav-text');
            });
            main.classList.remove('move-right');
        }
    }

    handleMediaQuery(mediaQuery);

    // Listen for changes in screen size
    mediaQuery.addListener(handleMediaQuery);

    button.addEventListener('click', function() {
        sidebar.classList.toggle('side-nav-small');
        sidebar.classList.toggle('side-nav-big');
        button.classList.toggle('glyphicon-chevron-right');
        button.classList.toggle('glyphicon-chevron-left');
        elements.forEach(function(element) {
            element.classList.toggle('side-nav-text');
        });
        main.classList.toggle('move-right');
    });
});

    </script>
    <script src="js/jquery-3.7.1.slim.js"></script>
    <script src="js/script.js"></script>
</body>
</html>