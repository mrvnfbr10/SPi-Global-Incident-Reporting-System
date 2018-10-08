<?php
include_once('db.php');
session_start();
$CategoryID = $_POST['CategoryID'];
$sql = "SELECT * FROM tblcategory WHERE CategoryID = '$CategoryID'";
$query = $conn->query($sql);
$output = $query->fetch_assoc();

echo json_encode($output);
?>