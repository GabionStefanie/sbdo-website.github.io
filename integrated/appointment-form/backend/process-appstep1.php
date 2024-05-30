<?php

if (empty($_POST["apptype"])) {
    header("Location: ../appstep1.php?error=Appointment type is required");

    return;

}

else if (empty($_POST["date"])) {
    header("Location: ../appstep1.php?error=Enter a date");

    return;

}

else if (empty($_POST["time"])) {
    header("Location: ../appstep1.php?error=Enter a date");

    return;

}


$mysqli = new mysqli("localhost", "root", "", "sbdoDatabase");

$stmt = $mysqli->stmt_init();



session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
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

    $_SESSION["apptypeLabel"] = $apptypeLabel;
    $_SESSION["apptype"] = $_POST["apptype"];
    $_SESSION["date"] = $_POST["date"];
    $_SESSION["time"] = $_POST["time"];
    header('Location: ../appstep2.php');
}

$mysqli->close();
