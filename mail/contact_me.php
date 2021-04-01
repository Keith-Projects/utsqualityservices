<?php
// Check for empty fields
if(empty($_POST['name']) || empty($_POST['phone']) || empty($_POST['message'])) {
  echo "empty array";
  //exit();
}

$name = strip_tags(htmlspecialchars($_POST['name']));
$phone = strip_tags(htmlspecialchars($_POST['phone']));
$message = strip_tags(htmlspecialchars($_POST['message']));
$formId = strip_tags(htmlspecialchars($_POST['formId']));

// Create the email and send the message
$to = "keith.blackwelder@ktbwebservices.com";
$subject = "Website Contact Form:  $name";
$body = "You have received a new message from your website contact form.\n\n"."Here are the details:\n\nName: $name\n\nPhone: $phone\n\nFormID: $formId\n\nMessage:\n$message";

if(!mail($to, $subject, $body))
  http_response_code(500);
