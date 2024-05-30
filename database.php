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
        `Amount` INT (10),
        `ReferenceNo` INT (9) NOT NULL,
        `ProofOfPayment` BLOB NOT NULL,
        `image_filename` VARCHAR (255) NOT NULL,
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
      );";
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
  scheduleTime TIME NOT NULL,
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
        `Username` VARCHAR (255) NOT NULL,
        `Password` VARCHAR (255) NOT NULL,
        `Name` VARCHAR (30) NOT NULL,
        `Phone` VARCHAR (11) NOT NULL,
        `Gender` VARCHAR (10) NOT NULL,
        `Email` VARCHAR (30) NOT NULL,
        `ProfilePicture` BLOB NOT NULL,
        `Account_Type` VARCHAR (10) NOT NULL,
        `account_activation_hash` VARCHAR (255), 
        `activation_expiry` DATETIME,
        CONSTRAINT PK_UserPatientID PRIMARY KEY (`User_ID`)
      )";
mysqli_query($conn, $createAccountTable);

$createPatientTable = "CREATE TABLE IF NOT EXISTS `PATIENT` (
        `Patient_ID` INT AUTO_INCREMENT,
        `User_ID` INT,
        `Patient_Status` VARCHAR (10) NOT NULL,
        CONSTRAINT PK_PatientID PRIMARY KEY (`Patient_ID`),
        CONSTRAINT FK_UserID FOREIGN KEY (`User_ID`) REFERENCES `ACCOUNT`(`User_ID`) ON UPDATE CASCADE ON DELETE SET NULL
      )";
mysqli_query($conn, $createPatientTable);

$createReviewsTable = "CREATE TABLE IF NOT EXISTS `REVIEWS` (
        `Review_ID` INT AUTO_INCREMENT,
        `Review` TEXT NOT NULL,
        `User_ID` INT,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        CONSTRAINT PK_ReviewID PRIMARY KEY (`Review_ID`),
        CONSTRAINT FK_UserReviewID FOREIGN KEY (`User_ID`) REFERENCES `ACCOUNT`(`User_ID`) ON UPDATE CASCADE ON DELETE SET NULL
      )";
mysqli_query($conn, $createReviewsTable);

$createAppointmentTable = "CREATE TABLE IF NOT EXISTS `APPOINTMENT` (
    `Appointment_ID` INT AUTO_INCREMENT,
    `Patient_ID` INT,
    `Service_ID` INT,
    `Schedule_ID` INT,
    `Appointment_Note` VARCHAR (50),
    `Time_Created` TIMESTAMP,
    CONSTRAINT PK_AppointmentID PRIMARY KEY (`Appointment_ID`),
    CONSTRAINT FK_ServiceAppointmentID FOREIGN KEY (`Service_ID`) REFERENCES `SERVICE`(`Service_ID`) ON UPDATE CASCADE ON DELETE RESTRICT,
    CONSTRAINT FK_PatientAppointmentID FOREIGN KEY (`Patient_ID`) REFERENCES `PATIENT`(`Patient_ID`) ON UPDATE CASCADE ON DELETE SET NULL,
    CONSTRAINT FK_ScheduleAppointmentID FOREIGN KEY (`Schedule_ID`) REFERENCES `SCHEDULE`(`Schedule_ID`) ON UPDATE CASCADE ON DELETE RESTRICT
  )";
mysqli_query($conn, $createAppointmentTable);

$createRecordTable = "CREATE TABLE IF NOT EXISTS `RECORD` (
        `Record_ID` INT AUTO_INCREMENT,
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

$conn->close();