<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Student</title>
    <link rel="stylesheet" href="css/bootstrap.min.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="css/bootstrap-theme.min.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="css/style.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <script src="js/jquery.js" type="text/javascript"></script>


    <script src="js/bootstrap.min.js" type="text/javascript"></script>
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
    <!--alert message-->
    <?php if (@$_GET['w']) {
        echo '<script>alert("' . @$_GET['w'] . '");</script>';
    }
    ?>
    <!--alert message end-->
</head>

<body>
    <?php
    include_once 'dbConnection.php';
    session_start();

    if (! isset($_SESSION['email'])) {
        header("Location: index.php");
        exit();
    }

    $name  = $_SESSION['name'];
    $email = $_SESSION['email'];
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

    <div>

        <!--navigation menu-->
        <div id="sidenav" class="right-sidebar side-nav-small" style="overflow: visible;">
            <div class="title1">
                <div class="">
                    <div class="side-nav-header">
                        <b class="sidenav-txt side-nav-text">Student Dashboard</b>
                        <span id="sidenav-btn" class="glyphicon glyphicon-chevron-right side-nav-button" style="font-size: 16px;" aria-hidden="true"></span>
                    </div>

                    <!-- Navigation Links -->
                    <div class="" style="padding: 0;" id="">
                        <ul class="side-nav-links">
                            <li <?php if (@$_GET['q'] == 1) { echo 'class="active"'; } ?>>
                                <a href="student.php?q=1">
                                        <span class="glyphicon glyphicon-home bigger-icons" aria-hidden="true"></span>
                                    <div class="sidenav-txt side-nav-text">&nbsp;Home</div>
                                    <span class="sr-only">(current)</span>
                                </a>
                            </li>
                            <li <?php if (@$_GET['q'] == 2) { echo 'class="active"'; } ?>>
                                <a href="student.php?q=2">
                                        <span class="glyphicon glyphicon-list-alt bigger-icons" aria-hidden="true"></span>
                                    <div class="sidenav-txt side-nav-text">&nbsp;History</div>
                                </a>
                            </li>
                            <li <?php if (@$_GET['q'] == 3) { echo 'class="active"'; } ?>>
                                <a href="student.php?q=3">
                                        <span class="glyphicon glyphicon-stats bigger-icons" aria-hidden="true"></span>
                                    <div class="sidenav-txt side-nav-text">&nbsp;Ranking</div>
                                </a>
                            </li>
                            <li>
                                <a href="logout.php?q=student.php">
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


        <!--container start-->
        <div id="main" class="main-container" style="margin-top: 70px;">
            <div class="row">
                <div class="col-md-12">
                    <!--home start-->
<?php 
if (@$_GET['q'] == 1) {

    // 1. Get student's department
    $student_query = mysqli_query($con, "SELECT department FROM user WHERE email='$email' LIMIT 1") or die('Error fetching department');
    $student_data = mysqli_fetch_array($student_query);
    $student_department = $student_data['department'];

    // 2. Fetch exams created for that department only
    $result = mysqli_query($con, "SELECT * FROM exam WHERE department='$student_department' ORDER BY date DESC") or die('Error fetching exams');
    $exams = [];

    while ($row = mysqli_fetch_array($result)) {
        $eid = $row['eid'];
        $q12 = mysqli_query($con, "SELECT score FROM history WHERE eid='$eid' AND email='$email'") or die('Error98');
        $rowcount = mysqli_num_rows($q12);

        $exams[] = [
            'title' => $row['title'],
            'mark'  => $row['mark'],
            'total' => $row['total'],
            'time'  => $row['time'],
            'eid'   => $eid,
            'attempted' => $rowcount > 0
        ];
    }
}
?>

