<?php
include_once('db.php');
session_start();
include_once('sendmail.php');
//Fetch users
$fetchusers = "SELECT CONCAT(user.FirstName,  user.LastName) AS FullName, user.Username, user.EmailAddress, tblbusinessunit.BusinessUnitDesc as Campaign, user.Position, tblsite.SiteDesc AS Site, user.ImmediateSuperior, user.UserType FROM user INNER JOIN tblbusinessunit ON user.BusinessUnitID = tblbusinessunit.BusinessUnitID INNER JOIN tblsite ON user.SiteID = tblsite.SiteID";
$filterusers = mysqli_query($conn, $fetchusers);
$result = filterTable($fetchusers);

function filterTable($fetchusers){
  global $conn;
  $filter_Result = mysqli_query($conn, $fetchusers); 
  return $filter_Result;
}
//Fetch Category
$fetchCat = "SELECT CategoryDescription FROM tblcategory";
$filterCat = mysqli_query($conn, $fetchCat);
$catResult = filterCatTable($fetchCat);
function filterCatTable($fetchCat){
  global $conn;
  $filter_CatResult = mysqli_query($conn, $fetchCat);
  return $filter_CatResult;
}


$fetchCam = mysqli_query($conn, "SELECT * FROM tblbusinessunit");
$filterCam = mysqli_query($conn, "SELECT * FROM tblbusinessunit");



$fetchsuperior = "SELECT CONCAT(FirstName, LastName) as FullName FROM user";
$filtersuperior = mysqli_query($conn, $fetchsuperior);

$fetchsite = "SELECT * FROM tblsite";
$filtersite = mysqli_query($conn, $fetchsite);

$error = false;

if(isset($_POST['catSave'])){

  $CategoryDesc = $_POST['CategoryDesc'];
  

  if(empty($CategoryDesc)){
    $error = true;
    $errorCategory = "Please enter category description";
  }
  if(!$error){
    $sql = "INSERT INTO tblcategory (CategoryDescription) VALUES('$CategoryDesc')";
    if(mysqli_query($conn, $sql)){
      $successMsg = "Succesfully added category into database!";
    }
    else{
      $successMsg = "Opps! Something went wrong, please try again later.".mysqli_error($conn);
    }
  }
}

if(isset($_POST['editCat'])){

  $CategoryID = $_POST['CategoryID'];
  $CategoryDesc = $_POST['CategoryDesc'];
  

  if(empty($CategoryDesc)){
    $error = true;
    $errorCategory = "Please enter category description";
  }
  if(!$error){
    $sql = "UPDATE tblcategory SET CategoryDescription = '$CategoryDesc' WHERE CategoryID = '$CategoryID' ";
    if(mysqli_query($conn, $sql)){
      $successMsg = "Succesfully updated category into database!";
    }
    else{
      $successMsg = "Opps! Something went wrong, please try again later.".mysqli_error($conn);
    }
  }
}

if(isset($_POST['delCat'])){

  $CategoryID = $_POST['removeCategoryID'];
  $CategoryDesc = $_POST['removeCategoryDesc'];
  

  if(empty($CategoryDesc)){
    $error = true;
    $errorDeparment = "Please enter category description";
  }
  if(!$error){
    $sql = "DELETE FROM tblcategory WHERE CategoryID = '$CategoryID' ";
    if(mysqli_query($conn, $sql)){
      $successMsg = "Succesfully deleted department into database!";
    }
    else{
      $successMsg = "Opps! Something went wrong, please try again later.".mysqli_error($conn);
    }
  }
}

if(isset($_POST['camSave'])){

  $CampaignName = $_POST['CampaignName'];
  $SupportGroup = $_POST['supportgroup'];

  if(empty($CampaignName)){
    $error = true;
    $errorCategory = "Please enter Business Unit/Campaign Name";
  }
  if(!$error){
    $sql = "INSERT INTO tblbusinessunit (BusinessUnitDesc, SupportGroup) VALUES('$CampaignName','$SupportGroup')";
    if(mysqli_query($conn, $sql)){
      $successMsg = "Succesfully added Campaign into database!";
    }
    else{
      $successMsg = "Opps! Something went wrong, please try again later.".mysqli_error($conn);
    }
  }
}

