<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Online examiner</title>
    <link rel="stylesheet" href="css/bootstrap.min.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="css/bootstrap-theme.min.css?v=<?php echo time(); ?>">
    <!-- <link rel="stylesheet" href="css/main.css?v=<?php echo time(); ?>"> -->
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

    <!-- <div class="header">
        <div class="row">
            <div class="col-lg-6">
                <span class="logo"></span>
            </div>
            <div class="col-md-4 col-md-offset-2">
            </div>
        </div>
    </div> -->
    <div>

        <!--navigation menu-->
        <div id="sidenav" class="right-sidebar side-nav-small" style="overflow: visible;">
            <div class="title1">
                <!-- TODO: Add a Tooltip -->
                <div class="">
                    <div class="side-nav-header">
                        <b class="sidenav-txt side-nav-text">Student Dashboard</b>
                        <span id="sidenav-btn" class="glyphicon glyphicon-chevron-right side-nav-button"
                            style="font-size: 16px;" aria-hidden="true"></span>
                    </div>

                    <!-- Navigation Links -->
                    <div class="" style="padding: 0;" id="">
                        <ul class="side-nav-links">
                            <li <?php if (@$_GET['q'] == 1) { echo 'class="active"'; } ?>>
                                <a href="student.php?q=1">
                                    <div class="tooltip1">
                                        <span class="glyphicon glyphicon-home bigger-icons" aria-hidden="true"></span>
                                        <span class="side-nav-tooltip tooltip-text">Home</span>
                                    </div>
                                    <div class="sidenav-txt side-nav-text">&nbsp;Home</div>
                                    <span class="sr-only">(current)</span>
                                </a>
                            </li>
                            <li <?php if (@$_GET['q'] == 2) { echo 'class="active"'; } ?>>
                                <a href="student.php?q=2">
                                    <div class="tooltip1">
                                        <span class="glyphicon glyphicon-list-alt bigger-icons" aria-hidden="true"></span>
                                        <span class="side-nav-tooltip tooltip-text">History</span>
                                    </div>
                                    <div class="sidenav-txt side-nav-text">&nbsp;History</div>
                                </a>
                            </li>
                            <li <?php if (@$_GET['q'] == 3) { echo 'class="active"'; } ?>>
                                <a href="student.php?q=3">
                                    <div class="tooltip1">
                                        <span class="glyphicon glyphicon-stats bigger-icons" aria-hidden="true"></span>
                                        <span class="side-nav-tooltip tooltip-text">Ranking</span>
                                    </div>
                                    <div class="sidenav-txt side-nav-text">&nbsp;Ranking</div>
                                </a>
                            </li>
                            <li>
                                <a href="logout.php?q=student.php">
                                    <div class="tooltip1">
                                        <span class="glyphicon glyphicon-log-out bigger-icons" aria-hidden="true"></span>
                                        <span class="side-nav-tooltip tooltip-text">Logout</span>
                                    </div>
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
        <div id="main" class="main-container">
            <div class="row">
                <div class="col-md-12">
                    <!--home start-->
                    <?php if (@$_GET['q'] == 1) {
                        $result = mysqli_query($con, "SELECT * FROM quiz ORDER BY date DESC") or die('Error');
                        $quizzes = [];

                        while ($row = mysqli_fetch_array($result)) {
                            $eid = $row['eid'];
                            $q12 = mysqli_query($con, "SELECT score FROM history WHERE eid='$eid' AND email='$email'") or die('Error98');
                            $rowcount = mysqli_num_rows($q12);

                            $quizzes[] = [
                                'title' => $row['title'],
                                'total' => $row['total'],
                                'sahi'  => $row['sahi'],
                                'wrong' => $row['wrong'],
                                'time'  => $row['time'],
                                'eid'   => $eid,
                                'attempted' => $rowcount > 0
                            ];
                        }
                    }
                    if (@$_GET['q'] == 1): ?>
                    <div class="section-panel">
                        <table class="exam-table table table-striped title1">
                            <tr style="color:#3d52a0;">
                                <td><b>No.</b></td>
                                <td><b>Topic</b></td>
                                <td class="col-total"><b>Total Questions</b></td>
                                <td class="col-marks"><b>Marks</b></td>
                                <td class="col-positive"><b>Positive</b></td>
                                <td class="col-negative"><b>Negative</b></td>
                                <td><b>Time Limit</b></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <?php $c = 1; ?>
                            <?php foreach ($quizzes as $quiz): ?>
                            <?php if (!$quiz['attempted']): ?>
                            <tr>
                                <td><?= $c++ ?></td>
                                <td><?= htmlspecialchars($quiz['title']) ?></td>
                                <td class="col-total"><?= $quiz['total'] ?></td>
                                <td class="col-marks"><?= $quiz['sahi'] * $quiz['total'] ?></td>
                                <td class="col-positive"><?= $quiz['sahi'] ?></td>
                                <td class="col-negative"><?= $quiz['wrong'] ?></td>
                                <td><?= $quiz['time'] ?> min</td>
                                <td>
                                    <a title="Open quiz description" href="student.php?q=1&fid=<?= $quiz['eid'] ?>">
                                        <b><span class="glyphicon glyphicon-folder-open" aria-hidden="true"></span></b>
                                    </a>
                                </td>
                                <td>
                                    <a href="student.php?q=quiz&step=2&eid=<?= $quiz['eid'] ?>&n=1&t=<?= $quiz['total'] ?>"
                                        class="pull-right btn-container">
                                        <button class="primary-button">
                                            <span class="glyphicon glyphicon-new-window"
                                                aria-hidden="true"></span>&nbsp;
                                            <span class="title1"><b>Start</b></span>
                                        </button>
                                    </a>
                                </td>
                            </tr>
                            <?php else: ?>
                            <tr style="color:#99cc32">
                                <td><?= $c++ ?></td>
                                <td>
                                    <?= htmlspecialchars($quiz['title']) ?>
                                    <span title="This quiz is already solved by you" class="glyphicon glyphicon-ok"
                                        aria-hidden="true"></span>
                                </td>
                                <td><?= $quiz['total'] ?></td>
                                <td><?= $quiz['sahi'] * $quiz['total'] ?></td>
                                <td><?= $quiz['sahi'] ?></td>
                                <td><?= $quiz['wrong'] ?></td>
                                <td><?= $quiz['time'] ?> min</td>
                                <td></td>
                                <td></td>
                            </tr>
                            <?php endif; ?>
                            <?php endforeach; ?>
                        </table>
                    </div>
                    <?php endif; ?>

                    <!----quiz reading portion starts--->

                    <?php if (@$_GET['fid']) : ?>
                    <br />
                    <?php $eid = @$_GET['fid']; $result = mysqli_query($con, "SELECT * FROM quiz WHERE eid='$eid'") or die('Error');
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
                    <!--quiz reading portion closed-->

                    <!-- <span id="countdown" class="timer"></span>
                    <script>
                    var seconds = 40;

                    function secondPassed() {
                        var minutes = Math.round((seconds - 30) / 60);
                        var remainingSeconds = seconds % 60;
                        if (remainingSeconds < 10) {
                            remainingSeconds = "0" + remainingSeconds;
                        }
                        document.getElementById('countdown').innerHTML = minutes + ":" + remainingSeconds;
                        if (seconds == 0) {
                            clearInterval(countdownTimer);
                            document.getElementById('countdown').innerHTML = "Buzz Buzz";
                        } else {
                            seconds--;
                        }
                    }
                    var countdownTimer = setInterval('secondPassed()', 1000);
                    </script> -->

                    <!--home closed-->

                    <?php
