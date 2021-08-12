<?php

$to ='ecomrsgclassroom@gmail.com';
    

function url(){
  return sprintf(
    "%s://%s",
    isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https' : 'http',
    $_SERVER['SERVER_NAME']
  );
}

if($_POST) {

   $fname = trim(stripslashes($_POST['contact-name']));
   $email = trim(stripslashes($_POST['contact-email']));
   $subject = trim(stripslashes($_POST['contact-subject']));
   $contact_message = trim(stripslashes($_POST['contact-message']));

   $name = $fname;
   
	if ($subject == '') { $subject = "Presentación del formulario de contacto"; }

   // Message
   $message .= "Nombre del destinatario: " . $name . "<br />";
	 $message .= "Correo: " . $email . "<br />";
   $message .= "Mensaje: <br />";
   $message .= nl2br($contact_message);
   $message .= "<br /> ----- <br /> Este correo electrónico fue enviado desde su sitio " . url() . " Formulario de contacto. <br />";

   // From: header
   $from =  $name . " <" . $email . ">";

   // Email Headers
	$headers = "De: " . $from . "\r\n";
	$headers .= "Responder a: ". $email . "\r\n";
 	$headers .= "MIME-Version: 1.0\r\n";
	$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

   ini_set("sendmail_from", $to); 
   $mail = mail($to, $subject, $message, $headers);

	if ($mail) { echo "OK"; }
   else { echo "Algo ha ido mal. Por favor, inténtelo de nuevo."; }

}

?>