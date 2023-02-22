<?php

/* SETTINGS */
$recipient = "your.email@gmail.com";
$subject = "New Message from Contact Form";

if($_POST){

  /* DATA FROM HTML FORM */
  $name = $_POST['name'];
  $lname = $_POST['lname'];
  $email = $_POST['email'];
  $phone = $_POST['phone'];
  $event = $_POST['event'];
  $message = $_POST['message'];
//$phone = $_POST['phone'];


  /* SUBJECT */
  $emailSubject = $subject . " por " . $name + $lname;

  /* HEADERS */
  $headers = "From: $name <$email>\r\n" .
             "Reply-To: $name <$email>\r\n" . 
             "Subject: $emailSubject\r\n" .
             "Content-type: text/plain; charset=UTF-8\r\n" .
             "MIME-Version: 1.0\r\n" . 
             "X-Mailer: PHP/" . phpversion() . "\r\n";
 
  /* PREVENT EMAIL INJECTION */
  if ( preg_match("/[\r\n]/", $name) || preg_match("/[\r\n]/", $email) ) {
    header($_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error', true, 500);
    die("500 Internal Server Error");
  }

  /* MESSAGE TEMPLATE */
  $mailBody = "Nombre: $name \n\r" .
              "Apellido: $lname \n\r" .
              "Email:  $email \n\r" .
              "Asunto:  $subject \n\r" .
              "Telefono:  $phone \n\r" .
              "Mensaje: $message";

  /* SEND EMAIL */
  mail($recipient, $emailSubject, $mailBody, $headers);
}
?>