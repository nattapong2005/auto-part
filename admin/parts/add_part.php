<form class="row p-3 bg-white shadow-sm" action="" method="POST">
    <h3>เพิ่มอะไหล่</h3>

    <div class="col-md-6 mb-2">
        <label class="form-label">ชื่อ</label>
        <input type="text" class="form-control" placeholder="กรอกชื่ออะไหล่" name="name" required>
    </div>

    <div class="col-md-6 mb-2">
        <label class="form-label">รายละเอียด</label>
        <input type="text" class="form-control" placeholder="กรอกรายละเอียด" name="description" required>
    </div>


    <div class="col-md-12 mb-2">
        <label class="form-label">สต๊อก</label>
        <input type="number" class="form-control" placeholder="กรอกจำนวนสต๊อก" name="stock" required>
    </div>

    <button name="add" class="btn btn-outline-primary mt-2" type="submit">เพิ่มข้อมูลอะไหล่</button>

</form>

<?php

if(isset($_POST['add'])) {

    $name = $_POST['name'];
    $description = $_POST['description'];
    $stock = $_POST['stock'];

    $sql = "INSERT INTO parts (name,description,stock) VALUES ('$name','$description','$stock')";
    $query = mysqli_query($conn, $sql);
    if ($query) {
        success("เพิ่มข้อมูลเรียบร้อย", "index.php?page=parts");
    } else {
        failed("เกิดข้อผิดพลาด", "index.php?page=parts");
    }
}

?>