if(isset($_POST['editDept'])){

  $BusinessUnitID = $_POST['BusinessUnitID'];
  $BusinessUnitDesc = $_POST['BusinessUnitDesc'];
  

  if(empty($BusinessUnitDesc)){
    $error = true;
    $errorDeparment = "Please enter department description";
  }
  if(!$error){
    $sql = "UPDATE tblbusinessunit SET BusinessUnitDesc = '$BusinessUnitDesc' WHERE BusinessUnitID = '$BusinessUnitID' ";
    if(mysqli_query($conn, $sql)){
      $successMsg = "Succesfully updated category into database!";
    }
    else{
      $successMsg = "Opps! Something went wrong, please try again later.".mysqli_error($conn);
    }
  }
}

if(isset($_POST['delDept'])){

  $BusinessUnitID = $_POST['removeBusinessUnitID'];
  $BusinessUnitDesc = $_POST['removeBusinessUnitDesc'];
  

  if(empty($BusinessUnitDesc)){
    $error = true;
    $errorDeparment = "Please enter department description";
  }
  if(!$error){
    $sql = "DELETE FROM tblbusinessunit WHERE BusinessUnitID = '$BusinessUnitID' ";
    if(mysqli_query($conn, $sql)){
      $successMsg = "Succesfully deleted department into database!";
    }
    else{
      $successMsg = "Opps! Something went wrong, please try again later.".mysqli_error($conn);
    }
  }
}

if(isset($_POST['btnSave'])){
  $FirstName = $_POST['FirstName'];
  $LastName = $_POST['LastName'];
  $username = $_POST['username'];
  $password = $_POST['password'];
  $EmailAddress = $_POST['EmailAddress'];
  $Position = $_POST['Position'];
  $CallbackNumber = $_POST['CallbackNumber'];
  $BusinessUnit = $_POST['BusinessUnit'];
  $DeptName = $_POST['deptname'];
  $Site = $_POST['Site'];
  $ImmediateSuperior = $_POST['ImmediateSuperior'];
  $UserType = $_POST['UserType'];
  if(empty($FirstName)){
    $error = true;
    $errorFullName = "Please enter First Name.";
  }
  if(empty($LastName)){
    $error = true;
    $errorLastName = "Please enter Last Name.";
  }
  if(empty($username)){
    $error = true;
    $errorusername = "Please enter Username.";
  }
  if(empty($password)){
    $error = true;
    $errorpassword = "Please enter Password.";
  }
  if(empty($EmailAddress)){
    $error = true;
    $errorEmailAddress = "Please enter Email Address.";
  }
  if(empty($CallbackNumber)){
    $error = true;
    $errorCallbackNumber = "Please enter Callback Number.";
  }
  if(empty($BusinessUnit)){
    $error = true;
    $errorBusinessUnit = "Please enter Business Unit.";
  }
  if(empty($Position)){
    $error = true;
    $errorPosition = "Please enter position.";
  }
  if(empty($ImmediateSuperior)){
    $error = true;
    $errorImmediateSuperior = "Please enter Immediate Superior.";
  }
  if(empty($UserType)){
    $error = true;
    $errorUserType = "Please enter User Type.";
  }
  if(!$error){
    $sql = "INSERT INTO user (FirstName, LastName, Username, Password, EmailAddress, Position, CallbackNumber, BusinessUnitID, SiteID, ImmediateSuperior, UserType) VALUES ('$FirstName',' $LastName','$username','$password','$EmailAddress', '$Position', '$CallbackNumber','$BusinessUnit', '$Site','$ImmediateSuperior','$UserType')";
    if(mysqli_query($conn, $sql)){
      $successMsg = "Account has been sucessfully created!";
      userconfirmation();
    }
    else{
      $successMsg = "Opps! Something went wrong, please try again later.".mysqli_error($conn);
    }
  }
}

