<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sbdoDatabase";

$conne = new mysqli($servername, $username, $password);

$createdb = "CREATE DATABASE IF NOT EXISTS sbdoDatabase";
mysqli_query($conne, $createdb);
$conne->close();

$conn = new mysqli($servername, $username, $password, $dbname);

$createPaymentTable = "CREATE TABLE IF NOT EXISTS PAYMENT (
        `PaymentDetails_ID` INT AUTO_INCREMENT,
        `ReferenceNo` INT (9) NOT NULL,
        `ProofOfPayment` BLOB NOT NULL,
        CONSTRAINT PK_PaymentDetailsID PRIMARY KEY (`PaymentDetails_ID`)
      )";
mysqli_query($conn, $createPaymentTable);

$createHealthDeclarationTable = "CREATE TABLE IF NOT EXISTS `HEALTH_DECLARATION` (
    `Health_Declaration_ID` INT AUTO_INCREMENT,
    `CovidVaccine_Status` VARCHAR (20) NOT NULL,
    CONSTRAINT PK_HealthDeclarationID PRIMARY KEY (`Health_Declaration_ID`)
)";
mysqli_query($conn, $createHealthDeclarationTable);

$createHealthSymptomsTable = "CREATE TABLE IF NOT EXISTS `HEALTH_SYMPTOMS` (
        `HealthSymptoms_ID` INT AUTO_INCREMENT NOT NULL,
        `Symptom_Name` VARCHAR (50) NOT NULL,
        CONSTRAINT PK_HealthSymptomsID PRIMARY KEY (`HealthSymptoms_ID`)
      )";
mysqli_query($conn, $createHealthSymptomsTable);

$createPxHealthSymptomsTable = "CREATE TABLE IF NOT EXISTS `PATIENT_HEALTH_SYMPTOMS` (
        `PatientHealthSymptoms_ID` INT AUTO_INCREMENT,
        `Health_Declaration_ID` INT,
        `HealthSymptoms_ID` INT,
        CONSTRAINT PK_PatientHealthSymptomsID PRIMARY KEY (`PatientHealthSymptoms_ID`),
        CONSTRAINT FK_HealthDeclarationID FOREIGN KEY (`Health_Declaration_ID`) REFERENCES `HEALTH_DECLARATION`(`Health_Declaration_ID`) ON UPDATE CASCADE ON DELETE SET NULL,
        CONSTRAINT FK_HealthSymptomsID FOREIGN KEY (`HealthSymptoms_ID`) REFERENCES `HEALTH_SYMPTOMS`(`HealthSymptoms_ID`) ON UPDATE CASCADE ON DELETE SET NULL
      )";
mysqli_query($conn, $createPxHealthSymptomsTable);

$createScheduleTable = "CREATE TABLE IF NOT EXISTS SCHEDULE (
  Schedule_ID INT AUTO_INCREMENT,
  scheduleDate DATE NOT NULL,
  scheduleTime VARCHAR (20) NOT NULL,
  Status VARCHAR (15) NOT NULL,
  CONSTRAINT PK_ScheduleID PRIMARY KEY (Schedule_ID),
  CONSTRAINT CHK_Status CHECK (Status IN ('Available', 'Not Available')));";
mysqli_query($conn, $createScheduleTable);

$createServiceTable = "CREATE TABLE IF NOT EXISTS `SERVICE` (
        `Service_ID` INT AUTO_INCREMENT,
        `Service_Name` VARCHAR (40) NOT NULL,
        CONSTRAINT PK_ServiceID PRIMARY KEY (`Service_ID`)
      )";
mysqli_query($conn, $createServiceTable);

$createChiefComplaintTable = "CREATE TABLE IF NOT EXISTS `CHIEF_COMPLAINT` (
        `Chief_Complaint_ID` INT AUTO_INCREMENT,
        `Chief_Complaint` VARCHAR (200) NOT NULL,
        `Details` TEXT NOT NULL,
        `DentalPain_Status` VARCHAR (100) NOT NULL,
        `Dental_Trauma` VARCHAR (10) NOT NULL,
        `Bleeding_Tissues` VARCHAR (10) NOT NULL,
        CONSTRAINT PK_ChiefComplaintID PRIMARY KEY (`Chief_Complaint_ID`)
      )";
mysqli_query($conn, $createChiefComplaintTable);

$createMedAllergenListTable = "CREATE TABLE IF NOT EXISTS `MEDICAL_ALLERGENS_LIST` (
        `Med_Allergen_ID` INT AUTO_INCREMENT,
        `Medicine_Name` VARCHAR (100) NOT NULL,
        CONSTRAINT PK_MedAllergenID PRIMARY KEY (`Med_Allergen_ID`)
      )";
