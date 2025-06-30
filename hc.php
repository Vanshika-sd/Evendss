<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);
    echo "<h2>Thank you, $name!</h2>";
    echo "<p>Your query has been submitted. We will get back to you at <strong>$email</strong> shortly.</p>";
    echo "<p>Your message: $message</p>";
}
?>
