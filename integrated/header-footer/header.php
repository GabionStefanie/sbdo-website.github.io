<?php
// Start the session
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="header-footer.css">
</head>

<body>
    <div class="wrapper-header-footer">
        <header>
            <img class="header-logo" src="../header-footer/images/sbdo-logo.jpeg" alt="sulit and bagasan dental office logo" />
            <div class="company_name">Sulit & Bagasan Dental Office</div>
            <nav>
                <ul class="nav_links">
                    <li class="nav__item">
                        <a class="nav__link" href="../static-home-page/index.php">Home</a>
                    </li>
                    <li class="nav__item">
                        <a class="nav__link" href="../static-about-us-page/about.php">About Us</a>
                    </li>
                    <li class="nav__item">
                        <a class="nav__link" href="../static-services-page/services.php">Services</a>
                    </li>
                    <li class="nav__item">
                        <a class="nav__link" href="../appointment-form/contact-us.php">Contact Us</a>
                    </li>
                    <li class="nav__item">
                        <?php
                        $conn = new mysqli("localhost", "root", "", "sbdoDatabase");
                        if (isset($_COOKIE["User_ID"])) {
                            $UserID = $_COOKIE['User_ID'];
                            $sql = "SELECT Account_Type 
                                    FROM account
                                    WHERE User_ID = '$UserID' ";
                            $result = mysqli_fetch_assoc(mysqli_query($conn, $sql));
                            // $Account_Type = $result['Account_Type'];
                            $Account_Type = $_COOKIE['User_Type'];

                            if ($Account_Type === 'Patient') { ?>
                                <a href="../acc-dashboard/account-dashboard-page.php" class="nav__link">
                                    <div class="profile-frame"></div>
                                </a>
                            <?php
                            return;
                            } elseif ($Account_Type === 'Admin') { ?>
                                <a href="../admin-reports/admin--reports [clients]-page.php" class="nav__link">
                                    <div class="profile-frame"></div>
                                </a>
                            <?php
                            }
                        } else { ?>
                            <a href="../login-forgot-password/login.php" class="nav__link">
                                <div class="profile-frame"></div>
                            </a>
                        <?php } ?>
                    </li>
                </ul>
            </nav>
        </header>
    </div>
</body>

</html>