<?php

include 'db.php';
include 'font.php';
include 'function.php';
session_start();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/bootstrap.bundle.min.js"></script>
    <title>เข้าสู่ระบบ</title>
</head>

<body>

    <div class="container">
        <div class="row d-flex justify-content-center align-items-center min-vh-100">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body shadow p-5">
                        <h1 class="fw-bold">เข้าสู่ระบบ</h1>
                        <form action=""  method="POST">
                            <label class="form-label"><i class="fa-solid fa-user"></i> ผู้ใช้งาน</label>
                            <input type="text" placeholder="กรอกผู้ใช้งาน" class="form-control mb-2" name="username">

                            <label class="form-label"><i class="fa-solid fa-lock"></i> รหัสผ่าน</label>
                            <input type="password" placeholder="กรอกรหัสผ่าน" class="form-control mb-2" name="password">

                            <button name="login" type="submit" class="btn btn-danger w-100 mb-2">เข้าสู่ระบบ</button>
                            <div class="d-flex justify-content-end mt-2"><a href="register.php">หากคุณยังไม่มีบัญชี? <span class="text-primary">สมัครสมาชิก</span></a></div>
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

if(isset($_POST['login'])) {

    $username = $_POST['username'];
    $password = $_POST['password'];
    $password = md5($password);

    $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password' ";
    $query = mysqli_query($conn,$sql);
    if(mysqli_num_rows($query) == 1) {

        $user = mysqli_fetch_array($query);
        $_SESSION['user'] = $user;
        $role = $user['role'];
        if($role == "admin") {
            success("เข้าสู่ระบบสำเร็จ", "admin/main.php");
        }else if($role == "user") {
            success("เข้าสู่ระบบสำเร็จ", "index.php");
        }

    }else {
        failed("ชื่อผู้ใช้งานหรือรหัสผ่านไม่ถูกต้อง", "login.php");
    }

}

?>