<?php if (@$_GET['q'] == 1): ?>
<div class="section-panel">
    <table class="exam-table table table-striped title1">
        <tr style="color:#3d52a0;">
            <td><b>No.</b></td>
            <td><b>Topic</b></td>
            <td class="col-total"><b>Total Questions</b></td>
            <td class="col-marks"><b>Marks per Question</b></td>
            <td class="col-positive"><b>Total Marks</b></td>
            <td><b>Time Limit</b></td>
            <td></td>
            <td></td>
        </tr>
        <?php $c = 1; ?>
        <?php foreach ($exams as $exam): ?>
            <?php if (!$exam['attempted']): ?>
            <tr>
                <td><?= $c++ ?></td>
                <td><?= htmlspecialchars($exam['title']) ?></td>
                <td><?= $exam['total'] ?></td>
                <td><?= $exam['mark'] ?></td>
                <td><?= $exam['mark'] * $exam['total'] ?></td>
                <td><?= $exam['time'] ?> min</td>
                <td>
                    <a title="Open exam description" href="student.php?q=1&fid=<?= $exam['eid'] ?>">
                        <b><span class="glyphicon glyphicon-folder-open" aria-hidden="true"></span></b>
                    </a>
                </td>
                <td>
                    <a href="student.php?q=exam&step=2&eid=<?= $exam['eid'] ?>&n=1&t=<?= $exam['total'] ?>" class="pull-right btn-container">
                        <button class="primary-button">
                            <span class="glyphicon glyphicon-new-window" aria-hidden="true"></span>&nbsp;
                            <span class="title1"><b>Start</b></span>
                        </button>
                    </a>
                </td>
            </tr>
            <?php else: ?>
            <tr style="color:#99cc32">
                <td><?= $c++ ?></td>
                <td>
                    <?= htmlspecialchars($exam['title']) ?>
                    <span title="This exam is already solved by you" class="glyphicon glyphicon-ok" aria-hidden="true"></span>
                </td>
                <td><?= $exam['total'] ?></td>
                <td><?= $exam['mark'] ?></td>
                <td><?= $exam['mark'] * $exam['total'] ?></td>
                <td><?= $exam['time'] ?> min</td>
                <td></td>
                <td></td>
            </tr>
            <?php endif; ?>
        <?php endforeach; ?>
    </table>
</div>
<?php endif; ?>

                    <!-- end home -->

                    <!----exam reading portion starts--->

                    <?php if (@$_GET['fid']) : ?>
                    <br />
                    <?php $eid = @$_GET['fid']; $result = mysqli_query($con, "SELECT * FROM exam WHERE eid='$eid'") or die('Error');
                        while ($row = mysqli_fetch_array($result)) :
                            $title = $row['title'];
                            $date = date("d-m-Y", strtotime($row['date']));
                            $intro = $row['intro'];
                    ?>
                    <div class="section-panel">
                        <div class="details-top">
                            <h2 class="details-header">
                                <b><?= htmlspecialchars($title) ?></b>
                            </h2>
                            <span
                                style="background-color: #3d52a0; border-radius: 10px; padding: 4px 10px; color:#ede8f5">
                                <b>DATE:</b> <?= $date ?>
                            </span>
                        </div>
                        <div style="color:#343a40">
                            <br />
                            <?= nl2br(htmlspecialchars($intro)) ?>
                        </div>
                    </div>
                    <?php endwhile; ?>
                    <?php endif; ?>

                    <!-- Exam start -->
                    <?php 

if (@$_GET['q'] == 'exam' && @$_GET['step'] == 2) :

    $eid = @$_GET['eid'];
    $sn = @$_GET['n'];  
    $total = @$_GET['t'];

    if (!isset($_SESSION['questions_'.$eid])) {
        $q_query = mysqli_query($con, "SELECT qid FROM questions WHERE eid='$eid' ORDER BY RAND()");
        $questions = [];
        while ($row = mysqli_fetch_array($q_query)) {
            $questions[] = $row['qid'];
        }
        $_SESSION['questions_'.$eid] = $questions;
    }

    $questions = $_SESSION['questions_'.$eid];

    // Set exam start time only once
    if ($sn == 1 && !isset($_SESSION['exam_start_time_'.$eid])) {
        $_SESSION['exam_start_time_'.$eid] = time(); // Save current server time
    }

    // Fetch exam time (in minutes)
    $time_query = mysqli_query($con, "SELECT time FROM exam WHERE eid='$eid'") or die('Error fetching exam time');
    $time_row = mysqli_fetch_array($time_query);
    $exam_time_minutes = $time_row['time'];
    $total_exam_seconds = $exam_time_minutes * 60;

    // Calculate remaining time
    $exam_start_time = $_SESSION['exam_start_time_'.$eid];
    $current_time = time();
    $elapsed_time = $current_time - $exam_start_time;
    $remaining_time = $total_exam_seconds - $elapsed_time;

    // Prevent negative time
    if ($remaining_time <= 0) {
        $remaining_time = 0;
    }

    // Current question id
    if (isset($questions[$sn - 1])) {
        $currentQid = $questions[$sn - 1];
    } else {
        echo "<div style='text-align:center;margin-top:20px;'><b>No question found. Please restart the exam.</b></div>";
        exit();
    }

    // Fetch question data
    $q = mysqli_query($con, "SELECT * FROM questions WHERE qid='$currentQid'") or die('Error fetching question');
    if ($row = mysqli_fetch_array($q)) :
        $qns = $row['qns'];
        $qid = $row['qid'];
