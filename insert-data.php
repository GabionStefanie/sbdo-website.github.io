<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sbdoDatabase";

$conn = new mysqli($servername, $username, $password, $dbname);

$insertHealthSymptoms = "INSERT INTO `HEALTH_SYMPTOMS` (`Symptom_Name`)
VALUES 
('Fever'), 
('Colds'),
('Cough'), 
('Sore Throat'),
('Headache'), 
('Diarrhea'),
('None')";

$insertPainLevelList = "INSERT INTO `PAIN_LEVEL_LIST` (`Pain_Value`)
VALUES 
('Hardly Notice the pain'), ('Notice the pain, but does not interfere with activities'),
('Notice the pain, sometimes distracts me'), ('Distracts me, but can do usual activities'),
('Pain interrupts some activities'), ('Hard to ignore, avoids usual activities'),
('Focus of attention, prevents doing daily activities'), ('Awful, hard to do anything'),
('Cannot bear the pain, unable to do anything'), ('As bad as it could be, nothing else matters')";

$insertMedAllergenList = "INSERT INTO `MEDICAL_ALLERGENS_LIST` (`Medicine_Name`)
VALUES 
('Mefenamic Acid'), ('Ibuprofen'),
('Aspirin'), ('Naproxen Sodium'),
('Paracetamol'), ('Amoxicillin/Other type of Penicillin'),
('Others'), ('None that I know of')";

$insertServiceList = "INSERT INTO `SERVICE` (`Service_Name`)
VALUES 
('Check Up'), ('Surgery'), ('Prophylaxis and Periodontics'), ('Restorative'),
('Prosthodontic'), ('Removable Applicables'), ('Orthodontics'), ('Root Canal Treatment'),
('Pediatric Dentistry'), ('Bleaching'), ('Emergency Treatment'), ('Retainers')";

$insertSchedule = "INSERT INTO SCHEDULE (scheduleDate, scheduleTime, `Status`)
VALUES 
('2024-05-31', '11:00', 'Available'),
('2024-05-31', '12:00', 'Available'),
('2024-05-31', '13:00', 'Available'),
('2024-05-31', '14:00', 'Available');";

      $password = "sulitandbagasan00";
      $password_hash = password_hash($password, PASSWORD_DEFAULT);


      $insertAccount = "INSERT INTO `ACCOUNT` (`Username`, `Password`, `Email`, `Account_Type`)
      VALUES
            ('sbdoAdminAcc', '$password_hash', 'sgabion.k12148528@umak.edu.ph', 'Admin');";

mysqli_query($conn, $insertHealthSymptoms);
mysqli_query($conn, $insertPainLevelList);
mysqli_query($conn, $insertMedAllergenList);
mysqli_query($conn, $insertServiceList);
mysqli_query($conn, $insertSchedule);
mysqli_query($conn, $insertAccount);