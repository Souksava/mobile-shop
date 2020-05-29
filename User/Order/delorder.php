<?php 
            require '../../ConnectDB/connectDB.php';
                $bill = $_GET['id'];
                $sqlck = "select * from orders where order_id='$bill' and status='ຍັງບໍ່ອະນຸມັດ';";
                $resultck = mysqli_query($link, $sqlck);
               if(mysqli_num_rows($resultck) > 0){
                    $sqldel = "delete from orderdetail where order_id='$bill';";
                    $resultdel = mysqli_query($link, $sqldel);
                    $sqldel2 = "delete from orders where order_id='$bill'";
                    $resultdel2 = mysqli_query($link, $sqldel2);
                    if(!$resultdel2)
                    {
                        echo"<script>";
                        echo"window.location.href='accept.php?del=found';";
                        echo"</script>";
                    }
                    else{
                        echo"<script>";
                        echo"window.location.href='accept.php?del=success';";
                        echo"</script>";
                    }
               }
               else{
                    echo"<script>";
                    echo"window.location.href='accept.php?del2=found';";
                    echo"</script>";
               }
            
          
?>
