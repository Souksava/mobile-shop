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
        <title>ສັ່ງຊື້</title>
        <link rel="icon" href="../../image/<?php echo $rowshop['img_title']; ?>">
        <link rel="stylesheet" href="../../css/style.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <body >
        <div class="header">
            <div class="container">
                <div class="tapbar">
                    <a href="order.php">
                        <img src="../../icon/back.ico" width="30px">
                    </a>
                </div>
                <div align="center" class="tapbar fonthead">
                    ສັ່ງຊື້
                </div>
                <div class="tapbar" align="right">
                    <a href="../../Check/Logout.php">
                        <img src="../../icon/close.ico" width="30px">
                    </a>
                </div>
            </div>
        </div>
        <br>
        <div class="clearfix"></div>
        <div class="container font14">
            <form action="frmOrder.php" id="fomrsearch" method="POST">
                <div style="width: 100%">
                    <input type="text" class="form-control" name="search" style="float: left;width: 50%;" placeholder="ລະຫັດ, ຊື່, ປະເພດ, ຫົວໜ່ວຍ, ຍີ່ຫໍ້">
                    <button class="btn btn-outline-primary" name="btnSearch" type="submit" style="float:left;margin-left: 10px">
                        ຄົ້ນຫາ
                    </button>
                    <button class="btn btn-outline-danger" name="btnalert" type="submit" style="float:left;margin-left: 10px">
                        ສິນຄ້າໃກ້ຈະໝົດ
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
                    $sql = "select pro_id,pro_name,p.qty,price,p.cated_id,cated_name,p.unit_id,unit_name,p.brand_id,brand_name,promotion,qtyalert,p.img_path from product p left join categorydetail d on p.cated_id=d.cated_id left join unit u on p.unit_id=u.unit_id left join brand b on p.brand_id=b.brand_id where pro_id like '$search' or pro_name like '$search' or cated_name like '$search' or unit_name like '$search' or brand_name like '$search';";
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
                            <h6 class="card-title">ລະຫັດ: <?php echo $row['pro_id']; ?></h6>
                            <p class="card-text">
                                ຊື່ສິນຄ້າ: <?php echo $row['pro_name']; ?>  ປະເພດ: <?php echo $row['cated_name']; ?> <br>
                                ຍີ່ຫໍ້: <?php echo $row['brand_name']; ?> ຈຳນວນ: <?php echo $row['qty']; ?>  <?php echo $row['unit_name']; ?> <br>
                                ລາຄາ: <?php echo number_format($row['price'],2); ?> <br> ສ່ວນຫຼຸດ: <?php echo number_format($row['promotion'],2); ?><br>
                                ເງື່ອນໄຂການສັ່ງຊື້: <?php echo $row['qtyalert']; ?><br>
                                <br><br>
                                <a href="frmOrder2.php?id=<?php echo $row['pro_id']; ?>" class="btn btn-outline-success" style="width: 100%;">ສັ່ງຊື້</a><br><br>
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
          <?php
            if(isset($_POST['btnalert'])){
            
        ?>
        <div class="container font12">
            <div class="row row-cols-1 row-cols-md-3">
                <?php
                    $sql = "select pro_id,pro_name,p.qty,price,p.cated_id,cated_name,p.unit_id,unit_name,p.brand_id,brand_name,promotion,qtyalert,p.img_path from product p left join categorydetail d on p.cated_id=d.cated_id left join unit u on p.unit_id=u.unit_id left join brand b on p.brand_id=b.brand_id where qty < qtyalert;";
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
                            <h6 class="card-title">ລະຫັດ: <?php echo $row['pro_id']; ?></h6>
                            <p class="card-text">
                                ຊື່ສິນຄ້າ: <?php echo $row['pro_name']; ?>  ປະເພດ: <?php echo $row['cated_name']; ?> <br>
                                ຍີ່ຫໍ້: <?php echo $row['brand_name']; ?> ຈຳນວນ: <?php echo $row['qty']; ?>  <?php echo $row['unit_name']; ?> <br>
                                ລາຄາ: <?php echo number_format($row['price'],2); ?> <br> ສ່ວນຫຼຸດ: <?php echo number_format($row['promotion'],2); ?><br>
                                ເງື່ອນໄຂການສັ່ງຊື້: <?php echo $row['qtyalert']; ?><br>
                                <br><br>
                                <a href="frmOrder2.php?id=<?php echo $row['pro_id']; ?>" class="btn btn-outline-success" style="width: 100%;">ສັ່ງຊື້</a><br><br>
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
