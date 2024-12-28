<?php
session_start();
if (!isset($_SESSION['UserID']) || $_SESSION['UserType'] != 'Administrator') {
    header("Location: login.html");
    exit();
}

include 'db.php';

// جلب المستخدمين من نوع "Student"
$stmt = $pdo->query("SELECT * FROM Users WHERE UserType = 'Student'");
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Users</title>
    <style>
        :root {
            --primary-color: #4CAF50;
            --secondary-color: #45A049;
            --background-dark: #1E1E1E;
            --background-light: #2C2C2C;
            --text-color: #FFFFFF;
            --card-shadow-color: rgba(0, 0, 0, 0.2);
            --highlight-color: #FFFFFF;
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
            width: 100%;
            max-width: 1200px;
            padding: 20px;
            background: var(--background-light);
            box-shadow: 0 5px 25px var(--card-shadow-color);
            border-radius: 15px;
            text-align: center;
        }

        h1 {
            font-size: 2.5em;
            font-weight: bold;
            color: var(--primary-color);
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            background: var(--background-dark);
            border-radius: 10px;
            overflow: hidden;
        }

        table th,
        table td {
            padding: 15px;
            text-align: left;
            color: var(--text-color);
        }

        table th {
            background: var(--primary-color);
            color: var(--highlight-color);
            font-weight: bold;
        }

        table tr:nth-child(even) {
            background: var(--background-light);
        }

        .btn {
            display: inline-block;
            padding: 10px 20px;
            margin: 10px 0;
            font-size: 1em;
            font-weight: bold;
            color: var(--highlight-color);
            background: var(--primary-color);
            border: none;
            border-radius: 10px;
            text-decoration: none;
            cursor: pointer;
        }

        .editable {
            background-color: rgb(207, 190, 190);
            border: 1px solid #ddd;
            cursor: text;
            /* لإظهار مؤشر الكتابة */
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Manage Users</h1>
        <table>
            <thead>
                <tr>
                    <th>UserID</th>
                    <th>FullName</th>
                    <th>Email</th>
                    <th>PhoneNumber</th>
                    <th>DateJoined</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user): ?>
                    <tr data-userid="<?php echo $user['UserID']; ?>">
                        <td><?php echo htmlspecialchars($user['UserID']); ?></td>
                        <td contenteditable="false" class="user-name"><?php echo htmlspecialchars($user['FullName']); ?>
                        </td>
                        <td contenteditable="false" class="user-email"><?php echo htmlspecialchars($user['Email']); ?></td>
                        <td contenteditable="false" class="user-phone"><?php echo htmlspecialchars($user['PhoneNumber']); ?>
                        </td>
                        <td><?php echo htmlspecialchars($user['DateJoined']); ?></td>
                        <td>
                            <a href="delete_user.php?id=<?php echo $user['UserID']; ?>"
                                onclick="return confirm('Are you sure you want to delete this user?')"
                                class="btn">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>

        </table>

        <div>
            <a class="btn" href="add_user.php">Add New User</a>
            <a class="btn" href="admin.php">Back to Dashboard</a>
        </div>
    </div>

    <script>
        const table = document.querySelector('table');
        let selectedRow = null;

        table.addEventListener('click', (event) => {
            const row = event.target.closest('tr');
            if (row) {
                if (selectedRow) {
                    makeCellsUneditable(selectedRow);
                }
                selectedRow = row;
                makeCellsEditable(selectedRow);
                selectedRow.querySelector('.user-name').focus(); // التركيز على أول خلية
            }
        });

        function makeCellsEditable(row) {
            const editableCells = row.querySelectorAll('.user-name, .user-email, .user-phone');
            editableCells.forEach(cell => {
                cell.contentEditable = 'true';
                cell.classList.add('editable');
            });
        }

        function makeCellsEditable(row) {
            const editableCells = row.querySelectorAll('.user-name, .user-email, .user-phone');
            editableCells.forEach(cell => {
                cell.contentEditable = 'true';
                cell.classList.add('editable');
                cell.focus(); // جعل التركيز مباشرة على الخلية القابلة للتحرير
            });
        }

        document.addEventListener('keydown', (event) => {
            if (event.key === 'Enter' && selectedRow) {
                event.preventDefault();
                const userId = selectedRow.dataset.userid;
                const fullName = selectedRow.querySelector('.user-name').textContent.trim();
                const email = selectedRow.querySelector('.user-email').textContent.trim();
                const phone = selectedRow.querySelector('.user-phone').textContent.trim();

                fetch('update_user.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ userId, fullName, email, phone })
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            alert('Changes saved successfully!');
                            makeCellsUneditable(selectedRow);
                        } else {
                            alert(`Error: ${data.message}`);
                        }
                    })
                    .catch(error => {
                        console.error(error);
                        alert('Error saving changes.');
                    });
            }
        });

        fetch('update_user.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                userId: userId,
                fullName: userName,
                email: userEmail,
                phone: userPhone
            })
        })
            .then(response => response.json())
            .then(data => {
                console.log(data); // عرض الرد في الكونسول
                if (data.success) {
                    alert('Changes saved successfully!');
                    makeCellsUneditable(selectedRow);
                } else {
                    alert(`Error: ${data.message || 'Unknown error occurred.'}`); // عرض الرسالة المرسلة من PHP
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred while saving changes.');
            });

    </script>
</body>

</html>