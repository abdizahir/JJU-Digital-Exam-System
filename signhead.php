<?php
include_once 'dbConnection.php';

$ref=@$_GET['q'];
$email = $_POST['email'];
$password = $_POST['password'];
$name = $_POST['name'];
$gender = $_POST['gender'];
$college = $_POST['college'];
$phone = $_POST['phone'];

$q = mysqli_query($con, "INSERT INTO user (email, password, name, gender, college, phone, role) VALUES ('$email', '$password', '$name', '$gender', '$college', '$phone', 'head')");


header("location:$ref?q=Succesfully registered");


?>