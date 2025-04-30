<?php
include_once 'dbConnection.php';
session_start();
$email=$_SESSION['email'];
//delete feedback
if(isset($_SESSION['key'])){
if(@$_GET['fdid'] && $_SESSION['key']=='prasanth123') {
$id=@$_GET['fdid'];
$result = mysqli_query($con,"DELETE FROM feedback WHERE id='$id' ") or die('Error');
header("location:admin.php?q=3");
}
}

//delete user
if(isset($_SESSION['key'])){
if(@$_GET['demail'] && $_SESSION['key']=='prasanth123') {
$demail=@$_GET['demail'];
$r1 = mysqli_query($con,"DELETE FROM rank WHERE email='$demail' ") or die('Error');
$r2 = mysqli_query($con,"DELETE FROM history WHERE email='$demail' ") or die('Error');
$result = mysqli_query($con,"DELETE FROM user WHERE email='$demail' ") or die('Error');
header("location:admin.php?q=1");
}
}

//delete admin

if(isset($_SESSION['key'])){
if(@$_GET['demail1'] && $_SESSION['key']=='prasanth123') {
$demail1=@$_GET['demail1'];

$result = mysqli_query($con,"DELETE FROM user WHERE email='$demail1' and role ='teacher' ") or die('Error');
header("location:admin.php?q=5");
}
}

//delete head

if(isset($_SESSION['key'])){
if(@$_GET['demail1'] && $_SESSION['key']=='prasanth123') {
$demail1=@$_GET['demail1'];

$result = mysqli_query($con,"DELETE FROM user WHERE email='$demail1' and role ='head' ") or die('Error');
header("location:admin.php?q=7");
}
}



//remove exam
if(isset($_SESSION['key'])){
if(@$_GET['q']== 'rmExam' && $_SESSION['key']=='prasanth123') {
$eid=@$_GET['eid'];
$result = mysqli_query($con,"SELECT * FROM questions WHERE eid='$eid'") or die('Error');
while($row = mysqli_fetch_array($result)) {
	$qid = $row['qid'];
$r1 = mysqli_query($con,"DELETE FROM options WHERE qid='$qid'") or die('Error');
$r2 = mysqli_query($con,"DELETE FROM answer WHERE qid='$qid' ") or die('Error');
}
$r3 = mysqli_query($con,"DELETE FROM questions WHERE eid='$eid' ") or die('Error');
$r4 = mysqli_query($con,"DELETE FROM exam WHERE eid='$eid' ") or die('Error');
$r4 = mysqli_query($con,"DELETE FROM history WHERE eid='$eid' ") or die('Error');

header("location:teacher.php?q=5");
}
}

//add exam
if(isset($_SESSION['key'])){
if(@$_GET['q']== 'addExam' && $_SESSION['key']=='prasanth123') {
$name = $_POST['name'];
$name= ucwords(strtolower($name));
$department = $_POST['department'];
$total = $_POST['total'];
$mark = $_POST['right'];
$time = $_POST['time'];
$desc = $_POST['desc'];
$id=uniqid();
$q3=mysqli_query($con,"INSERT INTO exam VALUES  ('$id', '$name', 'department', '$mark','$total' , '$time' , '$desc', NOW() ,'$email')");

header("location:teacher.php?q=4&step=2&eid=$id&n=$total");
}
}

