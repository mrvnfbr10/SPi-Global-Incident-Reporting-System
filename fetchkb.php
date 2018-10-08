<?php
include_once('db.php');
session_start();
$output = array('data' => array());
$sql = "SELECT tblknowledge.ArticleNo AS ArticleNo, tblknowledge.Title AS Title, tblcategory.CategoryDescription AS Category, tblknowledge.CreatedBy AS Author, tblknowledge.CreationDate AS Date FROM tblknowledge INNER JOIN tblcategory ON tblknowledge.CategoryID = tblcategory.CategoryID ";
$query = $conn->query($sql);
$a = 1;
while($row = $query->fetch_assoc()){
	$updatebutton = '<div class="btn-group">
	<button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Action <span class="caret"></span>
	</button>
	<ul class = "dropdown-menu">
		<li><a type="button" data-toggle="modal" data-target="#editCatModal" onclick="editCat('.$row['ArticleNo'].')"><span class="glyphicon glyphicon-edit"></span> Edit</a>
		</li>
		<li><a type="button" data-toggle="modal" data-target="#removeCatModal" onclick="removeCat('.$row['ArticleNo'].')"><span class="glyphicon glyphicon-trash"></span> Delete</a>
		</li> ';
	$output['data'][] = array(
		$row['ArticleNo'],
		$row['Title'],
		$row['Category'],
		$row['Author'],
		$row['Date'],
		$updatebutton
	);
	$a++;
}
echo json_encode($output);
?>