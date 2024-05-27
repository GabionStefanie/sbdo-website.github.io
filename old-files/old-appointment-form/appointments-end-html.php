<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointment | Sulit & Bagasan Dental Office</title>
    <link rel="stylesheet" type="text/css" href="appointments-end-css.css">
    <style>
        <?php include '../header-footer/header-footer.css' ?>
    </style>
</head>

<body>
    <div class="wrapper">
        <?php include '../header-footer/header.php' ?>
        <div class="APPOINTMENT-FORM-title">
            <p>APPOINTMENT FORM</p>
        </div>

        <div class="table-container">
            <div class="table-appointment-form">
                <table>
                    <tbody>
                        <tr>
                            <td><strong>NAME:</strong></td>
                            <td>Surname, FirstName</td>
                        </tr>
                        <tr>
                            <td><strong>PHONE:</strong></td>
                            <td>Phone Number</td>
                        </tr>
                        <tr>
                            <td><strong>EMAIL:</strong></td>
                            <td>Email Address</td>
                        </tr>
                        <tr>
                            <td><strong>TYPE OF APPOINTMENT:</strong></td>
                            <td>Appointment selected</td>
                        </tr>
                        <tr>
                            <td><strong>DATE AND TIME</strong></td>
                            <td>Date and time selected</td>
                        </tr>
                    </tbody>
                </table>

            </div>

            <div class="button-container">
                <input type="submit" name="confirmAppointment" value="CONFIRM APPOINTMENT" />
                <input type="submit" name="cancelAppointment" value="CANCEL APPOINTMENT" />
            </div>
        </div>
        <?php include '../header-footer/footer.php' ?>
    </div>
</body>

</html>