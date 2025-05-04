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

                    <!-- home Start -->
                    <?php if (@$_GET['q'] == 1): ?>
    <?php
    $email = $_SESSION['email'];

    $student_query = mysqli_query($con, "SELECT department_id FROM user WHERE email='$email' LIMIT 1") or die('Error fetching department');
    $student_data = mysqli_fetch_array($student_query);
    $student_department_id = $student_data['department_id'];

    $result = mysqli_query($con, "SELECT * FROM exam WHERE department_id = $student_department_id ORDER BY date DESC") or die('Error fetching exams');

    $exams = [];
    while ($row = mysqli_fetch_array($result)) {
        $eid = $row['eid'];
        $q12 = mysqli_query($con, "SELECT score FROM history WHERE eid='$eid' AND email='$email'") or die('Error checking attempt');
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
    ?>

    <div class="section-panel">
        <?php if (empty($exams)): ?>
        <div style="display: flex; justify-content: center;">
                <strong>No exams available at the moment.</strong>
        </div>
        <?php else: ?>
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
            <?php endif; ?>
        </table>
    </div>
<?php endif; ?>

                    <!-- home End -->

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

    $eid = mysqli_real_escape_string($con, $_GET['eid']);
    $sn = (int) $_GET['n'];
    $total = (int) $_GET['t'];
    $session_key = 'questions_' . $eid;

    // Fetch and cache questions only once per session
    if (!isset($_SESSION[$session_key])) {
        $q_query = mysqli_query($con, "SELECT qid FROM questions WHERE eid = '$eid' ORDER BY RAND()") or die('Error fetching questions');
        $questions = [];
        while ($row = mysqli_fetch_assoc($q_query)) {
            $questions[] = $row['qid'];
        }

        if (empty($questions)) {
            echo "<div style='text-align:center;margin-top:20px;'><b>No questions found for this exam. Please contact your teacher.</b></div>";
            exit();
        }

        $_SESSION[$session_key] = $questions;
    }

    $questions = $_SESSION[$session_key];

    // Start timer only once for this exam session
    if ($sn == 1 && !isset($_SESSION['exam_start_time_' . $eid])) {
        $_SESSION['exam_start_time_' . $eid] = time();
    }

    // Fetch exam duration in minutes
    $time_result = mysqli_query($con, "SELECT time FROM exam WHERE eid = '$eid'") or die('Error fetching exam time');
    $exam_time_row = mysqli_fetch_assoc($time_result);
    $exam_time_minutes = (int) $exam_time_row['time'];
    $total_exam_seconds = $exam_time_minutes * 60;

    // Timer logic
    $exam_start_time = $_SESSION['exam_start_time_' . $eid];
    $current_time = time();
    $elapsed_time = $current_time - $exam_start_time;
    $remaining_time = max(0, $total_exam_seconds - $elapsed_time);

    // Current Question ID check
    if (!isset($questions[$sn - 1])) {
        echo "<div style='text-align:center;margin-top:20px;'><b>Question not found. Please restart the exam.</b></div>";
        exit();
    }

    $currentQid = $questions[$sn - 1];

    // Fetch question details
    $q = mysqli_query($con, "SELECT * FROM questions WHERE qid = '$currentQid'") or die('Error fetching question');
    if ($row = mysqli_fetch_assoc($q)) :
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
        <div class="question-section-header"><b>Choose the correct answer</b></div>
        <br>
        <div style="font-size: 16px;"><?= htmlspecialchars($qns) ?></div>
        <br><br>

        <!-- Form to submit answer -->
        <form id="examForm" action="update.php?q=exam&step=2&eid=<?= $eid ?>&n=<?= $sn ?>&t=<?= $total ?>&qid=<?= $qid ?>" method="POST" class="form-horizontal">
            <?php
            $options = mysqli_query($con, "SELECT * FROM options WHERE qid = '$qid' ORDER BY optionid ASC");
            while ($opt = mysqli_fetch_assoc($options)) :
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
?>
<!--  Ranking Start -->
            <?php if (@$_GET['q'] == 3): ?>
            <?php
            $result = mysqli_query($con, "
                SELECT 
                    u.id,
                    u.name,
                    u.email,
                    u.gender,
                    u.phone,
                    u.year,
                    c.name AS college,
                    d.name AS department,
                    r.score
                FROM rank r
                JOIN user u ON r.email = u.email
                LEFT JOIN colleges c ON u.college_id = c.id
                LEFT JOIN departments d ON u.department_id = d.id
                WHERE u.role = 'student'
                ORDER BY r.score DESC, r.time ASC
            ") or die('Error fetching ranking');
            
            echo '<div class="section-panel">';
            ?>
       <!-- Filters -->
        <!-- TODO: fix the filtering -->
<div class="search-table" style="display: flex; justify-content: space-around; margin-bottom: 1rem;">
    <!-- College Filter -->
    <select id="collegeFilter" class="form-control" style="width: 200px;">
        <option value="">All Colleges</option>
        <?php
        $college_result = mysqli_query($con, "SELECT name FROM colleges ORDER BY name ASC") or die('Error fetching colleges');
        while ($row = mysqli_fetch_array($college_result)) {
            $college = htmlspecialchars($row['name']);
            echo "<option value=\"$college\">$college</option>";
        }
        ?>
    </select>

    <!-- Department Filter -->
    <select id="departmentFilter" class="form-control" style="width: 200px;">
        <option value="">All Departments</option>
        <?php
        $dept_result = mysqli_query($con, "SELECT DISTINCT departments.name AS department FROM user 
            LEFT JOIN departments ON user.department_id = departments.id 
            WHERE user.role = 'student' ORDER BY department ASC") or die('Error fetching departments');
        while ($dept_row = mysqli_fetch_array($dept_result)) {
            $department = htmlspecialchars($dept_row['department']);
            echo "<option value=\"$department\">$department</option>";
        }
        ?>
    </select>
</div>

        <?php
            echo '<table class="rank-table table title1">';
            echo '<thead><tr style="color: #3d52a0;">
                    <th>Rank</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>College</th>
                    <th>Department</th>
                    <th>Year</th>
                    <th>Score</th>
                </tr></thead><tbody>';
            
            $rank = 1;
            while ($row = mysqli_fetch_array($result)) {
                echo '<tr>';
                echo '<td>' . $rank++ . '</td>';
                echo '<td>' . htmlspecialchars($row['name']) . '</td>';
                echo '<td>' . htmlspecialchars($row['email']) . '</td>';
                echo '<td>' . htmlspecialchars($row['college'] ?? '-') . '</td>';
                echo '<td>' . htmlspecialchars($row['department'] ?? '-') . '</td>';
                echo '<td>' . htmlspecialchars($row['year'] ?? '-') . '</td>';
                echo '<td>' . $row['score'] . '</td>';
                echo '</tr>';
            }
            echo '</tbody></table></div>';
            ?>
            <?php endif; ?>
            <!-- Ranking End -->  




                </div>
            </div>
        </div>
    </div>

    <script>



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
    <script src="js/main.js"></script>

</body>

</html>