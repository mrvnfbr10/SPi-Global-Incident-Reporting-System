<?php
include_once('db.php');
session_start();
$output = array('data' => array());
$sql = "SELECT * FROM task";
$query = $conn->query($sql);
$a = 1;
while($row = $query->fetch_assoc()){
	$updatebutton = '<a href="updateTicket.php?edit='.$row['TicketNo'].'"class="btn btn-warning btn-sm"><span class="glyphicon glyphicon-pencil"></span> Update Ticket</a>';
	$output['data'][] = array(
		$row['TaskTitle'],
		$row['Notes'],
		$row['AssignedGroup'],
		$row['AssignedAnalyst'],
		$row['CreationDate'],
		$row['Status'],
		$updatebutton
	);
	$a++;
}
echo json_encode($output);
?>