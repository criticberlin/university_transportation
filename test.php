<?php
include 'db.php';  
session_start();

if (!isset($_SESSION['UserID']) || $_SESSION['UserType'] != 'Student') {
    header("Location: login.html");
    exit();
}

$userID = $_SESSION['UserID'];

$stmt = $pdo->prepare("
    SELECT 
        ER.EventReservationID,
        ER.ReservationDate,
        ER.Status,
        T.EventName,  -- تأكد من أن العمود المناسب موجود في الجدول المناسب
        T.EventDate,  -- تأكد من أن العمود المناسب موجود في الجدول المناسب
        Rt.StartPoint,
        Rt.EndPoint,
        B.PlateNumber AS BusPlateNumber
    FROM eventreservations ER
    INNER JOIN trips T ON ER.TripID = T.TripID
    INNER JOIN routes Rt ON T.RouteID = Rt.RouteID
    INNER JOIN buses B ON T.BusID = B.BusID
    WHERE ER.UserID = ? 
    ORDER BY ER.ReservationDate DESC
");
$stmt->execute([$userID]);
$reservations = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Reservations</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <h1>My Reservations</h1>

    <?php if (isset($message)): ?>
        <p style="color: green;"><?= htmlspecialchars($message) ?></p>
    <?php endif; ?>
    <?php if (isset($error)): ?>
        <p style="color: red;"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>

    <?php if (count($reservations) > 0): ?>
        <table border="1" cellpadding="10" cellspacing="0">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Event Name</th>
                    <th>Event Date</th>
                    <th>Route</th>
                    <th>Bus Plate</th>
                    <th>Reservation Date</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($reservations as $index => $reservation): ?>
                    <tr>
                        <td><?= $index + 1 ?></td>
                        <td><?= htmlspecialchars($reservation['EventName']) ?></td>
                        <td><?= htmlspecialchars($reservation['EventDate']) ?></td>
                        <td><?= htmlspecialchars($reservation['StartPoint']) ?> → <?= htmlspecialchars($reservation['EndPoint']) ?></td>
                        <td><?= htmlspecialchars($reservation['BusPlateNumber']) ?></td>
                        <td><?= htmlspecialchars($reservation['ReservationDate']) ?></td>
                        <td><?= htmlspecialchars($reservation['Status']) ?></td>
                        <td>
                            <?php if ($reservation['Status'] === 'Confirmed'): ?>
                                <form action="" method="POST" style="display:inline;">
                                    <input type="hidden" name="reservation_id" value="<?= $reservation['EventReservationID'] ?>">
                                    <button type="submit" onclick="return confirm('Are you sure you want to cancel this reservation?')">Cancel</button>
                                </form>
                            <?php else: ?>
                                <span>Not Cancelable</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>You have no reservations yet.</p>
    <?php endif; ?>
</body>

</html>
