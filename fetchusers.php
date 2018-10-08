<?php
include_once('db.php');
session_start();
$output = array('data' => array());
$sql = "SELECT CONCAT(FirstName, LastName) AS FullName, UserID, username, EmailAddress, ImmediateSuperior, UserType FROM user";
$query = $conn->query($sql);
$a = 1;
while($row = $query->fetch_assoc()){
	$updatebutton = '<div class="btn-group">
	<button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Action <span class="caret"></span>
	</button>
	<ul class = "dropdown-menu">
		<li><a type="button" data-toggle="modal" data-target="#editUserModal" onclick="editUser('.$row['UserID'].')"><span class="glyphicon glyphicon-edit"></span> Edit</a>
		</li>
		<li><a type="button" data-toggle="modal" data-target="#removeUserModal" onclick="removeUser('.$row['UserID'].')"><span class="glyphicon glyphicon-trash"></span> Delete</a>
		</li> ';
	$output['data'][] = array(
		$row['FullName'],
		$row['username'],
		$row['EmailAddress'],
		$row['ImmediateSuperior'],
		$row['UserType'],
		$updatebutton
	);
	$a++;
}
echo json_encode($output);
?>