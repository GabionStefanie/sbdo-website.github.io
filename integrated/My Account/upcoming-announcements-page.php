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
    <link rel="stylesheet" type="text/css" href="css/upcoming-announcements-css.css">
    <script defer src="jscript/upcoming-announcements-jscript.js"></script>
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
                    <?php
                    if (isset($user['ProfilePicture'])) {
                        $profilePicture = $user['ProfilePicture'];
                        if (file_exists($profilePicture) && is_readable($profilePicture)) {
                            echo "<img src='$profilePicture' alt='Profile Picture'>";
                        } else { ?>
                            <p class="profile-label">
                                <?php echo "The image file does not exist or is not readable"; ?>
                            </p>
                        <?php }
                    } else { ?>
                        <p class="profile-label">
                            <?php echo "Profile picture not set"; ?>
                        </p>
                    <?php } ?>
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
                        <textarea class="canceling-text-area" placeholder="State your reason for cancelling." required></textarea>
                        <form>
                            <label>AGREE
                                <input type="checkbox" id="agree" name="agree" required>
                            </label>
                        </form>
                        <div class="submit-container">
                            <input type="button" class="no-btn" value="NO" onclick="closeModal('cancel-modal-container')">
                            <input type="submit" value="YES" class="yes-btn">
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <?php include '../header-footer/footer.php'; ?>

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

            function closeModal(modalId) {
                var overlay = document.getElementById('overlay');
                var modals = document.querySelectorAll('.modal');
                var modalContainer = document.getElementById(modalId);
                // Hide the overlay and all modals
                overlay.style.display = 'none';
                modalContainer.style.display = 'none';
            }
        </script>
</body>

</html>