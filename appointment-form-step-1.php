<!DOCTYPE html>
<html>
<head>
    <title>Appointment Form</title>
    <meta charset="UTF-8">
    <script src="https://unpkg.com/just-validate@latest/dist/just-validate.production.min.js" defer></script>
    <script src = "appstep1-validation.js" defer></script>
    <style>
        .just-validate-error-label {
          margin-top: 5px;
          margin-left: 10px;
        }
      </style>
</head>
<body>
    <h1>Appointment Form</h1>
    
    <form action="trial.php" method="post" id="appstep1" novalidate>
        
        <div style="display: flex;">
            <label>Name</label>
                <div style="display: flex;">
                    <div style="margin-right: 5px;">
                        <input type="text" id="fname" name="fname">

                    </div>

                    <div>
                    <input type="text" id="lname" name="lname">
                    </div>
                </div>
        </div>
        <div>
            <label for="pnum">Phone Number</label>
            <input type="text" id="pnum" name="pnum">
        </div>

        <div>
            <label for="email">Email Address</label>
            <input type="email" id="email" name="email">
        </div>
		
		<div>
            <label for="gender">Gender</label>
           <select id="gender" name="gender">
               <option value="" disabled selected>Select an option</option>
               <option value="Male">Male</option>
               <option value="Female">Female</option>
               <option value="Other">Other</option>
           </select>
           </div>   
        
        <div>
         <label for="apptype">Type of Appointment</label>
        <select id ="apptype" name="apptype">
            <option value="" disabled selected>Select an option</option>
            <option value="Check Up">Check Up</option>
            <option value="Surgery">Surgery</option>
            <option value="Prophylaxis and Periodontics">Prophylaxis and Periodontics</option>
            <option value="Restorative">Restorative</option>
            <option value="Prosthodontic">Prosthodontic</option>
            <option value="Removable Applicables">Removable Applicables</option>
            <option value="Orthodontics">Orthodontics</option>
            <option value="Root Canal Treatment">Root Canal Treatment</option>
            <option value="Pediatric Dentistry">Pediatric Dentistry</option>
            <option value="Bleaching">Bleaching </option>
            <option value="Retainers">Retainers </option>
        </select>
        </div>
        <div style="display: flex;">
                <label>Date:</label>
                <div style="display: flex;">
                    <div>
                        <select id="date" name="date">
                            <option value="" disabled selected>DD/MM/YYYY</option>
                            <!-- PHP code to fetch data from database -->
                            <?php
                            // require DIR . "/database.php";
                            // $query = "SELECT scheduleDate FROM schedule WHERE status = 'available'";
                            // $result = mysqli_query($conn, $query);
                            // while ($row = mysqli_fetch_assoc($result)) {
                            //     $scheduleDate= $row['scheduleDate'];
                            //     $formattedDate = date('d/m/y', strtotime($scheduleDate));
                            //     echo "<option value='$scheduleDate'>$formattedDate</option>";
                            // }
                            ?>
                        </select>
                        </div>
                </div>
                <div style = "display: flex;">
                <label>Time:</label>
                <div>
                    <div>
                        <select id="time" name="time">
                            <option value="" disabled selected>Select an option</option>
                            <!-- PHP code to fetch data from database -->
                            <?php
                            // require DIR . "/database.php";
                            // $query = "SELECT scheduleTime FROM schedule WHERE status = 'available'";
                            // $result = mysqli_query($conn, $query);
                            // while ($row = mysqli_fetch_assoc($result)) {
                            //     $scheduleTime = $row['scheduleTime'];
                            //     $formattedTime = date('g:i A', strtotime($scheduleTime));
                            //     echo "<option value='$scheduleTime'>$formattedTime</option>";
                            // }
                            ?>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div>
        <button type="submit">Next</button>
		<button type="reset">Reset</button>
        </div>
        
    </form>

    
</body>
</html>








