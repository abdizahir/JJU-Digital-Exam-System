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
    $header_id = $_SESSION['id'];
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
                        <li <?php if(@$_GET['q']==5) echo'class="active"'; ?>>
                            <a href="header.php?q=4">
                                <span class="glyphicon glyphicon-plus bigger-icons" aria-hidden="true"></span>
                                <div class="sidenav-txt side-nav-text">&nbsp;Add Student</div>
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
        <table class="table" style="width: 100%; border: 1px solid #ccc;">
            <thead>
                <tr style="background: #f0f0f0;">
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>College</th>
                    <th>Registered At</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $recent_users = mysqli_query($con, "SELECT * FROM user WHERE role != 'admin' ORDER BY id DESC LIMIT 5");
                while ($user = mysqli_fetch_array($recent_users)) {
                    $formatted_date = date("Y-m-d", strtotime($user['date']));
                    echo '<tr>';
                    echo '<td>' . $user['id'] . '</td>';
                    echo '<td>' . htmlspecialchars($user['name']) . '</td>';
                    echo '<td>' . htmlspecialchars($user['email']) . '</td>';
                    echo '<td>' . ucfirst($user['role']) . '</td>';
                    echo '<td>' . htmlspecialchars($user['college']) . '</td>';
                    echo '<td>' . $formatted_date . '</td>';
                    echo '</tr>';
                }
                ?>
            </tbody>
        </table>
    </div>
<?php endif; ?>

<!-- Home End -->

<!-- View Students Start -->
<?php if (@$_GET['q'] == 1): ?>
    <div class="section-panel">
        <div class="search-table" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px;">
            <!-- Search Input (left) -->
            <div style="display: flex; align-items: center; gap: 10px;">
                <label for="studentSearch">Search:</label>
                <input type="text" id="studentSearch" class="form-control" placeholder="Search by name...">
            </div>
            
            <!-- Filter Select (right) -->
            <select id="departmentFilter" class="form-control" style="width: 200px;">
                <option value="">All Departments</option>
                <?php
                // Fetch distinct departments for the filter
                $dept_result = mysqli_query($con, "SELECT DISTINCT department FROM user WHERE role = 'student' ORDER BY department ASC") or die('Error fetching departments');
                while ($dept_row = mysqli_fetch_array($dept_result)) {
                    $department = htmlspecialchars($dept_row['department']);
                    echo "<option value=\"$department\">$department</option>";
                }
                ?>
            </select>
        </div>

        <table class="t-student-table table title1" id="studentsTable">
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
                $result = mysqli_query($con, "SELECT * FROM user WHERE role = 'student' ORDER BY id ASC") or die('Error fetching students');
                while ($row = mysqli_fetch_array($result)) {
                    echo '<tr>';
                    echo '<tr data-id="' . $row['id'] . '">';
                    echo '<td>' . $row['id'] . '</td>';
                    echo '<td>' . htmlspecialchars($row['name']) . ' ' . htmlspecialchars($row['fatherName']) . '</td>';
                    echo '<td>' . htmlspecialchars($row['email']) . '</td>';
                    echo '<td>' . htmlspecialchars($row['college']) . '</td>';
                    echo '<td>' . htmlspecialchars($row['department']) . '</td>';
                    echo '<td>' . htmlspecialchars($row['phone']) . '</td>';
                    echo '<td><button class="delete-btn" data-id="' . $row['id'] . '" style="border: none; background: none; cursor: pointer;"><i class="fa fa-trash" style="color: red;"></i></button></td>';

                    echo '</tr>';
                }
                ?>
            </tbody>
        </table>
    </div>

    <script>
    let selectedStudentId = null;

    function closeModal() {
        document.getElementById('deleteModal').style.display = 'none';
        selectedStudentId = null;
    }

    function openModal(studentId) {
        selectedStudentId = studentId;
        document.getElementById('deleteModal').style.display = 'flex';
    }

    document.addEventListener('DOMContentLoaded', function () {
        const searchInput = document.getElementById('studentSearch');
        const departmentFilter = document.getElementById('departmentFilter');
        const rows = document.querySelectorAll('#studentsTable tbody tr');

        function filterTable() {
            const searchValue = searchInput.value.toLowerCase();
            const selectedDept = departmentFilter.value.toLowerCase();

            rows.forEach(row => {
                const name = row.children[1].textContent.toLowerCase();
                const department = row.children[4].textContent.toLowerCase();

                const matchesSearch = name.includes(searchValue);
                const matchesDepartment = selectedDept === '' || department === selectedDept;

                row.style.display = (matchesSearch && matchesDepartment) ? '' : 'none';
            });
        }

        searchInput.addEventListener('keyup', filterTable);
        departmentFilter.addEventListener('change', filterTable);

        document.querySelectorAll('.delete-btn').forEach(button => {
            button.addEventListener('click', function () {
                const studentId = this.getAttribute('data-id');
                openModal(studentId);
            });
        });

        document.getElementById('confirmDeleteBtn').addEventListener('click', function () {
            if (!selectedStudentId) return;

            fetch('update.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: 'id=' + encodeURIComponent(selectedStudentId)
            })
            .then(response => response.text())
            .then(result => {
                if (result.trim() === 'success') {
                    const row = document.querySelector('tr[data-id="' + selectedStudentId + '"]');
                    if (row) row.remove();
                    closeModal();
                } else {
                    alert('Failed to delete student.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred.');
            });
        });
    });
