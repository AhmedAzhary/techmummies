<?php
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
  http_response_code(200);
  exit("Method Not Allowed test");
}

$to = "info@techmummies.com"; 
$name = strip_tags(trim($_POST["name"] ?? ''));
$email = filter_var(trim($_POST["email"] ?? ''), FILTER_SANITIZE_EMAIL);
$subject = strip_tags(trim($_POST["subject"] ?? ''));
$message = trim($_POST["message"] ?? '');

if (empty($name) || empty($email) || empty($subject) || empty($message)) {
  http_response_code(400);
  echo "Please fill in all fields.";
  exit;
}

$email_body = "Name: $name\n";
$email_body .= "Email: $email\n";
$email_body .= "Subject: $subject\n\n";
$email_body .= "Message:\n$message\n";

$headers = "From: $name <$email>";

if (mail($to, $subject, $email_body, $headers)) {
  echo "OK";
} else {
  http_response_code(500);
  echo "Failed to send message. Try again later.";
}
