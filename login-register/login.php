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

       
        $user = $statement->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $error) {
        print_r($error->getMessage());
    }

 
    if ($user && password_verify($password, $user['password'])) {
        
        $_SESSION['user'] = $user;
        echo '<script>alert("Login successful !")</script>';
        header("Location: ../index.php");
        exit();
    } else {
        
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
    <a href="./register.php">Sign up</a>
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