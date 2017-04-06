<?php
$return_data = array('success'=>'0');
// die ( json_encode($return_data) );
$gdl_send_complete = 'Contact Form Submitted, I will contact you soon! ';
$gdl_send_error =  'Message cannot be sent to destination';
$return_data = array('success'=>'0');

if(empty($_POST)){
	$return_data['value'] = 'Cannot send email to destination. No parameter receive form AJAX call.';
	die ( json_encode($return_data) );
}

$name = $_POST['ur_name'];
$email = $_POST['ur_email'];
$sub = $_POST['ur_sub'];
$message = $_POST['ur_msg'];

if(empty($name) || empty($email) || empty($sub) || empty($message)){
	$return_data['value'] = 'Please enter all fields';
	die ( json_encode($return_data) );
}

$receiver1 = 'admin@vasuchawla.com';
$receiver = 'vchawla26@gmail.com';

$messages = "You have received a new contact form message. \n";
$messages = $messages . 'Name : ' . $name . " \n";
$messages = $messages . 'Email : ' . $email . " \n";
$messages = $messages . 'Message : ' . $message;
$headers = 'From: '.$receiver1 . "\r\n" .
    'Reply-To: '.$email . "\r\n" .
    'X-Mailer: PHP/' . phpversion();
  
if( mail($receiver, 'New contact form received', $messages,$headers, "-f your@email.here") ){

	$return_data['success'] = '1';
	$return_data['value'] = $gdl_send_complete;
	die( json_encode($return_data) );
}else{
	$return_data['value'] = $gdl_send_error;
	die( json_encode($return_data) );
}
