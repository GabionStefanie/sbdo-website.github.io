<html>
<?php 
include  '../header-footer/header.php'; ?>
<style>
	<?php include '../header-footer/header-footer.css' ?>
</style>

</html>

<?php
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

// Prepare SQL statement to fetch the user data
$sql = "SELECT * FROM ACCOUNT WHERE User_ID = ?";
$stmt = $conn->prepare($sql);
if (!$stmt) {
	die("Preparation failed: " . $conn->error);
}

// Bind the user ID to the SQL statement
$stmt->bind_param("i", $_COOKIE["User_ID"]);
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
	<link rel="stylesheet" type="text/css" href="css/account-dashboard-css.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

</head>

<body>
	<div class="wrapper">

		<main>
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
							echo "Profile picture not set";
						}
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
						<a href="transactions-html.html" class="btn btn-primary">TRANSACTION</a>
						<a href="upcoming-announcements-html.html" class="btn btn-primary">APPOINTMENTS</a>
					</div>
				</div>
			</div>
			<div id="modalChangeProfilePicture" class="modal">
				<!-- Close button -->
				<span class="close-btn2" onclick="closeModal()">X</span>
				<div class="container">
					<div class="change-profile-picture-modal">
						<h2>CHANGE PROFILE PICTURE</h2>
					</div>
					<!-- Inside the "change-profile-picture-modal" div -->
					<form id="formChangeProfilePicture" onsubmit="submitProfilePicture(event)" method="POST" enctype="multipart/form-data" action="myaccounts.php">
						<label for="profilePicture">Please upload your new profile picture:</label>
						<input type="file" id="profilePicture" name="profilePicture" accept="image/*" required><br>
						<input type="hidden" name="formName" value="uploadForm">
						<input type="submit" value="Upload">
					</form>
				</div>
			</div>
			<div class="settings-title">
				<P>ACCOUNT SETTINGS</P>
				<img src="images/settings-photo.png" alt="settings-icon">
			</div>
			<div class="content3">
				<div id="content" class="content">
					<div class="account-settings">
						<div class="settings-title2">
							<P>ACCOUNT SETTINGS</P>
							<img src="images/settings-photo.png" alt="settings-icon">
						</div>
						<div class="datas">
							<ul>
								<li>
									<p class="username">Username: <?php echo $user["Username"]; ?></p>
									<button onclick="showModal('username')">Change</button>
								</li>
								<li>

									<div class="password">
										<div>Password: <input type="password" readonly id = "showPassword" value="<?php echo $user["Password"] ?>"></div>
									</div>

									<button onclick="showModal('password')">Change</button>
								</li>
								<li>
									<p class="emailadd">Email Address: <?php echo $user["Email"]; ?></p>
									<button onclick="showModal('email')">Change</button>
								</li>
							</ul>
						</div>
						
							<button type="button" class="logout-button" id = "logout">LOGOUT </button>
					</div>
				</div>
				<!-- Overlay -->
				<div id="overlay" class="overlay"></div>
				<!-- Modal for changing username -->
				<div id="modalUsername" class="modal">
					<!-- Close button -->
					<span class="close-btn" onclick="closeModal()">X</span>
					<div class="container">
						<div class="username-modal">
							<h2>CHANGE USERNAME</h2>
						</div>
						<form id="formUsername" onsubmit="submitUsername(event)">
							<label for="oldUsername">Old Username:</label>
							<input type="text" id="oldUsername" name="oldUsername" required>
							<label for="newUsername">New Username:</label>
							<input type="text" id="newUsername" name="newUsername" required>
							<label for="confirmNewUsername">Confirm New Username:</label>
							<input type="text" id="confirmNewUsername" name="confirmNewUsername" required>
							<div class="text-24hrs">It may take 24 hours for changes to take effect. <br>You will need to login with your new username.</div>
							<div id="messageChangeUsername"></div>
							<input type="submit" value="SUBMIT">
						</form>
					</div>
				</div>
				<!-- Modal for additional content - Username -->
				<div id="modalAdditionalUsername" class="modal">
					<!-- Close button -->
					<span class="close-btn" onclick="closeModal()">X</span>
					<div class="container5">
						<div class="additional-modal">
							<h2>CHANGE USERNAME</h2>
							<p>Please check your email address for the required OTP to verify your new username.
								The OTP is only available for 10 minutes.
							</p>
							<form id="formOTPUsername" onsubmit="submitOTPUsername(event)">
								<label for="otpUsername">OTP</label>
								<input type="text" id="otpUsername" name="otpUsername" required>
								<div id="otpUsernameMessage" style="color: red; font-size: 14px;"></div>
								<input type="button" value="RESEND OTP" onclick="resendOTP(event)">
								<input type="submit" value="SUBMIT">
							</form>
						</div>
					</div>
				</div>
				<!-- Modal for changing password -->
				<div id="modalPassword" class="modal">
					<!-- Close button -->
					<span class="close-btn" onclick="closeModal()">X</span>
					<div class="container">
						<div class="password-modal">
							<h2>CHANGE PASSWORD</h2>
						</div>
						<form id="formPassword" onsubmit="submitPassword(event)">
							<label for="oldPassword">Old Password:</label>
							<input type="password" name="oldPassword" required>
							<label for="newPassword">New Password:</label>
							<input type="password" name="newPassword" required>
							<label for="confirmNewPassword">Confirm New Password:</label>
							<input type="password" name="confirmNewPassword" required>
							<div class="text-24hrs">It may take 24 hours for changes to take effect. <br>You will need to login with your new password.</div>
							<span class="forgot-password" onclick="showForgotPasswordModal()">Forgot Password?</span>
							<BR>
							<input type="submit" value="SUBMIT">
						</form>
					</div>
				</div>
				<!-- Modal for forgot password -->
				<div id="modalForgotPassword" class="modal">
					<!-- Close button -->
					<span class="close-btn" onclick="closeModal()">X</span>
					<div class="container">
						<div class="forgot-password-modal">
							<h2>RESET PASSWORD</h2>
							<form id="forgotPasswordForm" onsubmit="submitForgotPassword(event)">
								<label for="forgotPasswordEmail">Email Address:</label>
								<input type="email" id="forgotPasswordEmail" name="forgotPasswordEmail" required>
								<input type="submit" value="SUBMIT">
							</form>
						</div>
					</div>
				</div>
				<!-- Modal for resetting password -->
				<div id="modalResetPassword" class="modal">
					<!-- Close button -->
					<span class="close-btn" onclick="closeModal()">X</span>
					<div class="container">
						<div class="reset-password-modal">
							<h2>CHANGE PASSWORD</h2>
							<p>Please check your email address for the required OTP to verify your new password.
								The OTP is only available for 10 minutes.
							</p>
							<form id="resetPasswordForm" onsubmit="submitResetPassword(event)">
								<label for="otpResetPassword">OTP:</label>
								<input type="text" id="otpResetPassword" name="otpResetPassword" required> <!-- Changed ID and name -->
								<label for="newPassword">New Password:</label>
								<input type="password" name="newPassword" required> <!-- Changed ID and name -->
								<label for="confirmNewPassword">Confirm New Password:</label>
								<input type="password" name="confirmNewPassword" required> <!-- Changed ID and name -->
								<div id="Forgotmessage" style="color: red; font-size: 14px;"></div>
								<input type="submit" value="SUBMIT">
							</form>
						</div>
					</div>
				</div>
				<!-- Modal for changing email address -->
				<div id="modalEmail" class="modal">
					<!-- Close button -->
					<span class="close-btn" onclick="closeModal()">X</span>
					<div class="container">
						<div class="email-modal">
							<h2>CHANGE EMAIL ADDRESS</h2>
						</div>
						<form id="formEmail" onsubmit="submitEmail(event)">
							<label for="oldEmail">Old Email Address:</label>
							<input type="email" id="oldEmail" name="oldEmail" required>
							<label for="newEmail">New Email Address:</label>
							<input type="email" id="newEmail" name="newEmail" required>
							<label for="confirmNewEmail">Confirm New Email Address:</label>
							<input type="email" id="confirmNewEmail" name="confirmNewEmail" required>
							<div class="text-24hrs">It may take 24 hours for changes to take effect. <br>You will need to login with your new email.</div>
							<input type="submit" value="SUBMIT">
						</form>
					</div>
				</div>
				<!-- Modal for additional content - Password -->
				<div id="modalAdditionalPassword" class="modal">
					<!-- Close button -->
					<span class="close-btn" onclick="closeModal()">X</span>
					<div class="container5">
						<div class="additional-modal">
							<h2>CHANGE PASSWORD</h2>
							<p>Please check your email address for the required OTP to verify your new password.
								The OTP is only available for 10 minutes.
							</p>
							<form id="formOTPPassword" onsubmit="submitOTPPassword(event)">
								<label for="otpPassword">OTP</label>
								<input type="text" id="otpPassword" name="otpPassword" required>
								<label for="newPassword">New Password</label>
								<div id="otpUsernameMessage" style="color: red; font-size: 14px;"></div>
								<input type="text" name="newPassword" required>
								<input type="button" value="RESEND OTP" onclick="resendPasswordOtp(event)">
								<input type="submit" value="SUBMIT">
							</form>
						</div>
					</div>
				</div>
				<!-- Modal for additional content - Email Address -->
				<div id="modalAdditionalEmail" class="modal">
					<!-- Close button -->
					<span class="close-btn" onclick="closeModal()">X</span>
					<div class="container5">
						<div class="additional-modal">
							<h2>CHANGE EMAIL ADDRESS</h2>
							<p>Please check your email address for the required OTP to verify your new email address.
								The OTP is only available for 10 minutes.
							</p>
							<form id="formOTPEmail" onsubmit="submitOTPEmail(event)">
								<label for="otpEmail">OTP</label>
								<input type="text" id="otpEmail" name="otpEmail" required>
								<div id="otpEmailMessage" style="color: red; font-size: 14px;"></div>
								<input type="button" value="RESEND OTP" onclick="resendOTP(event)">
								<input type="submit" value="SUBMIT">
							</form>
						</div>
					</div>
				</div>
			</div>
		</main>
	</div>

	<?php include '../header-footer/footer.php'    ?>
<script src="account-dashboard-jscript.js"></script>
<script>
	

var logout = document.getElementById('logout')	
logout.addEventListener("click", ()=> {

	$.ajax({
		url: "logout.php",
		type: "post",
		data: {logout: "logout"},
		success: function(data){
			location.replace('../static-home-page/index.php')
		}
	})
})
		
</script>
</body>

</html>