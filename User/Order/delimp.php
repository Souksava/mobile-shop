<?php
    require '../../ConnectDB/connectDB.php';
    $id = $_GET['id'];
    $sqlget = "select * from listimports where imp_id='$id';";
    $resultget = mysqli_query($link,$sqlget);
    $row = mysqli_fetch_array($resultget, MYSQLI_ASSOC);
    $pro_id = $row['pro_id'];
    $qty = $row['qty'];
    $sqllist = "delete from listimports where imp_id='$id';";
    $resultlist = mysqli_query($link,$sqllist);
    if(!$resultlist){
        echo"<script>";
        echo"window.location.href='import2.php?del=found';";
        echo"</script>";
    }
    else {
        $sqlstock = "update product set qty=qty-'$qty' where pro_id='$pro_id';";
        $resultstock = mysqli_query($link,$sqlstock);
        echo"<script>";
        echo"window.location.href='import2.php';";
        echo"</script>";
    }
?>
