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

$insertSchedule = "INSERT INTO SCHEDULE (scheduleDate, scheduleTime,`Status`)
VALUES 
('2024-05-30', '8:00 AM - 9:00 AM', 'Available'),
('2024-05-30', '9:00 AM - 10:00 AM', 'Available'), 
('2024-05-30', '10:00 AM - 11:00 AM', 'Available'),
('2024-05-30', '11:00 AM - 12:00 PM', 'Available'),
('2024-05-30', '1:00 PM - 2:00 PM', 'Available'),
('2024-05-30', '3:00 PM - 4:00 PM', 'Available'),
('2024-05-30', '4:00 PM - 5:00 PM', 'Available'),
('2024-05-31', '8:00 AM - 9:00 AM', 'Available'),
('2024-05-31', '9:00 AM - 10:00 AM', 'Available'), 
('2024-05-31', '10:00 AM - 11:00 AM', 'Available'),
('2024-05-31', '11:00 AM - 12:00 PM', 'Available'),
('2024-05-31', '1:00 PM - 2:00 PM', 'Available'),
('2024-05-31', '3:00 PM - 4:00 PM', 'Available'),
('2024-05-31', '4:00 PM - 5:00 PM', 'Available'),
('2024-05-01', '8:00 AM - 9:00 AM', 'Available'),
('2024-05-01', '9:00 AM - 10:00 AM', 'Available'), 
('2024-05-01', '10:00 AM - 11:00 AM', 'Available'),
('2024-05-01', '11:00 AM - 12:00 PM', 'Available'),
('2024-05-01', '1:00 PM - 2:00 PM', 'Available'),
('2024-05-01', '3:00 PM - 4:00 PM', 'Available'),
('2024-05-01', '4:00 PM - 5:00 PM', 'Available'),
('2024-05-02', '8:00 AM - 9:00 AM', 'Available'),
('2024-05-02', '9:00 AM - 10:00 AM', 'Available'), 
('2024-05-02', '10:00 AM - 11:00 AM', 'Available'),
('2024-05-02', '11:00 AM - 12:00 PM', 'Available'),
('2024-05-02', '1:00 PM - 2:00 PM', 'Available'),
('2024-05-02', '3:00 PM - 4:00 PM', 'Available'),
('2024-05-02', '4:00 PM - 5:00 PM', 'Available');";

$insertAccount = "INSERT INTO `ACCOUNT` (`Username`, `Password`, `Email`, `Account_Type`)
VALUES
      ('Arvie', 'arviearvie', 'sgabion.k12148528@umak.edu.ph', 'Admin');";

mysqli_query($conn, $insertHealthSymptoms);
mysqli_query($conn, $insertPainLevelList);
mysqli_query($conn, $insertMedAllergenList);
mysqli_query($conn, $insertServiceList);
mysqli_query($conn, $insertSchedule);
mysqli_query($conn, $insertAccount);