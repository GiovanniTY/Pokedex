<?php 
include ('./config.php');

if (isset($_POST['register'])){

    $errors = [];

    if (!isset($_POST['username']) || empty($_POST['username'])) {
        $errors['username_missing'] = 'Username is required.';
    }

    if (!isset($_POST['email']) || empty($_POST['email'])) {
        $errors['email_missing'] = 'Email is required.';
    } elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $errors['email_invalid'] = 'Email is invalid.';
    }

    if (!isset($_POST['password']) || empty($_POST['password']) || !isset($_POST['confirm_password']) || empty($_POST['confirm_password'])) {
        $errors['password_missing'] = 'Password is required.';
    } elseif ($_POST['password'] !== $_POST['confirm_password']) {
        $errors['password_mismatch'] = 'Passwords do not match.';
    }

    
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>
<body>
<a href="./index.php">Return to homepage</a>
    <h1>Register</h1>
    <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
        <label for="username">Username</label>
        <input type="text" name="username"><br>
        <?php if (isset($errors['username_missing'])) {?><span class="error" id="username_error"><?php echo $errors['username_missing'] ?? ''; ?></span><br><?php }?>
        <label for="email">Email</label>
        <input type="email" name="email"><br>
        <?php if (isset($errors['email_missing'])) {?><span class="error" id="email_error"><?php echo $errors['email_missing'] ?? ''; ?></span><br><?php }?>
        <?php if (isset($errors['email_invalid'])) {?><span class="error" id="email_invalid"><?php echo $errors['email_invalid'] ?? ''; ?></span><br><?php }?>
        <label for="password">Password</label>
        <input type="password" name="password"><br>
        <?php if (isset($errors['password_missing'])) {?><span class="error" id="password_error"><?php echo $errors['password_missing'] ?? ''; ?></span><br><?php }?>
        <label for="confirm_password">Password verification</label>
        <input type="password" name="confirm_password"><br>
        <?php if (isset($errors['password_mismatch'])) {?><span class="error" id="password_mismatch"><?php echo $errors['password_mismatch'] ?? ''; ?></span><br><?php }?>
        <button type="submit" name="register">Submit</button>
    </form>
    
</body>
</html>