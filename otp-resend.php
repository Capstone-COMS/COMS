<?php
include('includes/dbconnection.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

if (isset($_POST['resend_otp'])) {
    $email = $_POST['email'];

    // Check if the email exists in the database
    $sql = "SELECT * FROM user WHERE uemail = '$email'";
    $result = $con->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $uemail = $row['uemail'];


        // Generate a new OTP
        $new_otp = str_shuffle('0123456789');
        $new_otp = substr($new_otp, 0, 5);

        // Set OTP expiration time (5 minutes)
        $expiration_time = date("Y-m-d H:i:s", strtotime('+1 minutes'));

        // Update the OTP in the database
        $update_sql = "UPDATE user SET otp = '$new_otp',otp_expiration='$expiration_time' WHERE uemail = '$uemail'";
        $con->query($update_sql);
        // Send OTP to the user's email
        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com'; // Your SMTP server
            $mail->SMTPAuth = true;
            $mail->Username = 'coms.system.adm@gmail.com'; // Your Gmail email address
            $mail->Password = 'wdcbquevxahkehla'; // Your Gmail password
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            $mail->setFrom('coms.system.adm@gmail.com', 'Concessionaire Monitoring Operation System');
            $mail->addAddress($uemail); // User's email address
            $mail->isHTML(true);
            $mail->Subject = 'Email Verification';
            $mail->Body = 'Your OTP is: ' . $new_otp;

            $mail->send();
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }

        // Redirect back to the OTP verification page with a success message
        header('Location: otp.php?email=' . $uemail . '&success=1');
        exit();
    } else {
        $error_message = "Email not found in our records. Please sign up first.";
    }
}
?>
<!-- HTML -->
<?php include('includes/header.php')?>
<?php include('includes/nav.php')?>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap');
*{
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: 'Poppins',sans-serif;
}
body{
  height: 100vh;
  display: flex;
  justify-content: center;
  align-items: center;
  padding: 10px;
  background: linear-gradient(135deg, #71b7e6, #393E46);
}
.container{
  max-width: 700px;
  width: 100%;
  background-color: #fff;
  padding: 25px 30px;
  border-radius: 5px;
  box-shadow: 0 5px 10px rgba(0,0,0,0.15);
}
.container .title{
  font-size: 25px;
  font-weight: 500;
  position: relative;
}
.container .title::before{
  content: "";
  position: absolute;
  left: 0;
  bottom: 0;
  height: 3px;
  width: 30px;
  border-radius: 5px;
  background: linear-gradient(135deg, #71b7e6, #393E46);
}
.content form .user-details{
  display: flex;
  flex-wrap: wrap;
  justify-content: space-between;
  margin: 20px 0 12px 0;
}
form .user-details .input-box{
  margin-bottom: 15px;
  width: 100%;
}
form .input-box span.details{
  display: block;
  font-weight: 500;
  margin-bottom: 5px;
}
.user-details .input-box input{
  height: 45px;
  width: 100%;
  outline: none;
  font-size: 16px;
  border-radius: 5px;
  padding-left: 15px;
  border: 1px solid #ccc;
  border-bottom-width: 2px;
  transition: all 0.3s ease;
}
.user-details .input-box input:focus,
.user-details .input-box input:valid{
  border-color: #393E46;
}
 form .use-details .use-title{
  font-size: 20px;
  font-weight: 500;
 }
 form .category{
   display: flex;
   width: 80%;
   margin: 14px 0 ;
   justify-content: space-between;
 }
 form .category label{
   display: flex;
   align-items: center;
   cursor: pointer;
 }
 form .category label .dot{
  height: 18px;
  width: 18px;
  border-radius: 50%;
  margin-right: 10px;
  background: #d9d9d9;
  border: 5px solid transparent;
  transition: all 0.3s ease;
}
 #dot-1:checked ~ .category label .one,
 #dot-2:checked ~ .category label .two,
 #dot-3:checked ~ .category label .three{
   background: #393E46;
   border-color: #d9d9d9;
 }
 form input[type="radio"]{
   display: none;
 }
 form .button{
   height: 45px;
   margin: 35px 0
 }
 form .button input{
   height: 100%;
   width: 100%;
   border-radius: 5px;
   border: none;
   color: #fff;
   font-size: 18px;
   font-weight: 500;
   letter-spacing: 1px;
   cursor: pointer;
   transition: all 0.3s ease;
   background: linear-gradient(135deg, #71b7e6, #393E46);
 }
 form .button input:hover{
  /* transform: scale(0.99); */
  background: linear-gradient(-135deg, #71b7e6, #393E46);
  }
 @media(max-width: 584px){
 .container{
  max-width: 100%;
}
form .user-details .input-box{
    margin-bottom: 15px;
    width: 100%;
  }
  form .category{
    width: 100%;
  }
  .content form .user-details{
    max-height: 300px;
    overflow-y: scroll;
  }
  .user-details::-webkit-scrollbar{
    width: 5px;
  }
  }
  @media(max-width: 459px){
  .container .content .category{
    flex-direction: column;
  }
}
</style>
    <div class="container">
        <div class="title">OTP Resend</div>
        <div class="content">
            <form action="" method="POST">
                <p>
                    <?php
                        if (isset($error_message)) {
                            echo $error_message;
                        }
                    ?>
                </p>
                <div class="user-details">
                    <div class="input-box">
                        <span for="email" class="details">Email</span>
                        <input type="email" 
                               name="email" 
                               id="email" 
                               autocomplete="off" 
                               placeholder="Enter your email"
                               required>
                    </div>
                </div>

                <div class="button">
                    <input type="submit" name="resend_otp">
                </div>
                
                <!-- Countdown Timer -->
                <div class="text-center" id="timer"></div>
                </form>
            </div>
        </div>
    </div>

<script>
    // Set the expiration time for the countdown timer
    var expirationTime = <?php echo $expiration_time ? $expiration_time * 1000 : 0; ?>;

    if (expirationTime > 0) {
        // Update the countdown every second
        var x = setInterval(function () {
            var now = new Date().getTime();
            var distance = expirationTime - now;

            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);

            // Display the timer
            document.getElementById("timer").innerHTML = "Time remaining: " + minutes + "m " + seconds + "s ";

            // If the timer reaches zero, redirect the user or take appropriate action
            if (distance < 0) {
                clearInterval(x);
                // Handle expired timer (e.g., redirect to a different page)
                window.location.href = "otp-resend-new.php";
            }
        }, 1000);
    }
</script>
<?php include('includes/footer.php')?>
