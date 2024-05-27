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
                    <p class="profile-label">PROFILE PICTURE</p>
                </div>
                <div class="profile-details">
                    <p class="profile-name"><?php echo htmlspecialchars($username); ?></p>
                    <p class="profile-email"><?php echo htmlspecialchars($email); ?></p>
                    <p class="profile-number"><?php echo htmlspecialchars($phone_number); ?></p>
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
