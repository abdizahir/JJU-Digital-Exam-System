<?php
session_start();
if (isset($_SESSION["email"])) {
    session_destroy();
}

include_once 'dbConnection.php';

$email = $_POST['email'];
$password = $_POST['password'];

$query = "SELECT name, role FROM user WHERE email = '$email' AND password = '$password'";

$result = mysqli_query($con, $query);

if (!$result) {
    echo json_encode(['success' => false, 'message' => 'Database error.']);
    exit;
}

$count = mysqli_num_rows($result);

if ($count === 1) {
    $row = mysqli_fetch_assoc($result);
    $name = $row['name'];
    $role = $row['role']; 

    $_SESSION["name"] = $name;
    $_SESSION["key"] = 'prasanth123';
    $_SESSION["email"] = $email;
    $_SESSION["role"] = $role;

    if ($role === 'student') {
        $redirect = 'student.php?q=1';
    } else if ($role === 'teacher') {
        $redirect = 'teacher.php?q=0';
    }else if ($role === 'admin') {
        $redirect = 'admin.php?q=0';
    } else {
        echo json_encode(['success' => false, 'message' => 'Invalid user role.']);
        exit;
    }

    echo json_encode(['success' => true, 'redirect' => $redirect]);

} else {
    echo json_encode(['success' => false, 'message' => 'Wrong email or password.']);
}

exit;
?>
