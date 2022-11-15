<?php
    $id = $_GET["key"];
    require("../SQL/connect.php");
    $sql = "DELETE FROM category WHERE id_category = $id";
    mysqli_query($conn,$sql);
    header("location:category.php?id=category");
?>