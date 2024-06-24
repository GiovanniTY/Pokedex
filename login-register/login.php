<?php

include('./config.php');

session_start();

if (isset($_SESSION['user'])){
    header("Location: ../index.php");
}

if (isset($_POST['login'])) {
    $errors = [];
    try {

        $email = $_POST['email'];
        $password = $_POST['password'];

        $statement = $pdo->prepare("SELECT * FROM users WHERE email = :email");
        $statement->bindParam(':email', $email);
        $statement->execute();

        // Fetch the user's data from the database
        $user = $statement->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $error) {
        print_r($error->getMessage());
    }

    // Check if the user's input matches the credentials stored in the database
    if ($user && password_verify($password, $user['password'])) {
        // The user's input is valid, log them in
        $_SESSION['user'] = $user;
        echo '<script>alert("Login successful !")</script>';
        header("Location: ../index.php");
        exit();
    } else {
        // The user's input is not valid, show an error message
        $errors['credentials'] = "Invalid email or password.";
    }
}



?>

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
        <label for="email">Email</label>
        <input type="email" name="email"><br>
        <label for="password">Password</label>
        <input type="password" name="password"><br>
        <?php if (isset($errors['credentials'])) { ?><span class="error" id="credentials"><?php echo $errors['credentials'] ?? ''; ?></span><br><?php } ?>
        <button type="submit" name="login">Login</button>
    </form>


</body>

</html>