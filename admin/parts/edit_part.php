<?php

$id = $_GET['id'];
$sql = "SELECT * FROM parts WHERE id = $id ";
$query = mysqli_query($conn,$sql);
$row = mysqli_fetch_array($query);
?>

<form class="row p-3 bg-white shadow-sm" action="" method="POST">
    <h3>แก้ไขอะไหล่</h3>
    <input type="hidden" name="oid" value="<?php echo $id ?>">

    <div class="col-md-6 mb-2">
        <label class="form-label">ชื่อ</label>
        <input type="text" class="form-control" value="<?php echo $row['name'] ?>" name="name">
    </div>

    <div class="col-md-6 mb-2">
        <label class="form-label">รายละเอียด</label>
        <input type="text" class="form-control" value="<?php echo $row['description'] ?>" name="description">
    </div>

    <div class="col-md-12 mb-2">
        <label class="form-label">คงเหลือ</label>
        <input type="number" class="form-control" value="<?php echo $row['stock'] ?>" name="stock">
    </div>


    <button name="edit" class="btn btn-outline-primary mt-2" type="submit">แก้ไขข้อมูล</button>

</form>

<?php

if (isset($_POST['edit'])) {
    $oid = $_POST['oid'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $stock = $_POST['stock'];


    $sql = "UPDATE parts SET name = '$name', description = '$description', stock = '$stock'  WHERE id = $oid";
    $query = mysqli_query($conn, $sql);
    if ($query) {
        success("แก้ไขข้อมูลเรียบร้อย", "index.php?page=parts");
    } else {
        failed("เกิดข้อผิดพลาด", "index.php?page=parts");
    }
}


?>