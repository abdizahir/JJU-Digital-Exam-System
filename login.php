<?php
session_start();
if (isset($_SESSION["email"])) {
    session_destroy();
}

include_once 'dbConnection.php';

$ref=@$_GET['q'];
$email = $_POST['email'];
$password = $_POST['password'];
$role = $_POST['role'];  // Get role (student or teacher)

$role === 'student' ? 
$query = "SELECT name FROM user WHERE email = '$email' AND password = '$password'" : 
$query = "SELECT email FROM admin WHERE email = '$email' and password = '$password'";


$result = mysqli_query($con, $query);
// $result = mysqli_query($con, $query2);

if (!$result) {
    echo json_encode(['success' => false, 'message' => 'Database error.']);
    exit;
}

$count = mysqli_num_rows($result);

if ($count === 1) {
	// Redirect based on the selected role
    if ($role === 'student') {
		while ($row = mysqli_fetch_array($result)) {
			$name = $row['name'];
		}
		
		$_SESSION["name"] = $name;
		$_SESSION["key"] ='prasanth123';
		$_SESSION["email"] = $email;
        $redirect = 'student.php?q=1'; // Redirect to the student page
    } else {
		$_SESSION["name"] = 'Teacher';
		$_SESSION["key"] ='prasanth123';
		$_SESSION["email"] = $email;
        $redirect = "teacher.php?q=0";   // Redirect to the teacher page
    }

    echo json_encode(['success' => true, 'redirect' => $redirect]);

} else {
    echo json_encode(['success' => false, 'message' => 'Wrong username or password.']);
}

exit;
?>