?>

<!-- Timer Display -->
<div style="text-align:center; margin-bottom: 20px;">
    <h2 class="form-title">Time Remaining: <span id="timer" style="color: red;"></span></h2>
</div>

<!-- Question Panel -->
<div class="section-panel">
    <div class="question-panel">
        <b>
            <div class="question-section-header">
                Choose the correct answer
            </div>
            <br>
            <div style="font-size: 16px;"><?= htmlspecialchars($qns) ?></div>
        </b>
        <br><br>

        <!-- Form to submit answer -->
        <form id="examForm" action="update.php?q=exam&step=2&eid=<?= $eid ?>&n=<?= $sn ?>&t=<?= $total ?>&qid=<?= $qid ?>" method="POST" class="form-horizontal">
            <?php
            // Fetch options (no random)
            $options = mysqli_query($con, "SELECT * FROM options WHERE qid='$qid'");
            while ($opt = mysqli_fetch_array($options)) :
                $option = $opt['option'];
                $optionid = $opt['optionid'];
            ?>
            <label class="radio-option">
                <input required type="radio" name="ans" value="<?= $optionid ?>">
                <span class="answer-text"><?= htmlspecialchars($option) ?></span>
            </label>
            <?php endwhile; ?>
            <br>

            <!-- Navigation Buttons -->
            <div class="answer-submit">
                <?php if ($sn < $total): ?>
                <button type="submit" class="primary-button">
                    Next&nbsp;&nbsp;<span class="glyphicon glyphicon-arrow-right" aria-hidden="true"></span>
                </button>
                <?php else: ?>
                <button type="submit" class="primary-button">
                    Submit
                </button>
                <?php endif; ?>
            </div>
        </form>
    </div>
</div>

<!-- Countdown Script -->
<script>
let timeInSeconds = <?= $remaining_time ?>;

function updateTimerDisplay() {
    const minutes = Math.floor(timeInSeconds / 60);
    const seconds = timeInSeconds % 60;
    document.getElementById('timer').textContent = 
        `${minutes}:${seconds < 10 ? '0' : ''}${seconds}`;
}

function countdown() {
    updateTimerDisplay();
    if (timeInSeconds <= 0) {
        clearInterval(timerInterval);
        alert("Time's up! Submitting your exam automatically...");
        // Auto-submit the form
        document.getElementById('examForm').submit();
    }
    timeInSeconds--;
}

updateTimerDisplay();
const timerInterval = setInterval(countdown, 1000);
</script>

<?php
    endif;
endif;
?>

                    <!--exam end-->
                    <?php
// Display result
if (@$_GET['q'] == 'result' && @$_GET['eid']) :
    $eid = @$_GET['eid'];
    $q = mysqli_query($con, "SELECT * FROM history WHERE eid='$eid' AND email='$email' ") or die('Error157');
?>
                    <div class="section-panel" style="margin-top: 1rem; margin-bottom: 1rem;">
                        <center>
                            <h1 class="details-header" style="margin-top: 0;"><b>Result</b></h1>
                        </center>
                        <br>
                        <table class="table table-striped title1" style="font-size:20px; font-weight:1000;">
                            <?php
                            while ($row = mysqli_fetch_array($q)) :
                                $s = $row['score'];
                                $r = $row['mark'];
                                $qa = $row['level'];
                                $w = $qa - $r;
                            ?>
                            <tr>
                                <td>Total Questions</td>
                                <td><?= $qa ?></td>
                            </tr>
                            <tr style="color:#99cc32">
                                <td>Right Answers&nbsp;<span class="glyphicon glyphicon-ok-circle"
                                        aria-hidden="true"></span></td>
                                <td><?= $r ?></td>
                            </tr>
                            <tr style="color:#ff804a">
                                <td>Wrong Answers&nbsp;<span class="glyphicon glyphicon-remove-circle"
                                        aria-hidden="true"></span></td>
                                <td><?= $w ?></td>
                            </tr>
                            <tr style="color:#66CCFF">
                                <td>Score&nbsp;<span class="glyphicon glyphicon-star" aria-hidden="true"></span></td>
                                <td><?= $s ?></td>
                            </tr>
                            <?php endwhile; ?>

                            <?php
        $q_exam = mysqli_query($con, "SELECT total, mark FROM exam WHERE eid='$eid'") or die('Error fetching exam details');
        if ($row_exam = mysqli_fetch_array($q_exam)) {
            $totalQuestions = $row_exam['total'];  
            $marksPerRight = $row_exam['mark'];    
            $totalMarks = $totalQuestions * $marksPerRight;  
        }
        ?>
        <tr>
            <td>Total Exam Marks&nbsp;<span class="glyphicon glyphicon-stats" aria-hidden="true"></span></td>
            <td><?= $totalMarks ?></td>
        </tr>
                        </table>
                        <div style="display: flex; justify-content: center;">
                            <a href="student.php?q=1" class="btn-container">
                                <button class="secondary-button">
                                    <b>Go to home page</b>
                                </button>
                            </a>
                        </div>
                    </div>
                    <?php endif; ?>


                    <?php
                        // History start