mysqli_query($conn, $createMedAllergenListTable);

$createMedHistoryTable = "CREATE TABLE IF NOT EXISTS `MEDICAL_HISTORY` (
        `Medical_History_ID` INT AUTO_INCREMENT,
        `Diabetes` VARCHAR (10) NOT NULL,
        `Heart_Conditions` VARCHAR (40) NOT NULL,
        `Hypertension` VARCHAR (10) NOT NULL,
        `Maintenance` VARCHAR (40) NOT NULL,
        `Systolic_Pressure` VARCHAR (10) NOT NULL,
        `Diastolic_Pressure` VARCHAR (10) NOT NULL,
        `Medical_Conditions` VARCHAR (50) NOT NULL,
        CONSTRAINT PK_MedHistoryID PRIMARY KEY (`Medical_History_ID`)
      )";
mysqli_query($conn, $createMedHistoryTable);

$createPxMedAllergensTable = "CREATE TABLE IF NOT EXISTS `PATIENT_MEDICAL_ALLERGENS` (
        `PatientAllergen_ID` INT AUTO_INCREMENT,
        `Medical_History_ID` INT,
        `Med_Allergen_ID` INT,
        CONSTRAINT PK_PatientAllergenID PRIMARY KEY (`PatientAllergen_ID`),
        CONSTRAINT FK_MedAllergenID FOREIGN KEY (`Med_Allergen_ID`) REFERENCES `MEDICAL_ALLERGENS_LIST`(`Med_Allergen_ID`) ON UPDATE CASCADE ON DELETE SET NULL,
        CONSTRAINT FK_MedHistoryID FOREIGN KEY (`Medical_History_ID`) REFERENCES `MEDICAL_HISTORY`(`Medical_History_ID`) ON UPDATE CASCADE ON DELETE SET NULL
      )";
mysqli_query($conn, $createPxMedAllergensTable);

$createPainLevelTable = "CREATE TABLE IF NOT EXISTS `PAIN_LEVEL_LIST` (
        `Pain_Level_ID` INT AUTO_INCREMENT,
        `Pain_Value` VARCHAR (50)  NOT NULL,
        CONSTRAINT PK_PainLevelID PRIMARY KEY (`Pain_Level_ID`)
      )";
mysqli_query($conn, $createPainLevelTable);

$createPxPainLevelTable = "CREATE TABLE IF NOT EXISTS `PATIENT_PAIN_LEVEL` (
        `PatientPainLevel_ID` INT AUTO_INCREMENT,
        `Chief_Complaint_ID` INT,
        `Pain_Level_ID` INT,
        CONSTRAINT PK_PatientPainLevelID PRIMARY KEY (`PatientPainLevel_ID`),
        CONSTRAINT FK_ChiefComplaintID FOREIGN KEY (`Chief_Complaint_ID`) REFERENCES `CHIEF_COMPLAINT`(`Chief_Complaint_ID`) ON UPDATE CASCADE ON DELETE SET NULL,
        CONSTRAINT FK_PainLevelID FOREIGN KEY (`Pain_Level_ID`) REFERENCES `PAIN_LEVEL_LIST`(`Pain_Level_ID`) ON UPDATE CASCADE ON DELETE RESTRICT
      )";
mysqli_query($conn, $createPxPainLevelTable);

$createAccountTable = "CREATE TABLE IF NOT EXISTS `ACCOUNT` (
        `User_ID` INT AUTO_INCREMENT,
        `Username` VARCHAR (20) NOT NULL,
        `Password` VARCHAR (25) NOT NULL,
        `Email` VARCHAR (30) NOT NULL,
        `ProfilePicture` BLOB NOT NULL,
        `Account_Type` VARCHAR (10) NOT NULL,
        CONSTRAINT PK_UserPatientID PRIMARY KEY (`User_ID`)
      )";
mysqli_query($conn, $createAccountTable);

$createPatientTable = "CREATE TABLE IF NOT EXISTS `PATIENT` (
        `Patient_ID` INT AUTO_INCREMENT,
        `User_ID` INT,
        `Name` VARCHAR (30) NOT NULL,
        `Phone` VARCHAR (11) NOT NULL,
        `Email` VARCHAR (30) NOT NULL,
        `Gender` VARCHAR (5) NOT NULL,
        `Patient_Status` VARCHAR (10) NOT NULL,
        CONSTRAINT PK_PatientID PRIMARY KEY (`Patient_ID`),
        CONSTRAINT FK_UserID FOREIGN KEY (`User_ID`) REFERENCES `ACCOUNT`(`User_ID`) ON UPDATE CASCADE ON DELETE SET NULL
      )";
mysqli_query($conn, $createPatientTable);

