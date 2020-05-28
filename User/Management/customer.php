<?php
    session_start();
    if($_SESSION['ses_id'] == ''){
        echo"<meta http-equiv='refresh' content='1;URL=../../index.php'>";        
    }
    else if($_SESSION['status'] != 2){
        echo"<meta http-equiv='refresh' content='1;URL=../../Check/logout.php'>";
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
        <title>ລູກຄ້າ</title>
        <link rel="icon" href="../../image/<?php echo $rowshop['img_title']; ?>">
        <link rel="stylesheet" href="../../css/style.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <body >
        <div class="header">
            <div class="container">
                <div class="tapbar">
                    <a href="management.php">
                        <img src="../../icon/back.ico" width="30px">
                    </a>
                </div>
                <div align="center" class="tapbar fonthead">
                    ລູກຄ້າ
                </div>
                <div class="tapbar" align="right">
                    <a href="../../Check/Logout.php">
                        <img src="../../icon/close.ico" width="30px">
                    </a>
                </div>
            </div>
        </div>
        <br>
        <div class="container font14">
            <div class="row">
                <div style="float: left;width: 50%;padding-left: 10px;">
                    <b>ລູກຄ້າ</b>&nbsp <img src="../../icon/hidemenu.ico" width="10px">
                </div>
                <div align="right" style="width: 48%;float: right;">
                    <form action="customer.php" id="form1" method="POST" enctype="multipart/form-data">
                        <a href="#" data-toggle="modal" data-target="#exampleModal">
                            <img src="../../icon/add.ico" alt="" width="30px">
                        </a>
                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">ລູກຄ້າ</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row" align="left">
                                            <div class="col-md-12 col-sm-6 form-group">
                                                <label>ລະຫັດລູກຄ້າ</label>
                                                <input type="text" name="cus_id" class="form-control" placeholder="ລະຫັດລູກຄ້າ">
                                            </div>
                                            <div class="col-md-12 col-sm-6 form-group">
                                                <label>ຊື່ລູກຄ້າ</label>
                                                <input type="text" name="cus_name" class="form-control" placeholder="ຊື່ລູກຄ້າ">
                                            </div>
                                            <div class="col-md-12 col-sm-6 form-group">
                                                <label>ນາມສະກຸນ</label>
                                                <input type="text" name="cus_surname" class="form-control" placeholder="ນາມສະກຸນ">
                                            </div>
                                            <div class="col-md-12 col-sm-6 form-group">
                                                <select name="gender" id="" class="form-control">
                                                    <option value="">ເລືອກເພດ</option>
                                                    <option value="ຍິງ"​>ຍິງ</option>
                                                    <option value="ຊາຍ"​>ຊາຍ</option>
                                                </select>
                                            </div>
                                            <div class="col-md-12 col-sm-6 form-group">
                                                <label>ທີ່ຢູ່ປັດຈຸບັນ</label>
                                                <input type="text" name="address" class="form-control" placeholder="ທີ່ຢູ່ປັດຈຸບັນ">
                                            </div>
                                            <div class="col-md-12 col-sm-6 form-group">
                                                <label>ເບີໂທລະສັບ</label>
                                                <input type="text" name="tel" class="form-control" placeholder="ເບີໂທລະສັບ">
                                            </div>
                                            <div class="col-md-12 col-sm-6 form-group">
                                                <label>ເບີແອັບ</label>
                                                <input type="text" name="tel_app" class="form-control" placeholder="ເບີແອັບ">
                                            </div>
                                            <div class="col-md-12 col-sm-6 form-group">
                                                <label>ອີເມວ</label>
                                                <input type="email" name="email" class="form-control" placeholder="ອີເມວ">
                                            </div>
                                            <div class="col-md-12 col-sm-6 form-group">
                                                <label>ສ່ວນລົດສະມາຊິກ</label>
                                                <input type="number" name="cus_discount" min="0" max="100" class="form-control" placeholder="ສ່ວນລົດສະມາຊິກ">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">ຍົກເລີກ</button>
                                        <button type="submit" name="btnSave" class="btn btn-outline-primary">ບັນທຶກ</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <?php
            if(isset($_POST['btnSave'])){
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
                    $sqlsave = "insert into customers(cus_id,cus_name,cus_surname,gender,tel,tel_app,address,email,cus_discount) value('$cus_id','$cus_name','$cus_surname','$gender','$tel','$tel_app','$address','$email','$cus_discount')";
                    $resultsave = mysqli_query($link,$sqlsave);
                    if(!$resultsave){
                        echo"<script>";
                        echo"window.location.href='customer.php?save=found';";
                        echo"</script>";
                    }
                    else{
                        echo"<script>";
                        echo"window.location.href='customer.php?save=success';";
                        echo"</script>";
                    }
                }
            }
            if(isset($_GET['cus_id'])=='null'){
                echo'<script type="text/javascript">
                swal("", "ກະລຸນາປ້ອນລະຫັດລູກຄ້າ !", "info");
                </script>';
            }
            if(isset($_GET['cus_name'])=='null'){
                echo'<script type="text/javascript">
                swal("", "ກະລຸນາປ້ອນຊື່ລູກຄ້າ !", "info");
                </script>';
            }
            if(isset($_GET['gender'])=='null'){
                echo'<script type="text/javascript">
                swal("", "ກະລຸນາເລືອກເພດ !", "info");
                </script>';
            }
            if(isset($_GET['tel'])=='null'){
                echo'<script type="text/javascript">
                swal("", "ກະລຸນາປ້ອນເບີໂທລະສັບ !", "info");
                </script>';
            }
            if(isset($_GET['address'])=='null'){
                echo'<script type="text/javascript">
                swal("", "ກະລຸນາປ້ອນທີ່ຢູ່ປັດຈຸບັນ !", "info");
                </script>';
            }
            if(isset($_GET['email'])=='null'){
                echo'<script type="text/javascript">
                swal("", "ກະລຸນາປ້ອນອີເມວ !", "info");
                </script>';
            }
            if(isset($_GET['save'])=='found'){
                echo'<script type="text/javascript">
                swal("", "ບໍ່ສາມາດບັນທຶກຂໍ້ມູນໄດ້ !", "error");
                </script>';
            }
            if(isset($_GET['save'])=='success'){
                echo'<script type="text/javascript">
                swal("", "ບັນທຶກຂໍ້ມູນສຳເລັດ !", "success");
                </script>';
            }
            if(isset($_GET['del'])=='not'){
                echo'<script type="text/javascript">
                swal("", "ບໍ່ສາມາດລົບຂໍ້ມູນລູກຄ້າໄດ້ ເນື່ອງຈາກລູກຄ້າລະຫັດນີ້ເຄີຍຊື້ສິນຄ້າແລ້ວ !", "error");
                </script>';
            }
            if(isset($_GET['del2'])=='found'){
                echo'<script type="text/javascript">
                swal("", "ລົບຂໍ້ມູນບໍ່ສຳເລັດ !", "error");
                </script>';
            }
            if(isset($_GET['del2'])=='success'){
                echo'<script type="text/javascript">
                swal("", "ລົບຂໍ້ມູນສຳເລັດ !", "success");
                </script>';
            }
            if(isset($_GET['update'])=='found'){
                echo'<script type="text/javascript">
                swal("", "ບໍ່ສາມາດແກ້ໄຂຂໍ້ມູນໄດ້ ກະລຸນາກວດການປ້ອນຂໍ້ມູນອີກຄັ້ງ !", "error");
                </script>';
            }
            if(isset($_GET['update'])=='success'){
                echo'<script type="text/javascript">
                swal("", "ແກ້ໄຂຂໍ້ມູນສຳເລັດ !", "success");
                </script>';
            }
        ?>
        <div class="clearfix"></div>
        <div class="container font14">
            <form action="customer.php" id="fomrsearch" method="POST">
                <div style="width: 100%">
                    <input type="text" class="form-control" name="search" style="float: left;width: 50%;" placeholder="ລະຫັດ, ຊື່, ນາມສະກຸນ, ເພດ">
                    <button class="btn btn-outline-primary" name="btnSearch" type="submit" style="float:left;margin-left: 10px">
                        ຄົ້ນຫາ
                    </button>
                </div>
            </form>
        </div>
        <div class="clearfix"></div><br>
        <?php
            if(isset($_POST['btnSearch'])){
            $search = "%".$_POST['search']."%";
        ?>
        <div class="container font12">
            <div>
                <?php
                    $s = $_POST['search'];
                    if($s != ""){
                        echo"ຄົ້ນຫາດ້ວຍ '$s'";
                    }
                ?>
            </div>
            <div class="row row-cols-1 row-cols-md-3">
                <?php
                    $sql = "select * from customers where cus_id like '$search' or cus_name like '$search' or cus_surname like '$search' or gender like '$search';";
                    $result = mysqli_query($link,$sql);
                    $NO_ = 0;
                    while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                ?>
                <div class="col mb-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <h6 class="card-title">ລະຫັດ: <?php echo $row['cus_id']; ?></h6>
                            <p class="card-text">
                                ຊື່ ແລະ ນາມສະກຸນ: <?php echo $row['cus_name']; ?>  <?php echo $row['cus_surname']; ?> ເພດ: <?php echo $row['gender']; ?> <br>
                                ທີ່ຢູ່ປັດຈຸບັນ: <?php echo $row['address']; ?><br>
                                ທີ່ຢູ່ອີເມວ: <?php echo $row['email']; ?> <br>
                                ເບີໂທລະສັບ: <?php echo $row['tel']; ?> <br>
                                ເບີແອັບ: <?php echo $row['tel_app']; ?> <br>
                                ສ່ວນລົດສະມາຊິກ: <?php echo number_format($row['cus_discount']); ?> % <br>
                                <a href="updatecus.php?id=<?php echo $row['cus_id']; ?>" class="btn btn-outline-success" style="width: 100%;">ແກ້ໄຂ</a><br><br>
                                <a href="delcus.php?id=<?php echo $row['cus_id']; ?>" class="btn btn-outline-danger" style="width: 100%;" >ລົບ</a>
                            </p>
                        </div>
                    </div>
                </div>
                <?php
                    }
                ?>
            </div>
        </div>
        <?php
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
