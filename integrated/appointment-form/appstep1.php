<!DOCTYPE html>
<html>

<head>
    <title>Appointment Form</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="css/appstep1-css.css" />
    <script src="https://unpkg.com/just-validate@latest/dist/just-validate.production.min.js" defer></script>
    <script src="jscript/appstep1-validation.js" defer></script>
    <style>
        .just-validate-error-label {
            margin-top: 5px;
            margin-left: 10px;
        }

        <?php include "../header-footer/header-footer.css"; ?>
    </style>

</head>

<body>
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
    <div class="wrapper">
        <?php include "../header-footer/header.php"; ?>
        
        <div class="title">
            <div class="film"></div>
            <img class="contactImg" src="images/contactImg.png" alt="featured image: inside of the dental office" />
            <div class="contactText">CONTACT US</div>
        </div>

        <div class="APPOINTMENT-FORM-title">
            <p>Appointment Form</p>
        </div>

        <div class="APPOINTMENT-FORM-container" id = "appointment">
            <form action="backend/process-appstep1.php" method="post" id="appstep1" novalidate style="text-align: left;">
                <div class="input-group">
                    <div class="patient-information">Patient Information</div>

                    <?php if (isset($_GET['error'])){ ?>

                    <div class="error-message" style = "color: red" > Error: <?php echo $_GET['error']?> </div>

               <?php } ?>


                    <div class="flex-group">
                        <label>Name</label>
                        <input type="text" id="fname" name="fname" placeholder="First Name" required>
                        <input type="text" id="lname" name="lname" placeholder="Last Name" required>
                    </div>
                </div>

                <div class="input-group flex-group">
                    <label for="pnum">Phone Number</label>
                    <input type="text" id="pnum" name="pnum" placeholder="Phone Number" required>
                </div>

                <div class="input-group flex-group">
                    <label for="email">Email Address</label>
                    <input type="email" id="email" name="email" placeholder="Email Address" required>
                </div>

                <div class="input-group">
                    <label for="gender">Gender</label>
                    <select id="gender" name="gender" required>
                        <option value="" disabled selected>Select an option</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                        <option value="Other">Other</option>
                    </select>
                </div>

                <div class="input-group">
    <label for="apptype">Type of Appointment</label>
    <div id="apptype">
        <div>
            <input type="checkbox" id="apptype1" name="apptype[]" value="Check Up">
            <label for="apptype1">Check Up</label>
        </div>
        <div>
            <input type="checkbox" id="apptype2" name="apptype[]" value="Surgery">
            <label for="apptype2">Surgery</label>
        </div>
        <div>
            <input type="checkbox" id="apptype3" name="apptype[]" value="Prophylaxis and Periodontics">
            <label for="apptype3">Prophylaxis and Periodontics</label>
        </div>
        <div>
            <input type="checkbox" id="apptype4" name="apptype[]" value="Restorative">
            <label for="apptype4">Restorative</label>
        </div>
        <div>
            <input type="checkbox" id="apptype5" name="apptype[]" value="Prosthodontic">
            <label for="apptype5">Prosthodontic</label>
        </div>
        <div>
            <input type="checkbox" id="apptype6" name="apptype[]" value="Removable Applicables">
            <label for="apptype6">Removable Applicables</label>
        </div>
        <div>
            <input type="checkbox" id="apptype7" name="apptype[]" value="Orthodontics">
            <label for="apptype7">Orthodontics</label>
        </div>
        <div>
            <input type="checkbox" id="apptype8" name="apptype[]" value="Root Canal Treatment">
            <label for="apptype8">Root Canal Treatment</label>
        </div>
        <div>
            <input type="checkbox" id="apptype9" name="apptype[]" value="Pediatric Dentistry">
            <label for="apptype9">Pediatric Dentistry</label>
        </div>
        <div>
            <input type="checkbox" id="apptype10" name="apptype[]" value="Bleaching">
            <label for="apptype10">Bleaching</label>
        </div>
        <div>
            <input type="checkbox" id="apptype11" name="apptype[]" value="Retainers">
            <label for="apptype11">Retainers</label>
        </div>
    </div>
</div>


                <div class="input-group" style="display: flex;">
                    <label for="date" font-family: "Josefin Sans" , "sans-serif" ;>Date: <br></label>
                    <div style="display: flex;">
                        <div>
                            <select id="date" name="date" style="font-family: 'Inter', sans-serif; padding: 0.5rem; border-radius: 5px; border: 1px solid #ccc; margin-left: 2rem;">
                                <option value="" disabled selected>Select schedule</option>
                                <!-- PHP code to fetch data from database -->
                                <?php
                                $conn = new mysqli("localhost", "root", "", "sbdoDatabase");
                                $query = "SELECT scheduleDateTime FROM schedule WHERE status = 'available'";
                                $result = mysqli_query($conn, $query);
                                while ($row = mysqli_fetch_assoc($result)) {    
                                    $scheduleDate = $row["scheduleDateTime"];
                                    echo "<option value='$scheduleDate'>$scheduleDate</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="button-group">
                    <button type="reset">RESET INFO</button>
                    <?php if (isset($_COOKIE['User_ID'])) {
                    ?>
                        <input type="submit" value="NEXT" id="submit-comment">
                    <?php } else { ?>
                        <input type="button" id="login-button" value="SUBMIT">
                    <?php } ?>
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
                Contact No.: 0917 110 3983 / 0999 884 0454<br />
                E-mail: sulitandbagasan@gmail.com
            </div>
        </div>
        <div class="film3">
            <div class="content3">
                <p>WHEN ARE WE AVAILABLE</p>
            </div>
            <div class="content3-row3">
                <p>We are open from Monday to Sunday, 9 AM to 5 PM.</p>
                <p>
                    Please call us at 0917 110 3983 / 0999 884 0454 to schedule an
                    appointment.
                </p>
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