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
        echo "<div class='table-container'>
                <table class='styled-table'>
                <thead>
                    <tr>
                        <th>Reservation ID</th>
                        <th>User Name</th>
                        <th>Event Name</th>
                        <th>Event Date</th>
                        <th>Route</th>
                        <th>Status</th>
                        <th>Reservation Date</th>
                    </tr>
                </thead>
                <tbody>";

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
        echo "</tbody>
              </table>
            </div>";
    } else {
        echo "<p>No reservations found.</p>";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>

<!-- CSS -->
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        margin: 0;
        padding: 20px;
    }

    .table-container {
        max-width: 1200px;
        margin: auto;
        padding: 20px;
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .styled-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    .styled-table th, .styled-table td {
        padding: 10px;
        text-align: left;
        border: 1px solid #ddd;
    }

    .styled-table th {
        background-color: #4CAF50;
        color: white;
    }

    .styled-table tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    .styled-table tr:hover {
        background-color: #ddd;
    }

    .styled-table td {
        font-size: 14px;
        color: #333;
    }

    p {
        text-align: center;
        font-size: 16px;
        color: #333;
    }
</style>
