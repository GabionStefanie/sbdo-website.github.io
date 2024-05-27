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

<div class="wrapper">
    <header>
        <?php include "../header-footer/header.php"; ?>
      </header>
</div>

<div class="title">
				<div class="film"></div>
				<img
					class="contactImg"
					src="images/contactImg.png"
					alt="featured image: inside of the dental office"
					/>
				<div class="contactText">CONTACT US</div>
			</div>

<div class="APPOINTMENT-FORM-title"><p>Appointment Form</p></div>

<div class="APPOINTMENT-FORM-container">
    <form action="backend/process-appstep1.php" method="post" id="appstep1" novalidate style="text-align: left;">
        <div class="input-group">
            <div class="patient-information">Patient Information</div>
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
    <label for="date" font-family: "Josefin Sans", "sans-serif";>Date: <br></label>
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
            <button type="submit">NEXT</button>
        </div>
    </form>
</div>



<div class="map">
    <iframe
        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3861.775095013898!2d121.00472617494823!3d14.5548499859261!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3397c96d86c62c73%3A0xe913d861b4f9bb63!2sSulit%20%26%20Bagasan%20Dental%20Office!5e0!3m2!1sen!2sph!4v1701731077552!5m2!1sen!2sph"
        width="600"
        height="450"
        style="border: 0"
        allowfullscreen=""
        loading="lazy"
        referrerpolicy="no-referrer-when-downgrade"
        ></iframe>
        
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

        <footer> 
            <?php include "../header-footer/footer.php"; ?>  
        </footer>

</body>
</html>