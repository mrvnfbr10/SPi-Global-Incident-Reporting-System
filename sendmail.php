<?php 
include_once('db.php');
	function send_ir() {
		if(isset($_POST['btnSend'])) {
			include 'phpmailer/PHPMailerAutoload.php';
			$FullName = $_SESSION['FullName'];
			$IncidentReportNo = $_POST['IncidentReportNo'];
			$ToAddress = $_POST['toEmail'];
			$Subject = $_POST['Subject'];
			$Severity = $_POST['severity'];
			$AffectedSite = $_POST['affectedsite'];
			$IncidentOwner = $_POST['IncidentOwner'];
			$DateStart = $_POST['dateStart'];
			$DateEnd = $_POST['dateEnd'];
			$Duration = $_POST['Duration'];
			$AffectedUsers = $_POST['AffectedUsers'];
			$Details = $_POST['editor1'];

			$mailer = new PHPMailer();
			$mailer->IsSMTP();
			$mailer->Host = 'smtp.gmail.com:465'; 
			$mailer->SMTPAuth = TRUE;
			$mailer->Port = 465;
			$mailer->mailer="smtp";
			$mailer->SMTPSecure = 'ssl'; 
			$mailer->IsHTML(true);
			$mailer->SMTPOptions = array('ssl' => array(
									'verify_peer' => false, 
									'verify_peer_name' => false, 
									'allow_self_signed' => true)
									);
			$mailer->Username = 'spisdthesis@gmail.com';
			$mailer->Password = 'spiglobal@123';
			$mailer->From = 'spisdthesis@gmail.com'; 
			$mailer->FromName = 'SPi Global Service Desk';
			$mailer->Body =  '<h2>Incident Report No: #'.$IncidentReportNo.'</h2>
			<p>Description:'.$Subject.'<p>
			<p>Severity: '.$Severity.'<p>
			<p>Affected Site: '.$AffectedSite.'<p>
			<p>Incident Owner: '.$IncidentOwner.'<p>
			<p>Date / Time Start (MLA): '.$DateStart.'<p>
			<p>Date / Time End (MLA): '.$DateEnd.'<p>
			<p>Duration: '.$Duration.'<p>
			<p>Total No. of Affected Users: '.$AffectedUsers.'<p>
			  <table class="table table-striped table-hover">
                     <thead>
                       <tr>
                        <th>Update</th>
                        <th>Posted by</th>
                      </tr>
                     </thead>
                      <tbody>
                        <tr>
                          <td>'.$Details.'</td>
                          <td>'.$FullName.'</td>
                        </tr>
                      </tbody>
                    </table>';
			$mailer->Subject = $Subject;
			$mailer->AddAddress($ToAddress);
			if(!$mailer->send()) {
			echo 'Message could not be sent.';
			echo 'Mailer Error: ' . $mailer->ErrorInfo;
			} else {
			$successMsg = 'Successfully Sent';
			}
		}
	}

	function ticketconfirmation_mail($last_id){
		if(isset($_POST['btnSave'])){
			include 'phpmailer/PHPMailerAutoload.php';
			$FullName = $_SESSION['FullName'];
			$Title = $_POST['Title'];
			$TicketNo = $last_id;
			$ToAddress = $_SESSION['EmailAddress'];
			$mailer = new PHPMailer();
			$mailer->IsSMTP();
			$mailer->Host = 'smtp.gmail.com:465'; 
			$mailer->SMTPAuth = TRUE;
			$mailer->Port = 465;
			$mailer->mailer="smtp";
			$mailer->SMTPSecure = 'ssl'; 
			$mailer->IsHTML(true);
			$mailer->SMTPOptions = array('ssl' => array(
									'verify_peer' => false, 
									'verify_peer_name' => false, 
									'allow_self_signed' => true)
									);
			$mailer->Username = 'spisdthesis@gmail.com';
			$mailer->Password = 'spiglobal@123';
			$mailer->From = 'spisdthesis@gmail.com'; 
			$mailer->FromName = 'SPi Global Service Desk';
			$mailer->Body =  '<h2>Thank you for contacting SPi Global Service Desk</h2>
			<p>Hi '.$FullName.',<p>
			<p>Thank you for reaching out to us. Your request is now queued to our Support Groups for their accomodation.<p>
			<p>Our Service Desk will contact you in case of clarifications regarding your concern.<p>
			<p>Feel free to call us at 29911 or send us an email over at spisdthesis@gmail.com.<p>
			<p>Ticket No:'.$TicketNo.'<p>


			<p>Sincerely,
			<p>SPi Global Service Desk
			<p>
			';
			$mailer->Subject = 'You have filed a ticket RE:'.$Title;
			$mailer->AddAddress($ToAddress);
			if(!$mailer->send()) {
			echo 'Message could not be sent.';
			echo 'Mailer Error: ' . $mailer->ErrorInfo;
			} else {
			$successMsg = 'Successfully Sent';
			}
		}
	}
	function userconfirmation(){
		if(isset($_POST['btnSave'])){
			include 'phpmailer/PHPMailerAutoload.php';
			global $conn;
			$FullName = $_SESSION['FullName'];
			$FirstName = $_POST['FirstName'];
			$username = $_POST['username'];
			$password = $_POST['password'];
			$Position = $_POST['Position'];
			
  			$CallbackNumber = $_POST['CallbackNumber'];
  			$BusinessUnit = $_POST['BusinessUnit'];
  			$Site = $_POST['Site'];
  			$ImmediateSuperior = $_POST['ImmediateSuperior'];
  			$UserType = $_POST['UserType'];
			$ToAddress = $_POST['EmailAddress'];
			$fetchdept = mysqli_query($conn, "SELECT BusinessUnitDesc FROM tblbusinessunit WHERE BusinessUnitID = '$BusinessUnit'");
			$a = mysqli_fetch_array($fetchdept);
			$DeptName = $a['BusinessUnitDesc'];
			$mailer = new PHPMailer();
			$mailer->IsSMTP();
			$mailer->Host = 'smtp.gmail.com:465'; 
			$mailer->SMTPAuth = TRUE;
			$mailer->Port = 465;
			$mailer->mailer="smtp";
			$mailer->SMTPSecure = 'ssl'; 
			$mailer->IsHTML(true);
			$mailer->SMTPOptions = array('ssl' => array(
									'verify_peer' => false, 
									'verify_peer_name' => false, 
									'allow_self_signed' => true)
									);
			$mailer->Username = 'spisdthesis@gmail.com';
			$mailer->Password = 'spiglobal@123';
			$mailer->From = 'spisdthesis@gmail.com'; 
			$mailer->FromName = 'SPi Global Service Desk';
			$mailer->Body =  '<h2>Welcome to SPi Global Service Desk!</h2>
			<p>Hi '.$FirstName.',<p>
			<p>This is to confirm that you now have access to our ticketing tool. Hooray! Your account was created by: '.$FullName.'<p>
			<p>Our ticketing tool acts as a bridge to our users. With the ticketing tool, you may file tickets for your technical needs or report a technical issue.<p>
			<p>To start off, here are your user credentials and other information. For safety, we would like to advise you to keep your information private to avoid data breaches.<p>
			<p>Username: '.$username.'<p>
			<p>Password: '.$password.'<p>
			<p>Department: '.$DeptName.'<p>
			<p>Superior Officer: '.$ImmediateSuperior.'<p>
			<p>Contact No: '.$CallbackNumber.'<p>
			<p>UserType: '.$UserType.'<p>
			<p>Email Address: '.$ToAddress.'<p>
			<p>We look forward to hearing you soon.<p>
			<p>Feel free to call us at 29911 or send us an email over at spisdthesis@gmail.com.<p>


			<p>Sincerely,
			<p>SPi Global Service Desk
			<p>
			';
			$mailer->Subject = 'User Registration';
			$mailer->AddAddress($ToAddress);
			if(!$mailer->send()) {
			echo 'Message could not be sent.';
			echo 'Mailer Error: ' . $mailer->ErrorInfo;
			} else {
			$successMsg = 'Successfully Sent';
			}
		}
	}
	?>