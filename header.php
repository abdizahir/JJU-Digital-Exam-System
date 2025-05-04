<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Header</title>
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
    />
<!-- Bootstrap JS -->

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

    if (! isset($_SESSION['email']) || $_SESSION['role'] !== 'header') {
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

<!--navigation menu-->
<div id="sidenav" class="right-sidebar side-nav-small" style="overflow: visible;">
            <div class="title1">
                <div class="">
                    <div class="side-nav-header">
                        <b class="sidenav-txt side-nav-text">Header Dashboard</b>
                        <span id="sidenav-btn" class="glyphicon glyphicon-chevron-right side-nav-button"
                            style="font-size: 16px;" aria-hidden="true"></span>
                    </div>

                    <!-- Navigation Links -->
                     <!-- TODO: add a tooltip -->
                    <div class="" style="padding: 0;" id="">
                        <ul class="side-nav-links">
                            <li <?php if(@$_GET['q']==0) echo'class="active"'; ?>>
                                <a href="header.php?q=0">
                                    <span class="glyphicon glyphicon-home bigger-icons" aria-hidden="true"></span>
                                    <div class="sidenav-txt side-nav-text">&nbsp;Home</div>
                                    <span class="sr-only">(current)</span>
                                </a>
                            </li>
                            <li <?php if(@$_GET['q']==1) echo'class="active"'; ?>>
                                <a href="header.php?q=1">
                                    <span class="glyphicon glyphicon-user bigger-icons" aria-hidden="true"></span>
                                    <div class="sidenav-txt side-nav-text">&nbsp;View Students</div>
                                </a>
                            </li>
                            <li <?php if(@$_GET['q']==2) echo'class="active"'; ?>>
                                <a href="header.php?q=2">
                                    <span class="glyphicon glyphicon-education bigger-icons" aria-hidden="true"></span>
                                    <div class="sidenav-txt side-nav-text">&nbsp;View Teachers</div>
                                </a>
                            </li>
                        <li <?php if(@$_GET['q']==3) echo'class="active"'; ?>>
                            <a href="header.php?q=3">
                                <span class="glyphicon glyphicon-stats bigger-icons" aria-hidden="true"></span>
                                <div class="sidenav-txt side-nav-text">&nbsp;Ranking</div>
                            </a>
                        </li>
                <!---- <li <?php if(@$_GET['q']==4) echo'class="active"'; ?>><a href="teacher.php?q=3">Feedback</a></li>  ---->
                        <li <?php if(@$_GET['q']==4) echo'class="active"'; ?>>
                            <a href="header.php?q=4">
                                <span class="glyphicon glyphicon-plus bigger-icons" aria-hidden="true"></span>
                                <div class="sidenav-txt side-nav-text">&nbsp;Add User</div>
                            </a>
                        </li>
                        <li>
                            <a href="logout.php?q=header.php">
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
<?php if (@$_GET['q'] == 0 && $_SESSION['role'] == 'header'): ?>
    <div class="section-panel" style="margin-bottom: 0;">
        <h2 style="margin-bottom: 20px;">Dashboard Overview</h2>

        <?php
        // Count the number of users based on their roles
        $student_count = mysqli_num_rows(mysqli_query($con, "SELECT id FROM user WHERE role='student'"));
        $teacher_count = mysqli_num_rows(mysqli_query($con, "SELECT id FROM user WHERE role='teacher'"));
        $header_count = mysqli_num_rows(mysqli_query($con, "SELECT id FROM user WHERE role='header'"));
        $total_users = mysqli_num_rows(mysqli_query($con, "SELECT id FROM user WHERE role!='admin'"));
        ?>

        <div style="display: flex; gap: 20px; flex-wrap: wrap;">
            <div class="card" style="flex: 1; padding: 20px; border-radius: 10px; background-color: #f1f4ff; min-width: 200px;">
                <h3 style="color: #3d52a0;">Students</h3>
                <p style="font-size: 24px; font-weight: bold;"><?= $student_count ?></p>
            </div>
            <div class="card" style="flex: 1; padding: 20px; border-radius: 10px; background-color: #fff3e0; min-width: 200px;">
                <h3 style="color: #e67e22;">Teachers</h3>
                <p style="font-size: 24px; font-weight: bold;"><?= $teacher_count ?></p>
            </div>
            <div class="card" style="flex: 1; padding: 20px; border-radius: 10px; background-color: #e0f7fa; min-width: 200px;">
                <h3 style="color: #00796b;">Headers</h3>
                <p style="font-size: 24px; font-weight: bold;"><?= $header_count ?></p>
            </div>
            <div class="card" style="flex: 1; padding: 20px; border-radius: 10px; background-color: #e8f5e9; min-width: 200px;">
                <h3 style="color: #388e3c;">Total Users</h3>
                <p style="font-size: 24px; font-weight: bold;"><?= $total_users ?></p>
            </div>
        </div>

        <br><br>
        <h3>Recent Users</h3>
        <table class="recent-table table  title1">
            <thead>
                <tr style="color: #3d52a0;">
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>College</th>
                    <th>Department</th>
                    <th>Section</th>
                    <th>Registered At</th>
                </tr>
            </thead>
            <?php
            // Fetch recent users, joining with the necessary tables to get college, department, and section names
            $recent_users = mysqli_query($con, "
                SELECT user.id, user.name, user.email, user.role, user.date, 
                       colleges.name AS college_name, 
                       departments.name AS department_name, 
                       sections.name AS section_name
                FROM user
                LEFT JOIN colleges ON user.college_id = colleges.id
                LEFT JOIN departments ON user.department_id = departments.id
                LEFT JOIN sections ON user.section_id = sections.id
                WHERE user.role NOT IN ('admin', 'header')
                ORDER BY user.id DESC 
                LIMIT 5
            ");
            while ($user = mysqli_fetch_array($recent_users)) {
                $formatted_date = date("Y-m-d", strtotime($user['date']));

                // Check for null values and replace with dash
                $college_name = $user['college_name'] ? htmlspecialchars($user['college_name']) : '-';
                $department_name = $user['department_name'] ? htmlspecialchars($user['department_name']) : '-';
                $section_name = $user['section_name'] ? htmlspecialchars($user['section_name']) : '-';

                echo '<tr>';
                echo '<td>' . $user['id'] . '</td>';
                echo '<td>' . htmlspecialchars($user['name']) . '</td>';
                echo '<td>' . htmlspecialchars($user['email']) . '</td>';
                echo '<td>' . ucfirst($user['role']) . '</td>';
                echo '<td>' . $college_name . '</td>';
                echo '<td>' . $department_name . '</td>';
                echo '<td>' . $section_name . '</td>';
                echo '<td>' . $formatted_date . '</td>';
                echo '</tr>';
            }
            ?>
        </table>
    </div>
<?php endif; ?>
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
                    <th>Action</th>
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
                    echo '<td>
                            <button 
                                class="danger-button user-delete" style="padding: 8px 12px" 
                                data-id="' . $row['id'] . '"
                            >
                                <span class="glyphicon glyphicon-trash"></span>
                            </button>
                        </td>';
                    echo '</tr>';
                }
                ?>
            </tbody>
        </table>
    </div>
<?php endif; ?>
<!-- View Students End -->



            <!-- View Teachers Start -->
<?php if (@$_GET['q'] == 2): ?>
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
                WHERE user.role = 'teacher' ORDER BY department ASC") or die('Error fetching departments');
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
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Fetch teachers along with related college and department names
                $result = mysqli_query($con, "SELECT user.id, user.name, user.email, user.phone,  colleges.name AS college_name, departments.name AS department_name
                FROM user
                LEFT JOIN colleges ON user.college_id = colleges.id
                LEFT JOIN departments ON user.department_id = departments.id
                WHERE user.role = 'teacher'
                ORDER BY user.id ASC") or die('Error fetching teachers');
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
                    echo '<td>
                            <button 
                                class="danger-button user-delete" style="padding: 8px 12px" 
                                data-id="' . $row['id'] . '"
                            >
                                <span class="glyphicon glyphicon-trash"></span>
                            </button>
                        </td>';
                    echo '</tr>';
                }
                ?>
            </tbody>
        </table>
    </div>
<?php endif; ?>
<!-- View Teachers End -->


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


            <!-- Add User -->
<?php
if (isset($_GET['q']) && $_GET['q'] == 4) {
    // Fetch colleges, departments, and sections
    $colleges = mysqli_query($con, "SELECT * FROM colleges ORDER BY name ASC");
    $departments = mysqli_query($con, "SELECT * FROM departments ORDER BY name ASC");
    $sections = mysqli_query($con, "SELECT * FROM sections ORDER BY name ASC");

    // Group departments by college
    $deptMap = [];
    while ($dept = mysqli_fetch_assoc($departments)) {
        $deptMap[$dept['college_id']][] = $dept;
    }

    // Group sections by department
    $secMap = [];
    while ($sec = mysqli_fetch_assoc($sections)) {
        $secMap[$sec['department_id']][] = $sec;
    }

    echo "
    <div class=\"section-panel title\">
        <div class=\"row\">
            <span class=\"title1\" style=\"color:#3d52a0; display:flex; justify-content:center; font-size:30px;\">
                <b>Add User Details</b>
            </span>

            <form class=\"form-horizontal title1\" action=\"update.php?q=addUser\" method=\"POST\" style=\"padding:20px;\">
                <fieldset class=\"add-user-form\">
                    <!-- Role -->
                    <div class=\"form-group\">
                        <label class=\"col-md-12\">Role:</label>
                        <div class=\"col-md-12\">
                            <select name=\"role\" class=\"form-control\" required>
                                <option value=\"\">Select Role</option>
                                <option value=\"student\">Student</option>
                                <option value=\"teacher\">Teacher</option>
                            </select>
                        </div>
                    </div>

                    <!-- Name -->
                    <div class=\"form-group\">
                        <label class=\"col-md-12\">Name:</label>
                        <div class=\"col-md-12\">
                            <input name=\"name\" class=\"form-control\" type=\"text\" required>
                        </div>
                    </div>

                    <!-- Father's Name -->
                    <div class=\"form-group\">
                        <label class=\"col-md-12\">Father Name:</label>
                        <div class=\"col-md-12\">
                            <input name=\"fatherName\" class=\"form-control\" type=\"text\">
                        </div>
                    </div>

                    <!-- Email -->
                    <div class=\"form-group\">
                        <label class=\"col-md-12\">Email:</label>
                        <div class=\"col-md-12\">
                            <input name=\"email\" class=\"form-control\" type=\"email\" required>
                        </div>
                    </div>

                    <!-- Password -->
                    <div class=\"form-group\">
                        <label class=\"col-md-12\">Password:</label>
                        <div class=\"col-md-12\">
                            <input name=\"password\" class=\"form-control\" type=\"password\" required>
                        </div>
                    </div>

                    <!-- Gender -->
                    <div class=\"form-group\">
                        <label class=\"col-md-12\">Gender:</label>
                        <div class=\"col-md-12\">
                            <select name=\"gender\" class=\"form-control\" required>
                                <option value=\"\">Select Gender</option>
                                <option value=\"M\">Male</option>
                                <option value=\"F\">Female</option>
                            </select>
                        </div>
                    </div>

                    <!-- College -->
                    <div class=\"form-group\">
                        <label class=\"col-md-12\">College:</label>
                        <div class=\"col-md-12\">
                            <select id=\"college\" name=\"college_id\" class=\"form-control\" required>
                                <option value=\"\">Select College</option>";
                                while ($college = mysqli_fetch_assoc($colleges)) {
                                    echo "<option value=\"{$college['id']}\">{$college['name']}</option>";
                                }
                            echo "
                            </select>
                        </div>
                    </div>

                    <!-- Department -->
                    <div class=\"form-group\">
                        <label class=\"col-md-12\">Department: <span style=\"font-size: 12px; color:#3d52a0\">(Required if student)</span></label>
                        <div class=\"col-md-12\">
                            <select id=\"department\" name=\"department_id\" class=\"form-control\" disabled>
                                <option value=\"\">Select Department</option>
                            </select>
                        </div>
                    </div>

                    <!-- Section -->
                    <div class=\"form-group\">
                        <label class=\"col-md-12\">Section: <span style=\"font-size: 12px; color:#3d52a0\">(Required if student)</span></label>
                        <div class=\"col-md-12\">
                            <select id=\"section\" name=\"section_id\" class=\"form-control\" disabled>
                                <option value=\"\">Select Section</option>
                            </select>
                        </div>
                    </div>

                    <!-- Phone -->
                    <div class=\"form-group\">
                        <label class=\"col-md-12\">Phone Number:</label>
                        <div class=\"col-md-12\">
                            <input name=\"phone\" class=\"form-control\" type=\"text\">
                        </div>
                    </div>

                    <!-- Submit -->
                    <div class=\"form-group\" style=\"margin-top:40px;\">
                        <div class=\"col-md-12 text-center\">
                            <button type=\"submit\" class=\"primary-button\" style=\"font-size:20px;\">Submit</button>
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>

    <script>
        // Add user
    const deptMap = " . json_encode($deptMap) . ";
        const secMap = " . json_encode($secMap) . ";

        document.getElementById('college').addEventListener('change', function () {
            const collegeId = this.value;
            const deptSelect = document.getElementById('department');
            deptSelect.innerHTML = '<option value=\"\">Select Department</option>';
            deptSelect.disabled = true;

            if (deptMap[collegeId]) {
                deptMap[collegeId].forEach(dept => {
                    const option = document.createElement('option');
                    option.value = dept.id;
                    option.textContent = dept.name;
                    deptSelect.appendChild(option);
                });
                deptSelect.disabled = false;
            }

            document.getElementById('section').innerHTML = '<option value=\"\">Select Section</option>';
            document.getElementById('section').disabled = true;
        });

        document.getElementById('department').addEventListener('change', function () {
            const deptId = this.value;
            const secSelect = document.getElementById('section');
            secSelect.innerHTML = '<option value=\"\">Select Section</option>';
            secSelect.disabled = true;

            if (secMap[deptId]) {
                secMap[deptId].forEach(sec => {
                    const option = document.createElement('option');
                    option.value = sec.id;
                    option.textContent = sec.name;
                    secSelect.appendChild(option);
                });
                secSelect.disabled = false;
            }
        });
    </script>
    ";
}
?>

<!-- End Add User -->

            

<!-- Delete Confirmation Modal -->
<div id="deleteModal" class="modal" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background-color: rgba(0,0,0,0.5); justify-content:center; align-items:center;">
    <div style="background:#fff; padding:20px; border-radius:8px; max-width:400px; width:90%; box-shadow: 0 4px 8px rgba(0,0,0,0.2); text-align: center;">
        <h4>Are you sure you want to delete this student?</h4>
        <div style="margin-top: 20px;">
            <button id="confirmDeleteBtn" class="danger-button">Delete</button>
            <button onclick="closeModal()" class="secondary-button">Cancel</button>
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


    </script>
    <script src="js/jquery-3.7.1.slim.js"></script>
    <script src="js/main.js"></script>
</body>
</html>