</script>

<?php endif; ?>
<!-- View Students End -->




            <!-- View Teachers Start -->
<?php if (@$_GET['q'] == 2): ?>
    <div class="section-panel">
        <div class="search-table" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px;">
            <!-- Search Input (left) -->
            <div style="display: flex; align-items: center; gap: 10px;">
                <label for="teacherSearch">Search:</label>
                <input type="text" id="teacherSearch" class="form-control" placeholder="Search by name...">
            </div>
            
            <!-- Filter Select (right) -->
            <select id="teacherDepartmentFilter" class="form-control" style="width: 200px;">
                <option value="">All Departments</option>
                <?php
                $dept_result = mysqli_query($con, "SELECT DISTINCT department FROM user WHERE role = 'teacher' ORDER BY department ASC") or die('Error fetching departments');
                while ($dept_row = mysqli_fetch_array($dept_result)) {
                    $department = htmlspecialchars($dept_row['department']);
                    echo "<option value=\"$department\">$department</option>";
                }
                ?>
            </select>
        </div>

        <table class="t-teacher-table table title1" id="teachersTable">
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
                $result = mysqli_query($con, "SELECT * FROM user WHERE role = 'teacher' ORDER BY id ASC") or die('Error fetching teachers');
                while ($row = mysqli_fetch_array($result)) {
                    echo '<tr>';
                    echo '<td>' . $row['id'] . '</td>';
                    echo '<td>' . htmlspecialchars($row['name']) . ' ' . htmlspecialchars($row['fatherName']) . '</td>';
                    echo '<td>' . htmlspecialchars($row['email']) . '</td>';
                    echo '<td>' . htmlspecialchars($row['college']) . '</td>';
                    echo '<td>' . htmlspecialchars($row['department']) . '</td>';
                    echo '<td>' . htmlspecialchars($row['phone']) . '</td>';
                    echo '</tr>';
                }
                ?>
            </tbody>
        </table>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const searchInput = document.getElementById('teacherSearch');
        const departmentFilter = document.getElementById('teacherDepartmentFilter');
        const rows = document.querySelectorAll('#teachersTable tbody tr');

        function filterTable() {
            const searchValue = searchInput.value.toLowerCase();
            const selectedDept = departmentFilter.value.toLowerCase();

            rows.forEach(row => {
                const name = row.children[1].textContent.toLowerCase();
                const department = row.children[4].textContent.toLowerCase();

                const matchesSearch = name.includes(searchValue);
                const matchesDepartment = selectedDept === '' || department === selectedDept;

                row.style.display = (matchesSearch && matchesDepartment) ? '' : 'none';
            });
        }

        searchInput.addEventListener('keyup', filterTable);
        departmentFilter.addEventListener('change', filterTable);
    });
    </script>
