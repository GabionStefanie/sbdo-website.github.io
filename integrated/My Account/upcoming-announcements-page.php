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
    <link rel="stylesheet" type="text/css" href="css/upcoming-announcements-css.css">
    <script src="jscript/upcoming-announcements-jscript.js"></script>
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
            <a href="#" class="btn btn-primary edit-profile" onclick="showChangeProfilePictureModal()">CHANGE</a>
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
            <!-- Close button -->
            <span class="close-btn2" onclick="closeModal()">X</span>
            <div class="container">
                <div class="change-profile-picture-modal">
                    <h2>CHANGE PROFILE PICTURE</h2>
                </div>
                <!-- Inside the "change-profile-picture-modal" div -->
                <form id="formChangeProfilePicture" onsubmit="submitProfilePicture(event)">
					<label for="profilePicture">Please upload your new profile picture:</label>
					<input type="file" id="profilePicture" name="profilePicture" accept="image/*" required><br>
					<input type="submit" value="UPLOAD">
				</form>
            </div>
        </div>
        <div class="upcoming-appointments">
            <p>UPCOMING APPOINTMENTS</p>
            <div class="line1"></div>
					
            <div class="resched-cancel-wrapper">
            <?php include 'upcoming-announcements-php.php'; ?>
                <div class="text-resched">You can only reschedule appointments 1 week before the appointment date.</div>
                <input type="submit" value="RESCHED" onclick="toggleModal('modal-container')">
                <div class="text-cancel">You can only cancel appointments 2 weeks before the appointment date.</div>
                <input type="submit" value="CANCEL" onclick="toggleModal('cancel-modal-container')">
            </div>
        </div>
        <div id="rescheduleModal" class="modal">
    <!-- Modal content for rescheduling -->
</div>

<div id="confirmationModal" class="modal">
    <!-- Modal content for canceling -->
</div>

		
		
        <?php include '../header-footer/footer.php'; ?>
    </body>
    </html>
