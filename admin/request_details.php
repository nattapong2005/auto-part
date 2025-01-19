 <?php

    $id = $_GET['id'];

    $sqlCheck = "SELECT * FROM requests WHERE id = $id";
    $queryCheck = mysqli_query($conn, $sqlCheck);
    $rowCheck = mysqli_fetch_array($queryCheck);
    $statusCheck = $rowCheck['status'];

    ?>

 <div class="row mb-4 d-flex justify-content-center g-0">
     <div class="col-md-12 bg-white shadow-sm p-3">
         <div class="d-flex justify-content-between align-items-center mb-2">
             <h3>รายละเอียด</h3>
             <a class="text-dark" href="index.php"><i class="bi bi-arrow-left-short fs-3"></i></a>
         </div>
         <?php
            if ($statusCheck == "confirmed") {
            ?>
             <a class="btn btn-sm btn-primary mb-2 " href="print.php?id=<?php echo $id ?>">พิมพ์เอกสาร</a>
         <?php } ?>
         <div class="table-responsive">
             <table class="table" id="list">
                 <thead>
                     <tr>
                         <th>ลำดับ</th>
                         <th>รายการ</th>
                         <th>จำนวน</th>
                         <th>ร้องขอโดย</th>
                         <th>สถานะ</th>
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
                                        $status = "รอรับอะไหล่";
                                        $badge = "badge rounded-pill text-bg-primary text-white";
                                        break;
                                    }
                                case "confirmed": {
                                        $status = "รับสำเร็จ";
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
                             <td><?php echo $row['user_name']; ?></td>
                             <td><span class="<?php echo $badge ?>"><?php echo $status ?></span></td>
                         </tr>
                     <?php } ?>
                 </tbody>
             </table>

             <?php if ($statusCheck == "pending") { ?>
                 <div class="d-flex justify-content-end mt-2">
                     <?php ?>
                     <a class="btn me-2 px-3 btn-outline-primary" data-bs-target="#confirm<?php echo $count ?>" data-bs-toggle="modal">อนุมัติ</a>
                     <a class="btn me-2 px-3 btn-outline-danger" data-bs-target="#rejected<?php echo $count ?>" data-bs-toggle="modal">ปฏิเสธ</a>
                 </div>
             <?php } ?>
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
             },

         });
     });
 </script>

 <?php


    if (isset($_POST['confirm'])) {

        $req_id = $_POST['req_id'];

        $sqlDetails = "SELECT 
                request_details.part_id, 
                request_details.amount 
               FROM request_details 
               WHERE request_details.request_id = $req_id";

        $queryDetails = mysqli_query($conn, $sqlDetails);

        $is_stock_sufficient = true; // ใช้ตัวแปรนี้เพื่อตรวจสอบว่าจำนวนเพียงพอหรือไม่
        $insufficient_parts = [];   // เก็บรายการอะไหล่ที่ไม่พอ

        // ตรวจสอบสต๊อกของทุกอะไหล่ในคำร้อง
        while ($rowDetail = mysqli_fetch_array($queryDetails)) {

            $part_id = $rowDetail['part_id'];
            $requested_amount = $rowDetail['amount'];

            $sqlStock = "SELECT stock FROM parts WHERE id = $part_id";
            $queryStock = mysqli_query($conn, $sqlStock);
            $rowStock = mysqli_fetch_array($queryStock);

            if ($rowStock['stock'] < $requested_amount) {
                $is_stock_sufficient = false; // หากชิ้นใดไม่พอ ให้เปลี่ยนตัวแปรนี้
                $insufficient_parts[] = $part_id; // บันทึกอะไหล่ที่ไม่พอ
            }
        }

        if ($is_stock_sufficient) {
            // อัปเดตสถานะคำร้องเป็น "approved"
            $sqlApprove = "UPDATE requests SET status = 'approved' WHERE id = $req_id";
            $queryApprove = mysqli_query($conn, $sqlApprove);

            if ($queryApprove) {
                success("อนุมัติเรียบร้อย", "index.php");
            } else {
                failed("เกิดข้อผิดพลาด", "index.php");
            }
        } else {
            // หากสต๊อกไม่เพียงพอ ให้แจ้งข้อผิดพลาด
            // $insufficient_ids = implode(', ', $insufficient_parts); // รวมรายการอะไหล่ที่ไม่พอ
            failed("อะไหล่บางชิ้นไม่เพียงพอ กรุณาตรวจสอบสต๊อก", "?page=parts");
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