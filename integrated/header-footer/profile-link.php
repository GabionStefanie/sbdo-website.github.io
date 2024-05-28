<?php
$conn = new mysqli("localhost", "root", "", "sbdoDatabase");
if (isset($_COOKIE["User_ID"])) {
    $UserID = $_COOKIE['User_ID'];
    $sql = "SELECT Account_Type 
            FROM account
            WHERE User_ID = '$UserID' ";
    $result = mysqli_fetch_assoc(mysqli_query($conn, $sql));


    $Account_Type = $result['Account_Type'];
} else {
    $Account_Type = null;
}
$conn->close();

$profileframe = "";
if ($Account_Type === 'Patient') {
    $profileframe = '<a href="../My Account/account-dashboard.php" class="nav__link"><div class="profile-frame"></div></a>';
} elseif ($Account_Type === 'Admin') {
    $profileframe = '<a href="../admin-reports/account-dashboard.php" class="nav__link"><div class="profile-frame"></div></a>';
} else {
    $profileframe = '<a href="../Login/login.php" class="nav__link"><div class="profile-frame"></div></a>';
}
echo $profileframe;

