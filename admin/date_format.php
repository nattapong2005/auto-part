<?php
// ฟังก์ชันแปลงวันที่จากฐานข้อมูล (รูปแบบ 'Y-m-d H:i:s') เป็นภาษาไทย
function formatThaiDate($dateString) {
    // สร้างอ็อบเจ็กต์ DateTime จากวันที่
    $date = new DateTime($dateString, new DateTimeZone('UTC')); // ถ้าเวลาคือ UTC

    // ตั้งเวลาเป็นเขตเวลาในประเทศไทย (Asia/Bangkok)
    $date->setTimezone(new DateTimeZone('Asia/Bangkok'));

    // แสดงผลวันที่ในรูปแบบที่ต้องการ
    return $date->format('j F Y, H:i:s') . ' น.';
}
?>
