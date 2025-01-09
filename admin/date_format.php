<?php
date_default_timezone_set('Asia/Bangkok');

// ฟังก์ชันแปลงวันที่เป็นภาษาไทย
function thaiDate($dateTime)
{
    $thai_months = [
        "มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน",
        "กรกฎาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม"
    ];

    $thai_days = [
        "อาทิตย์", "จันทร์", "อังคาร", "พุธ", "พฤหัสบดี", "ศุกร์", "เสาร์"
    ];

    $timestamp = strtotime($dateTime); // แปลงวันที่เป็น timestamp
    $day = date("j", $timestamp); // วันที่
    $month = $thai_months[date("n", $timestamp) - 1]; // เดือนภาษาไทย
    $year = date("Y", $timestamp) + 543; // ปีพุทธศักราช
    $day_of_week = $thai_days[date("w", $timestamp)]; // วันในสัปดาห์
    $time = date("H:i:s", $timestamp); // เวลา
    $time = "เวลา " . $time;

    return "$day $month $year";
}

?>