if(isset($_POST['editUser'])){
  $UserID = $_POST['UserID'];
  $FirstName = $_POST['FirstName'];
  $LastName = $_POST['LastName'];
  $username = $_POST['username'];
  $password = $_POST['password'];
  $EmailAddress = $_POST['EmailAddress'];
  $Position = $_POST['Position'];
  $CallbackNumber = $_POST['CallbackNumber'];
  $BusinessUnit = $_POST['BusinessUnit'];
  $Site = $_POST['Site'];
  $ImmediateSuperior = $_POST['ImmediateSuperior'];
  $UserType = $_POST['UserType'];
  if(empty($FirstName)){
    $error = true;
    $errorFullName = "Please enter First Name.";
  }
  if(empty($LastName)){
    $error = true;
    $errorLastName = "Please enter Last Name.";
  }
  if(empty($username)){
    $error = true;
    $errorusername = "Please enter Username.";
  }
  if(empty($password)){
    $error = true;
    $errorpassword = "Please enter Password.";
  }
  if(empty($EmailAddress)){
    $error = true;
    $errorEmailAddress = "Please enter Email Address.";
  }
  if(empty($CallbackNumber)){
    $error = true;
    $errorCallbackNumber = "Please enter Callback Number.";
  }
  if(empty($BusinessUnit)){
    $error = true;
    $errorBusinessUnit = "Please enter Business Unit.";
  }
  if(empty($Position)){
    $error = true;
    $errorPosition = "Please enter position.";
  }
  if(empty($ImmediateSuperior)){
    $error = true;
    $errorImmediateSuperior = "Please enter Immediate Superior.";
  }
  if(empty($UserType)){
    $error = true;
    $errorUserType = "Please enter User Type.";
  }
  if(!$error){
    $sql = "UPDATE user SET FirstName = '$FirstName', LastName = '$LastName', Username = '$username', Password = '$password', EmailAddress = '$EmailAddress', Position = '$Position', CallbackNumber = '$CallbackNumber', BusinessUnitID = '$BusinessUnit', SiteID = '$Site', ImmediateSuperior = '$ImmediateSuperior', UserType = '$UserType' WHERE UserID = '$UserID' ";
    if(mysqli_query($conn, $sql)){
      $successMsg = "Account data has been updated!";
    }
    else{
      $successMsg = "Opps! Something went wrong, please try again later.".mysqli_error($conn);
    }
  }
}

if(isset($_POST['delUser'])){

  $UserID = $_POST['removeUserID'];
  $FullName = $_POST['removeFullname'];
  

  if(empty($FullName)){
    $error = true;
    $errorDeparment = "Please enter category description";
  }
  if(!$error){
    $sql = "DELETE FROM user WHERE UserID = '$UserID' ";
    if(mysqli_query($conn, $sql)){
      $successMsg = "Succesfully removed user from database!";
    }
    else{
      $successMsg = "Opps! Something went wrong, please try again later.".mysqli_error($conn);
    }
  }
}



