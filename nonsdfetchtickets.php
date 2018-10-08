<?php
include_once('db.php');
session_start();

$FullName = $_SESSION['FullName'];
$UserType = $_SESSION['UserType'];
$output = array('data' => array());
$sql = "SELECT TicketNo, Title, TicketDate, Status FROM tickets WHERE FirstApprover = '$FullName' OR SecondApprover = '$FullName' ";
$query = $conn->query($sql);
$a = 1;
while($row = $query->fetch_assoc()){
	$updatebutton = '<a href="nonsdupdateticket.php?edit='.$row['TicketNo'].'"class="btn btn-warning btn-sm"><span class="glyphicon glyphicon-pencil"></span> Update Ticket</a>';
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