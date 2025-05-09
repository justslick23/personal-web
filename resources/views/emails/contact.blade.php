<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Contact Form Submission</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            color: #333;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }
        h2 {
            color: #007bff;
        }
        .form-data {
            margin-top: 20px;
        }
        .form-data p {
            margin: 8px 0;
        }
        .form-data strong {
            color: #555;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>New Contact Form Submission</h2>
        <p>You have received a new message from the contact form on your website.</p>

        <div class="form-data">
            <p><strong>Name:</strong> {{ $name }}</p>
            <p><strong>Email:</strong> {{ $email }}</p>
            <p><strong>Message:</strong></p>
            <p>{{ $messageContent }}</p>
            >
        </div>

        <p>Thank you for your time!</p>
    </div>
</body>
</html>
