<?php
include_once('db.php');
session_start();

$UserID = $_SESSION['UserID'];

$fetchticket = "SELECT COUNT(TicketNo) AS Ticket FROM tickets WHERE UserID = '$UserID' ";
$filterticket = mysqli_query($conn, $fetchticket);

$b = mysqli_fetch_array($filterticket);
$Ticket = $b['Ticket'];

if(isset($_GET['edit'])){
  $TicketNo = $_GET['edit'];
  $ticketDetails = mysqli_query($conn, "SELECT tickets.TicketNo AS TicketNo, CONCAT(user.FirstName, user.LastName) AS FullName, user.EmailAddress AS EmailAddress, user.ImmediateSuperior AS ImmediateSuperior, tblsite.SiteDesc AS Site, tblcategory.CategoryDescription AS Category, tickets.FirstApprover AS FirstApprover, tickets.SecondApprover AS SecondApprover, tickets.ThirdApprover AS ThirdApprover, tickets.FourthApprover AS FourthApprover, tblbusinessunit.BusinessUnitDesc AS BusinessUnit, user.CallBackNumber AS CallbackNumber, tickets.Title AS Title, tickets.ResponseLevel AS Response, tickets.TicketType AS TicketType, tickets.Details AS Details FROM tickets INNER JOIN user ON tickets.UserID = user.UserID INNER JOIN tblsite ON user.SiteID = tblsite.SiteID INNER JOIN tblbusinessunit ON user.BusinessUnitID = tblbusinessunit.BusinessUnitID INNER JOIN tblcategory ON tickets.CategoryID = tblcategory.CategoryID WHERE TicketNo = $TicketNo");
  
  $a = mysqli_fetch_array($ticketDetails);
  $TicketNo = $a['TicketNo'];
  $FullName = $a['FullName'];
  $EmailAddress = $a['EmailAddress'];
  $ImmediateSuperior = $a['ImmediateSuperior'];
  $CallbackNumber = $a['CallbackNumber'];
  $Site = $a['Site'];
  $BusinessUnit = $a['BusinessUnit'];
  $Title = $a['Title'];
  $Details = $a['Details'];
  $Category = $a['Category'];
  $FirstApprover = $a['FirstApprover'];
  $SecondApprover = $a['SecondApprover'];
  $ThirdApprover = $a['ThirdApprover'];
  $FourthApprover = $a['FourthApprover'];
  $TicketType = $a['TicketType'];
  $Response = $a['Response'];

 $ticketshistory = mysqli_query($conn, "SELECT tickethistory.Title AS Title, tickethistory.Description AS Description, tickethistory.HistoryDate AS Date, CONCAT(user.FirstName, user.LastName) AS username FROM tickethistory INNER JOIN user ON tickethistory.UserID = user.UserID WHERE TicketNo = $TicketNo ORDER BY HistoryDate DESC");


}


$fetchCat = "SELECT * FROM tblcategory ORDER BY CategoryDescription";
$filterCat = mysqli_query($conn, $fetchCat);

$fetchSuperior = "SELECT CONCAT(FirstName, LastName) AS SuperiorName FROM user";
$filtersuperior = mysqli_query($conn, $fetchSuperior);
$filterboss = mysqli_query($conn, $fetchSuperior);
$filterboss1 = mysqli_query($conn, $fetchSuperior);
$filterboss2 = mysqli_query($conn, $fetchSuperior);

 

$error = false;
$fetchcampaign = "SELECT * FROM tblbusinessunit";
$filterunit = mysqli_query($conn, $fetchcampaign);
$fetchsite = "SELECT * FROM tblsite";
$filtersite = mysqli_query($conn, $fetchsite);

