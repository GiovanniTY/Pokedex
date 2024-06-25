<?php

include('../login-register/config.php');

session_start();

if (isset($_POST['submit'])) {
    $errors = [];
    $username = $_POST['username'] ?? '';
    $description = $_POST['description'] ?? PDO::PARAM_NULL;
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] != '' ? $_POST['password'] : $_SESSION['user']['password'];
    $avatar = $_POST['avatar'];

    if ($username === '') {
        $errors['username_missing'] = 'The username is required. We have set it back to your original one.';
    }
    if ($email === '') {
        $errors['email_missing'] = 'The email is required. We have set it back to your original one.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email_invalid'] = 'The email is invalid. We have set it back to your original one.';
    }
    if (password_verify($password, $_SESSION['user']['password'])) {
        $errors['password_identical'] = 'Your new password must be different.';
    }

    if (empty($errors)) {
        try {
            $email = filter_var($email, FILTER_VALIDATE_EMAIL);
            $password = password_hash($password, PASSWORD_DEFAULT);
            $sql = "UPDATE users SET username = :username, email = :email, password = :password, avatar = :avatar, description = :description WHERE id = :id;";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(":username", $username);
            $stmt->bindParam(":email", $email);
            $stmt->bindParam(":password", $password);
            $stmt->bindParam(":avatar", $avatar);
            $stmt->bindParam(":description", $description);
            $stmt->bindParam(":id", $_SESSION['user']['id']);
            $stmt->execute();
        } catch (PDOException $error) {
            print_r($error->getMessage());
        }

        try {
            $email = $_POST['email'];
            $password = $_POST['password'];

            $statement = $pdo->prepare("SELECT * FROM users WHERE email = :email");
            $statement->bindParam(':email', $email);
            $statement->execute();


            $_SESSION['user'] = $statement->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $error) {
            print_r($error->getMessage());
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/style.css">
    <title>Profile</title>
</head>

<body class="body-backend">
    <nav>
        <a href="../index.php">Back to home</a>
    </nav>
    <form class="form-backend" action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
        <h1>Profile</h1>
        <img src="<?php echo '.' . $_SESSION['user']['avatar'] ?>" class="avatar-img" alt="avatar" id="profile-img">
        <div>
            <label for="avatar">Avatar</label>
            <select name="avatar" id="avatar">
                <option <?php echo $_SESSION['user']['avatar'] === './storage/default_avatars/pikachu.png' ? 'selected' : '' ?> value="./storage/default_avatars/pikachu.png">Pikachu</option>
                <option <?php echo $_SESSION['user']['avatar'] ===  './storage/default_avatars/bulbizarre.png' ? 'selected' : '' ?> value="./storage/default_avatars/bulbizarre.png">Bulbizarre</option>
                <option <?php echo $_SESSION['user']['avatar'] ===  './storage/default_avatars/caninos.png' ? 'selected' : '' ?> value="./storage/default_avatars/caninos.png">Caninos</option>
                <option <?php echo $_SESSION['user']['avatar'] ===  './storage/default_avatars/carapuce.png' ? 'selected' : '' ?> value="./storage/default_avatars/carapuce.png">Carapuce</option>
                <option <?php echo $_SESSION['user']['avatar'] ===  './storage/default_avatars/goupix.png' ? 'selected' : '' ?> value="./storage/default_avatars/goupix.png">Goupix</option>
                <option <?php echo $_SESSION['user']['avatar'] ===  './storage/default_avatars/salameche.png' ? 'selected' : '' ?> value="./storage/default_avatars/salameche.png">Salamèche</option>
            </select>
        </div>
        <div>
            <label for="username">Username</label>
            <input type="text" name="username" value="<?php echo $_SESSION['user']['username'] ?>">
            <?php if (isset($errors['username_missing'])) { ?><span class="error" id="username_error"><?php echo $errors['username_missing'] ?? ''; ?></span><?php } ?>
        </div>
        <div>
            <label for="description">Description</label>
            <textarea name="description" id="description" rows="5"><?php echo $_SESSION['user']['description'] ?></textarea>
        </div>
        <div>
            <label for="email">Email</label>
            <input type="email" name="email" value="<?php echo $_SESSION['user']['email'] ?>">
            <?php if (isset($errors['email_missing'])) { ?><span class="error" id="email_error"><?php echo $errors['email_missing'] ?? ''; ?></span><?php } ?>
            <?php if (isset($errors['email_invalid'])) { ?><span class="error" id="email_invalid"><?php echo $errors['email_invalid'] ?? ''; ?></span><?php } ?>
        </div>
        <div>
            <label for="password">Modify your password</label>
            <input type="password" name="password">
            <?php if (isset($errors['password_identical'])) { ?><span class="error" id="password_identical"><?php echo $errors['password_identical'] ?? ''; ?></span><?php } ?>
        </div>
        <button type="submit" name="submit">Update</button>
    </form>

    <script>
        const img = document.getElementById("profile-img");
        const select = document.getElementById('avatar');
        select.addEventListener('change', function() {
            img.src = '.' + select.value;
        });
    </script>
</body>

</html>