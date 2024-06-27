<?php

include('./login-register/config.php');

session_start();

if (isset($_GET['role_changed']) && $_GET['role_changed'] === 'success') {
    echo '<script>alert("Role changed successfully.")</script>';
}

if (isset($_GET['forced_password']) && $_GET['forced_password'] === 'success') {
    echo '<script>alert("Password has been successfully forced.")</script>';
}

if (isset($_GET['update']) && $_GET['update'] === 'success') {
    echo '<script>alert("User successfully updated.")</script>';
}

if (isset($_GET['delete_user']) && $_GET['delete_user'] === 'success') {
    echo '<script>alert("User successfully deleted.")</script>';
}

$users = [];

try {
    $sql = "SELECT * FROM users";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    print_r($e->getMessage());
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/style.css">
    <title>Dashboard</title>
</head>

<body class="body-backend">
    <nav>
        <a href="./index.php">Return to homepage</a>
    </nav>
    <main class="main-dashboard">
        <h1>Dashboard</h1>

        <article class="article-dashboard">
            <ul>
                <li>Avatar</li>
                <li>Username</li>
                <li>Email address</li>
                <li>Password</li>
                <li>Role</li>
                <li>Actions</li>
            </ul>
            <?php
            foreach ($users as $user) { ?>
                <ul>
                    <li><img src="<?php echo $user['avatar'] ?>" /></li>
                    <li><?php echo $user['username'] ?></li>
                    <li><?php echo $user['email'] ?></li>
                    <li>
                        <form action="force_password.php" method="POST">
                            <input name="user_id" type="hidden" value="<?php echo $user['id'] ?>">
                            <button type="submit" name="force_password">Force password</button>
                        </form>
                    </li>
                    <li>
                        <form action="change_role.php" method="POST">
                            <input type="hidden" name="user_id" value="<?php echo $user['id'] ?>">
                            <select id="user_role" name="user_role" onchange="this.form.submit()">
                                <option <?php echo $user['role'] === 'admin' ? 'selected' : '' ?> value="admin">Admin</option>
                                <option <?php echo $user['role'] === 'user' ? 'selected' : '' ?> value="user">User</option>
                            </select>
                        </form>
                    </li>
                    <li class="li-actions">
                        <form action="update_user.php" method="POST">
                            <input type="hidden" name="user_id" value="<?php echo $user['id'] ?>">
                            <button type="submit" name="edit_user">Edit user</button>
                        </form>
                        <form action="delete_user.php" method="POST">
                            <input type="hidden" name="user_id" value="<?php echo $user['id'] ?>">
                            <button type="submit" name="delete_user">Delete user</button>
                        </form>
                    </li>
                </ul>
            <?php  }

            ?>
        </article>
    </main>

</body>

</html>