<?php
include_once('db.php');
session_start();
$error = false;
if(isset($_POST['btnSave'])){
  $FullName = $_POST['FullName'];
  
  $username = $_POST['username'];
  $password = $_POST['password'];
  $EmailAddress = $_POST['EmailAddress'];
  $CallbackNumber = $_POST['CallbackNumber'];
  $BusinessUnit = $_POST['BusinessUnit'];
  $ImmediateSuperior = $_POST['ImmediateSuperior'];
  $UserType = $_POST['UserType'];

  if(empty($FullName)){
    $error = true;
    $errorFullName = "Please enter FullName.";
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
  if(empty($ImmediateSuperior)){
    $error = true;
    $errorImmediateSuperior = "Please enter Immediate Superior.";
  }
  if(empty($UserType)){
    $error = true;
    $errorUserType = "Please enter User Type.";
  }
  if(!$error){
    $sql = "INSERT INTO tblusers(FullName, username, password, EmailAddress, CallbackNumber, BusinessUnit, ImmediateSuperior, UserType) VALUES ('$FullName', '$username','$password','$EmailAddress','$CallbackNumber','$BusinessUnit','$ImmediateSuperior','$UserType')";
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
    <title>SPi Service Desk |  Users</title>
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
          <li class="active">Users</li>
        </ol>
      </div>
    </section>

    <section id="main">
      <div class="container">
        <div class="row">
          <div class="col-md-3">
            <div class="list-group">
              <a href="index.php" class="list-group-item"><span class="glyphicon glyphicon-cog" aria-hidden="true"></span> Dashboard </a>
              <a href="fileIR.php" class="list-group-item"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> File Incident Report <span class="badge">12</span></a>
              <a href="previousIR.php" class="list-group-item"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Previous Incident Reports <span class="badge">33</span></a>
              <a href="opentickets.php" class="list-group-item"><span class="glyphicon glyphicon-tasks" aria-hidden="true"></span> Open Tickets <span class="badge">10</span></a>
              <a href="fileTicket.php" class="list-group-item"><span class="glyphicon glyphicon-download-alt" aria-hidden="true"></span> Log Ticket </a>
              <a href="users.php" class="list-group-item active main-color-bg"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Users <span class="badge">203</span></a>
            </div>

          </div>
          <div class="col-md-9">
            <!-- Website Overview -->
            <div class="panel panel-default">
              <div class="panel-heading main-color-bg">
                <h3 class="panel-title">Users</h3>
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
                      <li><a href="#">Menu 2</a></li>
                      <li><a href="#">Menu 3</a></li>
                      </ul>        
                <div class="tab-content">

                  <div id="list" class="tab-pane fade in active">
                    <br>
                    <div class="col-md-12">
                          <input class="form-control" type="text" placeholder="Filter Users...">
                      </div>
                    <br>
                    <table class="table table-striped table-hover">
                      <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Position</th>
                        <th>User Type</th>
                        <th></th>
                      </tr>
                      <tr>
                        <td>Jill Smith</td>
                        <td>jillsmith@gmail.com</td>
                        <td>Dec 12, 2016</td>
                        <td><a class="btn btn-default" href="edit.php">Edit</a> <a class="btn btn-danger" href="#">Delete</a></td>
                      </tr>
                      <tr>
                        <td>Eve Jackson</td>
                        <td>ejackson@yahoo.com</td>
                        <td>Dec 13, 2016</td>
                        <td><a class="btn btn-default" href="edit.php">Edit</a> <a class="btn btn-danger" href="#">Delete</a></td>
                      </tr>
                      <tr>
                       <td>Stephanie Landon</td>
                        <td>landon@yahoo.com</td>
                        <td>Dec 14, 2016</td>
                        <td><a class="btn btn-default" href="edit.php">Edit</a> <a class="btn btn-danger" href="#">Delete</a></td>
                      </tr>
                      <tr>
                        <td>Mike Johnson</td>
                        <td>mjohnson@gmail.com</td>
                        <td>Dec 15, 2016</td>
                        <td><a class="btn btn-default" href="edit.php">Edit</a> <a class="btn btn-danger" href="#">Delete</a></td>
                      </tr>
                    </table>
                  </div>

                   <div id="form" class="tab-pane fade">
                    <div class="col-md-12">
                    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" autocomplete="off">
                    <br>
                    <div class="form-group">
                      <label>Full Name</label>
                      <br>
                      <input type="text" class="form-control" name="FullName" placeholder="Juan">
                    </div>

                    <div class="form-group">
                      <label>Username</label>
                      <br>
                      <input type="text" class="form-control" name="username" placeholder="user123">
                    </div>

                    <div class="form-group">
                      <label>Password</label>
                      <br>
                      <input type="Password" class="form-control" name="password" placeholder="">
                    </div>

                    <div class="form-group">
                      <label>Email Address</label>
                      <br>
                      <input type="Email" class="form-control" name="EmailAddress" placeholder="example@example.com">
                    </div>

                    <div class="form-group">
                      <label>Callback Number</label>
                      <br>
                      <input type="text" class="form-control" name="CallbackNumber" placeholder="123456">
                    </div>

                    <div class="form-group">
                      <label>Business Unit / Campaign</label>
                      <br>
                      <select class="form-control" name="BusinessUnit" id="BusinessUnit">
                        <option value="Information Technology">Information Technology</option>
                        <option value="Production">Production</option>
                        <option value="Finance">Finance</option>
                      </select>
                    </div>

                    <div class="form-group">
                      <label>Immediate Superior</label>
                      <br>
                      <input type="text" class="form-control" name="ImmediateSuperior" placeholder="Juan">
                    </div>

                    <div class="form-group">
                      <label>User Type</label>
                      <br>
                      <select class="form-control" name="UserType" id="UserType">
                        <option value="Service Desk Analyst">Service Desk Analyst</option>
                        <option value="End User">End User</option>
                        <option value="Non-SD">Non SD</option>
                      </select>
                    </div>

                    <div class="form-group">
                      <input type="submit" name="btnSave" value="Register User" class="btn-lg btn-primary btn-block">
                    </div>

                  </form>
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
