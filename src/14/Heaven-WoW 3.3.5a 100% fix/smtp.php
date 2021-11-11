<?php
if (!defined('AXE')) exit;

require_once "include/phpmailer.php";

function duloSendMail($to, $subject = false, $message = false)
{
	global $WebMaster, $title;
	
	//setup the PHPMailer class
	$mail = new PHPMailerLite();
	$mail->IsMail();

	$mail->SetFrom($WebMaster, $title . ' Support');
					
	//break if the function failed to laod HTML
	if (!$message or $message == '')
	{
		return false;
	}
	if (!$subject or $subject == '')
	{
		$subject = $title. ' Support';
	}
	
	$mail->AddAddress($to, 'No Name');
  	$mail->Subject = $subject;			
  	$mail->MsgHTML($message);
  	if (!$mail->Send())
	{
		return false;
	}
	
	return true;
}
