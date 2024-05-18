<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Contact Us | Sulit & Bagasan Dental Office</title>
		<link rel="stylesheet" type="text/css" href="css/upcoming-announcements-css.css">
        <script src="jscript/upcoming-announcements-jscript.js"></script>
		<style>
    		<?php include '../header-footer/header-footer.css' ?>
		</style>
	</head>
	<body>
		<div class="wrapper">
		<?php include '../header-footer/header.php' ?>
		<div class="profile-container">
			<div class="profile-info">
				<div class="profile-picture">
					<p class="profile-label">PROFILE PICTURE</p>
				</div>
				<div class="profile-details">
					<p class="profile-name">USERNAME</p>
					<p class="profile-email">EMAIL ADDRESS</p>
					<p class="profile-number">PHONE NUMBER</p>
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
			<table>
				<tr>
					<th>NAME</th>
					<th>TYPE OF APPOINTMENT</th>
				</tr>
				<tr>
					<td>First Name Last Name</td>
					<td>Lorem Ipsum</td>
				</tr>
				<tr>
					<th>DATE CREATED</th>
					<th>DATE OF APPOINTMENT</th>
				</tr>
				<tr>
					<td>MM, DD, YYYY</td>
					<td>MM, DD, YYYY</td>
				</tr>
				<tr>
					<th class="colspan2" colspan="2">AMOUNT</th>
				</tr>
				<tr>
					<td class="colspan2" colspan="2">Lorem Ipsum</td>
				</tr>
			</table>
			<div class="resched-cancel-wrapper">
				<div class="text-resched">You can only reschedule appointments 1 week before the appointment date.</div>
				<input type="submit" value="RESCHED" onclick="toggleModal('modal-container')">
				<div class="text-cancel">You can only cancel appointments 2 weeks before the appointment date.</div>
				<input type="submit" value="CANCEL" onclick="toggleModal('cancel-modal-container')">            
			</div>
		</div>
		<!-- Modal container -->
		<div id="modal-container" class="modal-container">
			<div class="modal-content">
				<!-- Form for rescheduling -->
				<form id="resched-form" class="resched-form">
					<h3>RESCHEDULE APPOINTMENT</h3>
					<div class="reschedule-contents">
						<P>Please note that you are only permitted to change the date of your appointment; 
							you cannot alter the type of appointment you wish to schedule.
						</P>
						<div class="form-group">
							<label for="date">DATE</label>
							<input type="date" id="date" name="date" required>
						</div>
						<div class="form-group">
							<label for="time">TIME</label>
							<input type="time" id="time" name="time" required>
						</div>
						<div class="submit-container">
							<input type="submit" value="CANCEL" class="cancel-btn">
							<input type="submit" value="CONFIRM" class="confirm-btn">
						</div>
					</div>
				</form>
			</div>
		</div>
		<div id="cancel-modal-container" class="modal-container">
			<div class="modal-content">
				<!-- Form for canceling appointment -->
				<form id="cancel-form" class="cancel-form">
					<h3>CANCEL APPOINTMENT</h3>
					<div class="cancel-contents">
						<p>Please note that you will receive your refunded amount after 2-3 days of cancelling your appointment.
							<br><br>
							Are you sure you want to cancel your appointment?
						</p>
				<form>
				<label>AGREE
				<input type="checkbox" id="agree" name="agree" required>
				</label>
				</form>
				<div class="submit-container">
				<input type="submit" value="NO" class="no-btn">
				<input type="submit" value="YES" class="yes-btn">
				</div>
				</div>
				</form>
			</div>
		</div>
		<?php include '../header-footer/footer.php' ?>

		<script>
			// JavaScript to toggle modal visibility
			function toggleModal(modalId) {
			    var modalContainer = document.getElementById(modalId);
			    modalContainer.style.display = modalContainer.style.display === 'block' ? 'none' : 'block';
			}
			
			// Hide the modal container when clicking outside the modal content
			window.addEventListener('click', function(event) {
			    var modalContainers = document.querySelectorAll('.modal-container');
			    modalContainers.forEach(function(modalContainer) {
			        if (event.target == modalContainer) {
			            modalContainer.style.display = 'none';
			        }
			    });
			});
			
			function toggleContent() {
			    var content = document.getElementById('content');
			    if (content.style.display === 'none' || content.style.display === '') {
			        content.style.display = 'block';
			    } else {
			        content.style.display = 'none';
			    }
			}
			
			function showModal(modalType) {
			    var overlay = document.getElementById('overlay');
			    var modal = document.getElementById('modal' + modalType.charAt(0).toUpperCase() + modalType.slice(1)); // Capitalize first letter
			
			    // Close all modals first
			    closeModal();
			
			    // Display the overlay and modal
			    overlay.style.display = 'block';
			    modal.style.display = 'block';
			}
			
			function closeModal() {
			    var overlay = document.getElementById('overlay');
			    var modals = document.querySelectorAll('.modal');
			
			    // Hide the overlay and all modals
			    overlay.style.display = 'none';
			    modals.forEach(function(modal) {
			        modal.style.display = 'none';
			    });
			}
			
			// Function to handle submission of the profile picture change form
			function submitProfilePicture(event) {
			event.preventDefault(); // Prevent default form submission
			
			// Add your logic here to handle the form submission
			// For example, you can upload the selected profile picture to the server
			
			// After the profile picture is uploaded successfully, close the modal
			closeModal();
			}
			
			
			
			// Function to show the change profile picture modal
			function showChangeProfilePictureModal() {
			var overlay = document.getElementById('overlay');
			var modal = document.getElementById('modalChangeProfilePicture');
			
			// Close all modals first
			closeModal();
			
			// Display the overlay and modal
			overlay.style.display = 'block';
			modal.style.display = 'block';
			}
			
			// Inside your form, add an event listener to handle form submission 
			function submitUsername(event) {
			    event.preventDefault(); // Prevent default form submission
			
			    // Show the additional modal after form submission
			    showModal('additionalUsername');
			}
			
			// Inside your form, add an event listener to handle form submission 
			function submitPassword(event) {
			    event.preventDefault(); // Prevent default form submission
			
			    // Show the additional modal after form submission
			    showModal('additionalPassword');
			}
			
			function showForgotPasswordModal() {
			var overlay = document.getElementById('overlay');
			var modal = document.getElementById('modalForgotPassword');
			
			// Close all modals first
			closeModal();
			
			// Display the overlay and modal
			overlay.style.display = 'block';
			modal.style.display = 'block';
			}
			
			// Inside your form, add an event listener to handle form submission 
			function submitEmail(event) {
			    event.preventDefault(); // Prevent default form submission
			
			    // Show the additional modal after form submission
			    showModal('additionalEmail');
			}
			
			// Additional modal for OTP verification after changing the username
			function submitOTPUsername(event) {
			    event.preventDefault(); // Prevent default form submission
			
			    // Add your OTP verification logic here
			}
			
			// Additional modal for OTP verification after changing the password
			function submitOTPPassword(event) {
			    event.preventDefault(); // Prevent default form submission
			
			    // Add your OTP verification logic here
			}
			
			// Function to handle submission of the reset password form
			function submitForgotPassword(event) {
			event.preventDefault(); // Prevent default form submission
			
			// Add your logic here to handle the form submission
			// For example, you can send a request to the server to reset the password
			
			// After the password reset request is successful, show the reset password modal
			showModal('resetPassword');
			}
			
			// Function to show the reset password modal
			function showModal(modalType) {
			var overlay = document.getElementById('overlay');
			var modal = document.getElementById('modal' + modalType.charAt(0).toUpperCase() + modalType.slice(1)); // Capitalize first letter
			
			// Close all modals first
			closeModal();
			
			// Display the overlay and modal
			overlay.style.display = 'block';
			modal.style.display = 'block';
			}
			
			
			// Additional modal for OTP verification after changing the email address
			function submitOTPEmail(event) {
			    event.preventDefault(); // Prevent default form submission
			
			    // Add your OTP verification logic here
			}
			
			function logout() {
			    // Add your logout logic here
			    // For example, you can redirect the user to the login page
			    window.location.href = "logout.html";
			}
			
		</script>
	</body>
</html>