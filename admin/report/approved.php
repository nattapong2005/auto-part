
<div class="row mb-4 d-flex justify-content-center g-0">
    <div class="col-md-12 bg-white shadow-sm p-3">
        <h3>รายการเบิก <span class="text-success">อนุมัติแล้ว</span></h3>
        <div class="table-responsive">
            <table class="table" id="list">
                <thead>
                    <tr>
                        <th>ลำดับ</th>
                        <th>ร้องขอโดย</th>
                        <th>แผนก</th>
                        <th>วันที่ร้องขอ</th>
                        <th>สถานะ</th>
                        <th>จัดการ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $count = 0;
                    $sql = "SELECT users.name,departments.name as dname,requests.dates,requests.status,requests.id FROM users
                            JOIN requests ON users.id = requests.user_id
                            JOIN departments ON users.department_id = departments.id
                            WHERE requests.status = 'approved'";
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
                            <td><?php echo $row['dname']; ?></td>
                            <td><?php echo thaiDate($row['dates']) ?></td>
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
