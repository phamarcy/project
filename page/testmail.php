<?php
require 'vendor/PHPMailer/PHPMailerAutoload.php';
require 'vendor/autoload.php';
use Mailgun\Mailgun;

//gmail
$mail = new PHPMailer(); // create a new object
$mail->IsSMTP(); // enable SMTP
$mail->SMTPDebug = 2; // debugging: 1 = errors and messages, 2 = messages only
$mail->SMTPAuth = true; // authentication enabled
$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
$mail->Host = "smtp.gmail.com";
$mail->Port = 465; // or 587
$mail->IsHTML(true);
$mail->Username = "pharmcyatest@gmail.com";
$mail->Password = "11112222a";
$mail->SetFrom("knownamenow@gmail.com");
$mail->Subject = "Test";
$mail->Body = "hello";
$mail->AddAddress("knownamenow@gmail.com");

 if(!$mail->Send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;
 } else {
    echo "Message has been sent";
 }

//Mailgun
/*$mail = new PHPMailer();
//$mail->SMTPDebug = 1;
$mail->isSMTP();  // Set mailer to use SMTP
$mail->Host = 'smtp.mailgun.org';  // Specify mailgun SMTP servers
$mail->SMTPAuth = true; // Enable SMTP authentication
$mail->Username = 'postmaster@sandboxa71fb50d000d4ee2b83fcd180359c0cd.mailgun.org'; // SMTP username from https://mailgun.com/cp/domains
$mail->Password = '95dad070d6820f46a1a46b80f51443d1'; // SMTP password from https://mailgun.com/cp/domains
$mail->SMTPSecure = 'tls';   // Enable encryption, 'ssl'

$mail->From = 'postmaster@sandboxa71fb50d000d4ee2b83fcd180359c0cd.mailgun.org'; // The FROM field, the address sending the email
$mail->FromName = 'Orlie'; // The NAME field which will be displayed on arrival by the email client
$mail->addAddress('knownamenow@gmail.com', 'namer');     // Recipient's email address and optionally a name to identify him
$mail->isHTML(true);   // Set email to be sent as HTML, if you are planning on sending plain text email just set it to false

// The following is self explanatory
$mail->Subject = 'Email sent with Mailgun';
$mail->Body    = '<span style="color: red">Mailgun rocks</span>, thank you <em>phpmailer</em> for making emailing easy using this <b>tool!</b>';
$mail->AltBody = 'Mailgun rocks, shame you can\'t see the html sent with phpmailer so you\'re seeing this instead';

if(!$mail->send()) {
    echo "Message hasn't been sent.";
    echo 'Mailer Error: ' . $mail->ErrorInfo . "\n";
} else {
    echo "Message has been sent :) \n";

}*/

//Mailgun API


# Instantiate the client.
/*$mgClient = new Mailgun('key-9d8311f62065ca14b5ae94b3bc4f8915');
$domain = "sandboxa71fb50d000d4ee2b83fcd180359c0cd.mailgun.org";

# Make the call to the client.
$result = $mgClient->sendMessage("$domain",
          array('from'    => 'Mailgun Sandbox <postmaster@sandboxa71fb50d000d4ee2b83fcd180359c0cd.mailgun.org>',
                'to'      => 'anawat <knownamenow@gmail.com>',
                'subject' => 'Hello anawat',
                'text'    => 'Congratulations anawat, you just sent an email with Mailgun!  You are truly awesome! '));
*/
# You can see a record of this email in your logs: https://mailgun.com/app/logs .

# You can send up to 300 emails/day from this sandbox server.
# Next, you should add your own domain so you can send 10,000 emails/month for free.
