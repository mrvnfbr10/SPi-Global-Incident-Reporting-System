<?php
include_once('db.php');
session_start();
include_once('sendmail.php');

$error = false;

$UserID = $_SESSION['UserID'];

$EmailAddress = $_SESSION['EmailAddress'];

if(isset($_POST['btnSave'])){

  $UserID = $_SESSION['UserID'];
  $Title = $_POST['Title'];
  $Details = $_POST['details'];
  $EmailAddress = $_SESSION['EmailAddress'];

  if(empty($Title)){
    $error = true;
    $errorTitle = "Please enter Title";
  }
  if(empty($Details)){
    $error = true;
    $errorDetails = "Please enter details";
  }
  
  if(!$error){
    $sql = "INSERT INTO tickets (UserID, Title, Details, CategoryID, Status) VALUES ('$UserID','$Title','$Details', '24','Awaiting Response')";
    if(mysqli_query($conn, $sql)){
      $last_id = mysqli_insert_id($conn);
      $query = "INSERT INTO tickethistory (TicketNo, Title, Description, UserID) VALUES ('$last_id','Creation','Creation of Ticket','$UserID')";
      mysqli_query($conn, $query);
      $successMsg = "Ticket has been filed! Reference Number is: ".$last_id;

      ticketconfirmation_mail($last_id);
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
          <li><a href="selfservicePortal.php">Dashboard</a></li>
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
                <span class="glyphicon glyphicon-home" aria-hidden="true"></span> Dashboard
              </a>
              <a href="openticketsPortal.php" class="list-group-item"><span class="glyphicon glyphicon-tasks" aria-hidden="true"></span> Previous Tickets <span class="badge">10</span></a>
              <a href="fileTicketPortal.php" class="list-group-item active main-color-bg"><span class="glyphicon glyphicon-download-alt" aria-hidden="true"></span> Log Ticket </a>
            </div>

          </div>
          <div class="col-md-9">
            <!-- Website Overview -->
            <div class="panel panel-default">
              <div class="panel-heading main-color-bg">
                <h3 class="panel-title">File Ticket</h3>
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
                      <label>Title</label>
                      <input type="text" name = "Title" class="form-control" placeholder="Title (i.e MS Office Installation)" value="">
                      <span class="text-danger"><?php if(isset($errorTitle)) echo $errorTitle ?></span>
                    </div>
                  <div class="form-group">
                    <label>Details</label>
                    <textarea name="details" rows="10" cols="60" class="form-control" placeholder="Ticket Details" value=""></textarea>
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

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>
