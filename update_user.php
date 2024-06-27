<?php

include('./login-register/config.php');

session_start();

if (!isset($_POST['user_id'])) {
    die("User ID not provided.");
}

$userId = $_POST['user_id'];

try {
    $sql = "SELECT * FROM users WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(":id", $userId, PDO::PARAM_INT);
    $stmt->execute();

    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$user) {
        die("User not found.");
    }
} catch (PDOException $e) {
    die("Database error: " . $e->getMessage());
}

if (isset($_POST['submit'])) {
    $errors = [];
    $username = $_POST['username'] ?? '';
    $description = $_POST['description'] ?? null;
    $email = $_POST['email'] ?? '';
    $newPassword = $_POST['password'] ?? '';
    $avatar = $_POST['avatar'] ?? '';

    if ($username === '') {
        $errors['username_missing'] = 'The username is required. We have set it back to the original one.';
    }
    if ($email === '') {
        $errors['email_missing'] = 'The email address is required. We have set it back to the original one.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email_invalid'] = 'The email address is invalid. We have set it back to the original one.';
    }
    if (!empty($newPassword) && password_verify($newPassword, $user['password'])) {
        $errors['password_identical'] = 'The new password must be different than the previous one.';
    }

    if (empty($errors)) {
        try {
            if (!empty($newPassword)) {
                $password = password_hash($newPassword, PASSWORD_DEFAULT);
            } else {
                $password = $user['password'];
            }

            $sql = "UPDATE users SET username = :username, email = :email, password = :password, avatar = :avatar, description = :description WHERE id = :id";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(":username", $username);
            $stmt->bindParam(":email", $email);
            $stmt->bindParam(":password", $password);
            $stmt->bindParam(":avatar", $avatar);
            $stmt->bindParam(":description", $description);
            $stmt->bindParam(":id", $userId, PDO::PARAM_INT);
            $stmt->execute();

            header("Location: ./dashboard.php?update=success");
        } catch (PDOException $error) {
            die($error->getMessage());
        }
    } else {
        foreach ($errors as $error) {
            echo "<p>Error: $error</p>";
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
    <title>Update user - <?php echo htmlspecialchars($user['username']); ?></title>
</head>

<body class="body-backend">
    <nav>
        <a href="../index.php">Back to home</a>
    </nav>
    <form class="form-backend" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
        <h1>Update user - <?php echo htmlspecialchars($user['username']); ?></h1>
        <img src="<?php echo htmlspecialchars($user['avatar']); ?>" class="avatar-img" alt="avatar" id="profile-img">
        <div>
            <label for="avatar">Avatar</label>
            <select name="avatar" id="avatar">
                <option <?php echo $user['avatar'] === './storage/default_avatars/pikachu.png' ? 'selected' : ''; ?> value="./storage/default_avatars/pikachu.png">Pikachu</option>
                <option <?php echo $user['avatar'] === './storage/default_avatars/bulbizarre.png' ? 'selected' : ''; ?> value="./storage/default_avatars/bulbizarre.png">Bulbizarre</option>
                <option <?php echo $user['avatar'] === './storage/default_avatars/caninos.png' ? 'selected' : ''; ?> value="./storage/default_avatars/caninos.png">Caninos</option>
                <option <?php echo $user['avatar'] === './storage/default_avatars/carapuce.png' ? 'selected' : ''; ?> value="./storage/default_avatars/carapuce.png">Carapuce</option>
                <option <?php echo $user['avatar'] === './storage/default_avatars/goupix.png' ? 'selected' : ''; ?> value="./storage/default_avatars/goupix.png">Goupix</option>
                <option <?php echo $user['avatar'] === './storage/default_avatars/salameche.png' ? 'selected' : ''; ?> value="./storage/default_avatars/salameche.png">Salamèche</option>
            </select>
        </div>
        <div>
            <label for="username">Username</label>
            <input type="text" name="username" value="<?php echo htmlspecialchars($user['username']); ?>">
            <?php if (isset($errors['username_missing'])) { ?><span class="error" id="username_error"><?php echo htmlspecialchars($errors['username_missing']); ?></span><?php } ?>
        </div>
        <div>
            <label for="email">Email</label>
            <input type="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>">
            <?php if (isset($errors['email_missing'])) { ?><span class="error" id="email_error"><?php echo htmlspecialchars($errors['email_missing']); ?></span><?php } ?>
            <?php if (isset($errors['email_invalid'])) { ?><span class="error" id="email_invalid"><?php echo htmlspecialchars($errors['email_invalid']); ?></span><?php } ?>
        </div>
        <div>
            <label for="password">Modify their password</label>
            <input type="password" name="password">
            <?php if (isset($errors['password_identical'])) { ?><span class="error" id="password_identical"><?php echo htmlspecialchars($errors['password_identical']); ?></span><?php } ?>
        </div>
        <button type="submit" name="submit">Update</button>
        <input type="hidden" name="user_id" value="<?php echo htmlspecialchars($userId); ?>">
    </form>

    <script>
        const img = document.getElementById("profile-img");
        const select = document.getElementById('avatar');
        select.addEventListener('change', function() {
            img.src = select.value;
        });
    </script>
</body>

</html>
