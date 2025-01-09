<div class="row mb-2">
    <?php
    $sql = "SELECT * FROM requests WHERE status = 'pending'";
    $query = mysqli_query($conn, $sql);
    $rowCount = mysqli_num_rows($query);
    ?>
    <div class="col-md-3 mb-2">
        <div class="card shadow-sm bg-white w-100">
            <div class="card-body">
                <h5 class="card-title">รออนุมัติ</h5>
                <div class="d-flex align-items-center justify-content-between">
                    <p class="card-text fs-4 fw-bold"><?php echo $rowCount ?></p>
                    <span class="display-4"><i class="bi bi-hourglass text-warning"></i></span>
                </div>
            </div>
        </div>
    </div>
    <?php
    $sql = "SELECT * FROM requests WHERE status = 'approved'";
    $query = mysqli_query($conn, $sql);
    $rowCount = mysqli_num_rows($query);
    ?>
    <div class="col-md-3 mb-2">
        <div class="card shadow-sm bg-white w-100">
            <div class="card-body">
                <h5 class="card-title">อนุมัติแล้ว</h5>
                <div class="d-flex align-items-center justify-content-between">
                    <p class="card-text fs-4 fw-bold"><?php echo $rowCount ?></p>
                    <span class="display-4"><i class="bi bi-check-circle text-success"></i></span>
                </div>
            </div>
        </div>
    </div>
    <?php
    $sql = "SELECT * FROM requests WHERE status = 'rejected'";
    $query = mysqli_query($conn, $sql);
    $rowCount = mysqli_num_rows($query);
    ?>
    <div class="col-md-3 mb-2">
        <div class="card shadow-sm bg-white w-100">
            <div class="card-body">
                <h5 class="card-title">ปฏิเสธแล้ว</h5>
                <div class="d-flex align-items-center justify-content-between">
                    <p class="card-text fs-4 fw-bold"><?php echo $rowCount ?></p>
                    <span class="display-4"><i class="bi bi-x-circle text-danger"></i></span>
                </div>
            </div>
        </div>
    </div>
    <?php
    $sql = "SELECT * FROM parts ";
    $query = mysqli_query($conn, $sql);
    $rowCount = mysqli_num_rows($query);
    ?>
    <div class="col-md-3 mb-2">
        <div class="card shadow-sm bg-white w-100">
            <div class="card-body">
                <h5 class="card-title">รายการอะไหล่</h5>
                <div class="d-flex align-items-center justify-content-between">
                    <p class="card-text fs-4 fw-bold"><?php echo $rowCount ?></p>
                    <span class="display-4"><i class="bi bi-file-earmark text-primary"></i></span>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row mb-4 d-flex justify-content-center g-0">
    <div class="col-md-12 bg-white shadow-sm p-3">
        <h3>รายการเบิก <span class="text-warning">รออนุมัติ</span></h3>
        <div class="table-responsive">
            <table class="table" id="list">
                <thead>
                    <tr>
                        <th>ลำดับ</th>
                        <th>ร้องขอโดย</th>
                        <th>วันที่ร้องขอ</th>
                        <th>สถานะ</th>
                        <th>จัดการ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $count = 0;
                    $sql = "SELECT users.name,requests.dates,requests.status,requests.id FROM users
                            JOIN requests ON users.id = requests.user_id
                            WHERE requests.status = 'pending' ";
                    $query = mysqli_query($conn, $sql);
                    while ($row = mysqli_fetch_array($query)) {
                        switch($row['status']) {
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
                            <td><?php echo $row['name']; ?></td>
                            <td><?php echo formatThaiDate($row['dates']) ?></td>
                            <td><span class="<?php echo $badge ?>"><?php echo $status ?></span></td>
                            <td>
                                <a href="index.php?page=request_details&id=<?php echo $row['id'] ?>" class="btn btn-sm btn-outline-primary">รายละเอียด</a>
                            </td>

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
            }
        });
    });
</script>

<?php

if (isset($_POST['confirm'])) {

    $detail_id = $_POST['detail_id'];
    $sql = "UPDATE requests SET status = 'approved' WHERE id = $detail_id";
    $query = mysqli_query($conn, $sql);
    if ($query) {
        success("อนุมัติเรียบร้อย", "");
    } else {
        failed("เกิดข้อผิดพลาด", "");
    }
}

if (isset($_POST['rejected'])) {

    $detail_id = $_POST['detail_id'];
    $sql = "UPDATE requests SET status = 'rejected' WHERE id = $detail_id";
    $query = mysqli_query($conn, $sql);
    if ($query) {
        success("ปฏิเสธเรียบร้อย", "");
    } else {
        failed("เกิดข้อผิดพลาด", "");
    }
}


?>