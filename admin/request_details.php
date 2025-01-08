 <?php

    $id = $_GET['id'];


    ?>

 <div class="row mb-4 d-flex justify-content-center g-0">
     <div class="col-md-12 bg-white shadow-sm p-3">
         <div class="d-flex justify-content-between align-items-center mb-2">
         <h3>รายละเอียด</h3>
         <a class="text-dark" href="index.php"><i class="bi bi-arrow-left-short fs-3"></i></a>
         </div>
         <div class="table-responsive">
             <table class="table" id="list">
                 <thead>
                     <tr>
                         <th>ลำดับ</th>
                         <th>รายการ</th>
                         <th>จำนวน</th>
                         <th>ร้องขอโดย</th>
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
                            $count++;
                        ?>
                         <tr>
                             <td><?php echo $count; ?></td>
                             <td><?php echo $row['part_name']; ?></td>
                             <td><?php echo $row['amount']; ?></td>
                             <td><?php echo $row['user_name']; ?></td>
                         </tr>
                     <?php } ?>
                 </tbody>
             </table>
             <div class="d-flex justify-content-end mt-2">
                 <a class="btn me-2 px-3 btn-outline-primary" data-bs-target="#confirm<?php echo $count ?>" data-bs-toggle="modal">อนุมัติ</a>
                 <a class="btn me-2 px-3 btn-outline-danger" data-bs-target="#rejected<?php echo $count ?>" data-bs-toggle="modal">ปฏิเสธ</a>
             </div>
         </div>
     </div>
 </div>

 <!-- Confirm  Modal -->
 <div class="modal fade" id="confirm<?php echo $count ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
     <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
         <div class="modal-content">
             <center>
                 <img class="p-4" width="140" src="https://cdn-icons-png.flaticon.com/512/179/179386.png" alt="">
             </center>
             <h3 class="p-3 text-center">คุณแน่ใจแล้วใช่หรือไม่?</h3>

             <form action="" method="POST">

                 <input type="hidden" name="req_id" value="<?php echo $id ?>">

                 <div class="modal-body">
                     <center>
                         <button type="submit" name="confirm" class="btn btn-primary">ยืนยัน</button>
                         <button type="button" class="btn btn-danger" data-bs-dismiss="modal">ยกเลิก</button>
                     </center>
                 </div>
             </form>
         </div>
     </div>
 </div>

 <!-- Rejected Modal -->
 <div class="modal fade" id="rejected<?php echo $count ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
     <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
         <div class="modal-content">
             <center>
                 <img class="p-4" width="140" src="https://cdn-icons-png.flaticon.com/512/179/179386.png" alt="">
             </center>
             <h3 class="p-3 text-center">คุณแน่ใจแล้วใช่หรือไม่?</h3>

             <form action="" method="POST">

                 <input type="hidden" name="req_id" value="<?php echo $id ?>">

                 <div class="modal-body">
                     <center>
                         <button type="submit" name="rejected" class="btn btn-primary">ยืนยัน</button>
                         <button type="button" class="btn btn-danger" data-bs-dismiss="modal">ยกเลิก</button>
                     </center>
                 </div>
             </form>
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

        $req_id = $_POST['req_id'];
        $sql = "UPDATE requests SET status = 'approved' WHERE id = $req_id";
        $query = mysqli_query($conn, $sql);
        if ($query) {
            success("อนุมัติเรียบร้อย", "index.php");
        } else {
            failed("เกิดข้อผิดพลาด", "");
        }
    }

    if (isset($_POST['rejected'])) {

        $req_id = $_POST['req_id'];
        $sql = "UPDATE requests SET status = 'rejected' WHERE id = $req_id";
        $query = mysqli_query($conn, $sql);
        if ($query) {
            success("ปฏิเสธเรียบร้อย", "index.php");
        } else {
            failed("เกิดข้อผิดพลาด", "");
        }
    }


    ?>