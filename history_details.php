<?php

$id = $_GET['id'];

$sqlCheck = "SELECT * FROM requests WHERE id = $id";
$queryCheck = mysqli_query($conn, $sqlCheck);
$rowCheck = mysqli_fetch_array($queryCheck);
$statusCheck = $rowCheck['status'];

?>

<div class="row mb-4 d-flex justify-content-center g-0">
    <div class="col-md-12 bg-white shadow p-3">
        <div class="d-flex justify-content-between align-items-center mb-2">
            <h3>รายละเอียด</h3>
            <a class="text-dark" href="?page=history"><i class="bi bi-arrow-left-short fs-3"></i></a>
        </div>
        <div class="table-responsive">
            <table class="table table-hover" id="list">
                <thead>
                    <tr>
                        <th>ลำดับ</th>
                        <th>รายการ</th>
                        <th>จำนวน</th>
                        <th>วันที่</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $count = 0;
                    $sql = "SELECT 
                    requests.id as req_id,
                    requests.user_id,
                    requests.dates,
                    requests.status,
                    request_details.request_id,
                    request_details.part_id,
                    request_details.amount,
                    request_details.id as req_id,
                    parts.name AS part_name,
                    users.name AS user_name
                FROM 
                    requests
                JOIN 
                    request_details ON requests.id = request_details.request_id
                JOIN 
                    parts ON request_details.part_id = parts.id
                JOIN 
                    users ON requests.user_id = users.id
                WHERE 
                    requests.id = $id";
                    $query = mysqli_query($conn, $sql);
                    while ($row = mysqli_fetch_array($query)) {
                        switch ($row['status']) {
                            case "pending": {
                                    $status = "รออนุมัติ";
                                    $badge = "badge rounded-pill text-bg-warning text-white";
                                    break;
                                }
                            case "approved": {
                                    $status = "อนุมัติ";
                                    $badge = "badge rounded-pill text-bg-success text-white";
                                    break;
                                }
                            case "rejected": {
                                    $status = "ปฏิเสธ";
                                    $badge = "badge rounded-pill text-bg-danger text-white";
                                    $break;
                                }
                        }
                        $count++;
                    ?>
                        <tr>
                            <td><?php echo $count; ?></td>
                            <td><?php echo $row['part_name']; ?></td>
                            <td><?php echo $row['amount']; ?></td>
                            <td><?php echo thaiDate($row['dates']) ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>


<script>
    $(document).ready(function() {
        $('#list').DataTable({
            "language": {
                "lengthMenu": "จำนวน _MENU_ หน้า",
                "zeroRecords": "",
                "info": "แสดงหน้า _PAGE_ ถึง _PAGES_",
                "infoEmpty": "ไม่พบข้อมูลที่บันทึก",
                "infoFiltered": "(กรองจากทั้งหมด _MAX_ รายการ)",
                "paginate": {
                    "first": "แรก",
                    "last": "สุดท้าย",
                    "next": "ถัดไป",
                    "previous": "กลับ"
                },
                "search": "ค้นหา:",
                "emptyTable": "ไม่มีข้อมูลในตาราง"
            },

        });
    });
</script>