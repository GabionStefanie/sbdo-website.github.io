<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us | Sulit & Bagasan Dental Office</title>
    <script src="https://unpkg.com/just-validate@latest/dist/just-validate.production.min.js" defer></script>
    <script src="addschedule-validation.js" defer></script>

    <link rel="stylesheet" type="text/css" href="css/admin-addaccount-css.css">
    <style>
        <?php include '../header-footer/header-footer.css'; ?>
    </style>
</head>
<body>
<div class="wrapper">
    <?php include '../header-footer/header.php'; ?>
    <div class="reports-title">Add Records</div>
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
            
            <div class="APPOINTMENT-FORM-container">
                <form action="backend/process-addschedule.php" method="post" id="addschedule" novalidate style="text-align: left;">
                    <div class="input-group">
                        <div class="patient-information">Add Available Schedules</div>
                    </div>

                    <div class="input-group flex-group">
                        <label for="appointment_date">Appointment Date</label>
                        <input type="datetime-local" id="appointment_date" name="appointment_date" min="<?php echo date('Y-m-d\TH:i'); ?>" required>
                    </div>

                    <div class="button-group">
                         <button type="submit">SUBMIT</button>
                        <button type="reset">RESET INFO</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php include '../header-footer/footer.php'; ?>
</div>
<script>
</script>
</body>
</html>
