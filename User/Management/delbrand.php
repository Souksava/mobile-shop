<?php 
            require '../../ConnectDB/connectDB.php';
                $id = $_GET['id'];
                $sqlck = "select * from product where brand_id='$id';";
                $resultck = mysqli_query($link, $sqlck);
               
                if(mysqli_num_rows($resultck) > 0){
                    echo"<script>";
                    echo"window.location.href='brand.php?del=not';";
                    echo"</script>";
                }
               else{
                $sqlsec = "select bimg_path from brand where brand_id='$id'";
                $resultsec = mysqli_query($link, $sqlsec); 
                $data = mysqli_fetch_array($resultsec, MYSQLI_ASSOC);
                $path = __DIR__.DIRECTORY_SEPARATOR.'../../image'.DIRECTORY_SEPARATOR.$data['bimg_path'];
                if(file_exists($path) && !empty($data['bimg_path'])){
                    unlink($path);
                }
                    $sqldel = "delete from brand where brand_id='$id';";
                    $resultdel = mysqli_query($link, $sqldel);
                    if(!$resultdel)
                    {
                        echo"<script>";
                        echo"window.location.href='brand.php?del2=found';";
                        echo"</script>";
                    }
                    else{
                        echo"<script>";
                        echo"window.location.href='brand.php?del2=success';";
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