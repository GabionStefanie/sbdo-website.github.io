<html>

<style>
    .just-validate-error-label {
        margin-top: 5px;
        margin-left: 10px;
    }

    <?php include "../header-footer/header-footer.css"; ?>
</style>
<?php include "../header-footer/header.php"; ?>

</html>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Appointment Form</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/appstep1-css.css" />
    <script src="https://unpkg.com/just-validate@latest/dist/just-validate.production.min.js" defer></script>
    <script src="jscript/appstep1-validation.js" defer></script>

</head>

<body>
    <div class="wrapper">
        <div id="loginModal" class="modal">
            <div class="modal-content">
                <div class="modal-header">
                    <span class="close">&times;</span>
                    <h2>Login to Proceed</h2>
                </div>
                <div class="modal-body">
                    <p>It seems that you are not yet logged in.</p>
                    <p>Please log in to be able to book an appointment.</p>
                    <a href="../Login/login.php"><button>LOG IN</button></a>
                </div>
            </div>
        </div>
        <div class="title">
            <div class="film"></div>
            <img class="contactImg" src="images/contactImg.png" alt="featured image: inside of the dental office" />
            <div class="contactText">CONTACT US</div>
        </div>

        <div class="APPOINTMENT-FORM-title">
            <p>Appointment Form</p>
        </div>

        <div class="APPOINTMENT-FORM-container" id="appointment">
            <form action="backend/process-appstep1.php" method="post" id="appstep1" novalidate style="text-align: left;">
                <div class="input-group">
                    <div class="patient-information">Patient Information</div>

                    <div class="input-group">
                        <label for="apptype">Type of Appointment</label>
                        <select id="apptype" name="apptype" required>
                            <option value="" disabled selected>Select an option</option>
                            <option value="1">Check Up</option>
                            <option value="2">Surgery</option>
                            <option value="3">Prophylaxis and Periodontics</option>
                            <option value="4">Restorative</option>
                            <option value="5">Prosthodontic</option>
                            <option value="6">Removable Applicables</option>
                            <option value="7">Orthodontics</option>
                            <option value="8">Root Canal Treatment</option>
                            <option value="9">Pediatric Dentistry</option>
                            <option value="10">Bleaching</option>
                            <option value="11">Retainers</option>
                        </select>
                    </div>

                    <div class="input-group" style="display: flex;">
                        <label for="date">Date: </label>
                        <div style="display: flex;">
                            <div>
                                <select id="date" name="date" style="font-family: 'Inter', sans-serif; padding: 0.5rem; border-radius: 5px; border: 1px solid #ccc; margin-left: 2rem;">
                                    <option value="" disabled selected>Select schedule</option>
                                    <?php
                                    $conn = new mysqli("localhost", "root", "", "sbdoDatabase");
                                    $query = "SELECT DISTINCT scheduleDate FROM schedule WHERE status = 'available'";
                                    $result = mysqli_query($conn, $query);

                                    $dates = array();
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        $dates[] = $row["scheduleDate"];
                                    }

                                    // Remove duplicate dates
                                    $uniqueDates = array_unique($dates);

                                    foreach ($uniqueDates as $date) {
                                        echo "<option value='$date'>$date</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="input-group">
                        <label for="time">Time: </label>
                        <div style="display: flex;">
                            <!-- <div> -->
                                <select id="time" name="time">
                                    <option value="" disabled selected>Select time</option>
                                    <!-- Time options will be populated here -->
                                </select>
                            <!-- </div> -->
                        </div>
                    </div>

                    <script>
                        document.getElementById('date').addEventListener('change', function() {
                            var selectedDate = this.value;
                            var xhr = new XMLHttpRequest();
                            xhr.open('GET', 'get_times.php?date=' + selectedDate, true);
                            xhr.onreadystatechange = function() {
                                if (xhr.readyState === 4 && xhr.status === 200) {
                                    var times = JSON.parse(xhr.responseText);
                                    var timeSelect = document.getElementById('time');
                                    timeSelect.innerHTML = '<option value="" disabled selected>Select time</option>'; // Reset time options

                                    times.forEach(function(time) {
                                        // Convert time to AM/PM format
                                        var timeParts = time.split(':');
                                        var hours = parseInt(timeParts[0], 10);
                                        var minutes = timeParts[1];
                                        var ampm = hours >= 12 ? 'PM' : 'AM';
                                        hours = hours % 12;
                                        hours = hours ? hours : 12; // Handle midnight (00:00) as 12 AM
                                        var formattedTime = hours + ':' + minutes + ' ' + ampm;

                                        var option = document.createElement('option');
                                        option.value = time;
                                        option.text = formattedTime;
                                        timeSelect.appendChild(option);
                                    });

                                }
                            };
                            xhr.send();
                        });
                    </script>

                    <?php
                    if (isset($_GET['date'])) {
                        $selectedDate = $_GET['date'];
                        $conn = new mysqli("localhost", "root", "", "sbdoDatabase");
                        $query = "SELECT DISTINCT scheduleTime FROM schedule WHERE scheduleDate = '$selectedDate' AND status = 'Available'";
                        $result = mysqli_query($conn, $query);

                        $times = array();
                        while ($row = mysqli_fetch_assoc($result)) {
                            $times[] = $row["scheduleTime"];
                        }
                        echo '<script>var times = ' . json_encode($times) . ';</script>';
                    }
                    ?>


                    <div class="button-group">
                        <button type="reset">RESET INFO</button>
                        <?php if (isset($_COOKIE['User_ID'])) { ?>
                            <input type="submit" value="NEXT" id="submit-comment">
                        <?php } else { ?>
                            <input type="button" id="login-button" value="SUBMIT">
                        <?php } ?>
                    </div>
                </div>
            </form>
        </div>

        <div class="map">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3861.775095013898!2d121.00472617494823!3d14.5548499859261!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3397c96d86c62c73%3A0xe913d861b4f9bb63!2sSulit%20%26%20Bagasan%20Dental%20Office!5e0!3m2!1sen!2sph!4v1701731077552!5m2!1sen!2sph" width="600" height="450" style="border: 0" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>

        <div class="film2">
            <div class="content2">
                <p>WHERE TO FIND US</p>
            </div>
            <div class="content2-row2">
                Location: 2776 Faraday, Makati, 1234 Metro Manila<br />
                Contact No.: +63 917 110 3983 / +63 999 884 0454<br />
                E-mail: sulitandbagasan@gmail.com
            </div>
        </div>

        <div class="film3">
            <div class="content3">
                <p>WHEN ARE WE AVAILABLE</p>
            </div>
            <div class="content3-row3">
                <p>We are open from Monday to Sunday, 9 AM to 5 PM.</p>
            </div>
        </div>

        <?php include "../header-footer/footer.php"; ?>
    </div>

    <script>
        var modal = document.getElementById("loginModal");
        var btn = document.getElementById("login-button");
        var span = document.getElementsByClassName("close")[0];

        btn.onclick = function() {
            modal.style.display = "flex";
        }

        span.onclick = function() {
            modal.style.display = "none";
        }

        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>
</body>

</html>