<?php endif; ?>
<!-- View Teachers End -->


          <?php  

            // Ranking Start
if (@$_GET['q'] == 3) {
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
?>
<!--ranking end-->



            <!--add Student-->
            <?php
if (isset($_GET['q']) && $_GET['q'] == 4) {
    echo "
    <div class=\"section-panel title\">
        <div class=\"row\">
            <span class=\"title1\" style=\"color:#3d52a0; display:flex; justify-content:center; font-size:30px;\">
                <b>Add Student Details</b>
            </span>

            <form class=\"form-horizontal title1\" name=\"form\" action=\"update.php?q=addStudent\" method=\"POST\" style=\"padding:20px; align-items:center;\">
                <fieldset class=\"add-student-form\">

                    <!-- Student Name -->
                    <div class=\"form-group\">
                        <label class=\"col-md-12\" for=\"name\">Full Name:</label>
                        <div class=\"col-md-12\">
                            <input id=\"name\" name=\"name\" placeholder=\"Enter student name\" class=\"form-control input-md\" type=\"text\" required>
                        </div>
                    </div>

                    <!-- Fathers Name -->
                    <div class=\"form-group\">
                        <label class=\"col-md-12\" for=\"fatherName\">Father Name:</label>
                        <div class=\"col-md-12\">
                            <input id=\"fatherName\" name=\"fatherName\" placeholder=\"Enter father name\" class=\"form-control input-md\" type=\"text\">
                        </div>
                    </div>

                    <!-- Email -->
                    <div class=\"form-group\">
                        <label class=\"col-md-12\" for=\"email\">Email:</label>
                        <div class=\"col-md-12\">
                            <input id=\"email\" name=\"email\" placeholder=\"Enter email address\" class=\"form-control input-md\" type=\"email\" required>
                        </div>
                    </div>

                    <!-- Password -->
                    <div class=\"form-group\">
                        <label class=\"col-md-12\" for=\"password\">Password:</label>
                        <div class=\"col-md-12\">
                            <input id=\"password\" name=\"password\" placeholder=\"Enter password\" class=\"form-control input-md\" type=\"password\" maxlength=\"18\" required>
                        </div>
                    </div>

                    <!-- Gender -->
                    <div class=\"form-group\">
                        <label class=\"col-md-12\" for=\"gender\">Gender:</label>
                        <div class=\"col-md-12\">
                            <select id=\"gender\" name=\"gender\" class=\"form-control input-md\" required>
                                <option value=\"\">Select Gender</option>
                                <option value=\"M\">Male</option>
                                <option value=\"F\">Female</option>
                            </select>
                        </div>
                    </div>

                    <!-- College -->
                    <div class=\"form-group\">
                        <label class=\"col-md-12\" for=\"college\">College:</label>
                        <div class=\"col-md-12\">
                            <input id=\"college\" name=\"college\" placeholder=\"Enter college name\" class=\"form-control input-md\" type=\"text\">
                        </div>
                    </div>

                    <!-- Department -->
                    <div class=\"form-group\">
                        <label class=\"col-md-12\" for=\"department\">Department:</label>
                        <div class=\"col-md-12\">
                            <input id=\"department\" name=\"department\" placeholder=\"Enter department name\" class=\"form-control input-md\" type=\"text\" required>
                        </div>
                    </div>

                    <!-- Phone -->
                    <div class=\"form-group\">
                        <label class=\"col-md-12\" for=\"phone\">Phone Number:</label>
                        <div class=\"col-md-12\">
                            <input id=\"phone\" name=\"phone\" placeholder=\"Enter phone number\" class=\"form-control input-md\" type=\"text\">
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class=\"form-group\" style=\"justify-content:center; margin-top:40px;\">
                        <div class=\"col-md-12 text-center\">
                            <button type=\"submit\" class=\"primary-button\" style=\"font-size:20px;\">Submit</button>
                        </div>
                    </div>

                </fieldset>
            </form>
        </div>
    </div>";

}
?>

            

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
    <script src="js/script.js"></script>
</body>
</html>