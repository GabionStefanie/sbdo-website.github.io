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
            <span class="close-btn2" onclick="closeModal()">X</span>
            <div class="container">
                <div class="change-profile-picture-modal">
                    <h2>CHANGE PROFILE PICTURE</h2>
                </div>
                <form id="formChangeProfilePicture" onsubmit="submitProfilePicture(event)">
                    <label for="profilePicture">Please upload your new profile picture:</label>
                    <input type="file" id="profilePicture" name="profilePicture" accept="image/*" required><br>
                    <input type="submit" value="UPLOAD">
                </form>
            </div>
        </div>
        <div class="transac-history">
            <p>TRANSACTION HISTORY</p>
            <div class="line1"></div>
            <div class="sort">
                <button class="sortByMonth">SORT BY MONTH</button>
                <button class="sortByStatus">SORT BY STATUS</button>
            </div>
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>DATE</th>
                            <th>NAME</th>
                            <th>AMOUNT</th>
                            <th>STATUS</th>
                        </tr>
                    </thead>
                    <tbody id="transactionHistoryBody">
                    </tbody>
                </table>
            </div>
            <div class="page-buttons">
                <button class="prev">PREV</button>
                <button class="page-button">1</button>
                <button class="page-button">2</button>
                <button class="page-button">3</button>
                <button class="next">NEXT</button>
            </div>
        </div>
        <?php include '../header-footer/footer.php'; ?>
    </div>

    <script>
        
    </script>
</body>
</html>
