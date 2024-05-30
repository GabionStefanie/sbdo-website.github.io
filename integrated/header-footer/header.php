<?php
session_start(); ?>

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
                        <a class="nav__link" href="../appointment-form/appstep1.php">Contact Us</a>
                    </li>
					<li class="nav__item">
                        <?php if(isset($_SESSION['username'])) { ?>
                            <a class="nav__link" href="../logout.php">Logout</a>
                        <?php } ?>
                    </li>
                    <li class="nav__item">
                        <?php include 'profile-link.php'; ?>
                    </li>
                </ul>
            </nav>
        </header>
    </div>
</body>

</html>