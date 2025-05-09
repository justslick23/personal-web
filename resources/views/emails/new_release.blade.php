<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New {{ ucfirst($type) }} Release</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
        }

        .email-container {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .email-header {
            text-align: center;
            margin-bottom: 20px;
        }

        .email-header h2 {
            color: #4CAF50;
            font-size: 24px;
            margin: 0;
        }

        .email-content {
            margin-bottom: 20px;
        }

        .email-content p {
            font-size: 16px;
            color: #555;
            line-height: 1.6;
        }

        .email-button {
            display: inline-block;
            padding: 12px 24px;
            background-color: #4CAF50;
            color: white;
            font-size: 16px;
            font-weight: bold;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 20px;
            text-align: center;
        }

        .footer {
            text-align: center;
            color: #aaa;
            font-size: 14px;
            margin-top: 40px;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="email-header">
            <h2>🎶 New {{ ucfirst($type) }} Released: {{ $title }}</h2>
        </div>

        <div class="email-content">
            <p>Hey there,</p>
            <p>I'm excited to announce that a new {{ ucfirst($type) }} titled <strong>{{ $title }}</strong> has just been released!</p>
            <p>Click the link below to listen now:</p>
        </div>

        <a href="{{ $url }}" class="email-button">Listen Now</a>

        <div class="footer">
            <p>Thank you for the support!</p>
            <p>&copy; {{ date('Y') }} Just Slick. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
