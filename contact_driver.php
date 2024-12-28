<?php
session_start();
if (!isset($_SESSION['UserID']) || $_SESSION['UserType'] != 'Student') {
    header("Location: login.html");
    exit();
}

include 'db.php';

$userID = $_SESSION['UserID'];


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['driver_id'], $_POST['message'])) {
    $driverID = $_POST['driver_id'];
    $message = trim($_POST['message']);

    if (!empty($message)) {

        $stmt = $pdo->prepare("
            INSERT INTO Communication (SenderID, ReceiverID, MessageText, SentDate)
            VALUES (?, ?, ?, NOW())
        ");
        if ($stmt->execute([$userID, $driverID, $message])) {
            $success = "Message sent successfully.";
        } else {
            $error = "Failed to send the message.";
        }
    } else {
        $error = "Message cannot be empty.";
    }
}


$stmt = $pdo->prepare("
       SELECT 
        ER.EventReservationID,
        T.EventName,
        T.EventDate,
        Rt.StartPoint,
        Rt.EndPoint,
        B.PlateNumber AS BusPlateNumber,
        D.UserID AS DriverID,
        D.FullName AS DriverName,
        D.Email AS DriverEmail
    FROM EventReservations ER
    INNER JOIN Trips T ON ER.TripID = T.TripID
    INNER JOIN Routes Rt ON T.RouteID = Rt.RouteID
    INNER JOIN Buses B ON T.BusID = B.BusID
    INNER JOIN Users D ON D.UserID = T.BusID
    WHERE ER.UserID = ?
");

$stmt->execute([$userID]);
$reservations = $stmt->fetchAll(PDO::FETCH_ASSOC);


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
$stmt->execute([$userID]);
$driverMessages = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Driver</title>
</head>

<body>

    <h1>Contact Driver</h1>


    <?php if (isset($success)): ?>
        <p style="color: green;"><?= htmlspecialchars($success) ?></p>
    <?php endif; ?>
    <?php if (isset($error)): ?>
        <p style="color: red;"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>


    <h2>Your Reservations</h2>
    <?php if (count($reservations) > 0): ?>
        <table border="1">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Event Name</th>
                    <th>Event Date</th>
                    <th>Route</th>
                    <th>Bus Plate</th>
                    <th>Driver</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($reservations as $index => $reservation): ?>
                    <tr>
                        <td><?= $index + 1 ?></td>
                        <td><?= htmlspecialchars($reservation['EventName']) ?></td>
                        <td><?= htmlspecialchars($reservation['EventDate']) ?></td>
                        <td><?= htmlspecialchars($reservation['StartPoint']) ?> →
                            <?= htmlspecialchars($reservation['EndPoint']) ?>
                        </td>
                        <td><?= htmlspecialchars($reservation['BusPlateNumber']) ?></td>
                        <td>
                            <?= htmlspecialchars($reservation['DriverName']) ?> <br>
                            <small><?= htmlspecialchars($reservation['DriverEmail']) ?></small>
                        </td>
                        <td>
                            <form method="POST">
                                <input type="hidden" name="driver_id" value="<?= $reservation['DriverID'] ?>">
                                <textarea name="message" placeholder="Write your message" rows="3" required></textarea>
                                <button type="submit">Send</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No reservations found.</p>
    <?php endif; ?>


    <h2>Messages from Drivers</h2>
    <?php if (count($driverMessages) > 0): ?>
        <table border="1">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Driver</th>
                    <th>Message</th>
                    <th>Sent Date</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($driverMessages as $index => $message): ?>
                    <tr>
                        <td><?= $index + 1 ?></td>
                        <td><?= htmlspecialchars($message['SenderName']) ?>
                            <br><small><?= htmlspecialchars($message['SenderEmail']) ?></small>
                        </td>
                        <td><?= htmlspecialchars($message['MessageText']) ?></td>
                        <td><?= htmlspecialchars($message['SentDate']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No messages from drivers.</p>
    <?php endif; ?>

</body>

</html>