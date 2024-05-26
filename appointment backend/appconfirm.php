<!DOCTYPE html>
<html>
<head>
    <title>Confirm Appointment</title>
    <meta charset="UTF-8">
    <script src="https://unpkg.com/just-validate@latest/dist/just-validate.production.min.js" defer></script>
    <script src = "appconfirm-validation.js" defer></script>
    <style>
        .just-validate-error-label {
          margin-top: 5px;
          margin-left: 10px;
        }
        
        table {
            width: auto;
            border-collapse: collapse;
            color: black;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
        }
      </style>
</head>
<body>

    
    <h1>Appointment Form</h1>
    
    <form action="index.php" method="post" id="appconfirm" novalidate>
        
    <table>
            <tr>
                <th>Name:</th>
                <td><?php session_start(); echo $_SESSION["name"]; ?></td>
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

                

        <div>
    
        <button type="submit">Done</button>
        </div>
    </form>
</body>

</html>








