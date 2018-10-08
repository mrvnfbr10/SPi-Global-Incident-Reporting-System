<?php
include_once('db.php');
session_start();
$BusinessUnitID = $_POST['BusinessUnitID'];
$sql = "SELECT * FROM tblbusinessunit WHERE BusinessUnitID = '$BusinessUnitID'";
$query = $conn->query($sql);
$output = $query->fetch_assoc();

echo json_encode($output);
?>