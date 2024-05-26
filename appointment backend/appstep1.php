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
    
    <form action="process-appstep1.php" method="post" id="appstep1" novalidate>
        
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
            <option value="1">Check Up</option>
            <option value="2">Surgery</option>
            <option value="3">Prophylaxis and Periodontics</option>
            <option value="4">Restorative</option>
            <option value="5">Prosthodontic</option>
            <option value="6">Removable Applicables</option>
            <option value="7">Orthodontics</option>
            <option value="8">Root Canal Treatment</option>
            <option value="9">Pediatric Dentistry</option>
            <option value="10">Bleaching </option>
            <option value="11">Retainers </option>
        </select>
        </div>

        <div style="display: flex;">
                <label>Date:</label>
                <div style="display: flex;">
                    <div>
                        <select id="date" name="date">
                            <option value="" disabled selected>Select schedule</option>
                            <!-- PHP code to fetch data from database -->
                            <?php
                            require __DIR__ . "/database.php";
                            $query = "SELECT scheduleDateTime FROM schedule WHERE status = 'available'";
                            $result = mysqli_query($conn, $query);
                            while ($row = mysqli_fetch_assoc($result)) {
                                $scheduleDate= $row['scheduleDateTime'];
                                echo "<option value='$scheduleDate'>$scheduleDate</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>
               
        </div>

        <div>
		<button type="reset">Reset</button>
        <button type="submit">Next</button>
        </div>
    </form>
</body>
</html>








