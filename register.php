<?php

session_start();
include 'db.php';
include 'font.php';
include 'function.php';



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/bootstrap.bundle.min.js"></script>
    <title>ลงทะเบียน</title>
</head>

<body>

    <div class="container">
        <div class="row d-flex justify-content-center align-items-center min-vh-100">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body shadow p-5">
                        <h1 class="fw-bold">ลงทะเบียน</h1>
                        <form action="" class="row" method="POST">
                            <div class="col-md-6 mb-2">
                                <label class="form-label"><i class="fa-solid fa-tag"></i> ชื่อ</label>
                                <input type="text" placeholder="กรอกชื่อจริง" class="form-control mb-2" name="name" required>
                            </div>

                            <div class="col-md-6 mb-2">
                                <label class="form-label"><i class="fa-solid fa-user"></i> นามสกุล</label>
                                <input type="text" placeholder="กรอกนามสกุล" class="form-control mb-2" name="lastname" required>
                            </div>

                            <div class="col-md-6 mb-2">
                                <label class="form-label"><i class="fa-solid fa-user-check"></i> ผู้ใช้งาน</label>
                                <input type="text" placeholder="กรอกผู้ใช้งาน" class="form-control mb-2" name="username" required>
                            </div>

                            <div class="col-md-6 mb-2">
                                <label class="form-label"><i class="fa-solid fa-lock"></i> รหัสผ่าน</label>
                                <input type="password" placeholder="กรอกรหัสผ่าน" class="form-control mb-2" name="password" required>
                            </div>

                            <div class="col-md-6 mb-2">
                                <label class="form-label"><i class="fa-solid fa-phone"></i> เบอร์โทร</label>
                                <input
                                    type="tel"
                                    placeholder="กรอกเบอร์โทร"
                                    class="form-control mb-2"
                                    maxlength="10"
                                    name="phone"
                                    required
                                    oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 10);">
                            </div>

                            <div class="col-md-6 mb-2">
                                <label class="form-label"><i class="fa-solid fa-lock"></i> อีเมล</label>
                                <input type="text" placeholder="กรอกอีเมล" class="form-control mb-2" name="email" required>
                            </div>

                            <div class="col-md-12 mb-2">
                                <label class="form-label"><i class="fa-solid fa-address-book"></i> แผนก</label>
                                <select class="form-select" name="department_id" required>
                                    <option value="">เลือกแผนก</option>
                                    <?php
                                    $sql = "SELECT * FROM departments";
                                    $query = mysqli_query($conn, $sql);
                                    while ($row = mysqli_fetch_array($query)) {
                                    ?>
                                        <option value="<?php echo $row['id'] ?>"><?php echo $row['name'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>

                            <button name="register" type="submit" class="btn btn-danger w-100 mb-2">ลงทะเบียน</button>
                            <div class="d-flex justify-content-end mt-2"><a href="login.php">มีบัญชีแล้ว? <span class="text-primary">เข้าสู่ระบบ</span></a></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
<style>
    body {
        background-color: #f6f9fc;
    }

    .card {
        border: none;
    }

    a {
        text-decoration: none;
        color: black;
    }
</style>

<?php

if (isset($_POST['register'])) {

    $name = $_POST['name'];
    $lastname = $_POST['lastname'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $password = md5($password);
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $department_id = $_POST['department_id'];

    $sql = "INSERT INTO users (name,lastname,username,password,phone,email,department_id,role)  VALUES
    ('$name','$lastname','$username','$password','$phone','$email','$department_id','user')";
    $query = mysqli_query($conn, $sql);
    if ($query) {
        success("ลงทะเบียนเรียบร้อย", "login.php");
    } else {
        failed("เกิดข้อผิดพลาด", "login.php");
    }
}

?>