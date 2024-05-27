<!DOCTYPE html>
<html>

<head>
    <title>Confirm Appointment</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="css/appconfirm-css.css" />
    <script src="https://unpkg.com/just-validate@latest/dist/just-validate.production.min.js" defer></script>
    <script src="jscript/appconfirm-validation.js" defer></script>
    <style>
        .just-validate-error-label {
            margin-top: 5px;
            margin-left: 10px;
        }


        <?php include '../header-footer/header-footer.css'; ?>
    </style>
</head>

<body>
    <div class="wrapper">
        <?php include '../header-footer/header.php' ?>

        <div class="APPOINTMENT-FORM-title">
            <p>Appointment Form</p>
        </div>


        <div class="APPOINTMENT-FORM-container">

            <form action="index.php" method="post" id="appconfirm" novalidate>

                <table>
                    <tr>
                        <th>Name:</th>
                        <td><?php session_start();
                            echo $_SESSION["name"]; ?></td>
                    </tr>
                    <tr>
                        <th>Phone:</th>
                        <td><?php echo $_SESSION["pnum"]; ?></td>
                    </tr>
                    <tr>
                        <th>Email:</th>
                        <td><?php echo $_SESSION["email"]; ?></td>
                    </tr>
                    <tr>
                        <th>Type of Appointment:</th>
                        <td><?php echo $_SESSION["apptypeLabel"]; ?></td>
                    </tr>
                    <tr>
                        <th>Date and Time:</th>
                        <td><?php echo $_SESSION["date"]; ?></td>
                    </tr>
                </table>


                <div class="center button">
                    <div class="button-group">
                        <button type="button">Reject</button>
                        <button type="submit">Confirm</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
        <footer>
            <?php include "../header-footer/footer.php"; ?>
        </footer>

</body>

</html>