<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["referenceNo"])) {
        die("Reference No. is required");
    }

    if (empty($_FILES["proofOfPayment"])) {
        die("Proof of Payment required");
    }

    $mysqli = require __DIR__ . "/database.php";

    $_SESSION["referenceNo"] = $_POST["referenceNo"];
    $file = $_FILES['proofOfPayment'];

    $file_name = $file['name'];
    $file_tmp = $file['tmp_name'];
    $file_type = $file['type'];

    // Check if file is an image
    if (strpos($file_type, 'image') === false) {
        echo "<script>alert('File is not an image.');</script>";
        echo "<script>window.location.replace('payments-html.php');</script>";
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

         // Insert into appointment table
         $sql = "INSERT INTO appointment (patient_id, service_id, schedule_id) VALUES (?, ?, ?)";
         $stmt = $mysqli->prepare($sql);
         if (!$stmt) {
             throw new Exception("SQL error: " . $mysqli->error);
         }
         $stmt->bind_param("iii", $patient_id, $_SESSION["apptype"], $schedule_id);
         $stmt->execute();
         $stmt->close();

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


        // Insert into chief_complaint table
        $sql = "INSERT INTO chief_complaint (chief_complaint, details, dentalpain_status, dental_trauma, bleeding_tissues) VALUES (?, ?, ?, ?, ?)";
        $stmt = $mysqli->prepare($sql);
        if (!$stmt) {
            throw new Exception("SQL error: " . $mysqli->error);
        }
        $stmt->bind_param("sssss", $_SESSION["complaint"], $_SESSION["details"], $_SESSION["dentalpain"], $_SESSION["dentaltrauma"], $_SESSION["bleedingtissues"]);
        $stmt->execute();
        $stmt->close();

        // Insert into patient_pain_level table
        $sql = "INSERT INTO patient_pain_level (pain_level_id) VALUES (?)";
        $stmt = $mysqli->prepare($sql);
        if (!$stmt) {
            throw new Exception("SQL error: " . $mysqli->error);
        }
        $stmt->bind_param("i", $_SESSION["painlevel"]);
        $stmt->execute();
        $stmt->close();

        // Insert into medical_history table
        $sql = "INSERT INTO medical_history (diabetes, heart_conditions, hypertension, maintenance, systolic_pressure, diastolic_pressure, medical_conditions) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $mysqli->prepare($sql);
        if (!$stmt) {
            throw new Exception("SQL error: " . $mysqli->error);
        }
        $stmt->bind_param("sssssss", $_SESSION["diabetes"], $_SESSION["heartconditions"], $_SESSION["hypertension"], $_SESSION["maintenance"], $_SESSION["systolicpressure"], $_SESSION["diastolicpressure"], $_SESSION["medicalconditions"]);
        $stmt->execute();
        $stmt->close();

        // Insert into patient_medical_allergens table
        $sql = "INSERT INTO patient_medical_allergens (med_allergen_id) VALUES (?)";
        $stmt = $mysqli->prepare($sql);
        if (!$stmt) {
            throw new Exception("SQL error: " . $mysqli->error);
        }
        $stmt->bind_param("i", $_SESSION["medallergen"]);
        $stmt->execute();
        $stmt->close();

        // Insert into health_declaration table
        $sql = "INSERT INTO health_declaration (covidvaccine_status, healthsymptoms_id) VALUES (?, ?)";
        $stmt = $mysqli->prepare($sql);
        if (!$stmt) {
            throw new Exception("SQL error: " . $mysqli->error);
        }
        $stmt->bind_param("si", $_SESSION["covid"], $_SESSION["symptoms"]);
        $stmt->execute();
        $stmt->close();

        // Insert into payment table
        $sql = "INSERT INTO payment (referenceno, proofofpayment) VALUES (?, ?)";
        $stmt = $mysqli->prepare($sql);
        if (!$stmt) {
            throw new Exception("SQL error: " . $mysqli->error);
        }
        $stmt->bind_param("ss", $_SESSION["referenceNo"], $Image);
        $stmt->execute();
        $stmt->close();

        // Commit transaction
        $mysqli->commit();
    } catch (Exception $e) {
        $mysqli->rollback();
        die("Transaction failed: " . $e->getMessage());
    }

    header('Location: appconfirm.php');

    $mysqli->close();
}
?>
