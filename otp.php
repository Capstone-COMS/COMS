
<?php include('includes/dbconnection.php');?>

<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

if (isset($_POST['verify_otp'])) {
    $email = $_GET['email'];
    $otp = $_POST['otp'];

    // Check if the entered OTP matches the stored OTP
    $sql = "SELECT * FROM user WHERE uemail = '$email' AND otp = '$otp'";
    $result = $con->query($sql);

    if ($result->num_rows == 1) {
        // Update the user's status as verified (you can add a 'verified' column in the user table)
        $sql = "UPDATE user SET verified = 1 WHERE uemail = '$email'";
        $con->query($sql);

        // Redirect the user to a success page or login page
        header('Location: login.php'); // Create a success page for successful verification
        exit();
    } else {
        $error_message = "Invalid OTP. Please try again.";
    }
}
?>
<!-- HTML -->
<?php include('includes/header.php')?>
<?php include('includes/nav.php')?>

<section class="otp-form">

    <div class="container pt-5">
        <h2 class="text-center">OTP Verification</h2>
    <div class="row mt-4 mb-4">
        <div class="col-md-6 offset-md-3">
            <form action="" class="shadow-lg p-4" method="POST">
                <p><?php
                if (isset($error_message)) {
                    echo $error_message;
                } if (isset($_GET['success']) && $_GET['success'] == 1) {
                    echo "OTP has been successfully resent. Please check your email.";
                }
?></p>
                <div class="form-group form">
                    <input type="text" class="form-control form-input" name="otp" id="otp" autocomplete="off" placeholder="">
                    <label for="otp" class="form-label">
                        <i class="fa-solid fa-key"></i>
                        OTP
                    </label>
                </div>
                <button type="submit" class="btn btn-danger mt-3 btn-block shadow-sm font-weight-bold" name="verify_otp">Verify OTP</button>
            </form>

            <!-- OTP Resend -->
           <form action="otp-resend.php" method="POST">
                    <div class="form-group form">
                        <input type="email" class="form-control form-input" name="email" id="email" autocomplete="off" placeholder="Enter your email">
                        <label for "email" class="form-label">Email</label>
                    </div>
                    <button type="submit" class="btn btn-primary" name="resend_otp">Resend OTP</button>
                </form>
                <!-- Otp resend -->
        </div>
    </div>
</div>
</section>
<?php include('includes/footer.php')?>