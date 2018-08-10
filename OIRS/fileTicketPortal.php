<?php
include_once('db.php');
session_start();
$error = false;
if(isset($_POST['btnSave'])){
  $FullName = $_POST['FullName'];
  $EmailAddress = $_POST['EmailAddress'];
  $ImmediateSuperior = $_POST['ImmediateSuperior'];
  $CallbackNumber = $_POST['CallbackNumber'];
  $Site = $_POST['Site'];
  $BusinessUnit = $_POST['BusinessUnit'];
  $Title = $_POST['Title'];
  $Details = $_POST['editor1'];

  if(empty($FullName)){
    $error = true;
    $errorFullName = "Please enter FullName";
  }
  if(empty($EmailAddress)){
    $error = true;
    $errorEmailAddress = "Please enter EmailAddress";
  }
  if(empty($ImmediateSuperior)){
    $error = true;
    $errorImmediateSuperior = "Please enter ImmediateSuperior";
  }
  if(empty($CallbackNumber)){
    $error = true;
    $errorCallbackNumber = "Please enter CallbackNumber";
  }
  if(empty($Site)){
    $error = true;
    $errorSite = "Please enter Site";
  }
  if(empty($BusinessUnit)){
    $error = true;
    $errorBusinessUnit = "Please enter BusinessUnit";
  }
  if(empty($Title)){
    $error = true;
    $errorTitle = "Please enter Title";
  }
  if(empty($Details)){
    $error = true;
    $errorDetails = "Please enter details";
  }
  
  if(!$error){
    $sql = "INSERT INTO tbltickets(FullName, EmailAddress, ImmediateSuperior, CallbackNumber, Site, BusinessUnit, Title, Details, Status) VALUES ('$FullName','$EmailAddress','$ImmediateSuperior','$CallbackNumber','$Site','$BusinessUnit','$Title','$Details', 'Awaiting Response')";
    if(mysqli_query($conn, $sql)){
      $successMsg = "Ticket has been filed! You may get the reference number on your dashboard.";
    }
    else{
      $successMsg = "Opps! Something went wrong, please try again later.".mysqli_error($conn);
    }
  }
else{
      $successMsg = "Opps! Something went wrong, please try again later.".mysqli_error($conn);
    }
}
?> 
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SPi Global || File Ticket</title>
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
          <a class="navbar-brand" href="#"> SPi Global Service Desk User Portal </a>
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
          <li class="active">Log Ticket</li>
        </ol>
      </div>
    </section>

    <section id="main">
      <div class="container">
        <div class="row">
          <div class="col-md-3">
            <div class="list-group">
              <a href="selfservicePortal.php" class="list-group-item">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span> Dashboard
              </a>
              <a href="openticketsPortal.php" class="list-group-item"><span class="glyphicon glyphicon-tasks" aria-hidden="true"></span> Open Tickets <span class="badge">10</span></a>
              <a href="fileTicketPortal.php" class="list-group-item active main-color-bg"><span class="glyphicon glyphicon-download-alt" aria-hidden="true"></span> Log Ticket </a>
            </div>

          </div>
          <div class="col-md-9">
            <!-- Website Overview -->
            <div class="panel panel-default">
              <div class="panel-heading main-color-bg">
                <h3 class="panel-title">File Ticket</h3>
                <br>
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
                <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" autocomplete="off">
                  <div class="form-group">
                    <label>Full Name</label>
                    <input type="text" name = "FullName"class="form-control" value = "<?php echo $_SESSION['FullName'] ?>"placeholder="i.e Juan Dela Cruz">
                    <span class="text-danger"><?php if(isset($errorFullName)) echo $errorFullName ?></span>
                  </div>
                  <div class ="form-group">
                    <label>Email Address</label>
                    <input type="email" name = "EmailAddress"class="form-control" value = "<?php echo $_SESSION['EmailAddress'] ?>"placeholder="example@email.com">
                    <span class="text-danger"><?php if(isset($errorEmailAddress)) echo $errorEmailAddress ?></span>
                  </div>
                  <div class ="form-group">
                      <label>Immediate Superior</label>
                      <input type="text" name = "ImmediateSuperior" class="form-control" value = "<?php echo $_SESSION['ImmediateSuperior'] ?>" placeholder="i.e Juan Dela Cruz">
                      <span class="text-danger"><?php if(isset($errorImmediateSuperior)) echo $errorImmediateSuperior ?></span>
                    </div>
                  <div class="form-group">
                    <label>Callback Number</label>
                    <input type="text" name = "CallbackNumber" class="form-control" value = "<?php echo $_SESSION['CallbackNumber'] ?>" placeholder="i.e 29911">
                    <span class="text-danger"><?php if(isset($errorCallbackNumber)) echo $errorCallbackNumber ?></span>
                  </div>
                  <div class="form-group">
                    <label>Site</label>
                    <select class="form-control" name="Site" id="sel1">
                      <option value="Parañaque">Parañaque</option>
                      <option value="Dumaguete">Dumaguete</option>
                      <option value="Laguna">Laguna</option>
                      <span class="text-danger"><?php if(isset($errorSite)) echo $errorSite ?></span>
                    </select>
                  </div>
                  <div class="form-group">
                      <label>Business Unit</label>
                      <select class="form-control" name="BusinessUnit" id="sel1">
                        <option value="<?php echo $_SESSION['BusinessUnit'] ?>"> <?php echo $_SESSION['BusinessUnit'] ?> </option>
                        <span class="text-danger"><?php if(isset($errorBusinessUnit)) echo $errorBusinessUnit ?></span>
                      </select>
                    </div>
                  <div class="form-group">
                      <label>Title</label>
                      <input type="text" name = "Title" class="form-control" placeholder="Title (i.e MS Office Installation)" value="">
                      <span class="text-danger"><?php if(isset($errorTitle)) echo $errorTitle ?></span>
                    </div>
                  <div class="form-group">
                    <label>Details</label>
                    <textarea name="editor1" class="form-control" placeholder="Ticket Details">
                    </textarea>
                    <span class="text-danger"><?php if(isset($errorDetails)) echo $errorDetails ?></span>
                  </div>
                  <div class="form-group">
                  <input type="submit" name="btnSave" class="btn btn-primary" value="File Ticket">
                  </div>
                </form>
              </div>
              </div>

          </div>
        </div>
      </div>
    </section>

    <footer id="footer">
      <p>Copyright SPi Global Inc, &copy; 2018</p>
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
