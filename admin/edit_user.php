<?php

$id = $_GET['id'];
$sql = "SELECT 
	users.id,
 
    users.name,
    users.lastname,
    users.username,
    users.role,
    users.phone,
    departments.name AS dname
FROM 
    users
JOIN 
    departments ON users.department_id = departments.id
WHERE users.id = $id";
$query = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($query);
$department = $row['dname'];

switch($row['role']) {
    case "admin": {
        $role = "ผู้ดูแลระบบ";
        break;
    }
    case "user": {
        $role = "สมาชิก";
        break;
    }
}
?>

<form class="row p-3 bg-white shadow-sm" action="" method="POST">
    <h3>แก้ไขข้อมูลผู้ใช้งาน</h3>
    <input type="hidden" name="oid" value="<?php echo $id ?>">

    <div class="col-md-6 mb-2">
        <label class="form-label">ชื่อ</label>
        <input type="text" class="form-control" value="<?php echo $row['name'] ?>" name="name">
    </div>

    <div class="col-md-6 mb-2">
        <label class="form-label">นามสกุล</label>
        <input type="text" class="form-control" value="<?php echo $row['lastname'] ?>" name="lastname">
    </div>

    <div class="col-md-6 mb-2">
        <label class="form-label">เบอร์โทร</label>
        <input type="text" class="form-control" value="<?php echo $row['phone'] ?>" name="phone">
    </div>

    <div class="col-md-6 mb-2">
        <label class="form-label">แผนก <span class="badge rounded-pill text-bg-secondary"><?php echo $department ?></span></label>
        <select name="department_id" class="form-select" required>
            <option value="" selected>เลือกแผนก</option>
            <?php 
            $sql = "SELECT * FROM departments";
            $query = mysqli_query($conn,$sql);
            while($row = mysqli_fetch_array($query)) {
            ?>
            <option value="<?php echo $row['id'] ?>"><?php echo $row['name'] ?></option>
            <?php } ?>
        </select>
    </div>

    <div class="col-md-12 mb-2">
    <label class="form-label">ตำแหน่ง <span class="badge rounded-pill text-bg-secondary"><?php echo $role ?></span></label>
        <select name="role"  class="form-select" required>
            <option value="" selected>เลือกตำแหน่ง</option>
            <option value="user">สมาชิก</option>
            <option value="admin">ผู้ดูแลระบบ</option>
        </select>
    </div>

    <button name="edit" class="btn btn-outline-primary mt-2" type="submit">แก้ไขข้อมูล</button>

</form>

<?php

if(isset($_POST['edit'])) {
    $oid = $_POST['oid'];
    $name = $_POST['name'];
    $lastname = $_POST['lastname'];
    $phone = $_POST['phone'];
    $department_id = $_POST['department_id'];
    $role = $_POST['role'];


    $sql = "UPDATE users SET name='$name',lastname='$lastname',phone='$phone',department_id='$department_id',role='$role' WHERE id = $oid";
    $query = mysqli_query($conn,$sql);
    if($query) {
        success("แก้ไขข้อมูลเรียบร้อย", "index.php?page=user");
    }else {
        failed("เกิดข้อผิดพลาด", "index.php?page=user");
    }

}


?>