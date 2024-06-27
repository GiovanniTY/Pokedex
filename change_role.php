<?php

include('./login-register/config.php');

$userId = $_POST['user_id'];
$newRole = $_POST['user_role'];

try {
    $pdo->beginTransaction();

    // Prépare et exécute la sélection avec verrouillage
    $selectStmt = $pdo->prepare("SELECT * FROM users WHERE id = :id FOR UPDATE");
    $selectStmt->bindParam(':id', $userId, PDO::PARAM_INT);
    $selectStmt->execute();
    $user = $selectStmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        $updateStmt = $pdo->prepare("UPDATE users SET role = :role WHERE id = :id");
        $updateStmt->bindParam(':role', $newRole);
        $updateStmt->bindParam(':id', $userId, PDO::PARAM_INT);
        $updateStmt->execute();

        $pdo->commit();
        header("Location: ./dashboard.php");
    } else {
        $pdo->rollBack();
        echo "Utilisateur non trouvé.";
    }
} catch (PDOException $e) {
    $pdo->rollBack();
    print_r($e->getMessage());
}