if (@$_GET['q'] == 'quiz' && @$_GET['step'] == 2) :
    $eid = @$_GET['eid'];
    $sn = @$_GET['n'];
    $total = @$_GET['t'];

    // Random question
    $q = mysqli_query($con, "SELECT * FROM questions WHERE eid='$eid' ORDER BY RAND() LIMIT 1");
    if ($row = mysqli_fetch_array($q)) :
        $qns = $row['qns'];
        $qid = $row['qid'];
?>
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
                            <form
                                action="update.php?q=quiz&step=2&eid=<?= $eid ?>&n=<?= $sn ?>&t=<?= $total ?>&qid=<?= $qid ?>"
                                method="POST" class="form-horizontal">
                                <?php
            // Random options too
            $options = mysqli_query($con, "SELECT * FROM options WHERE qid='$qid' ORDER BY RAND()");
            while ($opt = mysqli_fetch_array($options)) :
                $option = $opt['option'];
                $optionid = $opt['optionid'];
            ?>
                                <div class="form-group">
                                    <label>
                                        <input required type="radio" name="ans" value="<?= $optionid ?>">
                                        <?= htmlspecialchars($option) ?>
                                    </label>
                                </div>
                                <?php endwhile; ?>
                                <br>
                                <div class="answer-submit">
                                    <?php if ($sn < $total): ?>
                                    <button type="submit" class="primary-button">
                                        Next&nbsp;&nbsp;<span class="glyphicon glyphicon-arrow-right"
                                            aria-hidden="true"></span>
                                    </button>
                                    <?php else: ?>
                                    <button type="submit" class="primary-button">
                                        Submit&nbsp;&nbsp;<span class="glyphicon glyphicon-lock"
                                            aria-hidden="true"></span>
                                    </button>
                                    <?php endif; ?>
                                </div>
                            </form>
                        </div>
                    </div>
                    <?php
    endif;
