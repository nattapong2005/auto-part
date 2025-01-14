<?php

$sql = "SELECT * FROM users";
$query = mysqli_query($conn, $sql);

?>

<!-- Confirm Delete Modal -->
<div class="modal fade" id="confirm" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <center>
                <img class="p-4" width="140" src="https://cdn-icons-png.flaticon.com/512/179/179386.png" alt="">
            </center>
            <h3 class="p-3 text-center">คุณแน่ใจแล้วใช่หรือไม่?</h3>

            <form action="" method="POST">

                <input type="hidden" name="id" id="id">

                <div class="modal-body">
                    <center>
                        <button type="submit" name="del" class="btn btn-primary">ยืนยัน</button>
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">ยกเลิก</button>
                    </center>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="row d-flex justify-content-center">
    <div class="col-md-12 p-3 bg-white shadow-sm">
        <div class="d-flex justify-content-between align-items-center">
            <h3>รายชื่อผู้ใช้งาน</h3>
            <a class="btn btn-sm btn-outline-secondary" href="?page=add_user">เพิ่มผู้ใช้งาน</a>
        </div>
        <div class="table-responsive">
            <table class="table table-hover table-borderless" id="user">
                <thead class="table-dark text-white">
                    <tr>
                        <th>ไอดี</th>
                        <th>ชื่อ-สกุล</th>
                        <th>แผนก</th>
                        <th>ตำแหน่ง</th>
                        <th>จัดการ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT 
                        users.id,
                        users.name,
                        users.lastname,
                        users.username,
                        users.role,
                        departments.name AS dname
                    FROM 
                        users
                    JOIN 
                        departments ON users.department_id = departments.id
                    ORDER BY 
                        users.role = 'admin' DESC, users.name";
                    $query = mysqli_query($conn, $sql);
                    while ($row = mysqli_fetch_array($query)) {
                        switch ($row['role']) {
                            case "admin": {
                                    $role = "ผู้ดูแลระบบ";
                                    $badge = "badge text-bg-danger";
                                    break;
                                }
                            case "user": {
                                    $role = "สมาชิก";
                                    $badge = "badge text-bg-success";
                                    break;
                                }
                        }

                    ?>
                        <tr>
                            <td><?php echo $row['id'] ?></td>
                            <td><?php echo "$row[name] $row[lastname]" ?></td>
                            <td><?php echo $row['dname'] ?></td>
                            <td><span class="<?php echo $badge ?>"><?php echo $role ?></span></td>
                            <td>
                                <a href="index.php?page=edit_user&id=<?php echo $row['id'] ?>" class="btn btn-sm btn-outline-primary">แก้ไข</a>
                                <a class="btn btn-sm btn-outline-danger delete" data-bs-target="#confirm" data-bs-toggle="modal">ลบ</a>
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
        $('#user').DataTable({
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


<script>
    $(document).ready(function() {

        $('.delete').on('click', function() {

            $('#confirm').modal('show');

            $tr = $(this).closest('tr');

            var data = $tr.children("td").map(function() {
                return $(this).text();
            }).get();

            // console.log(data);

            $('#id').val(data[0]);

        });
    });
</script>


<?php

if (isset($_POST['del'])) {

    $id = $_POST['id'];

    $sql = "DELETE FROM users WHERE id = $id";
    $query = mysqli_query($conn, $sql);
    if ($query) {
        success("ลบผู้ใช้งานเรียบร้อย", "");
    } else {
        failed("เกิดข้อผิดพลาด", "");
    }
}

?>