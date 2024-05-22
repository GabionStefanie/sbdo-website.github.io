<?php
session_start();

// Echo session variables
echo "Name: " . $_SESSION["name"] . "<br>";
echo "Phone Number: " . $_SESSION["pnum"] . "<br>";
echo "Email Address: " . $_SESSION["email"] . "<br>";
echo "Gender: " . $_SESSION["gender"] . "<br>";
echo "Type of Appointment: " . $_SESSION["apptype"] . "<br>";
echo "Date: " . $_SESSION["date"] . "<br>";
echo "Time: " . $_SESSION["time"] . "<br>";