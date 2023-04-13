<?php
    include("../inc/db.php");
    $id = $_POST["id"];
    $sql = "Select * from user_detail
            WHERE
            id = $id";
    $row = mysqli_query($conn,$sql);
    $fetch = mysqli_fetch_assoc($row);
    echo json_encode($fetch);
?>