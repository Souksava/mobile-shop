<?php 
            require '../../ConnectDB/connectDB.php';
                $id = $_GET['id'];
                $sqlck = "select * from orders where sup_id='$id';";
                $resultck = mysqli_query($link, $sqlck);
                $sqlck2 = "select * from imports where sup_id='$id';";
                $resultck2 = mysqli_query($link, $sqlck2);
                if(mysqli_num_rows($resultck) > 0){
                    echo"<script>";
                    echo"alert('ບໍ່ສາມາດລົບຂໍ້ມູນໄດ້ ເນື່ອງຈາກຜູ້ສະໜອງນີ້ໄດ້ເຄື່ອນໄຫວການນຳເຂົ້າສິນຄ້າແລ້ວ');";
                    echo"window.location.href='supplier.php';";
                    echo"</script>";
                }
                else if(mysqli_num_rows($resultck2) > 0){
                    echo"<script>";
                    echo"alert('ບໍ່ສາມາດລົບຂໍ້ມູນໄດ້ ເນື່ອງຈາກຜູ້ສະໜອງນີ້ໄດ້ເຄື່ອນໄຫວການສັ່ງຊື້ສິນຄ້າແລ້ວ');";
                    echo"window.location.href='supplier.php';";
                    echo"</script>";
                }
               else{
                    $sqldel = "delete from suppliers where sup_id='$id';";
                    $resultdel = mysqli_query($link, $sqldel);
                    if(!$resultdel)
                    {
                        echo"<script>";
                        echo"alert('ລົບຂໍ້ມູນບໍ່ສຳເລັດ');";
                        echo"window.location.href='supplier.php';";
                        echo"</script>";
                    }
                    else{
                        echo"<script>";
                        echo"alert('ລົບຂໍ້ມູນສຳເລັດ');";
                        echo"window.location.href='supplier.php';";
                        echo"</script>";
                    } 
               }
?>
<html>
    <head>
        <title>
            ລົບຂໍ້ມູນ
        </title>
        <link rel="icon" href="../../icon/logo.ico">
        <link rel="stylesheet" href="../../css/style.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    </head>
    <body>
            <div align="center" class="fontblack16"><br>
                <h3  >
                ບໍ່ສາມາດລົບຂໍ້ມູນໄດ້ເນື່ອງຈາກລະຫັດນີ້ໄດ້ເຄື່ອນໄຫວໃນລະບົບແລ້ວ<br>
                ກະລຸນາລົບການເຄື່ອນໄຫວຂອງລະຫັດນີ້ໃນລະບົບອອກໃຫ້ໝົດກ່ອນຈຶ່ງສາມາດລົບລະຫັດນີ້ໄດ້
                </h3>
                <a href="employee.php" class="btn btn-primary">ກັບໄປໜ້າເກົ່າ</a>
            </div>
    </body>
</html>