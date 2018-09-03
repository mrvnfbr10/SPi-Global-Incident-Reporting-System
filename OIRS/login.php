<?php
session_start();
include_once('db.php');
$error = false;
if(isset($_POST['btnLogin'])){
    $username = trim($_POST['username']);
    $username = htmlspecialchars(strip_tags($username));
    $password = trim($_POST['password']);
    $password = htmlspecialchars(strip_tags($password));

    if(empty($username)){
        $error = true;
        $errorUsername = "Please enter Username";
    }
    if(empty($password)){
        $error = true;
        $errorPassword = "Please enter Password";
    }
    elseif(strlen($password) < 6){
        $error = true;
        $errorPassword = "Your password must be atleast 6 characters";
    }
    if(!$error){
        $sql = "SELECT * FROM tblUsers WHERE username = '$username' and password ='$password' ";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($result);
        $_SESSION['UserID'] =$row['UserID'];
        $_SESSION['UserType'] =$row['UserType'];
        $count = mysqli_num_rows($result);
        if($count==1){

            if($row['UserType']=="Service Desk Analyst"){
                $_SESSION['FullName'] = $row['FullName'];
                $_SESSION['EmailAddress'] = $row['EmailAddress'];
                $_SESSION['CallbackNumber'] = $row['CallbackNumber'];
                $_SESSION['BusinessUnit'] = $row['BusinessUnit'];
                $_SESSION['Site'] = $row['Site'];
                $_SESSION['ImmediateSuperior'] = $row['ImmediateSuperior'];
                header("location: index.php");
            }
            else if ($row['UserType']=="End User"){
                $_SESSION['FullName'] = $row['FullName'];
                $_SESSION['EmailAddress'] = $row['EmailAddress'];
                $_SESSION['CallbackNumber'] = $row['CallbackNumber'];
                $_SESSION['BusinessUnit'] = $row['BusinessUnit'];
                $_SESSION['Site'] = $row['Site'];
                $_SESSION['ImmediateSuperior'] = $row['ImmediateSuperior'];
                header("location: selfservicePortal.php");
            }
            else if ($row['UserType'] == "Non-SD"){
                $_SESSION['FullName'] = $row['FullName'];
                $_SESSION['EmailAddress'] = $row['EmailAddress'];
                $_SESSION['CallbackNumber'] = $row['CallbackNumber'];
                $_SESSION['BusinessUnit'] = $row['BusinessUnit'];
                $_SESSION['Site'] = $row['Site'];
                $_SESSION['ImmediateSuperior'] = $row['ImmediateSuperior'];
                header("location: nonsdportal.php");
            }
        } 
        else{

            $errorMsg = "Oops! You may have entered the wrong credentials. Kindly try entering correct ones.";
            
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
    <title>SPi Global SupportDesk || Login</title>
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

        </div><!--/.nav-collapse -->
      </div>
    </nav>

    <header id="header">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <img src="assets/logofull.png" class="center-block" style="width:300px;height:200px;">
          </div>
        </div>
      </div>
    </header>

    <section id="main">
      <div class="container">
        <div class="row">
          <div class="col-md-4 col-md-offset-4">
            <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" id="login" autocomplete="off" class="well">
            <?php if(isset($errorMsg)){
                ?>
                <div class = "alert alert-Danger">
                    <span class = "glyphicon glyphicon-info-sign"></span>
                    <?php echo $errorMsg; ?>
            </div>
        <?php
            }  
        ?>    
            <div class="form-group">
                    <label>Username</label>
                    <input type="text" name="username" class="form-control" placeholder="Enter Username">
                    <span class="text-danger"><?php if(isset($errorUsername)) echo $errorUsername ?> </span>
                  </div>
                  <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control" placeholder="Password">
                    <span class="text-danger"><?php if(isset($errorPassword)) echo $errorPassword ?></span>
                  </div>
                  <button type="submit" name="btnLogin" class="btn btn-success btn-block">Login</button>
              </form>
          </div>
        </div>
      </div>
    </section>

    <footer id="footer">
      <p>Copyright SPi Global, &copy; 2018</p>
    </footer>

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
