<?php 
            require '../../ConnectDB/connectDB.php';
                $id = $_GET['id'];
                $sqlck2 = "select * from imports where pro_id='$id';";
                $resultck2 = mysqli_query($link, $sqlck2);
                $sqlck3 = "select * from orderdetail where pro_id='$id';";
                $resultck3 = mysqli_query($link, $sqlck3);
                $sqlck8= "select * from product_special where pro_id='$id';";
                $resultck8 = mysqli_query($link, $sqlck8);
                $sqlck9= "select * from selldetail where pro_id='$id';";
                $resultck9 = mysqli_query($link, $sqlck9);
                if(mysqli_num_rows($resultck2) > 0){
                    echo"<script>";
                    echo"window.location.href='product.php?import=found';";
                    echo"</script>";
                }
                else if(mysqli_num_rows($resultck3) > 0){
                    echo"<script>";
                    echo"window.location.href='product.php?order=found';";
                    echo"</script>";
                }
                else if(mysqli_num_rows($resultck9) > 0){
                    echo"<script>";
                    echo"window.location.href='product.php?sell=found';";
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
                        echo"window.location.href='product.php?del=found';";
                        echo"</script>";
                    }
                    else{
                        echo"<script>";
                        echo"window.location.href='product.php?del=success';";
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