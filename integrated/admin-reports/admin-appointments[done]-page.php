<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us | Sulit & Bagasan Dental Office</title>
    <link rel="stylesheet" type="text/css" href="css/admin-appointment[done]-css.css">
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
                    <div class="services-text">
                        <a href="admin-appointments[upcoming]-page.php">
                            <p>UPCOMING</p>
                        </a>
                    </div>
                </div>
                <div class="clients-and-services">
                    <div class="clients-text">
                        <a href="admin-appointments[done]-page.php">
                            <p>DONE</p>
                        </a>
                    </div>
                </div>
                <div class="clients-and-services">
                    <div class="cancelled-text">
                        <a href="admin-appointments[cancelled]-page.php">
                            <p>CANCELLED</p>
                        </a>
                    </div>
                </div>
            </div>
            <div class="appcontainer">
			<div class="appointment-table">
    <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "sbdoDatabase";

    $mysqli = new mysqli($servername, $username, $password, $dbname);
    $sql = "SELECT sc.scheduleDate, sc.scheduleTime, pd.paymentdetails_id, ac.name, ac.phone, ac.gender, ac.email, s.service_name, cc.chief_complaint, cc.details, cc.dentalpain_status, cc.dental_trauma, cc.bleeding_tissues, mh.medical_conditions, mh.diabetes, mh.heart_conditions, mh.hypertension, mh.maintenance, mh.systolic_pressure, mh.diastolic_pressure, GROUP_CONCAT(DISTINCT ma.medicine_name SEPARATOR ', ') AS medicine_name, GROUP_CONCAT(DISTINCT hs.symptom_name SEPARATOR ', ') AS symptom_name, pll.pain_value, hd.covidvaccine_status, pd.referenceno, pd.amount, pd.image_filename, a.appointment_id
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
    WHERE p.patient_status = 'Done'
    GROUP BY p.patient_id
    ORDER BY sc.scheduleDate";
    
    $result = $mysqli->query($sql);
    while($row = $result->fetch_assoc()) {
        $id = uniqid();

        $scheduleDate = $row['scheduleDate'];
        $scheduleTime = $row['scheduleTime'];

        // Combine and format date and time
        $datetime = new DateTime("$scheduleDate $scheduleTime");
        $formattedDatetime = $datetime->format('m/d/Y h:i A');
        ?>
                        <div class="dropdown">
                            <button id="buttonDropdown-<?php echo $id; ?>" class="buttonDropdown"><?php echo $row["name"]; ?></button>
                            <div id="dropdownData-<?php echo $id; ?>-event" class="dropdown-content">
                                <table>
                                    <tr><th>Appointment ID:</th><td><?php echo $row["appointment_id"]; ?></td></tr>
                                    <tr><th>Payment ID:</th><td><?php echo $row["paymentdetails_id"]; ?></td></tr>
                                    <tr><th>Appointment Schedule:</th><td><?php echo $formattedDatetime; ?></td></tr>
                                    <tr><th>Phone:</th><td><?php echo $row["phone"]; ?></td></tr>
                                    <tr><th>Email:</th><td><?php echo $row["email"]; ?></td></tr>
                                    <tr><th>Gender:</th><td><?php echo $row["gender"]; ?></td></tr>
                                    <tr><th>Service:</th><td><?php echo $row["service_name"]; ?></td></tr>
                                    <tr><th>Chief Complaint:</th><td><?php echo $row["chief_complaint"]; ?></td></tr>
									<tr><th>Details:</th><td><?php echo $row["details"]; ?></td></tr>
									<tr><th>Has dental pain?</th><td><?php echo $row["dentalpain_status"]; ?></td></tr>
									<tr><th>Has dental trauma?</th><td><?php echo $row["dental_trauma"]; ?></td></tr>
									<tr><th>Has bleeding tissues?</th><td><?php echo $row["bleeding_tissues"]; ?></td></tr>
                                    <tr><th>Medical History:</th><td><?php echo $row["medical_conditions"]; ?></td></tr>
									<tr><th>Has any form of diabetes?</th><td><?php echo $row["diabetes"]; ?></td></tr>
									<tr><th>Has heart conditions?</th><td><?php echo $row["heart_conditions"]; ?></td></tr>
									<tr><th>Has hypertension?</th><td><?php echo $row["hypertension"]; ?></td></tr>
									<tr><th>Takes maintenance medicine?</th><td><?php echo $row["maintenance"]; ?></td></tr>
									<tr><th>Systolic Pressure</th><td><?php echo $row["systolic_pressure"]; ?></td></tr>
									<tr><th>Diastolic Pressure</th><td><?php echo $row["diastolic_pressure"]; ?></td></tr>
                                    <tr><th>Covid Vaccine Status:</th><td><?php echo $row["covidvaccine_status"]; ?></td></tr>
									<tr><th>Medical Allergen:</th><td><?php echo $row["medicine_name"]; ?></td></tr>
									<tr><th>Health Symptoms:</th><td><?php echo $row["symptom_name"]; ?></td></tr>
									<tr><th>Pain Level:</th><td><?php echo $row["pain_value"]; ?></td></tr>
                                    <tr><th>Reference No.:</th><td><?php echo $row["referenceno"]; ?></td></tr>
									<tr><th>Amount:</th><td><?php echo $row["amount"]; ?></td></tr>
									<tr><th>Proof of Payment</th><td>  <a href="../appointment-form/backend/images/<?php echo $row['image_filename']; ?>" target="_blank">
            <img src="../appointment-form/backend/images/<?php echo $row['image_filename']; ?>" alt="Proof of Payment" style="max-width: 50%; max-height: auto; cursor: pointer;" id="image-<?php echo $row['image_filename']; ?>"></a></td></tr>
                                        <tr>
                                        <td colspan="2">
                                            <form action="" method="post">
                                                <input type="hidden" name="appointment_id" value="<?php echo $row["appointment_id"]; ?>">
                                                <input type="submit" value="Mark as Done" class="mark-done-button">
                                            </form>
                                        </td>
                                </table>
                            </div>
                        </div>
                        <?php
                    }
                    $mysqli->close();
                    ?>
                </div>
            </div>
        </div>
    </div>
    <?php include '../header-footer/footer.php'; ?>
</div>
<script>
document.addEventListener('DOMContentLoaded', (event) => {
    const dropdownButtons = document.querySelectorAll('.buttonDropdown');
    
    dropdownButtons.forEach(button => {
        const dropdownId = button.id.split('buttonDropdown-')[1];
        const dropdownData = document.querySelector(`#dropdownData-${dropdownId}-event`);
        dropdownData.style.display = "none";
        
        button.addEventListener("click", () => {
            // Close all dropdowns
            dropdownButtons.forEach(otherButton => {
                const otherDropdownId = otherButton.id.split('buttonDropdown-')[1];
                const otherDropdownData = document.querySelector(`#dropdownData-${otherDropdownId}-event`);
                if (otherDropdownId !== dropdownId) {
                    otherDropdownData.style.display = "none";
                }
            });
            
            // Toggle the display of the clicked dropdown
            if (dropdownData.style.display === "none") {
                dropdownData.style.display = "block";
                // Adjust the screen to show the clicked dropdown
                const yOffset = -100; // Adjust this value to position the dropdown correctly
                const y = dropdownData.getBoundingClientRect().top + window.pageYOffset + yOffset;
                window.scrollTo({ top: y, behavior: 'smooth' });
            } else {
                dropdownData.style.display = "none";
            }
        });
    });
});

</script>

</body>
</html>
