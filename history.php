 <?php

	$user = $_SESSION['user'];
	$id = $user['id'];
	$sql = "SELECT *
			FROM requests
			WHERE user_id = $id
			ORDER BY (status = 'pending') DESC, status";

	$query = mysqli_query($conn, $sql);
	?>

 <div class="row">
 	<div class="col-md-12">
 		<h2><i class="fa-solid fa-table"></i> ประวัติการเบิก</h2>
 		<div class="table-responsive">
 			<table class="table table-hover bg-white shadow">
 				<thead>
 					<tr>
 						<th>ลำดับ</th>
 						<th>วันที่</th>
 						<th>สถานะ</th>
 						<th>จัดการ</th>
 					</tr>
 				</thead>
 				<tbody>
 					<?php
						$count = 0;
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
 							<td><?php echo $count ?></td>
 							<td><?php echo thaiDate($row['dates']) ?></td>
 							<td><span class="<?php echo $badge ?>"><?php echo $status ?></span></td>
 							<td>
 								<a class="btn btn-sm btn-outline-primary" href="index.php?page=history_details&id=<?php echo $row['id'] ?>">รายละเอียด</a>
 							</td>
 						</tr>
 					<?php } ?>
 				</tbody>

 			</table>
 		</div>
 	</div>

 </div>