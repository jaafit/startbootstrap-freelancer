<?php
// Check for empty fields
if(empty($_POST['name'])  		||
   empty($_POST['email']) 		||
   empty($_POST['message'])	||
   !filter_var($_POST['email'],FILTER_VALIDATE_EMAIL))
   {
	echo "No arguments Provided!";
	return false;
   }

$name = strip_tags(htmlspecialchars($_POST['name']));
$email_address = strip_tags(htmlspecialchars($_POST['email']));
$message = strip_tags(htmlspecialchars($_POST['message']));

file_put_contents(
    '/home/learnspanishnh/contacts.txt',
    "\n".join("\n", array($name, $email_address, $message)),
    FILE_APPEND);

// Create the email and send the message
$to = 'vcfigueroa@gmail.com'; // Add your email address inbetween the '' replacing yourname@yourdomain.com - This is where the form will send a message to.

$email_subject = "LearnSpanishNH Contact Form:  $name";
$email_body = "You have received a new message from your website contact form.\r\n"."Here are the details:\r\nName: $name\r\nEmail: $email_address\r\nMessage:\r\n$message";
$headers = "From: ".'noreply@www.minethings.com'; // This is the email address the generated message will be from. We recommend using something like noreply@yourdomain.com.
$headers .= "\r\nReply-To: $email_address";
$r = mail($to,$email_subject,$email_body,$headers);
file_put_contents(
    '/home/learnspanishnh/contacts.txt',
    "\nmail: ".var_export($r, true),
    FILE_APPEND);

return true;