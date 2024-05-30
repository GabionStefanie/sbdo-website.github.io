<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us | Sulit & Bagasan Dental Office</title>
    <script src="https://unpkg.com/just-validate@latest/dist/just-validate.production.min.js" defer></script>
    <script src = "addschedule-validation.js" defer></script>

    <link rel="stylesheet" type="text/css" href="css/addaccount-success-css.css">
    <style>
        <?php include '../header-footer/header-footer.css';?>
    </style>
</head>
<body>
    <div class="wrapper">
        <?php include '../header-footer/header.php'; ?>
        <div class="reports-title">Appointments</div>
        <div class="container-clients-services">
            <div class="undercolor"></div>
            <div style="display: block">
                <div class="clients-and-services-container">
                    <div class="clients-and-services">
                        <div class="cancelled-text">
                            <a href="admin-add[account]-page.php">
                                <p>ACCOUNT</p>
                            </a>
                        </div>
                    </div>
                    <div class="clients-and-services">
                        <div class="clients-text">
                            <a href="admin-add[schedule]-page.php">
                                <p>SCHEDULE</p>
                            </a>
                        </div>
                    </div>
                </div>
                
                <div class="APPOINTMENT-FORM-title">
                    <p>Addition of schedule is successful. Click <a href="admin-add[schedule]-page.php">here</a> to add another available schedule.</p>
                </div>
            </div>
        </div>
        <?php include '../header-footer/footer.php'; ?>
    </div>
</body>
</html>
