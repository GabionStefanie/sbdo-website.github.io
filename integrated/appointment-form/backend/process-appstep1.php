<?php

if (empty($_POST["fname"])) {
    die("First name is required");
}

if (empty($_POST["lname"])) {
    die("Last name is required");
}

if (empty($_POST["pnum"])) {
    die("Phone number is required");
}

if (empty($_POST["email"])) {
    die("Email is required");
}

if ( ! filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
    die("Valid email is required");
}

if (empty($_POST["gender"])) {
    die("Gender is required");
}

if (empty($_POST["apptype"])) {
    die("Type of appointment is required");
}

if (empty($_POST["date"])) {
    die("Date is required");
}

$mysqli = new mysqli("localhost", "root", "", "sbdoDatabase");

$stmt = $mysqli->stmt_init();



session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Concatenate fname and lname
    $name = $_POST["fname"] . " " . $_POST["lname"];
    // Save form inputs in session
     // Get the selected apptype from the form
     $apptype = $_POST["apptype"];

     // Assign the label based on the selected apptype
     switch ($apptype) {
         case "1":
             $apptypeLabel = "Check Up";
             break;
         case "2":
             $apptypeLabel = "Surgery";
             break;
         case "3":
             $apptypeLabel = "Prophylaxis and Periodontics";
             break;
         case "4":
             $apptypeLabel = "Restorative";
             break;
         case "5":
             $apptypeLabel = "Prosthodontic";
             break;
         case "6":
             $apptypeLabel = "Removable Applicables";
             break;
         case "7":
             $apptypeLabel = "Orthodontics";
             break;
         case "8":
             $apptypeLabel = "Root Canal Treatment";
             break;
         case "9":
             $apptypeLabel = "Pediatric Dentistry";
             break;
         case "10":
             $apptypeLabel = "Bleaching";
             break;
         case "11":
             $apptypeLabel = "Retainers";
             break;
         default:
             $apptypeLabel = "";
             break;
     }

    $formatTime = date('g:i A', strtotime($_POST["time"]));

    $_SESSION["formattime"] = $formatTime;

    $_SESSION["apptypeLabel"] = $apptypeLabel;
    $_SESSION["name"] = $name;
    $_SESSION["pnum"] = $_POST["pnum"];
    $_SESSION["email"] = $_POST["email"];
    $_SESSION["gender"] = $_POST["gender"];
    $_SESSION["apptype"] = $_POST["apptype"];
    $_SESSION["date"] = $_POST["date"];
    $_SESSION["time"] = $_POST["time"];
    header('Location: ../appstep2.php');
}

$mysqli->close();