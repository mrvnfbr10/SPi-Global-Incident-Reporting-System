<?php 
	function email_send() {
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
	?>