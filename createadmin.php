<?php
try {
    $pdo = new PDO("mysql:host=localhost;dbname=university_transportation", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $password = "admin123";
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (FullName, Email, PhoneNumber, UserType, PasswordHash, DateJoined) 
            VALUES (
                'Mohaned User', 
                'admin@university.edu', 
                '1234567890', 
                'Administrator', 
                :hashedPassword,
                CURRENT_TIMESTAMP
            )";

    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':hashedPassword', $hashedPassword);
    $stmt->execute();

    echo "Admin user created successfully!";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>