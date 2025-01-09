<?php
ob_start();
session_start();
include 'db.php';
include 'font.php';
include 'function.php';
include 'checklogin.php'; 


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/bootstrap.bundle.min.js"></script>
    <link rel="icon" href="img/logo.png" type="image/x-icon">
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
                        <a class="nav-link active" aria-current="page"><i class="fa-solid fa-house"></i> หน้าหลัก</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="fa-solid fa-clock-rotate-left"></i> ประวัติการเบิก</a>
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
        <div class="row d-flex justify-content-center mt-2">
            <div class="col-md-6">
                <h2><i class="fa-solid fa-list"></i> เลือกอะไหล่ที่ต้องการเบิก</h2>
                <table class="table table-bordered table-hover">
                    <form action="" method="POST">
                        <thead>
                            <tr>
                                <th>ลำดับที่</th>
                                <th>รายการ</th>
                                <th>คงเหลือ</th>
                                <th>จำนวน</th>
                                <th>จัดการ</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql = "SELECT * FROM parts";
                            $query = mysqli_query($conn, $sql);
                            $count = 0;
                            while ($row = mysqli_fetch_array($query)) {
                                $count++;
                            ?>
                                <tr>
                                    <td><?php echo $count; ?></td>
                                    <?php
                                    if ($row['stock'] == 0) {
                                    ?>
                                        <td><?php echo $row['name']; ?> </td>
                                        <td><?php echo $row['stock']; ?></td>
                                        <td><input class="form-control" type="number" disabled value="0"></td>
                                        <td><button class="btn btn-danger" disabled type="submit">หมด</button></td>
                                    <?php } else { ?>
                                        <td>
                                            <input type="hidden" name="part_id[]" value="<?php echo $row['id']; ?>">
                                            <?php echo $row['name']; ?>
                                        </td>
                                        <td><?php echo $row['stock']; ?></td>
                                        <td> <input class="form-control" type="number" max="<?php echo $row['stock'] ?>" name="quantity[]" value="0"></td>
                                        <td><button class="btn btn-primary" name="add" type="submit">เพิ่ม</button></td>
                                    <?php } ?>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </form>
                </table>

            </div>
            <div class="col-md-6">
                <h2><i class="fa-solid fa-cart-shopping"></i> รายการของคุณ</h2>
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>ลำดับที่</th>
                            <th>รายการ</th>
                            <th>จำนวนที่เบิก</th>
                            <th>จัดการ</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (isset($_SESSION['cart'])) {
                            $count = 0;
                            foreach ($_SESSION['cart'] as $part_id => $quantity) {

                                $count++;
                                $part_sql = "SELECT * FROM parts WHERE id = '$part_id'";
                                $part_query = mysqli_query($conn, $part_sql);
                                $part = mysqli_fetch_assoc($part_query);

                                if ($quantity > $part['stock']) {
                                    $quantity = $part['stock'];
                                    $_SESSION['cart'][$part_id] = $part['stock'];
                                }

                        ?>
                                <tr>
                                    <td><?php echo $count; ?></td>
                                    <td><?php echo $part['name']; ?></td>
                                    <td><?php echo $quantity; ?></td>
                                    <td>
                                        <a href="decrease_cart.php?id=<?php echo $part_id; ?>" class="btn btn-danger">ลบ</a>
                                    </td>
                                </tr>
                        <?php
                            }
                        }
                        ?>
                    </tbody>
                </table>
                <form action="" method="POST">
                    <button type="submit" class="btn btn-success" name="checkout">ยืนยันการเบิก</button>
                </form>
            </div>
        </div>
    </div>

</body>

</html>

<?php



if (isset($_POST['add'])) {
    // Add selected parts to cart
    $part_ids = $_POST['part_id']; // part_id array
    $quantities = $_POST['quantity']; // quantity array


    // Add to session cart
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    foreach ($part_ids as $index => $part_id) {
        $quantity = $quantities[$index];

        if ($quantity > 0) {
            // If part is already in the cart, update quantity
            if (isset($_SESSION['cart'][$part_id])) {
                $_SESSION['cart'][$part_id] += $quantity;
            } else {
                $_SESSION['cart'][$part_id] = $quantity;
            }
        }
    }
    
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit();
}

// Process checkout and update stock
if (isset($_POST['checkout'])) {

    if (empty($_SESSION['cart'])) {
        failed("กรุณาตรวจสอบอะไหล่", "");
        return;
    }

    if (!isset($_SESSION['cart'])) {
        failed("กรุณาตรวจสอบอะไหล่", "");
        return;
    }

    $request_date = date('Y-m-d H:i:s');
    $user = $_SESSION['user']; // Assuming user ID is stored in session
    $user_id = $user['id'];
    $status = "pending";  // Set default status as 'pending'

    // Insert into requests table
    $request_sql = "INSERT INTO requests (user_id, dates, status) VALUES ('$user_id', '$request_date', '$status')";
    if (mysqli_query($conn, $request_sql)) {
        $request_id = mysqli_insert_id($conn); // Get the last inserted request ID

        // Loop through cart and add each part to request_details
        foreach ($_SESSION['cart'] as $part_id => $quantity) {
            // Fetch part details
            $part_sql = "SELECT * FROM parts WHERE id = '$part_id'";
            $part_query = mysqli_query($conn, $part_sql);
            $part = mysqli_fetch_assoc($part_query);

            // Check if sufficient stock is available
            if ($part['stock'] >= $quantity) {
                // Insert into request_details table
                $request_details_sql = "INSERT INTO request_details (request_id, part_id, amount) 
                                        VALUES ('$request_id', '$part_id', '$quantity')";
                if (mysqli_query($conn, $request_details_sql)) {
                    // Update the stock after successful request
                    $new_stock = $part['stock'] - $quantity;
                    $update_stock_sql = "UPDATE parts SET stock = '$new_stock' WHERE id = '$part_id'";
                    mysqli_query($conn, $update_stock_sql);
                }
            } else {
                echo "Insufficient stock for part: " . $part['name'];
                return;
            }
        }

        // Clear the cart after request is placed
        success("เบิกอะไหล่เรียบร้อย", "index.php");
        unset($_SESSION['cart']);
    }
}



// echo "<pre>";
// print_r($_SESSION['cart']);
// echo "</pre>";

ob_end_flush();
?>