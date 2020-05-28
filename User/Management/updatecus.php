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
                    <a href="customer.php">
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
            $sqlget = "select * from customers where cus_id='$id';";
            $resultget = mysqli_query($link,$sqlget);
            $row = mysqli_fetch_array($resultget, MYSQLI_ASSOC);

        ?>
        <div class="container font14">
            <form action="updatecus.php" id="update" method="POST" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-xs-12 col-sm-6 form-group">
                        <label>ຊື່ລູກຄ້າ</label>
                        <input type="text" name="cus_name" class="form-control" value="<?php echo $row['cus_name']?>" value="ຊື່ລູກຄ້າ">
                        <input type="hidden" name="cus_id" class="form-control" value="<?php echo $row['cus_id']?>">
                    </div>
                    <div class="col-xs-12 col-sm-6 form-group">
                        <label>ນາມສະກຸນ</label>
                        <input type="text" name="cus_surname" class="form-control" value="<?php echo $row['cus_surname']?>" placeholder="ນາມສະກຸນ">
                    </div>
                    <div class="col-xs-12 col-sm-6 form-group">
                        <label>ເພດ</label>
                       <select name="gender" id="" class="form-control">
                            <option value="<?php echo $row['gender'];?>"><?php echo $row['gender'] ?></option>
                            <option value="ຍິງ">ຍິງ</option>
                            <option value="ຊາຍ">ຊາຍ</option>
                       </select>
                    </div>
                    <div class="col-xs-12 col-sm-6 form-group">
                        <label>ເບີໂທລະສັບ</label>
                        <input type="text" name="tel" class="form-control" value="<?php echo $row['tel']?>" placeholder="ເບີໂທລະສັບ">
                    </div>
                    <div class="col-xs-12 col-sm-6 form-group">
                        <label>ເບີແອັບ</label>
                        <input type="text" name="tel_app" class="form-control" value="<?php echo $row['tel_app']?>" placeholder="ເບີແອັບ">
                    </div>
                    <div class="col-xs-12 col-sm-6 form-group">
                        <label>ທີ່ຢູ່ປັດຈຸບັນ</label>
                        <input type="text" name="address" class="form-control" value="<?php echo $row['address']?>" placeholder="ທີ່ຢູ່ປັດຈຸບັນ">
                    </div>
                    <div class="col-xs-12 col-sm-6 form-group">
                        <label>ທີ່ຢູ່ອີເມວ</label>
                        <input type="email" name="email" class="form-control" value="<?php echo $row['email']?>" placeholder="ທີ່ຢູ່ອີເມວ">
                    </div>
                    <div class="col-xs-12 col-sm-6 form-group">
                        <label>ສ່ວນລົດສະມາຊິກ </label>
                        <input type="number" name="cus_discount" min="0" max="100" class="form-control" value="<?php echo $row['cus_discount']?>" placeholder="ສ່ວນລົດສະມາຊິກ">
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
                $cus_id = $_POST['cus_id'];
                $cus_name = $_POST['cus_name'];
                $cus_surname = $_POST['cus_surname'];
                $gender = $_POST['gender'];
                $address = $_POST['address'];
                $tel = $_POST['tel'];
                $tel_app = $_POST['tel_app'];
                $email = $_POST['email'];
                $cus_discount = $_POST['cus_discount'];
                if(trim($cus_discount) == ""){
                    $cus_discount = 0;
                }
                if(trim($cus_surname) == ""){
                    $cus_surname = "-";
                }
                if(trim($cus_id) == ""){
                    echo"<script>";
                    echo"window.location.href='customer.php?cus_id=null';";
                    echo"</script>";
                }
                elseif(trim($cus_name) == ""){
                    echo"<script>";
                    echo"window.location.href='customer.php?cus_name=null';";
                    echo"</script>";
                }
                elseif(trim($gender) == ""){
                    echo"<script>";
                    echo"window.location.href='customer.php?gender=null';";
                    echo"</script>";
                }
                elseif(trim($gender) == ""){
                    echo"<script>";
                    echo"window.location.href='customer.php?gender=null';";
                    echo"</script>";
                }
                elseif(trim($tel) == ""){
                    echo"<script>";
                    echo"window.location.href='customer.php?tel=null';";
                    echo"</script>";
                }
                elseif(trim($address) == ""){
                    echo"<script>";
                    echo"window.location.href='customer.php?address=null';";
                    echo"</script>";
                }
                elseif(trim($email) == ""){
                    echo"<script>";
                    echo"window.location.href='customer.php?email=null';";
                    echo"</script>";
                }
                else{
                    $sqlsave = "update customers set cus_name='$cus_name',cus_surname='$cus_surname',gender='$gender',tel='$tel',tel_app='$tel_app',address='$address',email='$email',cus_discount='$cus_discount' where cus_id='$cus_id';";
                    $resultsave = mysqli_query($link,$sqlsave);
                    if(!$resultsave){
                        echo"<script>";
                        echo"window.location.href='customer.php?update=found';";
                        echo"</script>";
                    }
                    else{
                        echo"<script>";
                        echo"window.location.href='customer.php?update=success';";
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
