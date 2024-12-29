<?php
include 'db.php';  

$sql = "
    SELECT 
        ER.EventReservationID AS ReservationID,
        U.FullName AS UserName, 
        T.EventName AS EventName,
        T.EventDate AS EventDate,
        Rt.StartPoint,
        Rt.EndPoint,
        ER.Status,
        ER.ReservationDate
    FROM eventreservations ER
    INNER JOIN Users U ON ER.UserID = U.UserID
    INNER JOIN Trips T ON ER.TripID = T.TripID
    INNER JOIN Routes Rt ON T.RouteID = Rt.RouteID
";

try {
    $stmt = $pdo->query($sql);

    if ($stmt->rowCount() > 0) {
        echo "<table border='1'>
                <tr>
                    <th>Reservation ID</th>
                    <th>User Name</th>
                    <th>Event Name</th>
                    <th>Event Date</th>
                    <th>Route</th>
                    <th>Status</th>
                    <th>Reservation Date</th>
                </tr>";

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>
                    <td>" . htmlspecialchars($row['ReservationID'], ENT_QUOTES, 'UTF-8') . "</td>
                    <td>" . htmlspecialchars($row['UserName'], ENT_QUOTES, 'UTF-8') . "</td>
                    <td>" . htmlspecialchars($row['EventName'], ENT_QUOTES, 'UTF-8') . "</td>
                    <td>" . htmlspecialchars($row['EventDate'], ENT_QUOTES, 'UTF-8') . "</td>
                    <td>" . htmlspecialchars($row['StartPoint'], ENT_QUOTES, 'UTF-8') . " → " . htmlspecialchars($row['EndPoint'], ENT_QUOTES, 'UTF-8') . "</td>
                    <td>" . htmlspecialchars($row['Status'], ENT_QUOTES, 'UTF-8') . "</td>
                    <td>" . htmlspecialchars($row['ReservationDate'], ENT_QUOTES, 'UTF-8') . "</td>
                  </tr>";
        }
        echo "</table>";
    } else {
        echo "No reservations found.";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
