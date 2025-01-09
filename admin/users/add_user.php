<form class="row p-3 bg-white shadow-sm" action="" method="POST">
    <h3>เพิ่มผู้ใช้งาน</h3>
    <input type="hidden" name="oid" value="<?php echo $id ?>">

    <div class="col-md-6 mb-2">
        <label class="form-label">ชื่อ</label>
        <input type="text" class="form-control" placeholder="กรอกชื่อ" name="name" required>
    </div>

    <div class="col-md-6 mb-2">
        <label class="form-label">นามสกุล</label>
        <input type="text" class="form-control" placeholder="กรอกนามสกุล" name="lastname" required>
    </div>


    <div class="col-md-6 mb-2">
        <label class="form-label">ผู้ใช้งาน</label>
        <input type="text" class="form-control" placeholder="กรอกผู้ใช้งาน" name="username" required>
    </div>

    <div class="col-md-6 mb-2">
        <label class="form-label">รหัสผ่าน</label>
        <input type="password" class="form-control" placeholder="กรอกรหัสผ่าน" name="password" required>
    </div>

    <div class="col-md-6 mb-2">
        <label class="form-label">แผนก</label>
        <select name="department_id" class="form-select" required>
            <option value="" selected>เลือกแผนก</option>
            <?php
            $sql = "SELECT * FROM departments";
            $query = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_array($query)) {
            ?>
                <option value="<?php echo $row['id'] ?>"><?php echo $row['name'] ?></option>
            <?php } ?>
        </select>
    </div>

    <div class="col-md-6 mb-2">
        <label class="form-label">ตำแหน่ง</label>
        <select name="role" class="form-select" required>
            <option value="" selected>เลือกตำแหน่ง</option>
            <option value="user">สมาชิก</option>
            <option value="admin">ผู้ดูแลระบบ</option>
        </select>
    </div>

    <div class="col-md-12 mb-2">
        <label class="form-label">เบอร์โทร</label>
        <input type="text" class="form-control" placeholder="กรอกเบอร์โทร" name="phone" required>
    </div>

    <button name="add" class="btn btn-outline-primary mt-2" type="submit">เพิ่มข้อมูลผู้ใช้งาน</button>

</form>

<?php

if(isset($_POST['add'])) {

    $name = $_POST['name'];
    $lastname = $_POST['lastname'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $password = md5($password);
    $phone = $_POST['phone'];
    $department_id = $_POST['department_id'];
    $role = $_POST['role'];

    $sql = "INSERT INTO users (name,lastname,username,password,phone,department_id,role) VALUES
    ('$name','$lastname','$username','$password','$phone','$department_id','$role')";
    $query = mysqli_query($conn, $sql);
    if ($query) {
        success("เพิ่มข้อมูลเรียบร้อย", "index.php?page=user");
    } else {
        failed("เกิดข้อผิดพลาด", "index.php?page=user");
    }
}

?>