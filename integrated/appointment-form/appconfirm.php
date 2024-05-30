<!DOCTYPE html>
<html>

<head>
    <title>Confirm Appointment</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="css/appconfirm-css.css" />
    <script src="https://unpkg.com/just-validate@latest/dist/just-validate.production.min.js" defer></script>
    <script src="jscript/appconfirm-validation.js" defer></script>
    <style>
        .just-validate-error-label {
            margin-top: 5px;
            margin-left: 10px;
        }


        <?php include '../header-footer/header-footer.css'; ?>
    </style>
</head>

<body>
    <div class="wrapper">
        <?php include '../header-footer/header.php' ?>

        <div class="APPOINTMENT-FORM-title">
            <p>Appointment Form</p>
        </div>
        <div class="APPOINTMENT-FORM-container">

            <form action="../My Account/account-dashboard.php" method="post" id="appconfirm" novalidate>
                <?php

                // Database connection
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "sbdodatabase";

                $mysqli = new mysqli($servername, $username, $password, $dbname);

                // Check connection
                if ($mysqli->connect_error) {
                    die("Connection failed: " . $mysqli->connect_error);
                }

                $date = $_SESSION["date"];
                $time = date("H:i:s", strtotime($_SESSION["time"]));

                if (isset($_COOKIE["User_ID"])) {
                    $userid = $_COOKIE["User_ID"];
                }

                // Query to fetch data from database
                $sql = "SELECT a.appointment_id, pd.paymentdetails_id, ac.name, ac.phone, ac.email, ac.gender, sc.scheduleDate, sc.scheduleTime, s.service_name
         FROM account ac
        JOIN patient p ON ac.user_id = p.user_id
        JOIN appointment a ON p.patient_id = a.appointment_id
        JOIN service s ON a.service_id = s.service_id
        JOIN chief_complaint cc ON a.appointment_id = cc.chief_complaint_id
        JOIN medical_history mh ON a.appointment_id = mh.medical_history_id
        JOIN health_declaration hd ON a.appointment_id = hd.health_declaration_id
        JOIN patient_medical_allergens pma ON a.appointment_id = pma.medical_history_id
        JOIN medical_allergens_list ma ON pma.med_allergen_id = ma.med_allergen_id
        JOIN patient_health_symptoms phs ON a.appointment_id = phs.health_declaration_id
        JOIN health_symptoms hs ON phs.healthsymptoms_id = hs.healthsymptoms_id
        JOIN patient_pain_level ppl ON a.appointment_id = ppl.chief_complaint_id
        JOIN pain_level_list pll ON ppl.pain_level_id = pll.pain_level_id
        LEFT JOIN payment pd ON a.appointment_id = pd.paymentDetails_ID
        LEFT JOIN schedule sc ON a.schedule_id = sc.schedule_id 
        WHERE ac.user_id=$userid
        AND sc.scheduleDate = '$date' AND sc.scheduleTime = '$time'";
                $result = $mysqli->query($sql);

                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();

                    $scheduleDate = $row['scheduleDate'];
                    $scheduleTime = $row['scheduleTime'];

                    // Combine and format date and time
                    $datetime = new DateTime("$scheduleDate $scheduleTime");
                    $formattedDatetime = $datetime->format('m/d/Y h:i A');
                ?>
                    <table>
                        <tr>
                            <th>Appointment ID:</th>
                            <td><?php echo $row["appointment_id"]; ?></td>
                        </tr>
                        <tr>
                            <th>Payment Details ID:</th>
                            <td><?php echo $row["paymentdetails_id"]; ?></td>
                        </tr>
                        <tr>
                            <th>Name:</th>
                            <td><?php echo $row["name"]; ?></td>
                        </tr>
                        <tr>
                            <th>Phone:</th>
                            <td><?php echo $row["phone"]; ?></td>
                        </tr>
                        <tr>
                            <th>Email:</th>
                            <td><?php echo $row["email"]; ?></td>
                        </tr>
                        <tr>
                            <th>Gender:</th>
                            <td><?php echo $row["gender"]; ?></td>
                        </tr>
                        <tr>
                            <th>Appointment Schedule:</th>
                            <td><?php echo $formattedDatetime; ?></td>
                        </tr>
                        <tr>
                            <th>Service:</th>
                            <td><?php echo $row["service_name"]; ?></td>
                        </tr>
                    </table>
                <?php
                } else {
                    echo "No data found";
                }

                $mysqli->close();
                ?>




                <div class="center button">
                    <div class="button-group">
                        <button type="submit">Confirm</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <footer>
        <?php include "../header-footer/footer.php"; ?>
    </footer>

</body>

</html>