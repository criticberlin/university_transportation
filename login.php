<?php
session_start();
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM Users WHERE Email = :email";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['PasswordHash'])) {  // Use this line
    // if ($user && $user['PasswordHash'] == $password) {  // Remove or comment out this line

        $_SESSION['UserID'] = $user['UserID'];
        $_SESSION['FullName'] = $user['FullName'];
        $_SESSION['UserType'] = $user['UserType'];

        switch ($user['UserType']) {
            case 'Administrator':
                header("Location: admin.php");
                break;
            case 'Student':
                header("Location: students.php");
                break;
            case 'Driver':
                header("Location: drivers.php");
                break;
            default:
                echo "Invalid user type.";
        }
        exit();
    } else {
        echo "Invalid email or password.";
    }
}
?>