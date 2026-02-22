<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
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
        }
        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 30px;
            text-align: center;
            border-radius: 10px 10px 0 0;
        }
        .content {
            background: #f8f9fa;
            padding: 30px;
        }
        .footer {
            background: #2d3748;
            color: white;
            padding: 20px;
            text-align: center;
            border-radius: 0 0 10px 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>✅ Test Email</h1>
        </div>
        <div class="content">
            <?= $message ?? '<p>This is a test email from IBidSiam Vinyl Shop.</p>' ?>
        </div>
        <div class="footer">
            <p>&copy; <?= date('Y') ?> IBidSiam. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
