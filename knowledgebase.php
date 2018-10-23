<?php
include_once('db.php');
session_start();

$filterCat = mysqli_query($conn, "SELECT * FROM tblcategory");
$error = false;

if(isset($_POST['btnSave'])){
  $Title = $_POST['Title'];
  $Body = $_POST['Body'];
  $Category = $_POST['Category'];
  $Author = $_SESSION['FullName'];
  $Privacy = $_POST['privacy'];

  if(empty($Title)){
    $error = true;
    $errorFullName = "Please enter Title.";
  }
  
  if(empty($Body)){
    $error = true;
    $errorusername = "Please enter Details.";
  }
  if(!$error){
    $sql = "INSERT INTO tblknowledge(Title, Details, CategoryID, CreatedBy, Privacy) VALUES ('$Title', '$Body','$Category','$Author', '$Privacy')";
    if(mysqli_query($conn, $sql)){
      $successMsg = "Article has been saved to database!";
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
    <title>SPi Service Desk | Knowledge Base</title>
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
          <a class="navbar-brand" href="#">SPi Global Service Desk</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav navbar-left">
            <li><a href="admindashboard.php">Home</a></li>
            <li class="active"><a href="knowledgebase.php">Knowledge Base</a></li>
            <li><a href="reports.php">Reports</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li><h6 id = "demo"></h6></li>
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
          <li class="active">Knowledge Base</a></li>
        </ol>
      </div>
    </section>

    <section id="main">
      <div class="container">
        <div class="row">
          
          <div class="col-md-12">
            <!-- Website Overview -->
            <div class="panel panel-default">
              <div class="panel-heading main-color-bg">
                <h3 class="panel-title">Knowledge Base</h3>
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
                      <li class="active"><a data-toggle="tab" href="#list">All Articles</a></li>
                      </ul>        
                <div class="tab-content">
                  <div id="list" class="tab-pane fade in active">
                    <br>
                    <div class="col-md-12">
                          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addArticle">Add Article</button>
                          <br>
                    <br>
                    <table class="table table-bordered table-hover" id="tblknowledge">
                     <thead>
                       <tr>
                        <th>Article No.</th>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Date</th>
                        <th>Author</th>
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
      </div>
    </section>

    <footer id="footer">
      <p>Copyright SPi Global, &copy; 2018</p>
    </footer>

    <!-- Modals -->

    <!-- Add Article -->

    <div class="modal fade" id="addArticle" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
       <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" autocomplete="off">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Add Article</h4>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label>Title</label>
          <br>
          <input type="text" class="form-control" name="Title" placeholder="Title">
          <span class="text-danger"><?php if(isset($errorTitle)) echo $errorTitle ?></span>
        </div>
        <div class="form-group">
          <label>Article Body</label>
          <textarea class="form-control" rows="10" cols="60" name="Body" placeholder="Article Details"></textarea>
          <span class="text-danger"><?php if(isset($errorBody)) echo $errorBody ?></span>
        </div>
        <div class="form-group">
          <label>Category</label>
          <select class="form-control" name="Category" id="sel1">
                  <?php while($row = mysqli_fetch_array($filterCat)):;?>
          <option value="<?php echo $row[0];?>"><?php echo $row[1];?></option>
                  <?php endwhile;?>
          </select>
          <span class="text-danger"><?php if(isset($errorSite)) echo $errorSite ?> </span>
        </div>
        <div class="form-group">
          <label>Privacy Settings</label><br>
          <input type="radio" name="privacy" value="Only SD"> Only SD<br>
          <input type="radio" name="privacy" value="Public"> Public
        </div>
      </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <input type="submit" name="btnSave" class="btn btn-primary" value="Add Article">
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
      var tblknowledge =  $("#tblknowledge").DataTable({
        "ajax": "fetchkb.php",
        "order":[]
        });
       });
</script>
  </body>
</html>
