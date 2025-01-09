<?php
include '../db.php';
include '../fpdf/fpdf.php';
include 'date_format.php';

$id = $_GET['id'];

// ดึงข้อมูลจากฐานข้อมูล
$sql = "
    SELECT 
        requests.id as req_id,
        requests.user_id,
        requests.dates,
        requests.status,
        request_details.request_id,
        request_details.part_id,
        request_details.amount,
        request_details.id as req_detail_id,
        parts.name AS part_name,
        users.name AS user_name,
        users.lastname,
        departments.name as dname
    FROM 
        requests
    JOIN 
        request_details ON requests.id = request_details.request_id
    JOIN 
        parts ON request_details.part_id = parts.id
    JOIN 
        users ON requests.user_id = users.id
    JOIN departments ON users.department_id = departments.id
    WHERE 
        requests.id =  $id
";

$sqlUser = "SELECT users.name,users.lastname,departments.name as dname FROM users
JOIN requests ON users.id = requests.user_id
JOIN departments ON users.department_id = departments.id
WHERE requests.id = $id";
$queryUser = mysqli_query($conn,$sqlUser);
$rowUser = mysqli_fetch_array($queryUser);

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $pdf = new FPDF();
    $pdf->AddPage();
    $pdf->AddFont('sarabun', '', 'THSarabunNew.php');
    $pdf->AddFont('sarabun', 'B', 'THSarabunNew_b.php');
    $pdf->SetFont('sarabun', '', 16);

    // หัวข้อเอกสาร
    $pdf->SetFont('sarabun', 'B', 24);
    $pdf->Cell(0, 10, iconv('UTF-8', 'TIS-620', 'รายงานการเบิกอะไหล่'), 0, 1, 'L');
    $pdf->SetFont('sarabun', '', 17);
    $pdf->Cell(0, 5, iconv('UTF-8', 'TIS-620', "ผู้เบิก $rowUser[name] $rowUser[lastname] แผนก $rowUser[dname]"), 0, 1, 'L');
    $pdf->Ln(5);

    // หัวตาราง - ปรับขนาดคอลัมน์ให้เหมาะสม
    $pdf->SetFont('sarabun', 'B', 14);
    $pdf->SetFillColor(255, 255, 255); // สีพื้นหลังขาว

    $pdf->Cell(30, 10, iconv('UTF-8', 'TIS-620', 'ลำดับ'), 1, 0, 'C', true);
    $pdf->Cell(80, 10, iconv('UTF-8', 'TIS-620', 'รายการ'), 1, 0, 'C', true);
    $pdf->Cell(30, 10, iconv('UTF-8', 'TIS-620', 'จำนวน'), 1, 0, 'C', true);
    $pdf->Cell(50, 10, iconv('UTF-8', 'TIS-620', 'วันที่'), 1, 1, 'C', true);

    // เติมข้อมูลในตาราง - ปรับให้อ่านง่ายขึ้น
    $pdf->SetFont('sarabun', '', 14);
    $pdf->SetTextColor(0, 0, 0); // สีข้อความดำ
    $index = 1;
    while ($row = $result->fetch_assoc()) {
        $pdf->Cell(30, 10, iconv('UTF-8', 'TIS-620', $index), 1, 0, 'C');
        $pdf->Cell(80, 10, iconv('UTF-8', 'TIS-620', $row['part_name']), 1, 0, 'L');
        $pdf->Cell(30, 10, iconv('UTF-8', 'TIS-620', $row['amount']), 1, 0, 'C');
        $pdf->Cell(50, 10, iconv('UTF-8', 'TIS-620', thaiDate($row['dates'])), 1, 1, 'C');

        $index++;
    }

    $pdf->Output('I', 'report.pdf'); // ใช้ 'I' เพื่อเปิดในเบราว์เซอร์
} else {
    echo "ไม่มีข้อมูล";
}