endif;
?>
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
            $w = $row['wrong'];
            $r = $row['sahi'];
            $qa = $row['level'];
        ?>
                            <tr>
                                <td>Total Questions</td>
                                <td><?= $qa ?></td>
                            </tr>
                            <tr style="color:#99cc32">
                                <td>Right Answer&nbsp;<span class="glyphicon glyphicon-ok-circle"
                                        aria-hidden="true"></span></td>
                                <td><?= $r ?></td>
                            </tr>
                            <tr style="color:red">
                                <td>Wrong Answer&nbsp;<span class="glyphicon glyphicon-remove-circle"
                                        aria-hidden="true"></span></td>
                                <td><?= $w ?></td>
                            </tr>
                            <tr style="color:#66CCFF">
                                <td>Score&nbsp;<span class="glyphicon glyphicon-star" aria-hidden="true"></span></td>
                                <td><?= $s ?></td>
                            </tr>
                            <?php endwhile; ?>

                            <?php
        $q = mysqli_query($con, "SELECT * FROM rank WHERE email='$email' ") or die('Error157');
        while ($row = mysqli_fetch_array($q)) :
            $overall = $row['score'];
        ?>
                            <tr style="color:#990000">
                                <td>Overall Score&nbsp;<span class="glyphicon glyphicon-stats"
                                        aria-hidden="true"></span></td>
                                <td><?= $overall ?></td>
                            </tr>
                            <?php endwhile; ?>
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



                    <!--quiz end-->
                    <?php
// History start
if (@$_GET['q'] == 2) {
    $q = mysqli_query($con, "SELECT * FROM history WHERE email='$email' ORDER BY date DESC") or die('Error197');
?>
                    <div class="section-panel title">
                        <table class="table table-striped title1 history-table">
                            <tr style="color:#3d52a0"  style="overflow-x: scroll;">
                                <th>No.</th>
                                <th>Quiz</th>
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
                $w = $row['wrong'];
                $r = $row['sahi'];
                $qa = $row['level'];

                $q23 = mysqli_query($con, "SELECT title FROM quiz WHERE eid='$eid'") or die('Error208');
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

                $q12 = mysqli_query($con, "SELECT * FROM user WHERE email='$e'") or die('Error231');
                $userRow = mysqli_fetch_array($q12);

                $name = $userRow['name'];
                $gender = $userRow['gender'];
                $college = $userRow['college'];

                echo '<tr>';
                echo '<td style="color:#99cc32"><b>' . $c++ . '</b></td>';
                echo '<td>' . htmlspecialchars($name) . '</td>';
                echo '<td>' . htmlspecialchars($gender) . '</td>';
                echo '<td>' . htmlspecialchars($college) . '</td>';
                echo '<td>' . $s . '</td>';
                echo '</tr>';
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
    const tooltips = document.querySelectorAll('.side-nav-tooltip');

    // media query
    const mediaQuery = window.matchMedia('(min-width: 992px)');

    // media query change
    function handleMediaQuery(e) {
        if (e.matches) {
            // at least 992px wide
            sidebar.classList.add('side-nav-big');
            sidebar.classList.remove('side-nav-small');
            button.classList.remove('glyphicon-chevron-right');
            button.classList.add('glyphicon-chevron-left');
            elements.forEach(function(element) {
                element.classList.remove('side-nav-text');
            });
            main.classList.add('move-right');
        } else {
            // less than 992px wide
            sidebar.classList.remove('side-nav-big');
            sidebar.classList.add('side-nav-small');
            button.classList.remove('glyphicon-chevron-left');
            button.classList.add('glyphicon-chevron-right');
            elements.forEach(function(element) {
                element.classList.add('side-nav-text');
            });
            main.classList.remove('move-right');
        }

        toggleTooltips();
    }

    handleMediaQuery(mediaQuery);

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

        toggleTooltips();
    });

    function toggleTooltips() {
        if (sidebar.classList.contains('side-nav-small')) {
            tooltips.forEach(function(tooltip) {
                tooltip.classList.remove('hidden');  
            });
        } else {
            tooltips.forEach(function(tooltip) {
                tooltip.classList.add('hidden'); 
            });
        }
    }
});

    </script>

</body>

</html>