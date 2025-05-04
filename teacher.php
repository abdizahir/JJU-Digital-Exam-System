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

    $id  = $_SESSION['id'];
    $name  = $_SESSION['name'];
    $email = $_SESSION['email'];
    $role = $_SESSION['role'];
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
                                    <span class="glyphicon glyphicon-user bigger-icons" aria-hidden="true"></span>
                                    <div class="sidenav-txt side-nav-text">&nbsp;Students</div>
                                </a>
                            </li>
                        <li <?php if(@$_GET['q']==2) echo'class="active"'; ?>>
                            <a href="teacher.php?q=2">
                                <span class="glyphicon glyphicon-star bigger-icons" aria-hidden="true"></span>
                                <div class="sidenav-txt side-nav-text">&nbsp;Scores</div>
                            </a>
                        </li>  
                        <li <?php if(@$_GET['q']==3) echo'class="active"'; ?>>
                            <a href="teacher.php?q=3">
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
    $userId = $_SESSION['id']; // Ensure session contains the logged-in user's ID

    // Check if teacher has any exams
    $check = mysqli_query($con, "SELECT COUNT(*) as total FROM exam WHERE creator_id = $userId") or die('Error checking exams');
    $check_row = mysqli_fetch_assoc($check);

    if ($check_row['total'] == 0) {
        echo '<div class="section-panel"><p style="color:#999; display:flex; justify-content:center; font-style:italic;">You haven’t created any exams yet.</p></div>';
    } else {
        // Fetch exams created by this teacher
        $result = mysqli_query($con, "SELECT * FROM exam WHERE creator_id = $userId ORDER BY date DESC") or die('Error');

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
                    $eid = $row['eid'];
                    $title = htmlspecialchars($row['title']);
                    $total = (int)$row['total'];
                    $mark = (int)$row['mark'];
                    $time = (int)$row['time'];

                    // Check if current user attempted this exam
                    $user_email = $_SESSION['email'];
                    $q12 = mysqli_query($con, "SELECT score FROM history WHERE eid = '$eid' AND email = '$user_email'") or die('Error98');
                    $rowcount = mysqli_num_rows($q12);

                    // Count distinct students who attempted this exam
                    $student_query = mysqli_query($con, "SELECT COUNT(DISTINCT email) AS student_count FROM history WHERE eid = '$eid'") or die('Error99');
                    $student_data = mysqli_fetch_array($student_query);
                    $student_count = $student_data['student_count'];
                ?>
                    <tr <?php if ($rowcount != 0) echo 'style="color:#99cc32"'; ?>>
                        <td><?php echo $c++; ?></td>
                        <td>
                            <?php echo $title; ?>
                            <?php if ($rowcount != 0): ?>
                                <span title="This exam has already been solved by you" class="glyphicon glyphicon-ok" aria-hidden="true"></span>
                            <?php endif; ?>
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
}
?>
<!-- Home End -->


