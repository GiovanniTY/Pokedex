<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
<a href="../index.php">Return to homepage</a>
    <h1>Login</h1>
    <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
        <label for="username">Username</label>
        <input type="text" name="username"><br>
        <?php if (isset($errors['username_missing'])) { ?><span class="error" id="username_error"><?php echo $errors['username_missing'] ?? ''; ?></span><br><?php } ?>
        <?php if (isset($errors['username_exists'])) { ?><span class="error" id="username_exists"><?php echo $errors['username_exists'] ?? ''; ?></span><br><?php } ?>
        <label for="email">Email</label>
        <input type="email" name="email"><br>
        <?php if (isset($errors['email_missing'])) { ?><span class="error" id="email_error"><?php echo $errors['email_missing'] ?? ''; ?></span><br><?php } ?>
        <?php if (isset($errors['email_invalid'])) { ?><span class="error" id="email_invalid"><?php echo $errors['email_invalid'] ?? ''; ?></span><br><?php } ?>
        <?php if (isset($errors['email_exists'])) { ?><span class="error" id="email_exists"><?php echo $errors['email_exists'] ?? ''; ?></span><br><?php } ?>
        <label for="password">Password</label>
        <input type="password" name="password"><br>
        <?php if (isset($errors['password_missing'])) { ?><span class="error" id="password_error"><?php echo $errors['password_missing'] ?? ''; ?></span><br><?php } ?>
        <button type="submit" name="login">Login</button>
    </form>

    
</body>
</html>