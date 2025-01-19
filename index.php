<?php
ob_start();
session_start();
include 'db.php';
include 'font.php';
include 'function.php';
include 'checklogin.php';
include 'admin/date_format.php';


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/bootstrap.bundle.min.js"></script>
    <link rel="icon" href="img/logo.png" type="image/x-icon">


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.bootstrap5.min.css">

    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.bootstrap5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.colVis.min.js"></script>

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <title>เบิกจ่ายอะไหล่</title>
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark py-3 bg-danger">
        <div class="container-fluid">
            <img src="img/logo.png" class="img-fluid" style="width: 50px;margin-right: 10px;" alt="">
            <a class="navbar-brand" href="#">SOONCHAI INDUSTRY</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a href="index.php" class="nav-link <?php echo !isset($_GET['page']) && empty($_GET['page']) ? 'active' : '' ?>" aria-current="page"><i class="fa-solid fa-house"></i> หน้าหลัก</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo isset($_GET['page']) && $_GET['page'] == "history" ? 'active' : '' ?>" href="?page=history"><i class="fa-solid fa-clock-rotate-left"></i> ประวัติการเบิก</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php"><i class="fa-solid fa-right-from-bracket"></i> ออกจากระบบ</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Header section -->
    <div class="container-fluid bg-danger text-secondary  text-center shadow">
        <img class="logo" src="img/logo.png" width="500">
        <div class="py-5">
            <h1 class="display-5 fw-bold text-white">เบิกจ่ายอะไหล่รถบรรทุก</h1>
        </div>
    </div>

    <div class="container mt-5">

        <?php
        if (isset($_GET['page'])) {
            $page = $_GET['page'];
        } else {
            $page = "";
        }

        switch ($page) {

            case "history": {
                    $file = "history.php";
                    break;
                }
            case "history_details": {
                    $file = "history_details.php";
                    break;
                }
            default: {
                    $file = "main.php";
                    break;
                }
        }
        include "$file";
        ?>

    </div>

</body>

</html>



<style>
    body {
        overflow-x: hidden;
    }
    img.logo {
        -webkit-animation: mover 1s infinite alternate;
        animation: mover 1s infinite alternate;
    }

    img.logo {
        -webkit-animation: mover 1s infinite alternate;
        animation: mover 1s infinite alternate;
    }

    @-webkit-keyframes mover {
        0% {
            transform: translateY(0);
        }

        100% {
            transform: translateY(-10px);
        }
    }

    @keyframes mover {
        0% {
            transform: translateY(0);
        }

        100% {
            transform: translateY(-10px);
        }
    }
</style>