<!-- View Students Start -->
<?php if (@$_GET['q'] == 1): ?>
    <div class="section-panel">
        <div class="search-table">
            <div style="position: relative;">
                <label for="userSearch" style="position: absolute; top: -25%; left: 8%; margin: 0; font-size: 12px; background-color: white;">Search by Name:</label>
                <input type="text" id="userSearch" class="form-control" style="padding-block: 4px !important;">
            </div>
            
            <!-- Filter Select (right) -->
            <select id="userFilter" class="form-control" style="width: 200px;">
                <option value="">All Departments</option>
                <?php
                // Fetch distinct departments for the filter
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

        <table class="view-table table title1" id="usersTable">
            <thead>
                <tr style="color: #3d52a0;">
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>College</th>
                    <th>Department</th>
                    <th>Phone</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Fetch students along with related college and department names
                $result = mysqli_query($con, "SELECT user.id, user.name, user.email, user.phone,  colleges.name AS college_name, departments.name AS department_name
                FROM user
                LEFT JOIN colleges ON user.college_id = colleges.id
                LEFT JOIN departments ON user.department_id = departments.id
                WHERE user.role = 'student'
                ORDER BY user.id ASC") or die('Error fetching students');
                while ($row = mysqli_fetch_array($result)) {
                    // Check if college and department are null, and replace them with '-'
                    $college_name = $row['college_name'] ? htmlspecialchars($row['college_name']) : '-';
                    $department_name = $row['department_name'] ? htmlspecialchars($row['department_name']) : '-';

                    echo '<tr data-id="' . $row['id'] . '">';
                    echo '<td>' . $row['id'] . '</td>';
                    echo '<td>' . htmlspecialchars($row['name']) . '</td>';
                    echo '<td>' . htmlspecialchars($row['email']) . '</td>';
                    echo '<td>' . $college_name . '</td>';
                    echo '<td>' . $department_name . '</td>';
                    echo '<td>' . htmlspecialchars($row['phone']) . '</td>';
                    echo '</tr>';
                }
                ?>
            </tbody>
        </table>
    </div>
<?php endif; ?>
<!-- View Students End -->




            <!--  Score Details Start -->
            <?php
if (@$_GET['q'] == 2) {
    $userId = $_SESSION['id']; // Assuming the logged-in teacher's ID is stored here

    // Get distinct titles for exams created by this teacher
    $titles_result = mysqli_query($con, "
        SELECT DISTINCT title FROM exam WHERE creator_id = $userId
    ") or die('Error fetching titles');

    // Get distinct colleges
    $colleges_result = mysqli_query($con, "
        SELECT DISTINCT c.name AS college
        FROM user u
        JOIN colleges c ON u.college_id = c.id
    ") or die('Error fetching colleges');

    $selected_title = $_GET['filter_title'] ?? '';
    $selected_college = $_GET['filter_college'] ?? '';
?>
<div class="section-panel s-score-table title">

    <!-- Filter Form -->
    <div class="filter-form-container">
        <form method="GET" action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>" class="form-inline" style="margin-bottom:15px;">
            <input type="hidden" name="q" value="2">
            <div class="form-group" style="margin-right:10px;">
                <label for="filter_title">Exam Title:</label>
                <select name="filter_title" id="filter_title" class="form-control">
                    <option value="">All Titles</option>
                    <?php while ($row = mysqli_fetch_array($titles_result)) {
                        $title = $row['title'];
                        $selected = ($title == $selected_title) ? 'selected' : '';
                        echo "<option value=\"" . htmlspecialchars($title) . "\" $selected>" . htmlspecialchars($title) . "</option>";
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
                        echo "<option value=\"" . htmlspecialchars($college) . "\" $selected>" . htmlspecialchars($college) . "</option>";
                    } ?>
                </select>
            </div>

            <button type="submit" class="primary-button">Filter</button>
            <a href="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>?q=2" class="warn-button btn-container" style="margin-left:5px;">Reset</a>
        </form>
    </div>

    <?php
    // Build the score query with proper joins
    $query = "
        SELECT e.title, u.name, c.name AS college, h.score, h.date
        FROM history h
        JOIN user u ON h.email = u.email
        LEFT JOIN colleges c ON u.college_id = c.id
        JOIN exam e ON h.eid = e.eid
        WHERE e.creator_id = $userId
    ";

    if (!empty($selected_title)) {
        $query .= " AND e.title = '" . mysqli_real_escape_string($con, $selected_title) . "'";
    }

    if (!empty($selected_college)) {
        $query .= " AND c.name = '" . mysqli_real_escape_string($con, $selected_college) . "'";
    }

    $query .= " ORDER BY h.date DESC";

    $q = mysqli_query($con, $query) or die('Error executing query');
    ?>

    <table class="table t-score-table table-striped title1">
        <tr style="color:#3d52a0">
            <th>No.</th>
            <th>Title</th>
            <th>Name</th>
            <th>College</th>
            <th>Score</th>
            <th>Date</th>
        </tr>

        <?php
        $c = 1;
        while ($row = mysqli_fetch_array($q)) {
            echo "<tr>
                <td>" . $c++ . "</td>
                <td>" . htmlspecialchars($row['title']) . "</td>
                <td>" . htmlspecialchars($row['name']) . "</td>
                <td>" . htmlspecialchars($row['college'] ?? '-') . "</td>
                <td>" . htmlspecialchars($row['score']) . "</td>
                <td>" . htmlspecialchars($row['date']) . "</td>
            </tr>";
        }
        ?>
    </table>
</div>
<?php } ?>

        <!-- // Score Details End -->

            

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



<!-- start add exam 1 -->
<?php
if (isset($_GET['q']) && $_GET['q'] == 4 && !isset($_GET['step'])) {

    $email = $_SESSION['email'];
    $teacherDept = mysqli_fetch_assoc(
        mysqli_query($con, "SELECT department_id FROM user WHERE email = '$email'")
    );
    $department_id = $teacherDept['department_id'] ?? null;

    echo '
    <div class="section-panel title">
        <div class="row">
            <span class="title1 form-title" style="color:#3d52a0; display:flex; justify-content:center; font-size:30px;">
                <b>Enter Exam Details</b>
            </span>

            <form class="form-horizontal title1" name="form" action="update.php?q=addExam" style="padding:20px; align-items:center;" method="POST">
                <fieldset class="add-exam-form">

                    <!-- Exam Title -->
                    <div class="form-group">
                        <label class="col-md-12" for="name">Title:</label>
                        <div class="col-md-12">
                            <input id="name" name="name" placeholder="Enter Exam title" class="form-control input-md" type="text" required>
                        </div>
                    </div>

                    <!-- Hidden Department Field -->
                    <input type="hidden" name="department_id" value="' . htmlspecialchars($department_id) . '">

                    <!-- Year -->
                    <div class="form-group">
                        <label class="col-md-12" for="year">Year:</label>
                        <div class="col-md-12">
                            <select id="year" name="year" class="form-control input-md" required>
                                <option value="">Select Year</option>
                                <option value="1st">1st</option>
                                <option value="2nd">2nd</option>
                                <option value="3rd">3rd</option>
                                <option value="4th">4th</option>
                            </select>
                        </div>
                    </div>

                    <!-- Total Questions -->
                    <div class="form-group">
                        <label class="col-md-12" for="total">Total number of questions:</label>
                        <div class="col-md-12">
                            <input id="total" name="total" placeholder="Enter total number of questions" class="form-control input-md" type="number" required>
                        </div>
                    </div>

                    <!-- Marks per Correct Answer -->
                    <div class="form-group">
                        <label class="col-md-12" for="right">Marks on right answer:</label>
                        <div class="col-md-12">
                            <input id="right" name="right" placeholder="Enter marks on right answer" class="form-control input-md" min="0" type="number" required>
                        </div>
                    </div>

                    <!-- Time Limit -->
                    <div class="form-group">
                        <label class="col-md-12" for="time">Time Limit (in minutes):</label>
                        <div class="col-md-12">
                            <input id="time" name="time" placeholder="Enter time limit for test in minutes" class="form-control input-md" min="1" type="number" required>
                        </div>
                    </div>
                </fieldset>

                <!-- Description -->
                <div class="form-group" style="margin-top:25px; padding-inline:16px;">
                    <label class="col-md-12" for="desc">Description:</label>
                    <textarea id="desc" name="desc" rows="8" cols="8" class="form-control" placeholder="Write description here..." required></textarea>
                </div>

                <!-- Submit -->
                <div class="form-group" style="justify-items:center; margin-top:40px;">
                    <button type="submit" class="primary-button" style="font-size:20px;">Submit</button>
                </div>
            </form>
        </div>
    </div>';
}
?>
<!-- end add exam 1 -->



            <!--add exam step2 start-->
<?php
if (isset($_GET['q']) && $_GET['q'] == 4 && isset($_GET['step']) && $_GET['step'] == 2) {
    $n = (int) $_GET['n'];
    $eid = htmlspecialchars($_GET['eid']);
    
    echo ' 
    <div class="section-panel row">
        <span class="title1" style="color:#3d52a0;display:flex;justify-content:center;font-size:30px;"><b>Enter Question Details</b></span><br /><br />
        <div class="col-md-8" style="justify-content:center; width: 100%;">
        <form class="form-horizontal title1" name="form" action="update.php?q=addqns&n=' . $n . '&eid=' . $eid . '&ch=4" method="POST" style="justify-self:center;width: 70%;">
        <fieldset>';
    
    for ($i = 1; $i <= $n; $i++) {
        echo '
        <b>Question number ' . $i . ':</b><br />
        <div class="form-group">
            <label class="col-md-12 control-label" for="qns' . $i . '"></label>  
            <div class="col-md-12">
                <textarea rows="3" cols="5" name="qns' . $i . '" class="form-control" placeholder="Write question number ' . $i . ' here..." required></textarea>  
            </div>
        </div>

        <div class="form-group">
            <input name="' . $i . '1" placeholder="Enter option a" class="form-control input-md" type="text" required>
        </div>
        <div class="form-group">
            <input name="' . $i . '2" placeholder="Enter option b" class="form-control input-md" type="text" required>
        </div>
        <div class="form-group">
            <input name="' . $i . '3" placeholder="Enter option c" class="form-control input-md" type="text" required>
        </div>
        <div class="form-group">
            <input name="' . $i . '4" placeholder="Enter option d" class="form-control input-md" type="text" required>
        </div>
        <br />
        <b>Correct answer</b>:<br />
        <select name="ans' . $i . '" class="form-control input-md dropdown" required>
            <option value="">Select answer for question ' . $i . '</option>
            <option value="a">Option a</option>
            <option value="b">Option b</option>
            <option value="c">Option c</option>
            <option value="d">Option d</option>
        </select><br /><br />';
    }

    echo '
        <div class="form-group" style="justify-items:center;margin-top:40px">
            <button type="submit" class="primary-button" style="font-size:20px">Submit</button>
        </div>
        </fieldset>
        </form>
        </div>
    </div>';
}
?>
<!--add exam step 2 end-->



            <!-- Remove Exam -->
<?php
if (@$_GET['q'] == 5) {

    // Get current teacher's user ID
    $email = $_SESSION['email'];
    $getTeacherQuery = mysqli_query($con, "SELECT id FROM user WHERE email = '$email'") or die('Error fetching teacher ID');
    $teacher = mysqli_fetch_assoc($getTeacherQuery);
    $creator_id = $teacher['id'];

    // Get exams created by the teacher
    $result = mysqli_query($con, "SELECT * FROM exam WHERE creator_id = '$creator_id' ORDER BY date DESC") or die('Error fetching exams');

    echo '<div class="section-panel">
            <table class="table t-remove-table title1">
                <tr style="color:#3d52a0;">
                    <td class="remove-1"><b>No.</b></td>
                    <td><b>Topic</b></td>
                    <td><b>Total Questions</b></td>
                    <td><b>Total Marks</b></td>
                    <td><b>Time Limit</b></td>
                    <td></td>
                </tr>';

    $c = 1;
    while ($row = mysqli_fetch_array($result)) {
        $title = $row['title'];
        $total = $row['total'];
        $mark = $row['mark'];
        $time = $row['time'];
        $eid = $row['eid'];

        echo '<tr>
                <td>' . $c++ . '</td>
                <td>' . htmlspecialchars($title) . '</td>
                <td>' . $total . '</td>
                <td>' . ($mark * $total) . '</td>
                <td>' . $time . '&nbsp;min</td>
                <td>
                    <a href="update.php?q=rmExam&eid=' . $eid . '" class="pull-right btn-container">
                        <div class="danger-button">
                            <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>&nbsp;
                            <span class="title1"><b>Remove</b></span>
                        </div>
                    </a>
                </td>
              </tr>';
    }

    echo '</table></div>';
}
?>

    </div>
</div><!--container closed-->

    <script src="js/jquery-3.7.1.slim.js"></script>
    <script src="js/main.js"></script>
</body>
</html>