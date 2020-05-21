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
                    <a href="supplier.php">
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
            $sqlget = "select * from suppliers where sup_id='$id';";
            $resultget = mysqli_query($link,$sqlget);
            $row = mysqli_fetch_array($resultget, MYSQLI_ASSOC);

        ?>
        <div class="container font14">
            <form action="updatesup.php" id="update" method="POST" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-xs-12 col-sm-6 form-group">
                        <label>ຊື່ບໍລິສັດ</label>
                        <input type="text" name="company" class="form-control" value="<?php echo $row['company']?>" placeholder="ຊື່ບໍລິສັດ">
                        <input type="hidden" name="sup_id" class="form-control" value="<?php echo $row['sup_id']?>" placeholder="ລະຫັດພະນັກງານ">
                    </div>
                    <div class="col-xs-12 col-sm-6 form-group">
                        <label>ທີ່ຕັ້ງບໍລິສັດ</label>
                        <input type="text" name="address" class="form-control" value="<?php echo $row['address']?>" placeholder="ທີ່ຕັ້ງບໍລິສັດ">
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-6 form-group">
                        <label>ເບີໂທລະສັບ</label>
                        <input type="text" name="tel" class="form-control" value="<?php echo $row['tel']?>" placeholder="ເບີໂທລະສັບ">
                    </div>
                    <div class="col-xs-12 col-sm-6 form-group">
                        <label>ເບີແຟັກ</label>
                        <input type="text" name="fax" class="form-control" value="<?php echo $row['fax']?>" placeholder="ເບີແຟັກ">
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-6 form-group">
                        <label>ທີ່ຢູ່ອີເມວ</label>
                        <input type="email" name="email" class="form-control" value="<?php echo $row['email']?>" placeholder="ທີ່ຢູ່ອີເມວ">
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
                $sup_id = $_POST['sup_id'];
                $company = $_POST['company'];
                $address = $_POST['address'];
                $tel = $_POST['tel'];
                $fax = $_POST['fax'];
                $email = $_POST['email'];
                if(trim($company) == ""){
                    echo"<script>";
                    echo"alert('ກະລຸນາໃສ່ຊື່ບໍລິສັດ');";
                    echo"window.location.href='supplier.php';";
                    echo"</script>";
                }
                elseif(trim($address) == ""){
                    echo"<script>";
                    echo"alert('ກະລຸນາໃສ່ທີ່ຕັ້ງບໍລິສັດ');";
                    echo"window.location.href='supplier.php';";
                    echo"</script>";
                }
                elseif(trim($tel) == ""){
                    echo"<script>";
                    echo"alert('ກະລຸນາໃສ່ເບີໂທຕິດຕໍ່ບໍລິສັດ');";
                    echo"window.location.href='supplier.php';";
                    echo"</script>";
                }
                else {
                    $sqlupdate = "update suppliers set company='$company',address='$address',tel='$tel',fax='$fax',email='$email' where sup_id='$sup_id';";
                    $resultupdate = mysqli_query($link,$sqlupdate);
                    if(!$resultupdate){
                        echo"<script>";
                        echo"alert('ບໍ່ສາມາດແກ້ໄຂຂໍ້ມູນໄດ້');";
                        echo"window.location.href='supplier.php';";
                        echo"</script>";
                    }
                    else {
                        echo"<script>";
                        echo"alert('ແກ້ໄຂຂໍ້ມູນສຳເລັດ');";
                        echo"window.location.href='supplier.php';";
                        echo"</script>";
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
