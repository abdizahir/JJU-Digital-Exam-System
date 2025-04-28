<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher</title>
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
    />
    <link rel="stylesheet" href="css/bootstrap.min.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="css/bootstrap-theme.min.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="css/style.css?php echo time(); ?>">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>

<?php
    include_once 'dbConnection.php';
    session_start();

    if (! isset($_SESSION['email']) || $_SESSION['role'] !== 'teacher') {
        header("Location: index.php");
        exit();
    }

    $name  = $_SESSION['name'];
    $email = $_SESSION['email'];
    $teacher_id = $_SESSION['id'];
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
                        <b class="sidenav-txt side-nav-text">Teacher Dashboard</b>
                        <span id="sidenav-btn" class="glyphicon glyphicon-chevron-right side-nav-button"
                            style="font-size: 16px;" aria-hidden="true"></span>
                    </div>

                    <!-- Navigation Links -->
                     <!-- TODO: add a tooltip -->
                    <div class="" style="padding: 0;" id="">
                        <ul class="side-nav-links">
                            <li <?php if(@$_GET['q']==0) echo'class="active"'; ?>>
                                <a href="teacher.php?q=0">
                                    <span class="glyphicon glyphicon-home bigger-icons" aria-hidden="true"></span>
                                    <div class="sidenav-txt side-nav-text">&nbsp;Home</div>
                                    <span class="sr-only">(current)</span>
                                </a>
                            </li>
                        <li <?php if(@$_GET['q']==1) echo'class="active"'; ?>>
                            <a href="teacher.php?q=1">
                                <span class="glyphicon glyphicon-star bigger-icons" aria-hidden="true"></span>
                                <div class="sidenav-txt side-nav-text">&nbsp;Scores</div>
                            </a>
                        </li>  
                        <li <?php if(@$_GET['q']==2) echo'class="active"'; ?>>
                            <a href="teacher.php?q=2">
                                <span class="glyphicon glyphicon-stats bigger-icons" aria-hidden="true"></span>
                                <div class="sidenav-txt side-nav-text">&nbsp;Ranking</div>
                            </a>
                        </li>
                <!---- <li <?php if(@$_GET['q']==3) echo'class="active"'; ?>><a href="teacher.php?q=3">Feedback</a></li>  ---->
                        <li <?php if(@$_GET['q']==4) echo'class="active"'; ?>>
                            <a href="teacher.php?q=4">
                                <span class="glyphicon glyphicon-plus bigger-icons" aria-hidden="true"></span>
                                <div class="sidenav-txt side-nav-text">&nbsp;Add Exam</div>
                            </a>
                        </li>
                        <li <?php if(@$_GET['q']==5) echo'class="active"'; ?>>
                            <a href="teacher.php?q=5">
                                <span class="glyphicon glyphicon-pencil bigger-icons" aria-hidden="true"></span>
                                <div class="sidenav-txt side-nav-text">&nbsp;Remove Exam</div>
                            </a>
                        </li>
                        <li>
                            <a href="logout.php?q=teacher.php">
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

            <!--add exam-->
            <?php
                if(isset($_GET['q']) && $_GET['q'] == 4 && !isset($_GET['step']))
                {
                echo ' 
                <div class="section-panel title">
  <div class="row">
    <span class="title1" style="color:#3d52a0; display:flex; justify-content:center; font-size:30px;">
      <b>Enter Exam Details</b>
    </span>
    
    <form class="form-horizontal title1" name="form" action="update.php?q=addExam" style="padding:20px; align-items:center;" method="POST">
      <fieldset class="add-exam-form">
      
        <!-- Exam Title -->
        <div class="form-group">
          <label class="col-md-12" for="name">Title:</label>
          <div class="col-md-12">
            <input id="name" name="name" placeholder="Enter Exam title" class="form-control input-md" type="text">
          </div>
        </div>

        <!-- Total Questions -->
        <div class="form-group">
          <label class="col-md-12" for="total">Total number of questions:</label>
          <div class="col-md-12">
            <input id="total" name="total" placeholder="Enter total number of questions" class="form-control input-md" type="number">
          </div>
        </div>

        <!-- Marks per Correct Answer -->
        <div class="form-group">
          <label class="col-md-12" for="right">Marks on right answer:</label>
          <div class="col-md-12">
            <input id="right" name="right" placeholder="Enter marks on right answer" class="form-control input-md" min="0" type="number">
          </div>
        </div>

        <!-- Time Limit -->
        <div class="form-group">
          <label class="col-md-12" for="time">Time Limit:</label>
          <div class="col-md-12">
            <input id="time" name="time" placeholder="Enter time limit for test in minute" class="form-control input-md" min="1" type="number">
          </div>
        </div>

        </fieldset>

        <!-- Description -->
        <div class="form-group" style="margin-top:25px; padding-inline:16px;">
          <label class="col-md-12" for="desc">Description:</label>
          <textarea id="desc" name="desc" rows="8" cols="8" class="form-control" placeholder="Write description here..."></textarea>
        </div>
        
        <!-- Submit Button -->
        <div class="form-group" style="justify-items:center; margin-top:40px;">
          <button type="submit" class="primary-button" style="font-size:20px;">Submit</button>
        </div>
    </form>
  </div>
</div>
';
                }
            ?>
            <!--add exam end-->
            <!--add exam step2 start-->
            <?php
                if(@$_GET['q']==4 && (@$_GET['step'])==2 ){
                echo ' 
                <div class="section-panel row">
                    <span class="title1" style="color:#3d52a0;display:flex;justify-content:center;font-size:30px;"><b>Enter Question Details</b></span><br /><br />
                    <div class="col-md-8" style="justify-content:center; width: 100%;">
                <form class="form-horizontal title1" name="form" action="update.php?q=addqns&n='.@$_GET['n'].'&eid='.@$_GET['eid'].'&ch=4 "  method="POST" style="justify-self:center;width: 70%;">
                <fieldset>
                ';
                
                for($i=1;$i<=@$_GET['n'];$i++)
                {
                echo '<b>Question number&nbsp;'.$i.'&nbsp;:</><br /><!-- Text input-->
                <div class="form-group">
                <label class="col-md-12 control-label" for="qns'.$i.' "></label>  
                <div class="col-md-12">
                <textarea rows="3" cols="5" name="qns'.$i.'" class="form-control" placeholder="Write question number '.$i.' here..."></textarea>  
                </div>
                </div>
                <!-- Text input-->
                <div class="form-group">
                <label class="col-md-12 control-label" for="'.$i.'1"></label>  
                <div class="col-md-12">
                <input id="'.$i.'1" name="'.$i.'1" placeholder="Enter option a" class="form-control input-md" type="text">
                    
                </div>
                </div>
                <!-- Text input-->
                <div class="form-group">
                <label class="col-md-12 control-label" for="'.$i.'2"></label>  
                <div class="col-md-12">
                <input id="'.$i.'2" name="'.$i.'2" placeholder="Enter option b" class="form-control input-md" type="text">
                    
                </div>
                </div>
                <!-- Text input-->
                <div class="form-group">
                <label class="col-md-12 control-label" for="'.$i.'3"></label>  
                <div class="col-md-12">
                <input id="'.$i.'3" name="'.$i.'3" placeholder="Enter option c" class="form-control input-md" type="text">
                    
                </div>
                </div>
                <!-- Text input-->
                <div class="form-group">
                <label class="col-md-12 control-label" for="'.$i.'4"></label>  
                <div class="col-md-12">
                <input id="'.$i.'4" name="'.$i.'4" placeholder="Enter option d" class="form-control input-md" type="text">
                    
                </div>
                </div>
                <br />
                <b>Correct answer</b>:<br />
                <select id="ans'.$i.'" name="ans'.$i.'" placeholder="Choose correct answer " class="form-control input-md dropdown" >
                <option value="a">Select answer for question '.$i.'</option>
                <option value="a">option a</option>
                <option value="b">option b</option>
                <option value="c">option c</option>
                <option value="d">option d</option> </select><br /><br />'; 
                }
                    
                echo '
                <div class="form-group" style="justify-items:center;margin-top:40px">
                    <button  type="submit" class="primary-button"  style:"font-size:20px">Submit</button>
                </div>

                </fieldset>
                </form></div>';
                }
                ?><!--add exam step 2 end-->
            <!--remove exam-->
            <?php if(@$_GET['q']==5) {

                $result = mysqli_query($con,"SELECT * FROM exam where email='$email' ORDER BY date DESC") or die('Error');
                echo  '<div class="section-panel">
                <table class="table t-remove-table table-striped title1">
                    <tr>
                        <td class="remove-1"><b>No.</b></td>
                        <td><b>Topic</b></td>
                        <td><b>Total question</b></td>
                        <td><b>Marks</b></td>
                        <td><b>Time limit</b></td>
                        <td></td>
                    </tr>';
                $c=1;
                while($row = mysqli_fetch_array($result)) {
                    $title = $row['title'];
                    $total = $row['total'];
                    $mark = $row['mark'];
                $time = $row['time'];
                    $eid = $row['eid'];
                    echo '<tr><td>'.$c++.'</td><td>'.$title.'</td><td>'.$total.'</td><td>'.$mark*$total.'</td><td>'.$time.'&nbsp;min</td>
                    <td><b>
                    <a href="update.php?q=rmExam&eid='.$eid.'" class="pull-right btn-container">
                    <div class="danger-button"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span>&nbsp;<span class="title1"><b>Remove</b></span></div>
                    </a>
                    </b></td></tr>';
                }
                $c=0;
                echo '</table></div>';
            }
            ?>
            
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