<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sbdoDatabase";
    // $UserID = $_POST['UserID'];
    // $UserID = 1;
    // uncomment for userID

if(isset($_POST['anonymous']) && isset($_POST['testimonial'])){
    $Anonymous = $_POST['anonymous'];
    $Testimony = $_POST['testimonial'];
    $Stars = $_POST['rating'];

    if($Anonymous == 'true'){
        $UserID = null; 
    }
    else{
        $UserID = 1; // dummy user id put session here
    }

    $conne = new mysqli($servername, $username, $password, $dbname);

    $TestimonialSQL = "INSERT INTO REVIEWS (User_ID, Stars, Review)
    VALUES('$UserID', '$Stars', '$Testimony')";
    $TestimonialQuery = $conne->query($TestimonialSQL);

    $conne->close();
}
?>