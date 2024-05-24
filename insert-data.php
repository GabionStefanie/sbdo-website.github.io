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

$insertSchedule = "INSERT INTO SCHEDULE (scheduleDate,`Status`)
VALUES 
('2024-05-30 8:00', 'Available'),
('2024-05-31 8:00', 'Available'),
('2024-05-01 8:00', 'Available'),
('2024-05-02 8:00', 'Available');";

$insertAccount = "INSERT INTO `ACCOUNT` (`Username`, `Password`, `Email`, `Account_Type`)
VALUES
      ('Arvie', 'arviearvie', 'sgabion.k12148528@umak.edu.ph', 'Admin');";

$insertPatient = "INSERT INTO PATIENT (Name, email, phone) VALUES
('JohnDoe', 'john.doe@example.com', '123-456-7890'),
('JaneDoe', 'jane.doe@example.com', '098-765-4321');";

mysqli_query($conn, $insertHealthSymptoms);
mysqli_query($conn, $insertPainLevelList);
mysqli_query($conn, $insertMedAllergenList);
mysqli_query($conn, $insertServiceList);
mysqli_query($conn, $insertSchedule);
mysqli_query($conn, $insertAccount);
mysqli_query($conn, $insertPatient);
