<?php
// Configuración básica para el formulario de contacto
$receiving_email_address = 'contacto@ejemplo.com';

// Si el archivo validate.js está siendo utilizado, este código no será ejecutado
// Puedes añadir código personalizado para manejar el formulario aquí

if (file_exists($php_email_form = '../vendors/php-email-form/validate.js')) {
  include($php_email_form);
} else {
  die('No se puede acceder al archivo validate.js!');
}

$contact = new PHP_Email_Form;
$contact->ajax = true;

$contact->to = $receiving_email_address;
$contact->from_name = $_POST['name'];
$contact->from_email = $_POST['email'];
$contact->subject = $_POST['subject'];

// Agregar mensaje como párrafos HTML
$contact->message = '<p>' . $_POST['message'] . '</p>';

// Crear un mensaje de texto plano para clientes de correo electrónico que no aceptan HTML
$contact->message .= '<p>Este mensaje fue enviado a través del formulario de contacto del sitio web.</p>';

echo $contact->send();
?>
