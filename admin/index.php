<?php

include 'font.php';
include '../db.php';
include '../function.php';
include 'date_format.php';

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <!-- Bootstrap 5 CSS -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <script src="../js/bootstrap.bundle.min.js"></script>

    <!-- Data Tables -->
    <link href="https://cdn.datatables.net/v/bs5/dt-1.13.8/datatables.min.css" rel="stylesheet">
    <script src="https://cdn.datatables.net/v/bs5/dt-1.13.8/datatables.min.js"></script>

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

</head>

<body>
    <div class="container-fluid">
        <!-- Sidebar Mobile -->
        <div class="offcanvas offcanvas-start bg-white text-dark d-md-none" tabindex="-1" id="sidebar">
            <div class="offcanvas-header">
                <h1 class="ms-3">ผู้ดูแลระบบ</h1>
                <button type="button" class="btn-close btn-close-dark" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="#">
                            <i class="bi bi-house-door-fill"></i> หน้าหลัก
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="#">
                            <i class="bi bi-person-fill"></i> ผู้ใช้งาน
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="#">
                            <i class="bi bi-bar-chart-fill"></i> รายงาน
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="#">
                            <i class="bi bi-gear-fill"></i> ตั้งค่า
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Sidebar for Desktop -->
        <nav class="sidebar-desktop bg-white shadow d-none d-md-block">
            <div class="position-sticky">
                <h3 class="ms-3 py-3 text-dark">ผู้ดูแลระบบ</h3>
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link text-dark <?php echo !isset($_GET['page']) && empty($_GET['page']) ? 'active' : '' ?>" href="index.php">
                            <i class="bi bi-house-door-fill"></i> หน้าหลัก
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark <?php echo isset($_GET['page']) && $_GET['page'] == "user" ? 'active' : '' ?>" href="?page=user">
                            <i class="bi bi-person-fill"></i> ผู้ใช้งาน
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="#">
                            <i class="bi bi-bar-chart-fill"></i> รายงาน
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="#">
                            <i class="bi bi-gear-fill"></i> ตั้งค่า
                        </a>
                    </li>
                </ul>
            </div>
        </nav>

        <!-- Main Content -->
        <main class="container">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
                <!-- Sidebar Toggle Button for Mobile -->
                <button class="btn btn-danger d-md-none mb-3" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebar" aria-controls="sidebar">
                    <i class="bi bi-list"></i>
                </button>
                <h1 class="h2">ระบบเบิกจ่ายอะไหล่</h1>

                <div class="btn-toolbar mb-2 mb-md-0">
                    <a href="../logout.php" class="btn btn-outline-danger">
                        ออกจากระบบ
                    </a>
                </div>
            </div>

            <!--  Main Content -->

            <?php

            if (isset($_GET['page'])) {
                $page = $_GET['page'];
            } else {
                $page = "";
            }

            switch ($page) {
                case "user": {
                        $file = "user.php";
                        break;
                    }
                case "edit_user": {
                        $file = "edit_user.php";
                        break;
                    }
                case "request_details": {
                        $file = "request_details.php";
                        break;
                    }
                default: {
                        $file = "main.php";
                        break;
                    }
            }
            include "$file";
            ?>

        </main>
    </div>
</body>

</html>
<style>
    /* Custom CSS for fixed sidebar on desktop */
    @media (min-width: 768px) {
        .sidebar-desktop {
            position: fixed;
            top: 0;
            left: 0;
            height: 100%;
            width: 240px;
            z-index: 1030;
            color: #fff;
        }

    }

    body {
        background-color: #f6f9fc;
    }

    .card {
        border: none;
        border-radius: 0px;
    }
    .active {
        background-color: #dc3545;
        color: white !important;
    }
</style>