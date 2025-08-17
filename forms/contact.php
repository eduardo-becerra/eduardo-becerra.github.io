<?php
$receiving_email_address = 'mishelldominique@gmail.com';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
  die('Acceso no permitido');
}

$name    = htmlspecialchars(trim($_POST['name'] ?? ''), ENT_QUOTES, 'UTF-8');
$email   = filter_var(trim($_POST['email'] ?? ''), FILTER_SANITIZE_EMAIL);
$subject = htmlspecialchars(trim($_POST['subject'] ?? ''), ENT_QUOTES, 'UTF-8');
$message = htmlspecialchars(trim($_POST['message'] ?? ''), ENT_QUOTES, 'UTF-8');

if (!$name || !$subject || !$message) {
  die('Faltan datos');
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
  die('Email no válido');
}

$headers  = "MIME-Version: 1.0\r\n";
$headers .= "Content-type: text/html; charset=UTF-8\r\n";
$headers .= "From: Formulario Web <no-reply@asesoradelactanciaec.com>\r\n";
$headers .= "Reply-To: $name <$email>\r\n";

$email_content  = "<p><strong>De:</strong> $name ($email)</p>";
$email_content .= "<p><strong>Asunto:</strong> $subject</p>";
$email_content .= "<p><strong>Mensaje:</strong></p><p>$message</p>";
$email_content .= "<hr><p>Este mensaje fue enviado a través del formulario de contacto del sitio web.</p>";

if (mail($receiving_email_address, $subject, $email_content, $headers)) {
  echo "OK";
} else {
  echo "Error al enviar";
}