?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SPi Service Desk | File Maintenance</title>
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link href="css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="http://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet">
    <style>
      body{
        background-image:url(assets/background.png);
        height: 100%; 
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
      }
      </style>
  </head>
  <body>

    <nav class="navbar navbar-default">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">SPi Global Incident Reporting System</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav navbar-right">
            <li><h6 id = "demo"></h6></li>
            <li><a href="#">Welcome, <?php echo $_SESSION['FullName'] ?></a></li>
            <li><a href="login.php">Logout</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

    <header id="header">
      <div class="container">
        <div class="row">
        </div>
      </div>
    </header>

    <section id="breadcrumb">
      <div class="container">
        <ol class="breadcrumb">
          <li><a href="admindashboard.php">Dashboard</a></li>
          <li class="active">File Maintenance</li>
        </ol>
      </div>
    </section>

    <section id="main">
      <div class="container">
        <div class="row">
          <div class="col-md-3">
            <div class="list-group">
              <a href="admindashboard.php" class="list-group-item"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> Dashboard </a>
              <a href="fileIR.php" class="list-group-item"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> File Incident Report <span class="badge">12</span></a>
              <a href="previousIR.php" class="list-group-item"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Previous Incident Reports <span class="badge">33</span></a>
              <a href="opentickets.php" class="list-group-item"><span class="glyphicon glyphicon-tasks" aria-hidden="true"></span> Open Tickets <span class="badge">10</span></a>
              <a href="fileTicket.php" class="list-group-item"><span class="glyphicon glyphicon-download-alt" aria-hidden="true"></span> Log Ticket </a>
              <a href="users.php" class="list-group-item active main-color-bg"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> File Maintenance <span class="badge"></span></a>
            </div>

          </div>
          <div class="col-md-9">
            <!-- Website Overview -->
            <div class="panel panel-default">
              <div class="panel-heading main-color-bg">
                <h3 class="panel-title">File Maintenance</h3>
                      <?php 
                      if(isset($successMsg)){
                        ?>
                        <br>
                        <div class = "alert alert-success">
                          <span class = "glyphicon glyphicon-info-sign"></span>
                          <?php echo $successMsg; ?>
                        </div>
                      <?php
                      }
                        ?>

              </div>
              <div class="panel-body">
                <div class="row">
                      <ul class="nav nav-tabs">
                      <li class="active"><a data-toggle="tab" href="#list">Users</a></li>
                      <li><a data-toggle="tab" href="#Categories">Categories</a></li>
                      <li><a data-toggle="tab" href="#businessUnit">Business Unit</a></li>
                      </ul>     

                <div class="tab-content">
                  <div id="list" class="tab-pane fade in active">
                    <br>
                    <div class="col-md-12">
                     <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addUser">Add User</button>
                    <br>
                    <br>
                    <table class="table table-bordered table-hover" id="tblusers">
                     <thead>
                       <tr>
                         <th>Full Name</th>
                         <th>Username</th>
                         <th>Email Address</th>
                         <th>Immediate Superior</th>
                         <th>User Type</th>
                         <th>Action</th>
                       </tr>
                     </thead>
                    </table>
                    </div>
                  </div>

                  <div id="Categories" class="tab-pane">
                    <br>
                    <div class="col-md-12">
                     <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addCat">Add New Category</button>
                    <br>
                    <br>
                    <table class="table table-bordered table-hover" id="tblcategory">
                     <thead>
                       <tr>
                        <th>Category No</th>
                        <th>Category</th>
                        <th>Action</th>
                       </tr>
                     </thead>
                    </table>
                    </div>
                  </div>

                  <div id = "businessUnit" class="tab-pane fade">
                     <br>
                    <div class="col-md-12">
                     <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addDept">Add Department</button>
                    <br>
                    <br>
                    <table class="table table-bordered table-hover" id="tblbusinessunit">
                     <thead>
                       <tr>
                        <th>Department ID</th>
                        <th>Description</th>
                        <th>Action</th>
                       </tr>
                     </thead>
                    </table>
                    </div>
                  </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <footer id="footer">
      <p>Copyright SPi Global, &copy; 2018</p>
    </footer>

    <!-- Modals -->

    <!-- Add User Modal -->
    <div class="modal fade" id="addUser" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" autocomplete="off">
          <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">Add User</h4>
        </div>
        <div class="modal-body">
                    <div class="form-group">
                      <label>First Name</label>
                      <br>
                      <input type="text" class="form-control" name="FirstName" placeholder="Juan">
                      <span class="text-danger"><?php if(isset($errorFirstName)) echo $errorFirstName ?> </span>
                    </div>
                    <div class="form-group">
                      <label>Last Name</label>
                      <br>
                      <input type="text" class="form-control" name="LastName" placeholder="Juan">
                      <span class="text-danger"><?php if(isset($errorLastName)) echo $errorLastName ?> </span>
                    </div>
                    <div class="form-group">
                      <label>Username</label>
                      <br>
                      <input type="text" class="form-control" name="username" placeholder="user123">
                      <span class="text-danger"><?php if(isset($errorusername)) echo $errorusername ?> </span>
                    </div>
                    <div class="form-group">
                      <label>Password</label>
                      <br>
                      <input type="Password" class="form-control" name="password" placeholder="">
                      <span class="text-danger"><?php if(isset($errorpassword)) echo $errorpassword ?> </span>
                    </div>
                    <div class="form-group">
                      <label>Email Address</label>
                      <br>
                      <input type="Email" class="form-control" name="EmailAddress" placeholder="example@example.com">
                      <span class="text-danger"><?php if(isset($errorEmailAddress)) echo $errorEmailAddress ?> </span>
                    </div>
                    <div class="form-group">
                      <label>Callback Number</label>
                      <br>
                      <input type="text" class="form-control" name="CallbackNumber" placeholder="123456">
                      <span class="text-danger"><?php if(isset($errorCallbackNumber)) echo $errorCallbackNumber ?> </span>
                    </div>
                    <div class="form-group">
                      <label>Business Unit / Campaign</label>
                      <br>
                        <?php while($row = mysqli_fetch_array($fetchCam)):;?>
                      <input type="hidden" class="form-control" name="deptname" value="<?php echo $row[1];?>">
                        <?php endwhile;?>
                      <select class="form-control" name="BusinessUnit" id="BusinessUnit">
                        <?php while($row = mysqli_fetch_array($filterCam)):;?>
                      <option value="<?php echo $row[0];?>"><?php echo $row[1];?></option>
                                <?php endwhile;?>
                      </select>
                      <span class="text-danger"><?php if(isset($errorBusinessUnit)) echo $errorBusinessUnit ?> </span>
                    </div>
                    <div class="form-group">
                      <label>Position</label>
                      <br>
                      <input type="text" class="form-control" name="Position" placeholder="Media Officer">
                      <span class="text-danger"><?php if(isset($errorPosition)) echo $errorPosition ?> </span>
                    </div>
                    <div class="form-group">
                    <label>Site</label>
                    <select class="form-control" name="Site" id="sel1">
                      <?php while($row = mysqli_fetch_array($filtersite)):;?>
                      <option value="<?php echo $row[0];?>"><?php echo $row[1];?></option>
                                <?php endwhile;?>
                    </select>
                    <span class="text-danger"><?php if(isset($errorSite)) echo $errorSite ?> </span>
                  </div>
                    <div class="form-group">
                      <label>Immediate Superior</label>
                      <br>
                      <select class="form-control" name="ImmediateSuperior" id="sel2">
                      <?php while($row = mysqli_fetch_array($filtersuperior)):;?>
                      <option value="<?php echo $row['FullName'];?>"><?php echo $row['FullName'];?></option>
                                <?php endwhile;?>
                    </select>
                      <span class="text-danger"><?php if(isset($errorImmediateSuperior)) echo $errorImmediateSuperior ?> </span>
                    </div>
                    <div class="form-group">
                      <label>User Type</label>
                      <br>
                      <select class="form-control" name="UserType" id="UserType">
                        <option value="Service Desk Analyst">Service Desk Analyst</option>
                        <option value="End User">End User</option>
                        <option value="Non-SD">Non SD</option>
                      </select>
                      <span class="text-danger"><?php if(isset($errorUserType)) echo $errorUserType ?> </span>
                    </div>
        </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <input type="submit" name="btnSave" class="btn btn-primary" value="Add user">
      </div>
    </form>
    </div>
  </div>
