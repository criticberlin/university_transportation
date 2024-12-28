<?php
include 'db.php';  

$sql = "SELECT * FROM Reservations";
try {
    $stmt = $pdo->query($sql);

    if ($stmt->rowCount() > 0) {
        echo "<table border='1'>
                <tr>
                    <th>Reservation ID</th>
                    <th>User ID</th>
                    <th>Timing ID</th>
                    <th>Status</th>
                    <th>Reservation Date</th>
                </tr>";

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>
                    <td>" . htmlspecialchars($row['ReservationID'], ENT_QUOTES, 'UTF-8') . "</td>
                    <td>" . htmlspecialchars($row['UserID'], ENT_QUOTES, 'UTF-8') . "</td>
                    <td>" . htmlspecialchars($row['TimingID'], ENT_QUOTES, 'UTF-8') . "</td>
                    <td>" . htmlspecialchars($row['Status'], ENT_QUOTES, 'UTF-8') . "</td>
                    <td>" . htmlspecialchars($row['ReservationDate'], ENT_QUOTES, 'UTF-8') . "</td>
                  </tr>";
        }
        echo "</table>";
    } else {
        echo "No reservations found";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
