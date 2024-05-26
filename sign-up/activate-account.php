<?php

$token = $_GET["token"];

$token_hash = hash("sha256", $token);

$mysqli = new mysqli("localhost", "root", "", "sbdodatabase");

$sql = "SELECT * FROM account
        WHERE account_activation_hash = ?";

$stmt = $mysqli->prepare($sql);

$stmt->bind_param("s", $token_hash);

$stmt->execute();

$result = $stmt->get_result();

$user = $result->fetch_assoc();

if ($user === null) {
    die("token not found");
}

if (strtotime($user["activation_expiry"]) <= time()) {
    $sql = "DELETE FROM account WHERE user_id=?";
    $stmt = $mysqli->prepare($sql);

    $stmt->bind_param("s", $user["user_id"]);

    $stmt->execute();

    die("token expired");
}

$sql = "UPDATE account SET account_activation_hash = NULL WHERE user_id=?";
$stmt = $mysqli->prepare($sql);

$stmt->bind_param("s", $user["id"]);

$stmt->execute();

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up | Sulit & Bagasan Dental Office</title>
    <link rel="stylesheet" type="text/css" href="style_OTP.css">
    <style>
        <?php include '../header-footer/header-footer.css' ?>
    </style>

</head>

<body>

    <?php include '../header-footer/header.php' ?>

    <div class="wrapper">
        <div class="form">

                <h1 class="title">SIGN UP</h1>
                <hr>

        

                
    <h1>Account Activation</h1>

<p> Account activated successfully. You can now <a href = "../login-forgot-password/login.php"> log in </a>.</p>



                </div>
            </form>
        </div>

    </div>

    <?php include '../header-footer/footer.php' ?>


</body>

</html>