<div class="row d-flex justify-content-center mt-2">
            <div class="col-md-6">
                <h2><i class="fa-solid fa-list"></i> เลือกอะไหล่ที่ต้องการเบิก</h2>
                <table class="table table-bordered table-hover shadow bg-white">
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
                <table class="table table-bordered table-hover shadow bg-white">
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