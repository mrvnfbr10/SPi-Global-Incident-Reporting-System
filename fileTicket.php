<?php
include_once('db.php');
session_start();
$error = false;
$fetchcampaign = "SELECT * FROM tblbusinessunit";
$filterunit = mysqli_query($conn, $fetchcampaign);
$fetchsite = "SELECT * FROM tblsite";
$filtersite = mysqli_query($conn, $fetchsite);

if(isset($_POST['btnSave'])){
  $FullName = $_POST['FullName'];
  $EmailAddress = $_POST['EmailAddress'];
  $ImmediateSuperior = $_POST['ImmediateSuperior'];
  $CallbackNumber = $_POST['CallbackNumber'];
  $Site = $_POST['Site'];
  $BusinessUnit = $_POST['BusinessUnit'];
  $Title = $_POST['Title'];
  $Details = $_POST['editor1'];
  $Category = $_POST['Category'];
  $TicketType = $_POST['TicketType'];
  $ResponseLevel = $_POST['ResponseLevel'];
  $FirstApprover = $_POST['FirstApprover'];
  $SecondApprover = $_POST['SecondApprover'];
  $ThirdApprover = $_POST['ThirdApprover'];
  $FourthApprover = $_POST['FourthApprover'];

  if(!$error){
    $query = "INSERT INTO tbltickets (FullName, EmailAddress, ImmediateSuperior, CallbackNumber, Site, BusinessUnit, Title, Details, Category, TicketType, ResponseLevel, FirstApprover, SecondApprover, ThirdApprover, FourthApprover, Status) VALUES ('$FullName','$EmailAddress', '$ImmediateSuperior', '$CallbackNumber','$Site','$BusinessUnit', '$Title','$Details', '$Category', '$TicketType','$ResponseLevel', '$FirstApprover','$SecondApprover','$ThirdApprover','$FourthApprover','For Level 1 Approval')";
     if(mysqli_query($conn, $query)){
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
            <li><a href="index.php">Logout</a></li>
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
          <li class="active">Log Ticket</li>
        </ol>
      </div>
    </section>

    <section id="main">
      <div class="container">
        <div class="row">
          <div class="col-md-3">
            <div class="list-group">
              <a href="admindashboard.php" class="list-group-item">
                <span class="glyphicon glyphicon-home" aria-hidden="true"></span> Dashboard
              </a>
              <a href="fileIR.php" class="list-group-item"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> File Incident Report <span class="badge">12</span></a>
              <a href="previousIR.php" class="list-group-item"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Previous Incident Report <span class="badge">33</span></a>
              <a href="opentickets.php" class="list-group-item"><span class="glyphicon glyphicon-tasks" aria-hidden="true"></span> Open Tickets <span class="badge">10</span></a>
              <a href="fileTicket.php" class="list-group-item active main-color-bg"><span class="glyphicon glyphicon-download-alt" aria-hidden="true"></span> Log Ticket </a>
              <a href="users.php" class="list-group-item"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> File Maintenance <span class="badge"></span></a>
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
                    <label>Full Name</label>
                    <input type="text" name = "FullName" value = "<?php echo $_SESSION['FullName'] ?>" class="form-control" placeholder="i.e Juan Dela Cruz">
                  </div>
                  <div class ="form-group">
                    <label>Email Address</label>
                    <input type="email" name = "EmailAddress" value = "<?php echo $_SESSION['EmailAddress'] ?>"class="form-control" placeholder="example@email.com">
                  </div>
                  <div class ="form-group">
                      <label>Immediate Superior</label>
                      <input type="text" name = "ImmediateSuperior" value = "<?php echo $_SESSION['ImmediateSuperior'] ?>" class="form-control" placeholder="i.e Juan Dela Cruz">
                    </div>
                  <div class="form-group">
                    <label>Callback Number</label>
                    <input type="number" name = "CallbackNumber" value = "<?php echo $_SESSION['CallbackNumber'] ?>" class="form-control" placeholder="i.e 29911">
                  </div>
                  <div class="form-group">
                    <label>Site</label>
                    <select class="form-control" name="Site" id="sel1">
                      <option value="<?php echo $_SESSION['Site']?>"><?php echo $_SESSION['Site']?></option>
                       <?php while($row = mysqli_fetch_array($filtersite)):;?>
                      <option value="<?php echo $row[1];?>"><?php echo $row[1];?></option>
                                <?php endwhile;?>
                    </select>
                  </div>
                  <div class="form-group">
                      <label>Business Unit</label>
                      <select class="form-control" name="BusinessUnit" id="sel1">
                       <option value="<?php echo $_SESSION['BusinessUnit']?>"><?php echo $_SESSION['BusinessUnit']?></option>
                        <?php while($row = mysqli_fetch_array($filterunit)):;?>
                      <option value="<?php echo $row[1];?>"><?php echo $row[1];?></option>
                                <?php endwhile;?>
                      </select>
                    </div>
                  <div class="form-group">
                      <label>Title</label>
                      <input type="text" name = "Title" class="form-control" placeholder="Title (i.e MS Office Installation)" value="">
                    </div>
                  <div class="form-group">
                    <label>Details</label>
                    <textarea name="editor1" class="form-control" placeholder="Incident Details">
                    </textarea>
                  </div>
                  <div class="form-group">
                      <label>Category</label>
                      <select class="form-control" name="Category" id="sel1">
                        <option value="Account Management">Account Management</option>
                        <option value="Software Services">Software Services</option>
                        <option value="Hardware Services">HardwareServices</option>
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
                  <input type="submit" name = "btnSave" class="btn btn-primary" value="File Ticket">
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
