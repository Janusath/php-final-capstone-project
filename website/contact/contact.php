<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Page</title>
</head>
<body>
    <h2>Contact Us</h2>
    <form action="contact.php" method="POST">
        <label for="name">Name:</label><br>
        <input type="text" id="name" name="name" required><br><br>

        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" required><br><br>

        <label for="message">Message:</label><br>
        <textarea id="message" name="message" rows="4" required></textarea><br><br>

        <input type="submit" value="Submit">
    </form>
</body>
</html>

   
<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../../vendor/autoload.php'; // Include the autoloader if using Composer

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);

    // Validate data
    if (empty($name) || empty($email) || empty($message)) {
        echo "All fields are required!";
    } else {
        // Send email using PHPMailer
        $mail = new PHPMailer(true);
        try {
            // Server settings
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';  // Gmail SMTP server
            $mail->SMTPAuth = true;
            $mail->Username = 'mohamedahshan0056@gmail.com';  // Your Gmail address (the sender)
            $mail->Password = 'fetk qskm xgei liwp';  // Your app-specific password (16 characters)
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            // Recipients
            $mail->setFrom('mohamedahshan0056@gmail.com', 'Your Website Name');  // Your email as the sender
            $mail->addAddress('mohamedahshan0056@gmail.com', 'Admin');  // Replace with your admin email

            // Set the "Reply-To" address to the user's email address
            $mail->addReplyTo($email, $name);  // This makes the reply address the user's email

            // Content
            $mail->isHTML(true);
            $mail->Subject = 'New contact form submission from ' . $name;
            $mail->Body    = "You have received a new message from $name ($email):<br><br>$message";

            // Send the email
            $mail->send();
            echo 'Thank you for contacting us. We will get back to you soon!';
        } catch (Exception $e) {
            echo "There was an error sending your message. Please try again. Mailer Error: {$mail->ErrorInfo}";
        }
    }
}
?>
