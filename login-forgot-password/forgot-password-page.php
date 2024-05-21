<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password | Sulit & Bagasan Dental Office</title>
    <link rel="stylesheet" type="text/css" href="style_login.css">
    <style>
        <?php include '../header-footer/header-footer.css' ?>
    </style>
</head>
<body>
<?php include '../header-footer/header.php' ?>
    <div class="wrapper">
        <div class="form">
            <form action="backend/psword_OTP.php" method="post" onsubmit="return validateForm()">
                <h1 class="title">FORGOT PASSWORD</h1>
                <hr>
                
                <p>
                    <label>Email address/Username:</label><br>
                    <input type="text" name="username" required>
                </p>
                
                <div class="button-container">
                    <input type="submit" value="SUBMIT">
                </div>
            </form>
        </div>
    </div>
    <?php include '../header-footer/footer.php' ?>

</body>
</html>
