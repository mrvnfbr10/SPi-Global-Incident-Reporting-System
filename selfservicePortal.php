<?php
include_once('db.php');
session_start();
$FullName = $_SESSION['FullName']; 
$UserID = $_SESSION['UserID'];
$fetchticket = "SELECT COUNT(TicketNo) AS TicketNo FROM tickets WHERE UserID = '$UserID' ";
$filterticket = mysqli_query($conn, $fetchticket);

$a = mysqli_fetch_array($filterticket);
$TicketNo = $a['TicketNo'];


?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SPi Global || User Portal</title>
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
          <a class="navbar-brand" href="#">SPi Global Service Desk User Portal</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">

          
          <ul class="nav navbar-nav navbar-right">
            <li><a href="#">Welcome, <?php echo $_SESSION['FullName'] ?> </a></li>
            <li><a href="logout.php">Logout</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

    <header id="header">
      <div class="container">
        
      </div>
    </header>

    <section id="breadcrumb">
      <div class="container">
        <ol class="breadcrumb">
          <li class="active">Dashboard</li>
        </ol>
      </div>
    </section>

    <section id="main">
      <div class="container">
        <div class="row">
          <div class="col-md-3">
            <div class="list-group">
              <a href="selfservicePortal.php" class="list-group-item active main-color-bg">
                <span class="glyphicon glyphicon-home" aria-hidden="true"></span> Dashboard
              </a>
              <a href="openticketsPortal.php" class="list-group-item"><span class="glyphicon glyphicon-tasks" aria-hidden="true"></span> Open Tickets <span class="badge"><?php echo $TicketNo ?></span></a>
              <a href="fileTicketPortal.php" class="list-group-item"><span class="glyphicon glyphicon-download-alt" aria-hidden="true"></span> File Ticket </a>
            </div>
          </div>
          <div class="col-md-9">
            <!-- Website Overview -->
            <div class="panel panel-default">
              <div class="panel-heading main-color-bg">
                <h3 class="panel-title">SupportDesk Self Service</h3>
              </div>
              <div class="panel-body">
                <div class="alert alert-info" role="alert"> Hi! Welcome to SPi Global Service Desk. We'll help you get in touch with our Service Desk for your technical needs. <br><br>
                Here's some reminders for when filing a ticket: <br> <br>
                For faster processing of requests, always make sure to have complete details. Such as, PC hostname, IP Address, Cubicle No. or Location.
                <br>
                You may contact SPi Service Desk via email (spiservicedesk@spi-global.com) or give them a call (885-8911 local 29911)
              </div>
              </div>
              </div>

              <!-- Latest Users -->
              <div class="panel panel-default">
                <div class="panel-heading">
                  <h3 class="panel-title">Open Ticket filed by Me</h3>
                </div>
                <div class="panel-body">
                  <br>
                   <table class="table table-striped table-hover" id="tbltickets">
                     <thead>
                       <tr>
                        <th>Ticket No.</th>
                        <th>Title</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th>Action</th>
                      </tr>
                     </thead>
                    </table>
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
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script>
      var d = new Date();
      document.getElementById("demo").innerHTML = d;
      </script>
<script type="text/javascript">
  $(document).ready(function(){
   var tbltickets =  $("#tbltickets").DataTable({
    "ajax": "enduserfetchtickets.php",
    "order":[]
   });
  });
</script>
  </body>
</html>