if(isset($_POST['btnUpdate'])){
  $UserID = $_SESSION['UserID'];
  $TicketNo = $_POST['TicketNo'];
  $FullName = $_POST['FullName'];
  $EmailAddress = $_POST['EmailAddress'];
  $ImmediateSuperior = $_POST['ImmediateSuperior'];
  $CallbackNumber = $_POST['CallbackNumber'];
  $Site = $_POST['Site'];
  $BusinessUnit = $_POST['BusinessUnit'];
  $Title = $_POST['Title'];
  $Details = $_POST['details'];
  $Category = $_POST['Category'];
  $TicketType = $_POST['TicketType'];
  $ResponseLevel = $_POST['ResponseLevel'];
  $FirstApprover = $_POST['FirstApprover'];
  $SecondApprover = $_POST['SecondApprover'];
  $ThirdApprover = $_POST['ThirdApprover'];
  $FourthApprover = $_POST['FourthApprover'];

  if(!$error){
    $query = "UPDATE tickets SET CategoryID = '$Category', TicketType = '$TicketType', ResponseLevel = '$ResponseLevel', FirstApprover = '$FirstApprover', SecondApprover = '$SecondApprover', ThirdApprover = '$ThirdApprover', FourthApprover = '$FourthApprover', Status = 'For Level 1 Approval' WHERE TicketNo = $TicketNo ";
     if(mysqli_query($conn, $query)){
      $sql = "INSERT INTO tickethistory (TicketNo, Title, Description, UserID) VALUES ('$TicketNo','Update','Ticket was updated','$UserID')";
      mysqli_query($conn, $sql);
      $successMsg = "Ticket has been updated!";
      $ticketshistory = mysqli_query($conn, "SELECT tickethistory.Title AS Title, tickethistory.Description AS Description, tickethistory.HistoryDate AS Date, CONCAT(user.FirstName, user.LastName) AS username FROM tickethistory INNER JOIN user ON tickethistory.UserID = user.UserID WHERE TicketNo = $TicketNo ORDER BY HistoryDate DESC");
      
    }
    else{
      $successMsg = "Opps! Something went wrong, please try again later.".mysqli_error($conn);
    }
  }
  else{
      $successMsg = "Opps! Something went wrong, please try again later.".mysqli_error($conn);
    }
}
if(isset($_POST['btnCancel'])){

$TicketNo = $_POST['TicketNo'];
$Action = $_POST['Action'];
$Reason = $_POST['reason'];
$UserID = $_SESSION['UserID'];
  if($Action == 'Cancelled'){
    $sql = mysqli_query($conn, "UPDATE tickets SET Status = '$Action' WHERE TicketNo = $TicketNo");
    $query = mysqli_query($conn, "INSERT INTO tickethistory (TicketNo, Title, Description, UserID) VALUES ('$TicketNo','Cancelled','$Reason','$UserID')");
    $successMsg = "Ticket has been cancelled!";
    $ticketshistory = mysqli_query($conn, "SELECT tickethistory.Title AS Title, tickethistory.Description AS Description, tickethistory.HistoryDate AS Date, CONCAT(user.FirstName, user.LastName) AS username FROM tickethistory INNER JOIN user ON tickethistory.UserID = user.UserID WHERE TicketNo = $TicketNo ORDER BY HistoryDate DESC");
  }
  else if($Action == 'Rejected'){
    $a = mysqli_query($conn, "UPDATE tickets SET Status = '$Action' WHERE TicketNo = $TicketNo");
    $b = mysqli_query($conn, "INSERT INTO tickethistory (TicketNo, Title, Description, UserID) VALUES ('$TicketNo','Rejected','$Reason','$UserID')");
    $successMsg = "Ticket has been Rejected!";
    $ticketshistory = mysqli_query($conn, "SELECT tickethistory.Title AS Title, tickethistory.Description AS Description, tickethistory.HistoryDate AS Date, CONCAT(user.FirstName, user.LastName) AS username FROM tickethistory INNER JOIN user ON tickethistory.UserID = user.UserID WHERE TicketNo = $TicketNo ORDER BY HistoryDate DESC");
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
    <title>SPi Service Desk File Ticket</title>
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
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
          <a class="navbar-brand" href="#"> SPi Global Service Desk </a>
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
          <li><a>Dashboard</a></li>
          <li class="active">Update Ticket</li>
        </ol>
      </div>
    </section>

    <section id="main">
      <div class="container">
        <div class="row">
          <div class="col-md-3">
            <div class="list-group">
             <a href="selfservicePortal.php" class="list-group-item">
              <span class="glyphicon glyphicon-home" aria-hindden="true"></span> Dashboard
              </a>
              <a href="openticketsPortal.php" class="list-group-item active main-color-bg"><span class="glyphicon glyphicon-tasks" aria-hidden="true"></span> Previous Tickets <span class="badge"><?php echo $Ticket; ?></span></a>
              <a href="fileTicketPortal.php" class="list-group-item"><span class="glyphicon glyphicon-download-alt" aria-hidden="true"></span> Log Ticket </a>
            </div>
            <div class="well">
              <h4>Ticket History</h4>
              <?php while($row = mysqli_fetch_array($ticketshistory)):;?>
              <h5><?php echo $row['Title'] ?></h5>
              <h6><?php echo $row['Description'] ?></h6>
              <h6><?php echo $row['Date'] ?></h6>
              <h6><?php echo $row['username'] ?></h6>
              <?php endwhile;?>
            </div>
          </div>
          <div class="col-md-9">
            <!-- Website Overview -->
            <div class="panel panel-default">
              <div class="panel-heading main-color-bg">
                <h4 class="panel-title">Update Ticket</h4>
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
                  <input type="hidden" name="TicketNo" value="<?php echo $TicketNo; ?>">
                  <input type="hidden" name="FullName" value="<?php echo $FullName; ?>">
                  <input type="hidden" name="EmailAddress" value="<?php echo $EmailAddress; ?>">
                  <input type="hidden" name="ImmediateSuperior" value="<?php echo $ImmediateSuperior; ?>">
                  <input type="hidden" name="CallbackNumber" value="<?php echo $CallbackNumber; ?>">
                  <input type="hidden" name="Site" value="<?php echo $Site; ?>">
                  <input type="hidden" name="BusinessUnit" value="<?php echo $BusinessUnit; ?>">
                  <h2>Ticket No: <?php echo $TicketNo?></h2>
                  <h4>Full Name: <?php echo $FullName?></h4>
                  <h4>Email Address: <?php echo $EmailAddress?></h4>
                  <h4>Immediate Superior: <?php echo $ImmediateSuperior?></h4>
                  <h4>Callback Number: <?php echo $CallbackNumber ?></h4>
                  <h4>Site: <?php echo $Site ?></h4>
                  <h4>Business Unit/Campaign: <?php echo $BusinessUnit ?></h4>
                  <div class="form-group">
                      <label>Title</label>
                      <input type="text" name = "Title" class="form-control" placeholder="Title (i.e MS Office Installation)" disabled="disabled" value="<?php echo $Title ?>">
                    </div>
                  <div class="form-group">
                    <label>Details</label>
                    <textarea name="details" rows="10" cols="60" class="form-control" placeholder="Ticket Details" value = "<?php echo $Details ?>"><?php echo $Details ?>
                    </textarea>
                  </div>
                  
                  <input type="submit" name = "btnUpdate" class="btn btn-success" value="Save Ticket Changes">
                  <a href="fetchIR.php?edit=<?php echo $row['TicketNo']?>"class="btn btn-danger">File Incident Report</a>
                  <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#addPage">Cancel / Reject Ticket</button>
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
      <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" autocomplete="off">
        <input type="hidden" name="TicketNo" value="<?php echo $TicketNo; ?>">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Cancel / Reject Ticket</h4>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label>Select Action</label>
          <select class="form-control" name="Action" id="sel1">
            <option value="Cancelled">Cancel</option>
            <option value="Rejected">Reject</option>
          </select>
        </div>
        <div class="form-group">
          <label>Reason for Cancellation/Rejection</label>
          <textarea name="reason" rows="5" cols="60" class="form-control" placeholder="Reason"></textarea>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <input type="submit" name="btnCancel" class="btn btn-danger" value="Apply Action">
      </div>
    </form>
    </div>
  </div>
</div>


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script>
var d = new Date();
document.getElementById("demo").innerHTML = d;
</script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>
