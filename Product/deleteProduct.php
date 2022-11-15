<?php
$id = $_GET['key'];
require("../SQL/connect.php");
$sql_sel = "SELECT * FROM product Where id_product = $id";
$result = mysqli_query($conn,$sql_sel);
$row = mysqli_fetch_assoc($result);
$namefile = $row['image_product'];
$partName = "../Image/product/";
$name_arr = explode('/',$namefile);

for($i = 0; $i < sizeof($name_arr);$i++){
    $partName .= $name_arr[$i];
    if(unlink($partName)){
        $partName = "../Image/product/";
    }
}
$sql = "DELETE FROM product Where id_product = $id";
mysqli_query($conn,$sql);
header("location:product.php?id=product");

?>