</div>

<!--Edit User Modal-->

    <div class="modal fade" id="editUserModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" autocomplete="off">
          <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">Add User</h4>
        </div>
        <div class="modal-body">
                    <div class="form-group">
                      <input type="hidden" id="UserID" name="UserID" value="<?php echo $UserID; ?>">
                      <label>First Name</label>
                      <br>
                      <input type="text" class="form-control" id="FirstName" name="FirstName" placeholder="Juan">
                      <span class="text-danger"><?php if(isset($errorFirstName)) echo $errorFirstName ?> </span>
                    </div>
                    <div class="form-group">
                      <label>Last Name</label>
                      <br>
                      <input type="text" class="form-control" id="LastName" name="LastName" placeholder="Juan">
                      <span class="text-danger"><?php if(isset($errorLastName)) echo $errorLastName ?> </span>
                    </div>
                    <div class="form-group">
                      <label>Username</label>
                      <br>
                      <input type="text" class="form-control" id="username" name="username" placeholder="user123">
                      <span class="text-danger"><?php if(isset($errorusername)) echo $errorusername ?> </span>
                    </div>
                    <div class="form-group">
                      <label>Password</label>
                      <br>
                      <input type="Password" class="form-control" id="password" name="password" placeholder="">
                      <span class="text-danger"><?php if(isset($errorpassword)) echo $errorpassword ?> </span>
                    </div>
                    <div class="form-group">
                      <label>Email Address</label>
                      <br>
                      <input type="Email" class="form-control" id="EmailAddress" name="EmailAddress" placeholder="example@example.com">
                      <span class="text-danger"><?php if(isset($errorEmailAddress)) echo $errorEmailAddress ?> </span>
                    </div>
                    <div class="form-group">
                      <label>Callback Number</label>
                      <br>
                      <input type="text" class="form-control" id="CallbackNumber" name="CallbackNumber" placeholder="123456">
                      <span class="text-danger"><?php if(isset($errorCallbackNumber)) echo $errorCallbackNumber ?> </span>
                    </div>
                    <div class="form-group">
                      <label>Business Unit / Campaign</label>
                      <br>
                      <select class="form-control" name="BusinessUnit" id="newBusinessUnit">
                        <?php while($row = mysqli_fetch_array($filterCam)):;?>
                      <option value="<?php echo $row[0];?>"><?php echo $row[1];?></option>
                                <?php endwhile;?>
                      </select>
                      <span class="text-danger"><?php if(isset($errorBusinessUnit)) echo $errorBusinessUnit ?> </span>
                    </div>
                    <div class="form-group">
                      <label>Position</label>
                      <br>
                      <input type="text" class="form-control" id="Position" name="Position" placeholder="Media Officer">
                      <span class="text-danger"><?php if(isset($errorPosition)) echo $errorPosition ?> </span>
                    </div>
                    <div class="form-group">
                    <label>Site</label>
                    <select class="form-control" name="Site" id="newSite">
                      <?php while($row = mysqli_fetch_array($filtersite)):;?>
                      <option value="<?php echo $row[0];?>"><?php echo $row[1];?></option>
                                <?php endwhile;?>
                    </select>
                    <span class="text-danger"><?php if(isset($errorSite)) echo $errorSite ?> </span>
                  </div>
                    <div class="form-group">
                      <label>Immediate Superior</label>
                      <br>
                      <select class="form-control" name="ImmediateSuperior" id="ImmediateSuperior">
                      <?php while($row = mysqli_fetch_array($filtersuperior)):;?>
                      <option value="<?php echo $row['FullName'];?>"><?php echo $row['FullName'];?></option>
                                <?php endwhile;?>
                    </select>
                      <span class="text-danger"><?php if(isset($errorImmediateSuperior)) echo $errorImmediateSuperior ?> </span>
                    </div>
                    <div class="form-group">
                      <label>User Type</label>
                      <br>
                      <select class="form-control" name="UserType" id="newUserType">
                        <option value="Service Desk Analyst">Service Desk Analyst</option>
                        <option value="End User">End User</option>
                        <option value="Non-SD">Non SD</option>
                      </select>
                      <span class="text-danger"><?php if(isset($errorUserType)) echo $errorUserType ?> </span>
                    </div>
        </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <input type="submit" name="editUser" class="btn btn-primary" value="Save Changes">
      </div>
    </form>
    </div>
  </div>