//add question
if(isset($_SESSION['key'])){
if(@$_GET['q']== 'addqns' && $_SESSION['key']=='prasanth123') {
$n=@$_GET['n'];
$eid=@$_GET['eid'];
$ch=@$_GET['ch'];

for($i=1;$i<=$n;$i++)
 {
 $qid=uniqid();
 $qns=$_POST['qns'.$i];
$q3=mysqli_query($con,"INSERT INTO questions VALUES  ('$eid','$qid','$qns' , '$ch' , '$i')");
  $oaid=uniqid();
  $obid=uniqid();
$ocid=uniqid();
$odid=uniqid();
$a=$_POST[$i.'1'];
$b=$_POST[$i.'2'];
$c=$_POST[$i.'3'];
$d=$_POST[$i.'4'];
$qa=mysqli_query($con,"INSERT INTO options VALUES  ('$qid','$a','$oaid')") or die('Error61');
$qb=mysqli_query($con,"INSERT INTO options VALUES  ('$qid','$b','$obid')") or die('Error62');
$qc=mysqli_query($con,"INSERT INTO options VALUES  ('$qid','$c','$ocid')") or die('Error63');
$qd=mysqli_query($con,"INSERT INTO options VALUES  ('$qid','$d','$odid')") or die('Error64');
$e=$_POST['ans'.$i];
switch($e)
{
case 'a':
$ansid=$oaid;
break;
case 'b':
$ansid=$obid;
break;
case 'c':
$ansid=$ocid;
break;
case 'd':
$ansid=$odid;
break;
default:
$ansid=$oaid;
}


$qans=mysqli_query($con,"INSERT INTO answer VALUES  ('$qid','$ansid')");

 }
header("location:teacher.php?q=0");
}
}

//exam start
if(@$_GET['q']== 'exam' && @$_GET['step']== 2) {
$eid=@$_GET['eid'];
$sn=@$_GET['n'];
$total=@$_GET['t'];
$ans=$_POST['ans'];
$qid=@$_GET['qid'];
$q=mysqli_query($con,"SELECT * FROM answer WHERE qid='$qid' " );
while($row=mysqli_fetch_array($q) )
{
$ansid=$row['ansid'];
}
if($ans == $ansid)
{
$q=mysqli_query($con,"SELECT * FROM exam WHERE eid='$eid' " );
while($row=mysqli_fetch_array($q) )
{
$mark=$row['mark'];
}
if($sn == 1)
{
$q=mysqli_query($con,"INSERT INTO history VALUES('$email','$eid' ,'0','0','0','0',NOW())")or die('Error');
}
$q=mysqli_query($con,"SELECT * FROM history WHERE eid='$eid' AND email='$email' ")or die('Error115');

while($row=mysqli_fetch_array($q) )
{
$s=$row['score'];
$r=$row['mark'];
}
$r++;
$s=$s+$mark;
$q=mysqli_query($con,"UPDATE `history` SET `score`=$s,`level`=$sn,`mark`=$r, date= NOW()  WHERE  email = '$email' AND eid = '$eid'")or die('Error124');

} 
else
{
$q=mysqli_query($con,"SELECT * FROM exam WHERE eid='$eid' " )or die('Error129');

while($row=mysqli_fetch_array($q) )
{
}
if($sn == 1)
{
$q=mysqli_query($con,"INSERT INTO history VALUES('$email','$eid' ,'0','0','0','0',NOW() )")or die('Error137');
}
$q=mysqli_query($con,"SELECT * FROM history WHERE eid='$eid' AND email='$email' " )or die('Error139');
while($row=mysqli_fetch_array($q) )
{
$s=$row['score'];
}
$w++;
$q=mysqli_query($con,"UPDATE `history` SET `score`=$s,`level`=$sn, date=NOW() WHERE  email = '$email' AND eid = '$eid'")or die('Error147');
}
if($sn != $total)
{
$sn++;
header("location:student.php?q=exam&step=2&eid=$eid&n=$sn&t=$total")or die('Error152');
}
else if( $_SESSION['key']!='prasanth123')
{
$q=mysqli_query($con,"SELECT score FROM history WHERE eid='$eid' AND email='$email'" )or die('Error156');
while($row=mysqli_fetch_array($q) )
{
$s=$row['score'];
}
$q=mysqli_query($con,"SELECT * FROM rank WHERE email='$email'" )or die('Error161');
$rowcount=mysqli_num_rows($q);
if($rowcount == 0)
{
$q2=mysqli_query($con,"INSERT INTO rank VALUES('$email','$s',NOW())")or die('Error165');
}
else
{
while($row=mysqli_fetch_array($q) )
{
$sun=$row['score'];
}
$sun=$s+$sun;
$q=mysqli_query($con,"UPDATE `rank` SET `score`=$sun ,time=NOW() WHERE email= '$email'")or die('Error174');
}
header("location:student.php?q=result&eid=$eid");
}
else
{
header("location:student.php?q=result&eid=$eid");
}
}

