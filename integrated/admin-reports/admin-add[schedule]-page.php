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
        <!--<div class="undercolor"></div>-->
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
                        <input type="date" id="appointment_date" name="appointment_date" min="<?php echo date('Y-m-d', strtotime('next monday'));?>" required>
                    </div>

                    <div class="input-group flex-group">
                        <label for="appointment_time">Appointment Time</label>
                        <div id="appointment_time" name="appointment_time[]" class="checkbox-group" style="display: block;">
                        <div class ="grid">
                            <input type="checkbox" id="appointment_time_1" name="appointment_time[]" value="11:00:00" />
                            <label for="appointment_time_1">11:00 AM</label>
                            <input type="checkbox" id="appointment_time_2" name="appointment_time[]" value="12:00:00" />
                            <label for="appointment_time_2">12:00 PM</label>
                            <input type="checkbox" id="appointment_time_3" name="appointment_time[]" value="13:00:00" />
                            <label for="appointment_time_3">1:00 PM</label>
                            <input type="checkbox" id="appointment_time_4" name="appointment_time[]" value="14:00:00" />
                            <label for="appointment_time_4">2:00 PM</label>
                            <input type="checkbox" id="appointment_time_5" name="appointment_time[]" value="15:00::00" />
                            <label for="appointment_time_5">3:00 PM</label>
                            <input type="checkbox" id="appointment_time_6" name="appointment_time[]" value="16:00:00" />
                            <label for="appointment_time_6">4:00 PM</label>
                            <input type="checkbox" id="appointment_time_7" name="appointment_time[]" value="17:00:00" />
                            <label for="appointment_time_7">5:00 PM</label>
                            </div>
                        </div>
                    </div>

                    <div class="button-group">
                         <button type="button" id="check-all-timeslots">Check all</button>
                         <button type="button" id="uncheck-all-timeslots">Uncheck all</button>
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
    document.getElementById('check-all-timeslots').addEventListener('click', function() {
    var checkboxes = document.querySelectorAll('input[type="checkbox"]');
    for (var i = 0; i < checkboxes.length; i++) {
        checkboxes[i].checked = true;
    }
});

document.getElementById('uncheck-all-timeslots').addEventListener('click', function() {
    var checkboxes = document.querySelectorAll('input[type="checkbox"]');
    for (var i = 0; i < checkboxes.length; i++) {
        checkboxes[i].checked = false;
    }
});
</script>
</body>
</html>