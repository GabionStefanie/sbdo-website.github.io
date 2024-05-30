<?php
// $_SESSION["userID"] = 1;
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sbdoDatabase";

// Create a connection to the database
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check the connection
if (!$conn) {
	die("Connection failed: " . mysqli_connect_error());
}

$_SESSION['userID'] = 1;

// Prepare SQL statement to fetch the user data
$sql = "SELECT * FROM ACCOUNT WHERE User_ID = ?";
$stmt = $conn->prepare($sql);
if (!$stmt) {
	die("Preparation failed: " . $conn->error);
}

// Bind the user ID to the SQL statement
$stmt->bind_param("i", $_SESSION["userID"]);
$stmt->execute();

// Get the result
$result = $stmt->get_result();

// Check if the user exists
if ($result->num_rows == 1) {
	// Fetch the user data and assign it to $user
	$user = $result->fetch_assoc();
} else {
	echo 'No user found'; // Debug line
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us | Sulit & Bagasan Dental Office</title>
    <link rel="stylesheet" type="text/css" href="css/transactions-css.css">
    <script src="jscript/transactions-jscript.js"></script>
    <style>
        <?php include '../header-footer/header-footer.css'; ?>
    </style>
</head>
<body>
    <div class="wrapper">
        <?php include '../header-footer/header.php'; ?>
        <div class="profile-container">
            <div class="profile-info">
                <div class="profile-picture">
						<p class="profile-label"></p>
						<?php
						if (isset($user["ProfilePicture"])) {
							$profilePicture = $user["ProfilePicture"];
							if (file_exists($profilePicture) && is_readable($profilePicture)) {
								echo "<img src='$profilePicture' alt='Profile Picture'>";
							} else {
								echo "The image file does not exist or is not readable";
							}
						} else {
							echo "Profile picture not set";						}
					?>
				</div>
                <div class="profile-details">
					<p class="profile-name"><b>USERNAME:</b> <?php echo $user["Username"]; ?></p>
					<p class="profile-email"><b>EMAIL:</b> <?php echo $user["Email"]; ?></p>
					<a href="#" class="btn btn-primary edit-profile" onclick="showChangeProfilePictureModal()">Change profile picture</a>
				</div>
            </div>
            <div class="divider"></div>
            <div class="row">
                <div class="buttons-transac-appoint">
                    <a href="transactions-page.php" class="btn btn-primary">TRANSACTION</a>
                    <a href="upcoming-announcements-page.php" class="btn btn-primary">APPOINTMENTS</a>
                </div>
            </div>
        </div>
        <div id="overlay" class="overlay"></div>
        <div id="modalChangeProfilePicture" class="modal">
            <span class="close-btn2" onclick="closeModal()">X</span>
            <div class="container">
                <div class="change-profile-picture-modal">
                    <h2>CHANGE PROFILE PICTURE</h2>
                </div>
                <form id="formChangeProfilePicture" onsubmit="submitProfilePicture(event)" method="POST" enctype="multipart/form-data" action="uploadPFPs.php"">
                    <label for="profilePicture">Please upload your new profile picture:</label>
                    <input type="file" id="profilePicture" name="profilePicture" accept="image/*" required><br>
                    <input type="submit" value="UPLOAD">
                </form>
            </div>
        </div>
        <div class="transac-history">
            <p>TRANSACTION HISTORY</p>
            <div class="line1"></div>
           <!--<div class="sort">
            <button class="sortByMonth" onclick="sortTableByMonth()">SORT BY MONTH</button>
                <button class="sortByStatus" onclick="sortTableByStatus()">SORT BY STATUS</button>
            </div>-->
            <div class="table-container">
                 <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "sbdoDatabase";

    $mysqli = new mysqli($servername, $username, $password, $dbname);

    if(isset($_COOKIE["User_ID"])) {
        $userid = $_COOKIE["User_ID"];
        
    } 
    

    $sql = "SELECT a.appointment_id,  pd.paymentdetails_id,  sc.scheduleDate, sc.scheduleTime, s.service_name,  pd.amount, pd.image_filename, a.appointment_id, p.patient_status
    FROM account ac
    JOIN patient p ON ac.user_id = p.user_id
    JOIN appointment a ON p.patient_id = a.appointment_id
    JOIN service s ON a.service_id = s.service_id
    JOIN chief_complaint cc ON a.appointment_id = cc.chief_complaint_id
    JOIN medical_history mh ON a.appointment_id = mh.medical_history_id
    JOIN health_declaration hd ON a.appointment_id = hd.health_declaration_id
    JOIN patient_medical_allergens pma ON a.appointment_id = pma.medical_history_id
    JOIN medical_allergens_list ma ON pma.med_allergen_id = ma.med_allergen_id
    JOIN patient_health_symptoms phs ON a.appointment_id = phs.health_declaration_id
    JOIN health_symptoms hs ON phs.healthsymptoms_id = hs.healthsymptoms_id
    JOIN patient_pain_level ppl ON a.appointment_id = ppl.chief_complaint_id
    JOIN pain_level_list pll ON ppl.pain_level_id = pll.pain_level_id
    LEFT JOIN payment pd ON a.appointment_id = pd.paymentDetails_ID
    LEFT JOIN schedule sc ON a.schedule_id = sc.schedule_id 
    where p.user_id = $userid
    GROUP BY p.patient_id
    ORDER BY sc.scheduleDate";
    
    $result = $mysqli->query($sql);
    while($row = $result->fetch_assoc()) {
        $id = uniqid();

        $scheduleDate = $row['scheduleDate'];
        $scheduleTime = $row['scheduleTime'];

        // Combine and format date and time
        $datetime = new DateTime("$scheduleDate $scheduleTime");
        $formattedDatetime = $datetime->format('m/d/Y h:i A');
        ?>
                        <div>
                           
                            <div>
                            <table>
    <tr>
        <th>Appointment ID:</th>
        <th>Payment ID:</th>
        <th>Appointment Schedule:</th>
        <th>Service:</th>
        <th>Amount:</th>
        <th>Status:</th>
    </tr>
    <tr>
        <td><?php echo $row["appointment_id"]; ?></td>
        <td><?php echo $row["paymentdetails_id"]; ?></td>
        <td><?php echo $formattedDatetime; ?></td>
        <td><?php echo $row["service_name"]; ?></td>
        <td><?php echo $row["amount"]; ?></td>
        <td><?php echo $row["patient_status"]; ?></td>
    </tr>
</table>


                            </div>
                        </div>
                        <?php
                    }
                    $mysqli->close();
                    ?>
            </div>



        </div>
        <?php include '../header-footer/footer.php'; ?>
    </div>
    
</body>
</html>
