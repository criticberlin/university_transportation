<?php
session_start();

// التحقق من الصلاحيات
if (!isset($_SESSION['UserID']) || $_SESSION['UserType'] != 'Administrator') {
    header("Location: login.html");
    exit();
}


include 'db.php'; 

echo "<h1>View Messages</h1>";

$sql = "SELECT Communication.MessageID, Sender.FullName AS SenderName, Receiver.FullName AS ReceiverName, Communication.MessageText, Communication.SentDate
        FROM Communication
        JOIN Users AS Sender ON Communication.SenderID = Sender.UserID
        JOIN Users AS Receiver ON Communication.ReceiverID = Receiver.UserID";

$result = $pdo->query($sql);

if ($result->rowCount() > 0) {
    echo "<table border='1'>
            <tr>
                <th>Message ID</th>
                <th>Sender</th>
                <th>Receiver</th>
                <th>Message</th>
                <th>Sent Date</th>
            </tr>";
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr>
                <td>{$row['MessageID']}</td>
                <td>{$row['SenderName']}</td>
                <td>{$row['ReceiverName']}</td>
                <td>{$row['MessageText']}</td>
                <td>{$row['SentDate']}</td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "No messages found.";
}
