<?php
session_start();
if (!isset($_SESSION['UserID']) || $_SESSION['UserType'] != 'Administrator') {
    header("Location: login.php");
    exit();
}

include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fullName = $_POST['FullName'];
    $email = $_POST['Email'];
    $phoneNumber = $_POST['PhoneNumber'];
    $userType = $_POST['UserType'];
    $password = password_hash($_POST['Password'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO Users (FullName, Email, PhoneNumber, UserType, PasswordHash) VALUES (:fullName, :email, :phoneNumber, :userType, :password)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':fullName' => $fullName,
        ':email' => $email,
        ':phoneNumber' => $phoneNumber,
        ':userType' => $userType,
        ':password' => $password,
    ]);

    header("Location: manage_users.php");
    exit();
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Add User</title>
    <style>
        :root {
            --primary-color: #4CAF50;
            /* Green */
            --secondary-color: #45A049;
            /* Darker Green */
            --background-dark: #1E1E1E;
            /* Dark Gray */
            --background-light: #2C2C2C;
            /* Lighter Gray */
            --text-color: #FFFFFF;
            /* White */
            --card-shadow-color: rgba(0, 0, 0, 0.2);
            --highlight-color: #FFFFFF;
            /* White */
        }

        body {
            margin: 0;
            font-family: "Poppins", sans-serif;
            background: var(--background-dark);
            color: var(--text-color);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .container {
            background: var(--background-light);
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            /* Subtle shadow */
            padding: 30px;
            width: 400px;
            /* Adjust width as needed */
        }

        h1 {
            color: var(--primary-color);
            text-align: center;
            margin-bottom: 30px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table th,
        table td {
            padding: 12px 15px;
            text-align: left;
            color: var(--text-color);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            /* Subtle border */
        }

        table th {
            background: var(--secondary-color);
            color: var(--highlight-color);
        }

        .btn {
            background-color: var(--primary-color);
            color: var(--highlight-color);
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn:hover {
            background-color: var(--secondary-color);
        }
    </style>

</head>

<body>
    <div class="container">
        <h1>Add New User</h1>

        <form action="add_user.php" method="post">
            <table border="0">
                <tr>
                    <th>Full Name:</th>
                    <td><input type="text" name="FullName" required></td>
                </tr>
                <tr>
                    <th>Email:</th>
                    <td><input type="email" name="Email" required></td>
                </tr>
                <tr>
                    <th>Phone Number:</th>
                    <td><input type="tel" name="PhoneNumber" required></td>
                </tr>
                <tr>
                    <th>User Type:</th>
                    <td>
                        <select name="UserType" required>
                            <option value="Administrator">Administrator</option>
                            <option value="User">User</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th>Password:</th>
                    <td><input type="password" name="Password" required></td>
                </tr>
            </table>
            <br>
            <button type="submit" class="btn">Add User</button>
        </form>
    </div>
</body>

</html>