$createReviewsTable = "CREATE TABLE IF NOT EXISTS `REVIEWS` (
        `Review_ID` INT AUTO_INCREMENT,
        `Review` TEXT NOT NULL,
        `Stars` INT NOT NULL,
        `User_ID` INT,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        CONSTRAINT PK_ReviewID PRIMARY KEY (`Review_ID`),
        CONSTRAINT FK_UserReviewID FOREIGN KEY (`User_ID`) REFERENCES `ACCOUNT`(`User_ID`) ON UPDATE CASCADE ON DELETE SET NULL
      )";
mysqli_query($conn, $createReviewsTable);

$createDentistTable = "CREATE TABLE IF NOT EXISTS `DENTIST` (
    `Dentist_ID` INT AUTO_INCREMENT,
    `User_ID` INT,
    `Dentist_Name` VARCHAR (20) NOT NULL,
    `Contact_No` VARCHAR (11) NOT NULL,
    CONSTRAINT PK_DentistID PRIMARY KEY (`Dentist_ID`),
    CONSTRAINT FK_UserDentistID FOREIGN KEY (`User_ID`) REFERENCES `ACCOUNT`(`User_ID`)  ON UPDATE CASCADE ON DELETE SET NULL
  )";
mysqli_query($conn, $createDentistTable);

$createAppointmentTable = "CREATE TABLE IF NOT EXISTS `APPOINTMENT` (
    `Appointment_ID` INT AUTO_INCREMENT,
    `Patient_ID` INT,
    `Dentist_ID` INT,
    `Service_ID` INT,
    `Schedule_ID` INT,
    `Appointment_Note` VARCHAR (50),
    `Time_Created` TIMESTAMP,
    CONSTRAINT PK_AppointmentID PRIMARY KEY (`Appointment_ID`),
    CONSTRAINT FK_ServiceAppointmentID FOREIGN KEY (`Service_ID`) REFERENCES `SERVICE`(`Service_ID`) ON UPDATE CASCADE ON DELETE RESTRICT,
    CONSTRAINT FK_PatientAppointmentID FOREIGN KEY (`Patient_ID`) REFERENCES `PATIENT`(`Patient_ID`) ON UPDATE CASCADE ON DELETE SET NULL,
    CONSTRAINT FK_DentistAppointmentID FOREIGN KEY (`Dentist_ID`) REFERENCES `DENTIST`(`Dentist_ID`) ON UPDATE CASCADE ON DELETE RESTRICT,
    CONSTRAINT FK_ScheduleAppointmentID FOREIGN KEY (`Schedule_ID`) REFERENCES `SCHEDULE`(`Schedule_ID`) ON UPDATE CASCADE ON DELETE RESTRICT
  )";
mysqli_query($conn, $createAppointmentTable);

$createRecordTable = "CREATE TABLE IF NOT EXISTS `RECORD` (
        `Record_ID` INT,
        `Appointment_ID` INT,
        `Chief_Complaint_ID` INT,
        `Medical_History_ID` INT,
        `Health_Declaration_ID` INT,
        `PaymentDetails_ID` INT,
        CONSTRAINT PK_RecordID PRIMARY KEY (`Record_ID`),
        CONSTRAINT FK_AppointmentRecordID FOREIGN KEY (`Appointment_ID`) REFERENCES `APPOINTMENT`(`Appointment_ID`) ON UPDATE CASCADE ON DELETE SET NULL,
        CONSTRAINT FK_ChiefComplaintRecordID FOREIGN KEY (`Chief_Complaint_ID`) REFERENCES `CHIEF_COMPLAINT`(`Chief_Complaint_ID`) ON UPDATE CASCADE ON DELETE RESTRICT,
        CONSTRAINT FK_MedHistoryRecordID FOREIGN KEY (`Medical_History_ID`) REFERENCES `MEDICAL_HISTORY`(`Medical_History_ID`) ON UPDATE CASCADE ON DELETE RESTRICT,
        CONSTRAINT FK_HealthDeclarationRecordID FOREIGN KEY (`Health_Declaration_ID`) REFERENCES `HEALTH_DECLARATION`(`Health_Declaration_ID`) ON UPDATE CASCADE ON DELETE RESTRICT,
        CONSTRAINT FK_PaymentDetailsRecordID FOREIGN KEY (`PaymentDetails_ID`) REFERENCES `PAYMENT`(`PaymentDetails_ID`) ON UPDATE CASCADE ON DELETE RESTRICT
      )";
mysqli_query($conn, $createRecordTable);

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

mysqli_query($conn, $insertHealthSymptoms);
mysqli_query($conn, $insertPainLevelList);
mysqli_query($conn, $insertMedAllergenList);
mysqli_query($conn, $insertServiceList);
mysqli_query($conn, $insertSchedule);

$conn->close();