<?php
include_once('db.php');
session_start();

$fetchArt = "SELECT Title, tblcategory.CategoryDescription AS Category, CreationDate, CreatedBy FROM tblknowledge INNER JOIN tblcategory ON tblknowledge.CategoryID = tblcategory.CategoryID";
$filterArt = mysqli_query($conn, $fetchArt);
$result = filterTable($fetchArt);

function filterTable($fetchArt){
  global $conn;
  $filter_Result = mysqli_query($conn, $fetchArt);
  return $filter_Result;
}

$fetchCat = "SELECT * FROM tblcategory";
$filterCat = mysqli_query($conn, $fetchCat);
$error = false;
if(isset($_POST['btnSave'])){
  $Title = $_POST['Title'];
  $Body = $_POST['Body'];
  $Category = $_POST['Category'];
  $Author = $_SESSION['FullName'];

  if(empty($Title)){
    $error = true;
    $errorFullName = "Please enter Title.";
  }
  
  if(empty($Body)){
    $error = true;
    $errorusername = "Please enter Details.";
  }
  if(!$error){
    $sql = "INSERT INTO tblknowledge(Title, Details, CategoryID, CreatedBy) VALUES ('$Title', '$Body','$Category','$Author')";
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
          <a class="navbar-brand" href="#">SPi Global Service Desk</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav navbar-left">
            <li><a href="index.php">Home</a></li>
            <li class="active"><a href="knowledgebase.php">Knowledge Base</a></li>
            <li><a href="reports.php">Reports</a></li>
          </ul>
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
                      <li><a data-toggle="tab" href="#form">Create Article</a></li>
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
                         <th>Title</th>
                         <th>Category</th>
                         <th>Date</th>
                         <th>Author</th>
                         <th>Action</th>
                       </tr>
                     </thead>
                     <?php while($row = mysqli_fetch_array($result)): ?>
                      <tbody>
                        <tr>
                          <td><?php echo $row['Title'];?></td>
                          <td><?php echo $row['Category']?></td>
                          <td><?php echo $row['CreationDate']?></td>
                          <td><?php echo $row['CreatedBy']?></td>
                          <td><button type="button" class="btn btn-warning" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-pencil"></span></td>
                          <td><button type="button" class="btn btn-danger" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-trash"></span></td>
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
                      <label>Title</label>
                      <br>
                      <input type="text" class="form-control" name="Title" placeholder="Title">
                      <span class="text-danger"><?php if(isset($errorTitle)) echo $errorTitle ?> </span>
                    </div>

                    <div class="form-group">
                      <label>Article Body</label>
                      <textarea class="form-control" name="Body" placeholder="Type something here. . "></textarea>
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
                      <input type="submit" name="btnSave" value="Save Article" class="btn-lg btn-primary btn-block">
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
<script>
var d = new Date();
document.getElementById("demo").innerHTML = d;
</script>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>
