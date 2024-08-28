<!DOCTYPE html>
<html lang="eng">
  <head>
    <title>Change password</title>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE-edge" />
    <meta name="description" content="change password" />
    <link rel="stylesheet" href="style.css" />
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0"
    />
  </head>
  <script src = "./script.js"></script>
  <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/@emailjs/browser@4/dist/email.min.js"></script>
  <body>
    <div class="fp-block">
      <h2 style="color: #ffff">NS JEWELLS</h2>
      <div class="fp-container step-1">
        <h3>OTP Verfication</h3>
        <h4>Enter your email address</h4>
        <p>You will recieve an email with one-time password</p>
        <form class="fp-form email-form form-group">
          <input type="email" id = "emailAddress" required placeholder="Enter your email" onkeyup="validateEmail(this.value)" />
          <br /><br />
          <button type ="button" class = "nextButton">
            Next
            <span class="material-symbols-outlined" id = "right_arr"> chevron_right </span>
          </button>
        </form>
      </div>
      <div class="fp-container step-2">
        <h3>OTP Verfication</h3>
        <h4>Enter one-time password</h4>
        <p>An one-time password is sent to <span id = "userEmailAddress-1"></span></p>
        <form class="fp-form otp-form form-group">
          <div class = "otp-input">
          <input type="number" id = "1" required/>
          <input type="number" id = "2" required/>
          <input type="number" id = "3" required/>
          <input type="number" id = "4" required/>
          </div>
          <br />
          <p>Not your email? / Didn't recieve an OTP?
            <a href="#">Try again</a>
          </p>
          <button type="button" onclick="verifyOTP()" class = "verifyButton">
            Verify
            <span class="material-symbols-outlined"> chevron_right </span>
          </button>
        </form>
      </div>
      <div class="fp-container step-3">
        <h2 style="color:lightgreen;">Your OTP verification has been sucessfully completed</h2>
        <p>Password reset for <span id = "userEmailAddress-2"></span></p>
        <form class = "fp-form change-pass-form form-group">
          <input type="password" required placeholder="New password">
          <br /><br />
          <input type="password" required placeholder="Confirm password">
          <br /><br />
          <button type = "submit">Change password</button>
        </form>
      </div>
    </div>
  </body>
</html>
