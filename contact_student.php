<?php
session_start();
if (!isset($_SESSION['UserID']) || $_SESSION['UserType'] != 'Driver') {
    header("Location: login.html");
    exit();
}

include 'db.php';

$driverID = $_SESSION['UserID'];

$stmt = $pdo->prepare("
    SELECT 
        C.MessageID,
        C.SenderID,
        C.MessageText,
        C.SentDate,
        U.FullName AS SenderName,
        U.Email AS SenderEmail
    FROM Communication C
    INNER JOIN Users U ON C.SenderID = U.UserID
    WHERE C.ReceiverID = ?
    ORDER BY C.SentDate DESC
");
$stmt->execute([$driverID]);
$messages = $stmt->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['reply_message'], $_POST['message_id'], $_POST['sender_id'])) {
    $replyMessage = trim($_POST['reply_message']);
    $messageID = (int)$_POST['message_id'];
    $senderID = (int)$_POST['sender_id'];

    if (!empty($replyMessage)) {
        $stmt = $pdo->prepare("
            INSERT INTO Communication (SenderID, ReceiverID, MessageText, SentDate)
            VALUES (?, ?, ?, NOW())
        ");
        if ($stmt->execute([$driverID, $senderID, $replyMessage])) {
            $success = "Reply sent successfully.";
        } else {
            $error = "Failed to send the reply.";
        }
    } else {
        $error = "Reply message cannot be empty.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Driver Messages</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .container {
            width: 60%;
            margin: auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            background-color: #f9f9f9;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table,
        th,
        td {
            border: 1px solid #ddd;
        }

        th,
        td {
            padding: 10px;
            text-align: left;
        }

        .message {
            padding: 10px;
            background-color: #f1f1f1;
            margin-bottom: 15px;
        }

        .sender {
            font-weight: bold;
        }

        .date {
            font-size: 0.8em;
            color: gray;
        }

        .reply-form {
            margin-top: 20px;
        }

        .error {
            color: red;
        }

        .success {
            color: green;
        }

        a {
            text-decoration: none;
            color: blue;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Messages for You</h1>

        <?php if (isset($success)): ?>
            <p class="success"><?= htmlspecialchars($success) ?></p>
        <?php endif; ?>
        <?php if (isset($error)): ?>
            <p class="error"><?= htmlspecialchars($error) ?></p>
        <?php endif; ?>

        <?php if (count($messages) > 0): ?>
            <table>
                <thead>
                    <tr>
                        <th>Sender</th>
                        <th>Message</th>
                        <th>Date</th>
                        <th>Reply</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($messages as $message): ?>
                        <tr>
                            <td><?= htmlspecialchars($message['SenderName']) ?> <br> <small><?= htmlspecialchars($message['SenderEmail']) ?></small></td>
                            <td><?= htmlspecialchars($message['MessageText']) ?></td>
                            <td><?= htmlspecialchars($message['SentDate']) ?></td>
                            <td>
                                <form method="POST" class="reply-form">
                                    <input type="hidden" name="message_id" value="<?= $message['MessageID'] ?>">
                                    <input type="hidden" name="sender_id" value="<?= $message['SenderID'] ?>">
                                    <textarea name="reply_message" placeholder="Write your reply" rows="3" required></textarea><br><br>
                                    <button type="submit">Send Reply</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No messages found.</p>
        <?php endif; ?>

        <p><a href="drivers.php">Back to Dashboard</a></p>
    </div>
</body>

</html>