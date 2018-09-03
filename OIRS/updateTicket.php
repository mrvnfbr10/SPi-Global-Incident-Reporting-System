<?php
include_once('db.php');
session_start();

if(isset($_GET['edit'])){
  $TicketNo = $_GET['edit'];
  $ticketDetails = mysqli_query($conn, "SELECT * FROM tbltickets WHERE TicketNo = $TicketNo");
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

}

$fetchCat = "SELECT * FROM tblcategory ORDER BY CategoryDescription";
$filterCat = mysqli_query($conn, $fetchCat);


$error = false;
$fetchcampaign = "SELECT * FROM tblbusinessunit";
$filterunit = mysqli_query($conn, $fetchcampaign);
$fetchsite = "SELECT * FROM tblsite";
$filtersite = mysqli_query($conn, $fetchsite);

if(isset($_POST['btnUpdate'])){
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
    $query = "UPDATE tbltickets SET FullName = '$FullName', EmailAddress = '$EmailAddress', ImmediateSuperior = '$ImmediateSuperior', CallbackNumber = '$CallbackNumber', Site = '$Site', BusinessUnit = '$BusinessUnit', Title = '$Title', Details = '$Details', Category = '$Category', TicketType = '$TicketType', ResponseLevel = '$ResponseLevel', FirstApprover = '$FirstApprover', SecondApprover = '$SecondApprover', ThirdApprover = 'ThirdApprover', FourthApprover = '$FourthApprover', Status = 'For Approval' WHERE TicketNo = $TicketNo ";
     if(mysqli_query($conn, $query)){
      $successMsg = "Ticket has been updated!";
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
    <title>SPi Service Desk File Ticket</title>
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
          <a class="navbar-brand" href="#"> SPi Global Service Desk </a>
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
          <li class="active">Update Ticket</li>
        </ol>
      </div>
    </section>

    <section id="main">
      <div class="container">
        <div class="row">
          <div class="col-md-3">
            <div class="list-group">
              <a href="index.php" class="list-group-item">
                <span class="glyphicon glyphicon-home" aria-hidden="true"></span> Dashboard
              </a>
              <a href="fileIR.php" class="list-group-item"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> File Incident Report</a>
              <a href="previousIR.php" class="list-group-item"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> Previous Incident Report <span class="badge">33</span></a>
              <a href="opentickets.php" class="list-group-item"><span class="glyphicon glyphicon-tasks" aria-hidden="true"></span> Open Tickets <span class="badge">10</span></a>
              <a href="fileTicket.php" class="list-group-item active main-color-bg"><span class="glyphicon glyphicon-download-alt" aria-hidden="true"></span> Log Ticket </a>
              <a href="users.php" class="list-group-item"><span class="glyphicon glyphicon-cog" aria-hidden="true"></span> File Maintenance <span class="badge"></span></a>
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
                      <input type="text" name = "Title" class="form-control" placeholder="Title (i.e MS Office Installation)" value="<?php echo $Title ?>">
                    </div>
                  <div class="form-group">
                    <label>Details</label>
                    <textarea name="details" class="form-control" placeholder="Ticket Details" value = "<?php echo $Details ?>"><?php echo $Details ?>
                    </textarea>
                  </div>
                  <div class="form-group">
                      <label>Category</label>
                      <select class="form-control" name="Category" id="sel1">
                        <?php while($row = mysqli_fetch_array($filterCat)):;?>
                      <option value="<?php echo $row[1];?>"><?php echo $row[1];?></option>
                                <?php endwhile;?>
                      </select>
                    </div>
                    <div class="form-group">
                        <label>Ticket Type</label>
                        <select class="form-control" name="TicketType" id="sel1">
                          <option value="Service Request">Service Request</option>
                          <option value="Incident">Incident</option>
                          <option value="Change Request">Change Request</option>
                        </select>
                      </div>
                    <div class="form-group">
                        <label>Response Level</label>
                        <select class="form-control" name="ResponseLevel" id="sel1">
                            <option value="Severity 1">Severity 1</option>
                            <option value="Severity 2">Severity 2</option>
                            <option value="Severity 3">Severity 3</option>
                            <option value="Severity 4">Severity 4</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>First Approver</label>
                        <select class="form-control" name="FirstApprover" id="sel1">
                            <option value="Mohammed Salah">Mohammed Salah</option>
                            <option value="Sadio Mane">Sadio Mane</option>
                            <option value="Roberto Firmino">Roberto Firmino</option>
                            <option value="Alexander Chamberlain">Alexander Chamberlain</option>
                            <option value="Naby Keita">Naby Keita</option>
                            <option value="Jordan Henderson">Jordan Henderson</option>
                            <option value="Dejan Lovren">Dejan Lovren</option>
                            <option value="John Green">John Green</option>
                            <option value="Robin Scherbatsky">Robin Scherbatsky</option>
                            <option value="Lily Aldrin">Lily Aldrin</option>
                            <option value="NotApplicable">Not Applicable</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Second Approver</label>
                        <select class="form-control" name="SecondApprover" id="sel1">
                            <option value="Mohammed Salah">Mohammed Salah</option>
                            <option value="Sadio Mane">Sadio Mane</option>
                            <option value="Roberto Firmino">Roberto Firmino</option>
                            <option value="Alexander Chamberlain">Alexander Chamberlain</option>
                            <option value="Naby Keita">Naby Keita</option>
                            <option value="Jordan Henderson">Jordan Henderson</option>
                            <option value="Dejan Lovren">Dejan Lovren</option>
                            <option value="John Green">John Green</option>
                            <option value="Robin Scherbatsky">Robin Scherbatsky</option>
                            <option value="Lily Aldrin">Lily Aldrin</option>
                            <option value="NotApplicable">Not Applicable</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Third Approver</label>
                        <select class="form-control" name="ThirdApprover" id="sel1">
                            <option value="Mohammed Salah">Mohammed Salah</option>
                            <option value="Sadio Mane">Sadio Mane</option>
                            <option value="Roberto Firmino">Roberto Firmino</option>
                            <option value="Alexander Chamberlain">Alexander Chamberlain</option>
                            <option value="Naby Keita">Naby Keita</option>
                            <option value="Jordan Henderson">Jordan Henderson</option>
                            <option value="Dejan Lovren">Dejan Lovren</option>
                            <option value="John Green">John Green</option>
                            <option value="Robin Scherbatsky">Robin Scherbatsky</option>
                            <option value="Lily Aldrin">Lily Aldrin</option>
                            <option value="NotApplicable">Not Applicable</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Fourth Approver</label>
                        <select class="form-control" name="FourthApprover" id="sel1">
                            <option value="Mohammed Salah">Mohammed Salah</option>
                            <option value="Sadio Mane">Sadio Mane</option>
                            <option value="Roberto Firmino">Roberto Firmino</option>
                            <option value="Alexander Chamberlain">Alexander Chamberlain</option>
                            <option value="Naby Keita">Naby Keita</option>
                            <option value="Jordan Henderson">Jordan Henderson</option>
                            <option value="Dejan Lovren">Dejan Lovren</option>
                            <option value="John Green">John Green</option>
                            <option value="Robin Scherbatsky">Robin Scherbatsky</option>
                            <option value="Lily Aldrin">Lily Aldrin</option>
                            <option value="NotApplicable">Not Applicable</option>
                        </select>
                    </div>
                  <input type="submit" name = "btnUpdate" class="btn btn-primary" value="File Ticket">
                  <a href="fetchIR.php?edit=<?php echo $row['TicketNo']?>"class="btn btn-warning">File Incident Report</a>
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
