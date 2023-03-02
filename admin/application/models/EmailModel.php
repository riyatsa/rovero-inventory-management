<?php

/**
 * 
 */
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
class EmailModel extends CI_Model
{
	

	// USING PHPMAILER
	function send_mail($mail_to,$mail_subject,$mail_message) {
		if ($mail_to == 'admin') {
			$mail_to = 'viral.ce15@gmail.com';
			// $mail_to = 'Venkatrakesh@riyatsa.com';
		}
		
		$mail = new PHPMailer();
        $mail->IsSMTP();            
        $mail->SMTPAuth = true; // enabled SMTP authentication
		$mail->SMTPSecure = $this->config->item('smtp_secure');  // prefix for secure protocol to connect to the server
		$mail->SMTPDebug = 2;
		$mail->Host = $this->config->item('smtp_hostname');
		$mail->Port = $this->config->item('smtp_port');
		$mail->Username = $this->config->item('smtp_mail');
		$mail->Password = base64_decode($this->config->item('smtp_password'));            
		$mail->AddAddress($mail_to);
		$mail->SetFrom("testriyatsa@gmail.com", 'RoverInco');
		$mail->IsHTML(true);
		$mail->Subject = $mail_subject;
		$mail->Body = $mail_message;     
		try {
            if ($mail->Send()) {
            	
            return 1;
            }else{
            	
            echo $mail->ErrorInfo;
            }
        } catch(Exception $e) {
        	return 0;
        }
	}
}