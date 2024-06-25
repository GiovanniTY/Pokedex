<?php

include('../login-register/config.php');

session_start();

if (isset($_POST['submit'])){
    $username = $_POST['username'];
    $description = $_POST['description'] ?? null;
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    $password = $_POST['password'] ?? $_SESSION['user']['password'];
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
</head>

<body>
    <h1>Profile</h1>
    <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
        <label for="avatar">Avatar</label>
        <select name="avatar" id="avatar">
            <option value="../storage/default_avatars/pikachu.png">Pikachu</option>
            <option value="../storage/default_avatars/bulbizarre.png">Bulbizarre</option>
            <option value="../storage/default_avatars/caninos.png">Caninos</option>
            <option value="../storage/default_avatars/carapuce.png">Carapuce</option>
            <option value="../storage/default_avatars/goupix.png">Goupix</option>
            <option value="../storage/default_avatars/salameche.png">Salamèche</option>
        </select><br>
        <label for="username">Username</label>
        <input type="text" name="username" value="<?php echo $_SESSION['user']['username']?>"><br>
        <label for="description">Description</label>
        <textarea name="description" id="description" rows="5" value="<?php echo $_SESSION['user']['description']?>"></textarea><br>
        <label for="email">Email</label>
        <input type="email" name="email" value="<?php echo $_SESSION['user']['email']?>"><br>
        <label for="password">Modify your password</label>
        <input type="password" name="password"><br>
        <button type="submit" name="submit">Update</button>

    </form>
</body>

</html>