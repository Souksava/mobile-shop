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
        <title>ຫົວໜ່ວຍສິນຄ້າ</title>
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
                    ຫົວໜ່ວຍສິນຄ້າ
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
                    <b>ຫົວໜ່ວຍສິນຄ້າ</b>&nbsp <img src="../../icon/hidemenu.ico" width="10px">
                </div>
                <div align="right" style="width: 48%;float: right;">
                    <form action="unit.php" id="form1" method="POST" enctype="multipart/form-data">
                        <a href="#" data-toggle="modal" data-target="#exampleModal">
                            <img src="../../icon/add.ico" alt="" width="30px">
                        </a>
                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">ຫົວໜ່ວຍສິນຄ້າ</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row" align="left">
                                            <div class="col-md-12 col-sm-6 form-group">
                                                <label>ຊື່ຫົວໜ່ວຍສິນຄ້າ</label>
                                                <input type="text" name="unit_name" class="form-control" placeholder="ຊື່ປະເພດສິນຄ້າ">
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
                $unit_name = $_POST['unit_name']; 
                if(trim($unit_name) == ""){
                    echo"<script>";
                    echo"window.location.href='unit.php?name=null';";
                    echo"</script>";
                }
                else {
                    $sqlckid = "select * from unit where unit_name='$unit_name';";
                    $resultckid = mysqli_query($link,$sqlckid);
                    if(mysqli_num_rows($resultckid) > 0){
                        echo"<script>";
                        echo"window.location.href='unit.php?unit=same';";
                        echo"</script>";
                    }
                    else {
                        $sqlinsert = "insert into unit(unit_name) values('$unit_name');";
                        $resultinsert = mysqli_query($link, $sqlinsert);
                        if(!$resultinsert){
                            echo"<script>";
                            echo"window.location.href='unit.php?save=found';";
                            echo"</script>";
                        }
                        else {
                            echo"<script>";
                            echo"window.location.href='unit.php?save=success';";
                            echo"</script>";
                        }
                    }
                }
            }
            if(isset($_GET['name'])=='null'){
                echo'<script type="text/javascript">
                swal("", "ກະລຸນາປ້ອນຊື່ຫົວໜ່ວຍສິນຄ້າ !", "info");
                </script>';
            }
            if(isset($_GET['unit'])=='same'){
                echo'<script type="text/javascript">
                swal("", "ບໍ່ສາມາດເພີ່ມຂໍ້ມູນໄດ້ ເນື່ອງຈາກຫົວໜ່ວຍສິນຄ້ານີ້ມີຢູ່ແລ້ວ !", "info");
                </script>';
            }
            if(isset($_GET['save'])=='found'){
                echo'<script type="text/javascript">
                swal("", "ບໍ່ສາມາດເພີ່ມຂໍ້ມູນໄດ້ !", "error");
                </script>';
            }
            if(isset($_GET['save'])=='success'){
                echo'<script type="text/javascript">
                swal("", "ເພີ່ມຂໍ້ມູນສຳເລັດ !", "success");
                </script>';
            }
            if(isset($_GET['del'])=='not'){
                echo'<script type="text/javascript">
                swal("", "ບໍ່ສາມາດລົບຂໍ້ມູນໄດ້ ເນື່ອງຫົວໜ່ວຍສິນຄ້ານີ້ມີຢູ່ໃນຂໍ້ມູນສິນຄ້າແລ້ວ !", "error");
                </script>';
            }
            if(isset($_GET['del2'])=='found'){
                echo'<script type="text/javascript">
                swal("", "ບໍ່ສາມາດລົບຂໍ້ມູນໄດ້ !", "error");
                </script>';
            }
            if(isset($_GET['del2'])=='success'){
                echo'<script type="text/javascript">
                swal("", "ລົບຂໍ້ມູນສຳເລັດ !", "success");
                </script>';
            }
            if(isset($_GET['update'])=='found'){
                echo'<script type="text/javascript">
                swal("", "ບໍ່ສາມາດແກ້ໄຂຂໍ້ມູນໄດ້ ກະລຸນາລອງໃໝ່ອີກຄັ້ງ !", "error");
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
            <form action="unit.php" id="fomrsearch" method="POST">
                <div style="width: 100%">
                    <input type="text" class="form-control" name="search" style="float: left;width: 50%;" placeholder="ລະຫັດ, ຊື່ຫົວໜ່ວຍ">
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
                    $sql = "select * from unit where unit_id like '$search' or unit_name like '$search';";
                    $result = mysqli_query($link,$sql);
                    $NO_ = 0;
                    while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                ?>
                <div class="col mb-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <h6 class="card-title">ລະຫັດ: <?php echo $row['unit_id']; ?>  ຊື່ປະເພດ: <?php echo $row['unit_name']; ?> </h6>
                            <p class="card-text">
                                <a href="updateunit.php?id=<?php echo $row['unit_id']; ?>" class="btn btn-outline-success" style="width: 100%;">ແກ້ໄຂ</a><br><br>
                                <a href="delunit.php?id=<?php echo $row['unit_id']; ?>" class="btn btn-outline-danger" style="width: 100%;" >ລົບ</a>
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