if (@$_GET['q'] == 2) {
    $q = mysqli_query($con, "SELECT * FROM history WHERE email='$email' ORDER BY date DESC") or die('Error197');
?>
                    <div class="section-panel title">
                        <table class="table table-striped title1 history-table">
                            <tr style="color:#3d52a0"  style="overflow-x: scroll;">
                                <th>No.</th>
                                <th>Exam</th>
                                <th>Question Solved</th>
                                <th>Right</th>
                                <th>Wrong</th>
                                <th>Score</th>
                            </tr>
                            <?php
            $c = 1;
            while ($row = mysqli_fetch_array($q)) {
                $eid = $row['eid'];
                $s = $row['score'];
                $r = $row['mark'];
                $qa = $row['level'];
                $w = $qa - $r;

                $q23 = mysqli_query($con, "SELECT title FROM exam WHERE eid='$eid'") or die('Error208');
                $titleRow = mysqli_fetch_array($q23);
                $title = $titleRow['title'];

                echo '<tr>';
                echo '<td>' . $c++ . '</td>';
                echo '<td>' . htmlspecialchars($title) . '</td>';
                echo '<td>' . $qa . '</td>';
                echo '<td>' . $r . '</td>';
                echo '<td>' . $w . '</td>';
                echo '<td>' . $s . '</td>';
                echo '</tr>';
            }
            ?>
                        </table>
                    </div>
                    <?php
}

// Ranking start
if (@$_GET['q'] == 3) {
    $q = mysqli_query($con, "SELECT * FROM rank ORDER BY score DESC") or die('Error223');
?>
<div class="section-panel title">
    <table class="table table-striped title1 ranking-table">
        <tr style="color:#3d52a0">
            <th>Rank</th>
            <th>Name</th>
            <th>Gender</th>
            <th>College</th>
            <th>Score</th>
        </tr>
        <?php
        $c = 1;
        while ($row = mysqli_fetch_array($q)) {
            $e = $row['email'];
            $s = $row['score'];

            $q12 = mysqli_query($con, "SELECT * FROM user WHERE email='$e' LIMIT 1");

            if ($userRow = mysqli_fetch_array($q12)) {
                $name = !empty($userRow['name']) ? $userRow['name'] : '-';
                $gender = !empty($userRow['gender']) ? $userRow['gender'] : '-';
                $college = !empty($userRow['college']) ? $userRow['college'] : '-';

                echo '<tr>';
                echo '<td style="color:#99cc32"><b>' . $c++ . '</b></td>';
                echo '<td>' . htmlspecialchars($name) . '</td>';
                echo '<td>' . htmlspecialchars($gender) . '</td>';
                echo '<td>' . htmlspecialchars($college) . '</td>';
                echo '<td>' . $s . '</td>';
                echo '</tr>';
            }
            // If user not found, skip showing anything
        }
        ?>
    </table>
</div>
<?php
}
?>





                </div>
            </div>
        </div>
    </div>

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


// Timer
let timeInSeconds = <?= $remaining_time ?>;

function updateTimerDisplay() {
    const minutes = Math.floor(timeInSeconds / 60);
    const seconds = timeInSeconds % 60;
    document.getElementById('timer').textContent = 
        `${minutes}:${seconds < 10 ? '0' : ''}${seconds}`;
}

function countdown() {
    updateTimerDisplay();
    if (timeInSeconds <= 0) {
        clearInterval(timerInterval);
        alert("Time's up! Submitting your exam automatically...");
        // Auto-submit the form
        document.getElementById('examForm').submit();
    }
    timeInSeconds--;
}

// Initialize display immediately
updateTimerDisplay();

// Start countdown
if (typeof timerInterval !== 'undefined') {
    clearInterval(timerInterval);
}
timerInterval = setInterval(countdown, 1000);

    </script>

</body>

</html>