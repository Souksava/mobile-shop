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
        <title>ຜູ້ສະໜອງ</title>
        <link rel="icon" href="../../image/<?php echo $rowshop['img_title']; ?>">
        <link rel="stylesheet" href="../../css/style.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <body >
        <div class="header">
            <div class="container">
                <div class="tapbar">
                    <a href="management.php">
                        <img src="../../icon/back.ico" width="30px">
                    </a>
                </div>
                <div align="center" class="tapbar fonthead">
                    ຜູ້ສະໜອງ
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
                    <b>ຜູ້ສະໜອງ</b>&nbsp <img src="../../icon/hidemenu.ico" width="10px">
                </div>
                <div align="right" style="width: 48%;float: right;">
                    <form action="supplier.php" id="form1" method="POST" enctype="multipart/form-data">
                        <a href="#" data-toggle="modal" data-target="#exampleModal">
                            <img src="../../icon/add.ico" alt="" width="30px">
                        </a>
                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">ຜູ້ສະໜອງ</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row" align="left">
                                            <div class="col-md-12 form-group">
                                                <label>ບໍລິສັດ</label>
                                                <input type="text" name="company" class="form-control" placeholder="ບໍລິສັດ">
                                            </div>
                                            <div class="col-md-12 form-group">
                                                <label>ເບີໂທລະສັບ</label>
                                                <input type="text" name="tel" class="form-control" placeholder="ເບີໂທລະສັບ">
                                            </div>
                                            <div class="col-md-12 form-group">
                                                <label>ເບີແຟັກ</label>
                                                <input type="text" name="fax" class="form-control" placeholder="ເບີແຟັກ">
                                            </div>
                                            <div class="col-md-12 form-group">
                                                <label>ທີ່ຕັ້ງບໍລິສັດ</label>
                                                <input type="text" name="address" class="form-control" placeholder="ທີ່ຕັ້ງບໍລິສັດ">
                                            </div>
                                            <div class="col-md-12 form-group">
                                                <label>ທີ່ຢູ່ອີເມວ</label>
                                                <input type="email" name="email" class="form-control" placeholder="ທີ່ຢູ່ອີເມວ">
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
                    $sqlckid = "select * from company where company='$company';";
                    $resultckid = mysqli_query($link,$sqlckid);
                    if(mysqli_num_rows($resultckid) > 0){
                        echo"<script>";
                        echo"alert('ບໍລິສັດນີ້ໄດ້ມີຢູ່ແລ້ວ ກະລຸນາໃສ່ຊື່ບໍລິສັດທີ່ແຕກຕ່າງ');";
                        echo"window.location.href='supplier.php';";
                        echo"</script>";
                    }
                    else {
                        $sqlinsert = "insert into suppliers(company,address,tel,fax,email) values('$company','$address','$tel','$fax','$email');";
                        $resultinsert = mysqli_query($link, $sqlinsert);
                        if(!$resultinsert){
                            echo"<script>";
                            echo"alert('ບໍ່ສາມາດບັນທຶກຂໍ້ມູນໄດ້');";
                            echo"window.location.href='supplier.php';";
                            echo"</script>";
                        }
                        else {
                            echo"<script>";
                            echo"alert('ບັນທຶກຂໍ້ມູນສຳເລັດ');";
                            echo"window.location.href='supplier.php';";
                            echo"</script>";
                        }
                    }
                }
            }
        ?>
        <div class="clearfix"></div>
        <div class="container font14">
            <form action="supplier.php" id="fomrsearch" method="POST">
                <div style="width: 100%">
                    <input type="text" class="form-control" name="search" style="float: left;width: 50%;" placeholder="ລະຫັດ, ຊື່ບໍລິສັດ">
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
                    $sql = "select * from suppliers where sup_id like '$search' or company like '$search';";
                    $result = mysqli_query($link,$sql);
                    $NO_ = 0;
                    while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                ?>
                <div class="col mb-4">
                    <div class="card h-100">
                        <a href="../../image/<?php echo $row['img_path'] ?>">
                            <img src="../../image/<?php echo $row['img_path'] ?>" height="280px" class="card-img-top" alt="">
                        </a>
                        <div class="card-body">
                            <h6 class="card-title">ລະຫັດ: <?php echo $row['sup_id']; ?></h6>
                            <p class="card-text">
                                ຊື່ບໍລິສັດ: <?php echo $row['company']; ?><br>
                                ທີ່ຕັ້ງບໍລິສັດ: <?php echo $row['address']; ?> <br>
                                ເບີໂທລະສັບ: <?php echo $row['tel']; ?>  ເບີແຟັກ: <?php echo $row['fax']; ?><br>
                                ທີ່ຢູ່ອີເມວ: <?php echo $row['email']; ?> <br>
                                <a href="updatesup.php?id=<?php echo $row['sup_id']; ?>" class="btn btn-outline-success" style="width: 100%;">ແກ້ໄຂ</a><br><br>
                                <a href="delsup.php?id=<?php echo $row['sup_id']; ?>" class="btn btn-outline-danger" style="width: 100%;" >ລົບ</a>
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
