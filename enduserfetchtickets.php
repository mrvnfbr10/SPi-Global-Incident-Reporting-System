<?php
include_once('db.php');
session_start();
$FullName = $_SESSION['FullName'];
$UserType = $_SESSION['UserType'];
$UserID = $_SESSION['UserID'];
$output = array('data' => array());
$sql = "SELECT TicketNo, Title, TicketDate, Status FROM tickets WHERE UserID = '$UserID'";
$query = $conn->query($sql);
$a = 1;
while($row = $query->fetch_assoc()){
	$updatebutton = '<a href="updateticketsportal.php?edit='.$row['TicketNo'].'"class="btn btn-warning btn-sm"><span class="glyphicon glyphicon-pencil"></span> Open Ticket</a>';
	$output['data'][] = array(
		$row['TicketNo'],
		$row['Title'],
		$row['TicketDate'],
		$row['Status'],
		$updatebutton
	);
	$a++;
}
echo json_encode($output);
?>