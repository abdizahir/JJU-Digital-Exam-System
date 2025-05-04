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
                                <span class="glyphicon glyphicon-user bigger-icons" aria-hidden="true"></span>
                                <div class="sidenav-txt side-nav-text">&nbsp;Students</div>
                            </a>
                        </li>  
                        <li <?php if(@$_GET['q']==2) echo'class="active"'; ?>>
                            <a href="admin.php?q=2">
                                <span class="glyphicon glyphicon-education bigger-icons" aria-hidden="true"></span>
                                <div class="sidenav-txt side-nav-text">&nbsp;Teachers</div>
                            </a>
                        </li>

                        <li <?php if(@$_GET['q']==3) echo'class="active"'; ?>>
                            <a href="admin.php?q=3">
                                <span class="glyphicon glyphicon-user bigger-icons" aria-hidden="true"></span>
                                <div class="sidenav-txt side-nav-text">&nbsp;Headers</div>
                            </a>
                        </li>
                        <li <?php if(@$_GET['q']==5) echo'class="active"'; ?>>
                            <a href="admin.php?q=5">
                            <span class="glyphicon glyphicon-plus bigger-icons" aria-hidden="true"></span>
                                <div class="sidenav-txt side-nav-text">&nbsp;Add User</div>
                            </a>
                        </li>

                        <li <?php if(@$_GET['q']==4) echo'class="active"'; ?>>
                            <a href="admin.php?q=4">
                                <span class="glyphicon glyphicon-user bigger-icons" aria-hidden="true"></span>
                                <div class="sidenav-txt side-nav-text">&nbsp;Colleges & Departments</div>
                            </a>
                        </li>

                        <li <?php if(@$_GET['q']==6) echo'class="active"'; ?>>
                            <a href="admin.php?q=6">
                            <span class="glyphicon glyphicon-plus bigger-icons" aria-hidden="true"></span>
                                <div class="sidenav-txt side-nav-text">&nbsp;Add College or Department</div>
                            </a>
                        </li>

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
<?php if (@$_GET['q'] == 0 && $_SESSION['role'] == 'admin'): ?>
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
                WHERE user.role != 'admin' 
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
                    <th>Delete</th>
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
                    <th>Delete</th>
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




