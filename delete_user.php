<?php

include('./login-register/config.php');


$userId = $_POST['user_id'];

echo '<script>
        const userConfirmed = confirm("Are you sure you want to delete this user?");
        if (!userConfirmed) {
            window.location = "./dashboard.php";
        }
    </script>';

$userId = $_POST['user_id'];

try {
    $pdo->beginTransaction();

    $selectStmt = $pdo->prepare("SELECT * FROM users WHERE id = :id FOR UPDATE");
    $selectStmt->bindParam(':id', $userId, PDO::PARAM_INT);
    $selectStmt->execute();
    $user = $selectStmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        $deleteStmt = $pdo->prepare("DELETE FROM users WHERE id = :id");
        $deleteStmt->bindParam(':id', $userId, PDO::PARAM_INT);
        $deleteStmt->execute();

        $pdo->commit();
        header("Location: ./dashboard.php?delete_user=success");
    } else {
        $pdo->rollBack();
        echo "User not found.";
        exit;
    }
} catch (PDOException $e) {
    $pdo->rollBack();
    echo "Erreur lors de la suppression de l'utilisateur : " . $e->getMessage();
    exit;
}
