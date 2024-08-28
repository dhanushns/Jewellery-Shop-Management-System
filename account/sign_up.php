<!DOCTYPE html>
<html lang="en">

<head>
    <title>NS - Sign Up</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE-edge">
    <meta name="description" content="sign up">
    <link rel="stylesheet" href="sign_up_style_sheet.css">
</head>

<body>
    <div class="background_image">
        <div class="success">
        </div>
        <h3>NSJ sign up</h3>
        <div class="sign_up">
            <form action="acc_new_user.php" method="post">
                <label>First name</label><label id="lastName">Last name</label><br><br>
                <input type="text" name="firstName" id="fn" required><input type="text" name="lastName" id="ln"><br><br>
                <label>Username</label><br><br>
                <input type="text" name="username" requird><br><br><br>
                <label>Email</label><br><br>
                <input type="email" name="email" requird><br><br><br>
                <label>Create password</label><br><br>
                <input type="password" name="password" requird><br><br><br>
                <label>Confirm password</label><br><br>
                <input type="password" name="re_type_password" required><br><br><br>
                <input type="submit" name="submit" value="Create account" id="create_acc">
            </form>
        </div>
    </div>
</body>

</html>