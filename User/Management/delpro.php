<?php 
            require '../../ConnectDB/connectDB.php';
                $id = $_GET['id'];
                $sqlck = "select * from function_product where pro_id='$id';";
                $resultck = mysqli_query($link, $sqlck);
                $sqlck2 = "select * from imports where pro_id='$id';";
                $resultck2 = mysqli_query($link, $sqlck2);
                $sqlck3 = "select * from orderdetail where pro_id='$id';";
                $resultck3 = mysqli_query($link, $sqlck3);
                $sqlck4 = "select * from productdetail where pro_id='$id';";
                $resultck4 = mysqli_query($link, $sqlck4);
                $sqlck5 = "select * from product_color where pro_id='$id';";
                $resultck5 = mysqli_query($link, $sqlck5);
                $sqlck6 = "select * from product_model where pro_id='$id';";
                $resultck6 = mysqli_query($link, $sqlck6);
                $sqlck7= "select * from product_property where pro_id='$id';";
                $resultck7 = mysqli_query($link, $sqlck7);
                $sqlck8= "select * from product_special where pro_id='$id';";
                $resultck8 = mysqli_query($link, $sqlck8);
                $sqlck9= "select * from selldetail where pro_id='$id';";
                $resultck9 = mysqli_query($link, $sqlck9);
                if(mysqli_num_rows($resultck) > 0){
                    echo"<script>";
                    echo"alert('ບໍ່ສາມາດລົບຂໍ້ມູນໄດ້ ເນື່ອງຈາກສິນຄ້ານີ້ໄດ້ເພີ່ມເຂົ້າຟັງຊັນແລ້ວ');";
                    echo"window.location.href='product.php';";
                    echo"</script>";
                }
                else if(mysqli_num_rows($resultck2) > 0){
                    echo"<script>";
                    echo"alert('ບໍ່ສາມາດລົບຂໍ້ມູນໄດ້ ເນື່ອງຈາກສິນຄ້ານີ້ໄດ້ເຄີຍທຳການນຳເຂົ້າສິນຄ້າແລ້ວ');";
                    echo"window.location.href='product.php';";
                    echo"</script>";
                }
                else if(mysqli_num_rows($resultck3) > 0){
                    echo"<script>";
                    echo"alert('ບໍ່ສາມາດລົບຂໍ້ມູນໄດ້ ເນື່ອງຈາກສິນຄ້ານີ້ໄດ້ເຄີຍທຳການສັ່ງຊື້ແລ້ວ');";
                    echo"window.location.href='product.php';";
                    echo"</script>";
                }
                else if(mysqli_num_rows($resultck4) > 0){
                    echo"<script>";
                    echo"alert('ບໍ່ສາມາດລົບຂໍ້ມູນໄດ້ ເນື່ອງຈາກສິນຄ້ານີ້ໄດ້ເພີ່ມລາຍລະອຽດແລ້ວ');";
                    echo"window.location.href='product.php';";
                    echo"</script>";
                }
                else if(mysqli_num_rows($resultck5) > 0){
                    echo"<script>";
                    echo"alert('ບໍ່ສາມາດລົບຂໍ້ມູນໄດ້ ເນື່ອງຈາກສິນຄ້ານີ້ໄດ້ເພີ່ມສີສິນຄ້າແລ້ວ');";
                    echo"window.location.href='product.php';";
                    echo"</script>";
                }
                else if(mysqli_num_rows($resultck6) > 0){
                    echo"<script>";
                    echo"alert('ບໍ່ສາມາດລົບຂໍ້ມູນໄດ້ ເນື່ອງຈາກສິນຄ້ານີ້ໄດ້ເພີ່ມລາຍລະອຽດມຸມຂອງສິນຄ້າແລ້ວ');";
                    echo"window.location.href='product.php';";
                    echo"</script>";
                }
                else if(mysqli_num_rows($resultck7) > 0){
                    echo"<script>";
                    echo"alert('ບໍ່ສາມາດລົບຂໍ້ມູນໄດ້ ເນື່ອງຈາກສິນຄ້ານີ້ໄດ້ເພີ່ມເຂົ້າຄຸນສົມບັດຂອງສິນຄ້າແລ້ວ');";
                    echo"window.location.href='product.php';";
                    echo"</script>";
                }
                else if(mysqli_num_rows($resultck8) > 0){
                    echo"<script>";
                    echo"alert('ບໍ່ສາມາດລົບຂໍ້ມູນໄດ້ ເນື່ອງຈາກສິນຄ້ານີ້ໄດ້ເພີ່ມຈຸດພິເສດແລ້ວ');";
                    echo"window.location.href='product.php';";
                    echo"</script>";
                }
                else if(mysqli_num_rows($resultck9) > 0){
                    echo"<script>";
                    echo"alert('ບໍ່ສາມາດລົບຂໍ້ມູນໄດ້ ເນື່ອງຈາກສິນຄ້ານີ້ໄດ້ເຮັດການຂາຍແລ້ວ');";
                    echo"window.location.href='product.php';";
                    echo"</script>";
                }
               else{
                    $sqlsec = "select img_path from product where pro_id='$id'";
                    $resultsec = mysqli_query($link, $sqlsec); 
                    $data = mysqli_fetch_array($resultsec, MYSQLI_ASSOC);
                    $path = __DIR__.DIRECTORY_SEPARATOR.'../../image'.DIRECTORY_SEPARATOR.$data['img_path'];
                    if(file_exists($path) && !empty($data['img_path'])){
                        unlink($path);
                    }
                    $sqldel = "delete from product where pro_id='$id';";
                    $resultdel = mysqli_query($link, $sqldel);
                    if(!$resultdel)
                    {
                        echo"<script>";
                        echo"alert('ລົບຂໍ້ມູນບໍ່ສຳເລັດ');";
                        echo"window.location.href='product.php';";
                        echo"</script>";
                    }
                    else{
                        echo"<script>";
                        echo"alert('ລົບຂໍ້ມູນສຳເລັດ');";
                        echo"window.location.href='product.php';";
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