</div>

<!--Remove User Modal-->
<div class="modal fade" id="removeUserModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" id="removeUserForm" autocomplete="off">
          <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">Remove User</h4>
        </div>
        <div class="modal-body">
            <input type="hidden" id="removeUserID" name="removeUserID" value="<?php echo $UserID; ?>">
            <div class="form-group">
              <label>User FullName</label>
                <br>
                  <input type="text" class="form-control" id="removeFullname" name="removeFullname">
                  <span class="text-danger"><?php if(isset($errorDeparment)) echo $errorDepartment ?> </span>
            </div>
        </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <input type="submit" name="delUser" class="btn btn-danger" value="Remove User">
      </div>
    </form>
    </div>
  </div>
</div>


<!--Add Category Modal -->
<div class="modal fade" id="addCat" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" autocomplete="off">
          <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">Add New Category</h4>
        </div>
        <div class="modal-body">
            <div class="form-group">
              <label>Category Description</label>
                <br>
                  <input type="text" class="form-control" name="CategoryDesc">
                  <span class="text-danger"><?php if(isset($errorCategory)) echo $errorCategory ?> </span>
            </div>
        </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <input type="submit" name="catSave" class="btn btn-primary" value="Add Category">
      </div>
    </form>
    </div>
  </div>
</div>

