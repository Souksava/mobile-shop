<?php 
            require '../../ConnectDB/connectDB.php';
                    $id = $_GET['id'];
                    $sqldel = "delete from cupon where cupon_key='$id';";
                    $resultdel = mysqli_query($link, $sqldel);
                    if(!$resultdel)
                    {
                        echo"<script>";
                        echo"window.location.href='cupon.php?del=found';";
                        echo"</script>";
                    }
                    else{
                        echo"<script>";
                        echo"window.location.href='cupon.php?del=success';";
                        echo"</script>";
                    } 
?>
