<?php
include_once('db.php');
session_start();
$UserID = $_POST['UserID'];
$sql = "SELECT * FROM user WHERE UserID = '$UserID'";
$filtersuperior = mysqli_query($conn, "SELECT CONCAT(FirstName, LastName) as FullName FROM user");
$filtersite = mysqli_query($conn, "SELECT * FROM tblsite");
$filterCam = mysqli_query($conn, "SELECT * FROM tblbusinessunit");
$query = $conn->query($sql);
$output = $query->fetch_assoc();

echo json_encode($output);
?>