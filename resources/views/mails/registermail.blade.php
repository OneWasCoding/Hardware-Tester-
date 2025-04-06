<!DOCTYPE html>
<html>
<head>
    <title>Welcome to Our Platform</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #f9f9f9;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .header h1 {
            color: #4CAF50;
        }
        .content {
            margin-bottom: 20px;
        }
        .footer {
            text-align: center;
            font-size: 0.9em;
            color: #777;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Welcome to Our Platform!</h1>
        </div>
        <div class="content">
            <p>Dear {{ $user->fname }} {{$user->lname}},</p>
            <p>Thank you for registering with us. We are excited to have you on board!</p>
            <p>Please feel free to explore our platform and let us know if you have any questions or need assistance.</p>
            <p>Best regards,</p>
            <p>The Team</p>
        </div>
        <div class="footer">
            <p>&copy; {{ date('Y') }} Our Platform. All rights reserved.</p>
        </div>
    </div>
</body>
</html>