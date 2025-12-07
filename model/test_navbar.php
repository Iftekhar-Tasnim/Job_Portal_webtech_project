<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <title>Test Navbar</title>
    <link rel="stylesheet" href="../assets/css/nav-footer.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            padding-top: 80px;
            font-family: 'Poppins', sans-serif;
        }
        .test-content {
            padding: 40px;
            text-align: center;
        }
    </style>
</head>
<body>
    <?php include '../view/navbar.php'; ?>
    
    <div class="test-content">
        <h1>Navbar Test Page</h1>
        <p>If you can see the navbar above, it's working!</p>
        <p>Check:</p>
        <ul style="text-align: left; max-width: 600px; margin: 20px auto;">
            <li>✓ Logo visible</li>
            <li>✓ Navigation links visible</li>
            <li>✓ User actions visible (Login/Register or Profile)</li>
            <li>✓ Mobile menu button visible on small screens</li>
        </ul>
    </div>
    
    <script src="../assets/js/navbar.js"></script>
</body>
</html>

