<?php
include_once('db.php');
session_start();
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

$fetchCam = "SELECT * FROM tblbusinessunit";
$filterCam = mysqli_query($conn, $fetchCam);
$camResult = filterCamTable($fetchCam);
function filterCamTable($fetchCam){
  global $conn;
  $filter_CamResult = mysqli_query($conn, $fetchCam);
  return $filter_CamResult;
}
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
if(isset($_POST['camSave'])){

  $CampaignName = $_POST['CampaignName'];
  

  if(empty($CampaignName)){
    $error = true;
    $errorCategory = "Please enter Business Unit/Campaign Name";
  }
  if(!$error){
    $sql = "INSERT INTO tblbusinessunit (BusinessUnitDesc) VALUES('$CampaignName')";
    if(mysqli_query($conn, $sql)){
      $successMsg = "Succesfully added Campaign into database!";
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
    <script src="http://cdn.ckeditor.com/4.6.1/standard/ckeditor.js"></script>
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
          <li><a href="index.php">Dashboard</a></li>
          <li class="active">File Maintenance</li>
        </ol>
      </div>
    </section>

    <section id="main">
      <div class="container">
        <div class="row">
          <div class="col-md-3">
            <div class="list-group">
              <a href="index.php" class="list-group-item"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> Dashboard </a>
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
                      <li class="active"><a data-toggle="tab" href="#list">All users</a></li>
                      <li><a data-toggle="tab" href="#form">Add User</a></li>
                      <li><a data-toggle="tab" href="#Categories">Categories</a></li>
                      <li><a data-toggle="tab" href="#businessUnit">Business Unit</a></li>
                      </ul>        
                <div class="tab-content">
                  <div id="list" class="tab-pane fade in active">
                    <br>
                    <div class="col-md-12">
                          <input class="form-control" type="text" placeholder="Filter Users...">
                    <br>
                    <table class="table table-bordered table-hover">
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
                     <?php while($row = mysqli_fetch_array($result)): ?>
                      <tbody>
                        <tr>
                          <td><?php echo $row['FullName'];?></td>
                          <td><?php echo $row['Username'];?></td>
                          <td><?php echo $row['EmailAddress'];?></td>
                          <td><?php echo $row['ImmediateSuperior'];?></td>
                          <td><?php echo $row['UserType'];?></td>
                          <td><button type="button" class="btn btn-warning" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-pencil"></span><span> Update User</span></td>
                        </tr>
                      </tbody>
                    <?php endwhile;?>
                    </table>
                    </div>
                  </div>

                   <div id="form" class="tab-pane fade">
                    <div class="col-md-12">
                    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" autocomplete="off">
                    <br>
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
                      <select class="form-control" name="ImmediateSuperior" id="sel1">
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
                    <div class="form-group">
                      <input type="submit" name="btnSave" value="Register User" class="btn-lg btn-primary btn-block">
                    </div>
                  </form>
                </div>
                </div>

                  <div id = "Categories" class="tab-pane fade">
                    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" autocomplete="off">
                      <div class="col-md-12">
                        <br>
                      <div class="form-group">
                        <label>Category Description</label>
                        <br>
                        <input type="text" class="form-control" name="CategoryDesc">
                        <span class="text-danger"><?php if(isset($errorCategory)) echo $errorCategory ?> </span>
                      </div>
                      <div class="form-group">
                        <input type="submit" name="catSave" value="Add Category" class="btn btn-primary btn-block">
                      </div>
                    </form>
                    <br>
                    <table class="table table-bordered table-hover">
                      <thead>
                        <tr>
                          <th>Category List</th>
                        </tr>
                      </thead>
                      <?php while($row = mysqli_fetch_array($catResult)): ?>
                      <tbody>
                        <tr>
                          <td><?php echo $row['CategoryDescription']; ?></td>
                        </tr>
                      </tbody>
                       <?php endwhile;?>
                    </table>
                  </div>
                </div>

                  <div id = "businessUnit" class="tab-pane fade">
                    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" autocomplete="off">
                      <div class="col-md-12">
                        <br>
                      <div class="form-group">
                        <label>Business Unit/Campaign</label>
                        <br>
                        <input type="text" class="form-control" name="CampaignName">
                      </div>
                      <div class="form-group">
                        <input type="submit" name="camSave" value="Add Campaign" class="btn btn-primary btn-block">
                      </div>
                    </form>
                    <br>
                    <table class="table table-bordered table-hover">
                      <thead>
                        <tr>
                          <th>Campaign List</th>
                        </tr>
                      </thead>
                      <?php while($row = mysqli_fetch_array($camResult)): ?>
                      <tbody>
                        <tr>
                          <td><?php echo $row['BusinessUnitDesc']; ?></td>
                        </tr>
                      </tbody>
                       <?php endwhile;?>
                    </table>
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

    <!-- Add Page -->
    <div class="modal fade" id="addPage" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form>
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Add Page</h4>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label>Page Title</label>
          <input type="text" class="form-control" placeholder="Page Title">
        </div>
        <div class="form-group">
          <label>Page Body</label>
          <textarea name="editor1" class="form-control" placeholder="Page Body"></textarea>
        </div>
        <div class="checkbox">
          <label>
            <input type="checkbox"> Published
          </label>
        </div>
        <div class="form-group">
          <label>Meta Tags</label>
          <input type="text" class="form-control" placeholder="Add Some Tags...">
        </div>
        <div class="form-group">
          <label>Meta Description</label>
          <input type="text" class="form-control" placeholder="Add Meta Description...">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
    </form>
    </div>
  </div>
</div>

  <script>
     CKEDITOR.replace( 'editor1' );
 </script>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>
