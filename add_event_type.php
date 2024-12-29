<?php
session_start();

// التأكد من أن المستخدم لديه صلاحية أدمن
if (!isset($_SESSION['UserID']) || $_SESSION['UserType'] != 'Administrator') {
    header("Location: login.php"); // إعادة توجيه إذا لم يكن أدمن
    exit();
}

include 'db.php'; // تضمين الاتصال بقاعدة البيانات

// التحقق إذا كانت الصفحة تم الوصول إليها عبر POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $eventTypeName = $_POST['EventTypeName']; // جلب اسم نوع الحدث من النموذج

    // التحقق إذا كان اسم نوع الحدث غير فارغ
    if (!empty($eventTypeName)) {
        // إدخال نوع الحدث في قاعدة البيانات
        $sql = "INSERT INTO EventTypes (EventTypeName) VALUES (?)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(1, $eventTypeName, PDO::PARAM_STR); // ربط البيانات في الاستعلام

        if ($stmt->execute()) {
            echo "Event Type added successfully!"; // رسالة نجاح
        } else {
            echo "Error adding Event Type: " . $stmt->errorInfo()[2]; // في حالة حدوث خطأ
        }
    } else {
        echo "Please enter an Event Type name."; // رسالة إذا لم يتم إدخال اسم نوع الحدث
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Event Type</title>
</head>
<body>
    <h1>Add New Event Type</h1>
    <form method="POST">
        <label>Event Type Name:</label>
        <input type="text" name="EventTypeName" required><br><br>
        <button type="submit">Add Event Type</button>
    </form>
    <br>
    <a href="manage_trips.php">Back to Manage Trips</a>
</body>
</html>
