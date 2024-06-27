<?php

include('./login-register/config.php');

$userId = $_POST['user_id'];
$forcedPassword = '123456789';
$hashedPassword = password_hash($forcedPassword, PASSWORD_DEFAULT);

try {
    $pdo->beginTransaction();

    $selectStmt = $pdo->prepare("SELECT * FROM users WHERE id = :id FOR UPDATE");
    $selectStmt->bindParam(':id', $userId, PDO::PARAM_INT);
    $selectStmt->execute();
    $user = $selectStmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        $updateStmt = $pdo->prepare("UPDATE users SET password = :password WHERE id = :id");
        $updateStmt->bindParam(':password', $hashedPassword);
        $updateStmt->bindParam(':id', $userId, PDO::PARAM_INT);
        $updateStmt->execute();

        $pdo->commit();
        header("Location: ./dashboard.php?forced_password=success");
    } else {
        $pdo->rollBack();
        echo "Utilisateur non trouvé.";
    }
} catch (PDOException $e) {
    $pdo->rollBack();
    print_r($e->getMessage());
}

?>