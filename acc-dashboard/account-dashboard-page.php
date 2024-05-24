
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Contact Us | Sulit & Bagasan Dental Office</title>
		<link rel="stylesheet" type="text/css" href="css/account-dashboard-css.css">
        <script src="jscript/account-dashboard-jscript.js"></script>
		<style>
    		<?php include '../header-footer/header-footer.css' ?>
		</style>
	</head>
	<body>
		<div class="wrapper">
		<?php include '../header-footer/header.php' ;		?>
			<div class="profile-container">
				<div class="profile-details">
                    <p class="profile-name"><?php echo htmlspecialchars($username); ?></p>
                    <p class="profile-email"><?php echo htmlspecialchars($email); ?></p>
                    <p class="profile-number"><?php echo htmlspecialchars($phone_number); ?></p>
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
									<p class="username">Username: <?php echo htmlspecialchars($username); ?></p>
									<button onclick="showModal('username')">Change</button>
								</li>
								<li>
									<p class="password">Password: *******</p>
									<button onclick="showModal('password')">Change</button>
								</li>
								<li>
									<p class="emailadd">Email Address: <?php echo htmlspecialchars($email); ?></p>
									<button onclick="showModal('email')">Change</button>
								</li>
							</ul>
						</div>
						<div class = "logout-button"><a href="logout.php">Logout</a></div>
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
								<input type="submit" value="RESEND OTP">
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
							<input type="password" id="oldPassword" name="oldPassword" required>
							<label for="newPassword">New Password:</label>
							<input type="password" id="newPassword" name="newPassword" required>
							<label for="confirmNewPassword">Confirm New Password:</label>
							<input type="password" id="confirmNewPassword" name="confirmNewPassword" required>
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
							<h2>CHANGE PASSWORD</h2>
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
								<label for="otpResetPassword">OTP</label>
								<input type="text" id="oldUsername" name="oldUsername" required>
								<label for="newUsername">New Password:</label>
								<input type="text" id="newUsername" name="newUsername" required>
								<label for="confirmNewUsername">Confirm New Password:</label>
								<input type="text" id="confirmNewUsername" name="confirmNewUsername" required>
								<input type="submit" value="RESEND OTP">
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
								<input type="text" id="newPassword" name="newPassword" required>
								<input type="submit" value="RESEND OTP">
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
								<input type="submit" value="RESEND OTP">
								<input type="submit" value="SUBMIT">
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php include '../header-footer/footer.php' ?>
	</body>
</html>