<?php 
$db = new PDO('mysql:host=localhost; dbanme=spiglobal','root','');
$page = isset($_GET['p'])?$_GET['p']:'';
if($page == 'add'){
		$firstName = $_POST["FirstName"];
        $lastName = $_POST["LastName"];
        $username = $_POST["username"];
        $password = $_POST["password"];
        $EmailAddress = $_POST["EmailAddress"];
        $position = $_POST["Position"];
        $callback = $_POST["CallbackNumber"];
        $department = $_POST["BusinessUnit"];
        $site = $_POST["Site"];
        $superior = $_POST["ImmediateSuperior"];
        $usertype = $_POST["UserType"];
        echo $firstName;
        $query = $db->prepare("INSERT INTO user (FirstName, LastName, Username, Password, EmailAddress, Position, CallbackNumber, BusinessUnitID, SiteID, ImmediateSuperior, UserType) VALUES (?,?,?,?,?,?,?,?,?,?,?)");
        $query->bindParam(1,$firstName);
        $query->bindParam(2,$lirstName);
        $query->bindParam(3,$username);
        $query->bindParam(4,$password);
        $query->bindParam(5,$EmailAddress);
        $query->bindParam(6,$position);
        $query->bindParam(7,$callback);
        $query->bindParam(8,$department);
        $query->bindParam(9,$site);
        $query->bindParam(10,$superior);
        $query->bindParam(11,$usertype);
        if($query->execute()){
        	echo "add";
        }else{
        	echo "no";
        }


}
?>,