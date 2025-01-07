<?php
session_start();

// ตรวจสอบว่ามีการส่ง ID ของสินค้าเข้ามาหรือไม่
if (isset($_GET['id'])) {
    $part_id = $_GET['id'];

    // ตรวจสอบว่า session cart มีสินค้านั้นอยู่หรือไม่
    if (isset($_SESSION['cart'][$part_id])) {
        unset($_SESSION['cart'][$part_id]); // ลบสินค้าออกจาก cart

        // หากตะกร้าว่างเปล่า ให้ลบ session cart
        if (empty($_SESSION['cart'])) {
            unset($_SESSION['cart']);
        }
    }
}

// กลับไปยังหน้าหลักหลังจากลบสินค้า
header("Location: index.php");
exit;
?>