<!--Edit Category Modal -->
<div class="modal fade" id="editCatModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" id="editCatForm" autocomplete="off">
          <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">Edit Category</h4>
        </div>
        <div class="modal-body">
            <input type="hidden" id="CategoryID" name="CategoryID" value="<?php echo $CategoryID; ?>">
            <div class="form-group">
              <label>Category Description</label>
                <br>
                  <input type="text" class="form-control" id="CategoryDesc" name="CategoryDesc">
                  <span class="text-danger"><?php if(isset($errorCategory)) echo $errorCategory ?> </span>
            </div>
        </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <input type="submit" name="editCat" class="btn btn-primary" value="Save Changes">
      </div>
    </form>
    </div>
  </div>
</div>

<!--Remove Category Modal-->
<div class="modal fade" id="removeCatModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" id="removeCatForm" autocomplete="off">
          <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">Edit Category</h4>
        </div>
        <div class="modal-body">
            <input type="hidden" id="removeCategoryID" name="removeCategoryID" value="<?php echo $CategoryID; ?>">
            <div class="form-group">
              <label>Category Description</label>
                <br>
                  <input type="text" class="form-control" id="removeCategoryDesc" name="removeCategoryDesc">
                  <span class="text-danger"><?php if(isset($errorCategory)) echo $errorCategory ?> </span>
            </div>
        </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <input type="submit" name="delCat" class="btn btn-danger" value="Save Changes">
      </div>
    </form>
    </div>
  </div>
</div>

<!--Add Department Modal -->
<div class="modal fade" id="addDept" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" autocomplete="off">
          <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">Add Department</h4>
        </div>
        <div class="modal-body">
            <div class="form-group">
              <label>Business Unit/Campaign</label>
              <br>
              <input type="text" class="form-control" name="CampaignName">
            </div>
            <div class="form-group">
              <label>Is Department a Support Group?</label>
              <input type="radio" id="form-control" name="supportgroup" value="Yes">Yes
              <input type="radio" id="form-control" name="supportgroup" value="No">No
            </div>
        </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <input type="submit" name="camSave" class="btn btn-primary" value="Add Department">
      </div>
    </form>
    </div>
  </div>
</div>

<!--Edit Department Modal-->
<div class="modal fade" id="editDeptModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" id="editDeptForm" autocomplete="off">
          <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">Edit Department</h4>
        </div>
        <div class="modal-body">
            <input type="hidden" id="BusinessUnitID" name="BusinessUnitID" value="<?php echo $BusinessUnitID; ?>">
            <div class="form-group">
              <label>Department Name</label>
                <br>
                  <input type="text" class="form-control" id="BusinessUnitDesc" name="BusinessUnitDesc">
                  <span class="text-danger"><?php if(isset($errorDeparment)) echo $errorDepartment ?> </span>
            </div>
        </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <input type="submit" name="editDept" class="btn btn-warning" value="Save Changes">
      </div>
    </form>
    </div>
  </div>
</div>

<!--Remove Department Modal-->

<div class="modal fade" id="removeDeptModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" id="removeDeptForm" autocomplete="off">
          <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">Remove Department</h4>
        </div>
        <div class="modal-body">
            <input type="hidden" id="removeBusinessUnitID" name="removeBusinessUnitID" value="<?php echo $BusinessUnitID; ?>">
            <div class="form-group">
              <label>Department Name</label>
                <br>
                  <input type="text" class="form-control" id="removeBusinessUnitDesc" name="removeBusinessUnitDesc">
                  <span class="text-danger"><?php if(isset($errorDeparment)) echo $errorDepartment ?> </span>
            </div>
        </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <input type="submit" name="delDept" class="btn btn-danger" value="Save Changes">
      </div>
    </form>
    </div>
  </div>
