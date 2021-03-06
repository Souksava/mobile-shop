<?php
    session_start();
    if($_SESSION['ses_id'] == ''){
       echo"<meta http-equiv='refresh' content='1;URL=../index.php'>";        
    }
    else if($_SESSION['status'] != 2){
       echo"<meta http-equiv='refresh' content='1;URL=../Check/logout.php'>";
    }
    else{
        require '../../ConnectDB/connectDB.php';
        date_default_timezone_set("Asia/Bangkok");
        $datenow = time();
        $Date = date("Y-m-d",$datenow);
        $sqlshop = "select * from shop;";
        $resultshop = mysqli_query($link,$sqlshop);
        $rowshop = mysqli_fetch_array($resultshop,MYSQLI_ASSOC);
?>
<!Doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>ແກ້ໄຂຂໍ້ມູນ</title>
        <link rel="icon" href="../../image/<?php echo $rowshop['img_title']; ?>">
        <link rel="stylesheet" href="../../css/style.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <body >
        <div class="header">
            <div class="container">
                <div class="tapbar">
                    <a href="brand.php">
                        <img src="../../icon/back.ico" width="30px">
                    </a>
                </div>
                <div align="center" class="tapbar fonthead">
                    ແກ້ໄຂຂໍ້ມູນ
                </div>
                <div class="tapbar" align="right">
                    <a href="../../Check/Logout.php">
                        <img src="../../icon/close.ico" width="30px">
                    </a>
                </div>
            </div>
        </div>
        <br>
        <?php 
            $id = $_GET['id'];
            $sqlget = "select * from brand where brand_id='$id';";
            $resultget = mysqli_query($link,$sqlget);
            $row = mysqli_fetch_array($resultget, MYSQLI_ASSOC);

        ?>
        <div class="container font14">
            <form action="updatebrand.php" id="update" method="POST" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-xs-12 col-sm-6 form-group">
                        <label>ຊື່ຍີຫໍ້</label>
                        <input type="text" name="brand_name" class="form-control" value="<?php echo $row['brand_name']?>" placeholder="ຊື່ຍີຫໍ້">
                        <input type="hidden" name="brand_id" class="form-control" value="<?php echo $row['brand_id']?>" >
                    </div>
                    <div class="col-xs-12 col-sm-6 form-group">
                        <label>ຮູບພາບຍີ່ຫໍ້</label>
                        <input type="file" name="bimg_path" class="form-control">
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 form-group">
                        <button type="submit" class="btn btn-outline-success" name="btnUpdate" style="width: 100%;">
                           ແກ້ໄຂຂໍ້ມູນ
                        </button>
                    </div>
                </div>
            </form>
        <?php
            if(isset($_POST['btnUpdate'])){
                $brand_id = $_POST['brand_id'];
                $brand_name = $_POST['brand_name']; 
                if(trim($brand_name) == ""){
                    echo"<script>";
                    echo"window.location.href='brand.php?name=null';";
                    echo"</script>";
                }
                else {
                    if($_FILES['bimg_path']['name'] == ""){
                        $sqlupdate = "update brand set brand_name='$brand_name' where brand_id='$brand_id';";
                        $resultupdate = mysqli_query($link,$sqlupdate);
                        if(!$resultupdate){
                            echo"<script>";
                            echo"window.location.href='brand.php?update=found';";
                            echo"</script>";
                        }
                        else {
                            echo"<script>";
                            echo"window.location.href='brand.php?update=success';";
                            echo"</script>";
                        }
                    }
                    else{
                           //ເມື່ອປ່ຽນຮູບພາບແລ້ວລົບພາບເກົ່າ
                           $sqlsec = "select bimg_path from brand where brand_id='$brand_id';";
                           $resultsec = mysqli_query($link, $sqlsec);
                           $data2 = mysqli_fetch_array($resultsec, MYSQLI_ASSOC);
                           $path = __DIR__.DIRECTORY_SEPARATOR.'../../image'.DIRECTORY_SEPARATOR.$data2['bimg_path'];
                           if(file_exists($path) && !empty($data2['bimg_path'])){
                               unlink($path);
                           }
                           //ສິ້ນສຸດ
                           //ຕັ້ງຊື່ຮູບພາບອັດຕະໂນມັດ
                           $ext = pathinfo(basename($_FILES['bimg_path']['name']), PATHINFO_EXTENSION);
                           $new_image_name = 'img_'.uniqid().".".$ext;
                           $image_path = "../../image/";
                           $upload_path = $image_path.$new_image_name;
                           move_uploaded_file($_FILES['bimg_path']['tmp_name'], $upload_path);
                           $pro_image = $new_image_name;
                           //ສິນສຸດການຕັ້ງຊື່
                           $sqlupdate = "update brand set brand_name='$brand_name',bimg_path='$pro_image' where brand_id='$brand_id';";
                           $resultupdate = mysqli_query($link,$sqlupdate);
                           if(!$resultupdate){
                               echo"<script>";
                               echo"alert('ບໍ່ສາມາດແກ້ໄຂຂໍ້ມູນໄດ້');";
                               echo"window.location.href='brand.php';";
                               echo"</script>";
                           }
                           else {
                               echo"<script>";
                               echo"alert('ແກ້ໄຂຂໍ້ມູນສຳເລັດ');";
                               echo"window.location.href='brand.php';";
                               echo"</script>";
                           }
                    }                    
                }
            }
        ?>
    </body>
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</html>
<?php
    }

?>
