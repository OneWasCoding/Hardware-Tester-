<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Order Confirmation</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
        }
        .container {
            width: 80%;
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
        .order-details {
            margin-bottom: 20px;
        }
        .footer {
            text-align: center;
            margin-top: 20px;
            font-size: 0.9em;
            color: #777;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Thank You for Your Order!</h1>
        </div>
        <p>Hi {{ $info[0]->Customer }},</p>
        <p>Order Completed:</p>
        <div class="order-details">
            <p><strong>Order Number:</strong> {{ $info[0]->ID }}</p>
            <p><strong>Order Date:</strong> {{ $info[0]->{'Order Placed'} }}</p>
            <p><strong>Order Status:</strong> {{ $info[0]->Status }}</p>
        </div>
        <p>If you have any questions about your order, feel free to contact us.</p>
        <div class="footer">
            <p>Thank you for shopping with us!</p>
            <p>&copy; {{ date('Y') }} Your Company Name. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