</div>


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
     <script>
      var d = new Date();
      document.getElementById("demo").innerHTML = d;
      </script>

<script type="text/javascript">
  $(document).ready(function(){
   var tblusers =  $("#tblusers").DataTable({
    "ajax": "fetchusers.php",
    "order":[]
   });
  });
  function editUser(UserID = null){
    if(UserID){
      $.ajax({
        url: 'getuser.php',
        type: 'post',
        data: {UserID : UserID},
        dataType: 'json',
        success:function(response){
          $("#UserID").val(response.UserID);
          $("#FirstName").val(response.FirstName);
          $("#LastName").val(response.LastName);
          $("#username").val(response.Username);
          $("#password").val(response.Password);
          $("#EmailAddress").val(response.EmailAddress);
          $("#CallbackNumber").val(response.CallbackNumber);
          $("#newBusinessUnit").val(response.BusinessUnitID);
          $("#Position").val(response.Position);
          $("#newSite").val(response.SiteID);
          $("#newImmediateSuperior").val(response.ImmediateSuperior);
          $("#newUserType").val(response.UserType);
        }
      });
    }
    else{
      alert("Oops! Something went wrong kindly try again later.");
    }
  }
  function removeUser(UserID = null){
    if(UserID){
      $.ajax({
        url: 'getuser.php',
        type: 'post',
        data: {UserID : UserID},
        dataType: 'json',
        success:function(response){
          $("#removeUserID").val(response.UserID);
          $("#removeFullname").val(response.FirstName);
        }
      });
    }
  }
</script>

<script type="text/javascript">
  $(document).ready(function(){
   var tblcategory =  $("#tblcategory").DataTable({
    "ajax": "fetchcat.php",
    "order":[]
   });
  });
  function editCat(CategoryID = null){
    if(CategoryID){
      $.ajax({
        url: 'getcat.php',
        type: 'post',
        data: {CategoryID : CategoryID},
        dataType: 'json',
        success:function(response){
          $("#CategoryID").val(response.CategoryID);
          $("#CategoryDesc").val(response.CategoryDescription);
        }

      });
    }
    else{
      alert("Oops! Something went wrong kindly try again later.");
    }
  }
  function removeCat(CategoryID = null){
    if(CategoryID){
      $.ajax({
        url: 'getcat.php',
        type: 'post',
        data: {CategoryID : CategoryID},
        dataType: 'json',
        success:function(response){
          $("#removeCategoryID").val(response.CategoryID);
          $("#removeCategoryDesc").val(response.CategoryDescription);
        }

      });
    }
    else{
      alert("Oops! Something went wrong kindly try again later.");
    }
  }
</script>

<script type="text/javascript">
  $(document).ready(function(){
   var tblbusinessunit =  $("#tblbusinessunit").DataTable({
    "ajax": "fetchdept.php",
    "order":[]
   });
  });
  function editDept(BusinessUnitID = null){
    if(BusinessUnitID){
      $.ajax({
        url: 'getdept.php',
        type: 'post',
        data: {BusinessUnitID : BusinessUnitID},
        dataType: 'json',
        success:function(response){
          $("#BusinessUnitID").val(response.BusinessUnitID);
          $("#BusinessUnitDesc").val(response.BusinessUnitDesc);
        }

      });
    }
    else{
      alert("Oops! Something went wrong kindly try again later.");
    }
  }
  function removeDept(BusinessUnitID = null){
    if(BusinessUnitID){
      $.ajax({
        url: 'getdept.php',
        type: 'post',
        data: {BusinessUnitID : BusinessUnitID},
        dataType: 'json',
        success:function(response){
          $("#removeBusinessUnitID").val(response.BusinessUnitID);
          $("#removeBusinessUnitDesc").val(response.BusinessUnitDesc);
        }
      });
    }
  }
</script>

  </body>
</html>
