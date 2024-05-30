<?php
$conn = new mysqli("localhost", "root", "", "sbdoDatabase");
if (isset($_COOKIE["User_ID"])) {
    $UserID = $_COOKIE['User_ID'];
    $sql = "SELECT Account_Type, ProfilePicture 
            FROM account
            WHERE User_ID = '$UserID' ";
    $result = mysqli_fetch_assoc(mysqli_query($conn, $sql));

    $picture = $result['ProfilePicture'];


    $Account_Type = $result['Account_Type'];
    // $profilePicture = "<img src='$picture' alt='Profile Picture'>";

} else {
    $Account_Type = null;
}
$conn->close();

$profileframe = "";

if ($Account_Type === 'Patient') {
    $profileframe = '<a href="../My Account/account-dashboard.php" class="nav__link accButton">Account</a>';
} elseif ($Account_Type === 'Admin') {
    $profileframe = '<a href="../admin-reports/account-dashboard.php" class="nav__link accButton">Account</a>';
} else {
    $profileframe = '<a href="../Login/login.php" class="nav__link accButton">Login</a>';
}
echo $profileframe;