//restart exam
if(@$_GET['q']== 'quizre' && @$_GET['step']== 25 ) {
$eid=@$_GET['eid'];
$n=@$_GET['n'];
$t=@$_GET['t'];
$q=mysqli_query($con,"SELECT score FROM history WHERE eid='$eid' AND email='$email'" )or die('Error156');
while($row=mysqli_fetch_array($q) )
{
$s=$row['score'];
}
$q=mysqli_query($con,"DELETE FROM `history` WHERE eid='$eid' AND email='$email' " )or die('Error184');
$q=mysqli_query($con,"SELECT * FROM rank WHERE email='$email'" )or die('Error161');
while($row=mysqli_fetch_array($q) )
{
$sun=$row['score'];
}
$sun=$sun-$s;
$q=mysqli_query($con,"UPDATE `rank` SET `score`=$sun ,time=NOW() WHERE email= '$email'")or die('Error174');
header("location:student.php?q=exam&step=2&eid=$eid&n=1&t=$t");
}

// Delete User
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
  $id = intval($_POST['id']);
  $role = isset($_POST['role']) && in_array($_POST['role'], ['student', 'teacher', 'header']) ? $_POST['role'] : 'student';
  
  $stmt = mysqli_prepare($con, "DELETE FROM user WHERE id = ? AND role = ?");
  mysqli_stmt_bind_param($stmt, 'is', $id, $role);

  if (mysqli_stmt_execute($stmt)) {
    echo 'success';
  } else {
    echo 'error';
  }
}

// ADD Student
if (isset($_GET['q']) && $_GET['q'] == 'addStudent') {

  $name = $_POST['name'];
  $fatherName = $_POST['fatherName'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $gender = $_POST['gender'];
  $college = $_POST['college'];
  $department = $_POST['department'];
  $phone = $_POST['phone'];
  $role = 'student'; 

  $query = "INSERT INTO user (email, password, name, fatherName, gender, college, department, phone, role) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
  $stmt = $con->prepare($query);
  $stmt->bind_param("sssssssss", $email, $password, $name, $fatherName, $gender, $college, $department, $phone, $role);

  if ($stmt->execute()) {
      echo "<script>alert('Student added successfully.'); window.location.href='header.php?q=0';</script>";
  } else {
      echo "<script>alert('Error adding student: " . $stmt->error . "'); window.location.href='index.php?q=4';</script>";
  }

  $stmt->close();
  $con->close();
}

// Add user
if (isset($_GET['q']) && $_GET['q'] == 'addUser' && $_SERVER['REQUEST_METHOD'] === 'POST') {
  $name = $_POST['name'];
  $fatherName = $_POST['fatherName'] ?? '';
  $email = $_POST['email'];
  $password = $_POST['password'];
  $gender = $_POST['gender'];
  $college = $_POST['college'];
  $department = $_POST['department'];
  $phone = $_POST['phone'];
  $role = $_POST['role'];

  $stmt = mysqli_prepare($con, "INSERT INTO user (name, fatherName, email, password, gender, college, department, phone, role) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
  mysqli_stmt_bind_param($stmt, "sssssssss", $name, $fatherName, $email, $password, $gender, $college, $department, $phone, $role);
  if (mysqli_stmt_execute($stmt)) {
      header("Location: admin.php?q=0"); // or any confirmation page
      exit();
  } else {
      echo "Error: " . mysqli_error($con);
  }
}


// ?>