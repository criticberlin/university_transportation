<?php
session_start();

// التأكد من أن المستخدم هو المسؤول فقط
if (!isset($_SESSION['UserID']) || $_SESSION['UserType'] != 'Administrator') {
    header("Location: login.html");
    exit();
}

include 'db.php';

// التأكد من أن المعرف (ID) للرحلة موجود في الرابط
if (!isset($_GET['tripID']) || empty($_GET['tripID'])) {
    echo "Invalid Trip ID.";
    exit();
}

$tripID = $_GET['tripID'];

try {
    // تعطيل التحقق من القيود الخارجية أثناء الحذف
    $pdo->exec("SET FOREIGN_KEY_CHECKS=0");

    // حذف الأحداث المرتبطة بالرحلة من جدول TripEventTypes
    $sqlEventTypes = "DELETE FROM TripEventTypes WHERE TripID = :tripID";
    $stmtEventTypes = $pdo->prepare($sqlEventTypes);
    $stmtEventTypes->execute([':tripID' => $tripID]);

    // حذف الرحلة نفسها من جدول Trips
    $sqlTrip = "DELETE FROM Trips WHERE TripID = :tripID";
    $stmtTrip = $pdo->prepare($sqlTrip);
    $stmtTrip->execute([':tripID' => $tripID]);

    // إعادة تفعيل التحقق من القيود الخارجية
    $pdo->exec("SET FOREIGN_KEY_CHECKS=1");

    // إعادة توجيه المستخدم إلى صفحة إدارة الرحلات مع إشعار الحذف
    header("Location: manage_trips.php?status=deleted");
    exit();
} catch (PDOException $e) {
    // في حالة حدوث خطأ، يتم إظهار رسالة الخطأ
    echo "Error: " . $e->getMessage();
    exit();
}
?>
