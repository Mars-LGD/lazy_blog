<?php
// Check for empty fields
if(empty($_POST['name'])  		||
   empty($_POST['email']) 		||
   empty($_POST['phone']) 		||
   empty($_POST['message'])	||
   !filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)){
	echo "No arguments Provided!";
	return false;
   }
	
$name = $_POST['name'];
$email_address = $_POST['email'];
$phone = $_POST['phone'];
$message = $_POST['message'];
	
// Create the email and send the message
$to = 'xiaotian15@126.com';
$email_subject = "=?UTF-8?B?".base64_encode('Lazy Blog Email：'.$name)."?=";  
$email_body = "Name：$name<br>Email：$email_address<br>Phone：$phone<br>Message：<br>$message";
$headers = "From: noreply@xiaotian15.com\n"; 
$headers .= "Reply-To: $email_address\n";	
$headers .= 'Content-type: text/html; charset=utf-8' . "\n"; 
mail($to,$email_subject,$email_body,$headers);
return true;			
?>