<!-- View Headers Start -->
<?php if (@$_GET['q'] == 3): ?>
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
                WHERE user.role = 'header' ORDER BY department ASC") or die('Error fetching departments');
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
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Fetch headers along with related college and department names
                $result = mysqli_query($con, "SELECT user.id, user.name, user.email, user.phone,  colleges.name AS college_name, departments.name AS department_name
                FROM user
                LEFT JOIN colleges ON user.college_id = colleges.id
                LEFT JOIN departments ON user.department_id = departments.id
                WHERE user.role = 'header'
                ORDER BY user.id ASC") or die('Error fetching headers');
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
<!-- View Headers End -->

<!-- start View Colleges and Departments -->
<?php if (isset($_GET['q']) && $_GET['q'] == 4): ?>
<div class="section-panel title">
    <h3 style="text-align:center; color:#3d52a0;"><b>Manage Colleges and Departments</b></h3>

    <!-- Search by Name -->
    
    <!-- College Table -->
    <h3 style="margin-top: 30px;color: #3d52a0;font-weight:bold">Colleges</h3>
    <div style="position: relative;width: 200px;margin: 20px 10px 0 10px;">
        <label for="searchColleges" style="position: absolute; top: -25%; left: 8%; margin: 0; font-size: 12px; background-color: white;">Search by College Name:</label>
        <input type="text" id="searchColleges" class="form-control" style="padding-block: 4px !important;">
    </div>
    <table class="table title1" id="collegeTable">
        <thead>
            <tr style="color: #3d52a0;">
                <th>ID</th>
                <th>College Name</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $collegeRes = mysqli_query($con, "SELECT * FROM colleges ORDER BY id ASC");
            while ($college = mysqli_fetch_assoc($collegeRes)) {
                echo '<tr class="collegeRow">';
                echo '<td>' . $college['id'] . '</td>';
                echo '<td>' . htmlspecialchars($college['name']) . '</td>';
                echo '<td>
                        <button class="danger-button" style="padding: 8px 12px" onclick="confirmDelete(\'college\', ' . $college['id'] . ')">
                            <span class="glyphicon glyphicon-trash"></span>
                        </button>
                      </td>';
                echo '</tr>';
            }
            ?>
        </tbody>

    </table>
    
    
    <!-- Department Table -->
    <h3 style="margin-top: 40px;color: #3d52a0;font-weight:bold">Departments</h3>
    <div style="position: relative;width: 200px;margin: 20px 10px 0 10px;">
        <label for="searchDepartments" style="position: absolute; top: -25%; left: 8%; margin: 0; font-size: 12px; background-color: white;">Search by Department Name:</label>
        <input type="text" id="searchDepartments" class="form-control" style="padding-block: 4px !important;">
    </div>
    <table class="d-view-table table title1" id="departmentTable">
        <thead>
            <tr style="color: #3d52a0;">
                <th>ID</th>
                <th>Department Name</th>
                <th>College</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $deptRes = mysqli_query($con, "SELECT d.id, d.name AS dept_name, c.name AS college_name FROM departments d JOIN colleges c ON d.college_id = c.id ORDER BY d.id ASC");
            while ($dept = mysqli_fetch_assoc($deptRes)) {
                echo '<tr class="departmentRow">';
                echo '<td>' . $dept['id'] . '</td>';
                echo '<td>' . htmlspecialchars($dept['dept_name']) . '</td>';
                echo '<td>' . htmlspecialchars($dept['college_name']) . '</td>';
                echo '<td>
                        <button class="danger-button" style="padding: 8px 12px" onclick="confirmDelete(\'department\', ' . $dept['id'] . ')">
                            <span class="glyphicon glyphicon-trash"></span>
                        </button>
                      </td>';
                echo '</tr>';
            }
            ?>
        </tbody>
    </table>
</div>

<script>
    // College Search Function
    document.getElementById('searchColleges').addEventListener('input', function() {
        let searchValue = this.value.toLowerCase();
        let rows = document.querySelectorAll('#collegeTable .collegeRow');
        rows.forEach(row => {
            let name = row.cells[1].textContent.toLowerCase();
            row.style.display = name.includes(searchValue) ? '' : 'none';
        });
    });

    // Department Search Function
    document.getElementById('searchDepartments').addEventListener('input', function() {
        let searchValue = this.value.toLowerCase();
        let rows = document.querySelectorAll('#departmentTable .departmentRow');
        rows.forEach(row => {
            let name = row.cells[1].textContent.toLowerCase();
            row.style.display = name.includes(searchValue) ? '' : 'none';
        });
    });

    // Show Delete Confirmation Modal
    function confirmDelete(type, id) {
        // Store the type and ID to handle deletion
        document.getElementById('deleteType').value = type;
        document.getElementById('deleteId').value = id;
        
        // Show the modal
        document.getElementById('deleteModal').style.display = 'flex';
    }

    // Close the Delete Confirmation Modal
    function closeModal() {
        document.getElementById('deleteModal').style.display = 'none';
    }
</script>

<!-- Delete Confirmation Modal -->
<div id="deleteModal" class="modal" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background-color: rgba(0,0,0,0.5); justify-content:center; align-items:center;">
    <div style="background:#fff; padding:20px; border-radius:8px; max-width:400px; width:90%; box-shadow: 0 4px 8px rgba(0,0,0,0.2); text-align: center;">
        <h4>Are you sure you want to delete this item?</h4>
        <div style="margin-top: 20px;">
            <form method="POST" action="update.php?q=deleteCollegeDept">
                <input type="hidden" name="type" id="deleteType">
                <input type="hidden" name="id" id="deleteId">
                <button type="submit" class="danger-button">Delete</button>
                <button onclick="closeModal()" class="secondary-button">Cancel</button>
            </form>
        </div>
    </div>
</div>
<?php endif; ?>

<!-- end View Colleges and Departments -->

<!-- Add User -->
<?php
if (isset($_GET['q']) && $_GET['q'] == 5) {
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
                                <option value=\"header\">Header</option>
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

<!-- start add college or department -->
<?php if (isset($_GET['q']) && $_GET['q'] == 6): ?>
<div class="section-panel title">
    <div class="row">
        <span class="title1" style="color:#3d52a0; display:flex; justify-content:center; font-size:24px;">
            <b>Add College / Department</b>
        </span>

        <!-- Toggle Buttons -->
        <div class="text-center" style="margin-top: 20px;">
            <button type="button" class="primary-button" onclick="showForm('collegeForm')">Add College</button>
            <button type="button" class="primary-button" onclick="showForm('departmentForm')">Add Department</button>
        </div>

        <!-- Add College Form -->
        <form id="collegeForm" class="form-horizontal title1" action="update.php?q=addCollegeDept" method="POST" style="padding:20px; display: none;">
            <fieldset>
                <div class="form-group">
                    <label for="collegeName">College Name:</label>
                    <input name="collegeName" class="form-control input-md" type="text" placeholder="Enter new college name" required>
                </div>
                <div class="text-center" style="margin-top: 20px;">
                    <button type="submit" class="primary-button">Submit College</button>
                </div>
            </fieldset>
        </form>

        <!-- Add Department Form -->
        <form id="departmentForm" class="form-horizontal title1" action="update.php?q=addCollegeDept" method="POST" style="padding:20px; display: none;">
            <fieldset>
                <div class="form-group">
                    <label for="departmentName">Department Name:</label>
                    <input name="departmentName" class="form-control input-md" type="text" placeholder="Enter new department name" required>
                </div>
                <div class="form-group">
                    <label for="departmentCollege">Assign to College:</label>
                    <select name="departmentCollege" class="form-control input-md" required>
                        <option value="">Select College</option>
                        <?php
                        $college_query = mysqli_query($con, "SELECT id, name FROM colleges ORDER BY name ASC");
                        while ($college = mysqli_fetch_assoc($college_query)) {
                            echo "<option value=\"{$college['id']}\">" . htmlspecialchars($college['name']) . "</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="text-center" style="margin-top: 20px;">
                    <button type="submit" class="primary-button">Submit Department</button>
                </div>
            </fieldset>
        </form>
    </div>
</div>

<!-- Toggle JS -->
<script>
    function showForm(formId) {
        document.getElementById('collegeForm').style.display = 'none';
        document.getElementById('departmentForm').style.display = 'none';
        document.getElementById(formId).style.display = 'block';
    }
</script>
<?php endif; ?>
<!-- end add college or department -->


            
        </div>
    </div>
</div><!--container closed-->


<!-- Delete Confirmation Modal -->
<div id="deleteModal" class="modal-overlay" style="display: none;">
    <div class="modal-content">
        <h4>Confirm Deletion</h4>
        <p>Are you sure you want to delete this user?</p>
        <div class="modal-actions">
            <button id="confirmDeleteBtn" class="danger-button">Delete</button>
            <button onclick="closeModal()" class="secondary-button">Cancel</button>
        </div>
    </div>
</div>

<script>
    

    </script>
    <script src="js/jquery-3.7.1.slim.js"></script>
    <script src="js/main.js"></script>
</body>
</html>