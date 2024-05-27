<?php
session_start();
ini_set('mysql.connect_timeout', 300);
ini_set('default_socket_timeout', 300);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["referenceNo"])) {
        die("Reference No. is required");
    }

    if (empty($_FILES["proofOfPayment"])) {
        die("Proof of Payment required");
    }

    $mysqli = new mysqli("localhost", "root", "", "sbdoDatabase");

    $_SESSION["referenceNo"] = $_POST["referenceNo"];
    $file = $_FILES['proofOfPayment'];

    $file_name = $file['name'];
    $file_tmp = $file['tmp_name'];
    $file_type = $file['type'];

    // Check if file is an image
    if (strpos($file_type, 'image') === false) {
        echo "<script>alert('File is not an image.');</script>";
        echo "<script>window.location.replace('payments.php');</script>";
        exit;
    }

    $Image = addslashes(file_get_contents($file_tmp));

    $mysqli->begin_transaction();

    try {
        // Insert into patient table
        $sql = "INSERT INTO patient (name, phone, email, gender, patient_status) VALUES (?, ?, ?, ?, ?)";
        $stmt = $mysqli->prepare($sql);
        if (!$stmt) {
            throw new Exception("SQL error: " . $mysqli->error);
        }
        $_status = "Pending";
        $stmt->bind_param("sssss", $_SESSION["name"], $_SESSION["pnum"], $_SESSION["email"], $_SESSION["gender"], $_status);
        $stmt->execute();


        // Get the patient_id of the last inserted patient
        $patient_id = $mysqli->insert_id;

        // Get schedule_id
        $sql = "SELECT schedule_id FROM schedule WHERE scheduleDateTime = ?";
        $stmt = $mysqli->prepare($sql);
        if (!$stmt) {
            throw new Exception("SQL error: " . $mysqli->error);
        }
        $stmt->bind_param("s", $_SESSION["date"]);
        $stmt->execute();
        $stmt->bind_result($schedule_id);
        $stmt->fetch();
        $stmt->close();

        // Update schedule table
        $sql = "UPDATE schedule SET status = 'Not Available' WHERE schedule_id = ?";
        $stmt = $mysqli->prepare($sql);
        if (!$stmt) {
            throw new Exception("SQL error: " . $mysqli->error);
        }
        $stmt->bind_param("i", $schedule_id);
        $stmt->execute();
        $stmt->close();

        // Insert into appointment table
        $sql = "INSERT INTO appointment (patient_id, service_id, schedule_id) VALUES (?, ?, ?)";
        $stmt = $mysqli->prepare($sql);
        if (!$stmt) {
            throw new Exception("SQL error: " . $mysqli->error);
        }
        $stmt->bind_param("iii", $patient_id, $_SESSION["apptype"], $schedule_id);
        $stmt->execute();
        $appointment_id = $mysqli->insert_id;
        $stmt->close();


        // Insert into chief_complaint table
        $sql = "INSERT INTO chief_complaint (chief_complaint, details, dentalpain_status, dental_trauma, bleeding_tissues) VALUES (?, ?, ?, ?, ?)";
        $stmt = $mysqli->prepare($sql);
        if (!$stmt) {
            throw new Exception("SQL error: " . $mysqli->error);
        }
        $stmt->bind_param("sssss", $_SESSION["complaint"], $_SESSION["details"], $_SESSION["dentalpain"], $_SESSION["dentaltrauma"], $_SESSION["bleedingtissues"]);
        $stmt->execute();
        $chief_complaint_id = $mysqli->insert_id;
        $stmt->close();

        // Insert into patient_pain_level table
        $sql = "INSERT INTO patient_pain_level (pain_level_id, Chief_Complaint_ID) VALUES (?,?)";
        $stmt = $mysqli->prepare($sql);
        if (!$stmt) {
            throw new Exception("SQL error: " . $mysqli->error);
        }
        $stmt->bind_param("ii", $_SESSION["painlevel"], $chief_complaint_id);
        $stmt->execute();
        $stmt->close();

        $sql = "INSERT INTO medical_history (diabetes, heart_conditions, hypertension, maintenance, systolic_pressure, diastolic_pressure, medical_conditions) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $mysqli->prepare($sql);

        $stmt->bind_param("sssssss", $_SESSION["diabetes"], $_SESSION["heartconditions"], $_SESSION["hypertension"], $_SESSION["maintenance"], $_SESSION["systolicpressure"], $_SESSION["diastolicpressure"], $_SESSION["medicalconditions"]);
        $stmt->execute();
        $medical_history_id = $stmt->insert_id; // Retrieve the medical_history_id value
        $stmt->close();

        // Insert allergen data into the patient_medical_allergens table
        $stmt = $mysqli->prepare("INSERT INTO patient_medical_allergens (med_allergen_id, medical_history_id) VALUES (?, ?)");


        // Loop through the $_SESSION["medallergen"] array and execute an INSERT statement for each value
        foreach ($_SESSION["medallergen"] as $value) {
            $stmt->bind_param("ii", $value, $medical_history_id);
            $stmt->execute();
        }
        $stmt->close();

        // Insert into health_declaration table
        $sql = "INSERT INTO health_declaration (covidvaccine_status) VALUES (?)";
        $stmt = $mysqli->prepare($sql);
        if (!$stmt) {
            throw new Exception("SQL error: " . $mysqli->error);
        }
        $stmt->bind_param("s", $_SESSION["covid"]);
        $stmt->execute();
        $health_declaration_id = $mysqli->insert_id;
        $stmt->close();

        // Insert into patient_health_declaration table
        $sql = "INSERT INTO patient_health_symptoms (health_declaration_id, healthsymptoms_id) VALUES (?, ?)";
        $stmt = $mysqli->prepare($sql);

        foreach ($_SESSION["symptoms"] as $sympvalue) {
            $stmt->bind_param("ii", $health_declaration_id, $sympvalue);
            $stmt->execute();
        }
        $stmt->close();

        // Insert into payment table
        $sql = "INSERT INTO payment ( referenceno, proofofpayment) VALUES ( ?, ?)";
        $stmt = $mysqli->prepare($sql);
   
        $stmt->bind_param("ss", $_SESSION["referenceNo"], $Image);
        $stmt->execute();
        $payment_id = $mysqli->insert_id;
        $stmt->close();

        // Insert into record table
        $sql = "INSERT INTO record (Appointment_ID, Chief_Complaint_ID, Medical_History_ID, Health_Declaration_ID, 	PaymentDetails_ID) VALUES (?, ?,?,?,?)";
        $stmt = $mysqli->prepare($sql);
   
        $stmt->bind_param("iiiii", $appointment_id, $chief_complaint_id, $medical_history_id, $health_declaration_id, $payment_id);
        $stmt->execute();
        $stmt->close();

        // Commit transaction
        $mysqli->commit();
    } catch (Exception $e) {
        $mysqli->rollback();
        die("Transaction failed: " . $e->getMessage());
    }

    header('Location: ../appconfirm.php');

    $mysqli->close();
}
