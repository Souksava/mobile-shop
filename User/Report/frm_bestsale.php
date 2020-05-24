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
    <title>ລາຍງານສິນຄ້າຂາຍດີ</title>
    <link rel="icon" href="../../image/<?php echo $rowshop['img_title']; ?>">
    <link rel="stylesheet" href="../../css/style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  </head>
  <body >
    <!-- head -->
        <div class="header">
            <div class="container">
                <div class="tapbar">
                    <a href="report.php">
                        <img src="../../icon/back.ico" width="30px">
                    </a>
                </div>
                <div align="center" class="tapbar fonthead">
                    ລາຍງານສິນຄ້າຂາຍດີ
                </div>
                <div class="tapbar" align="right">
                    <a href="../../Check/Logout.php">
                        <img src="../../icon/close.ico" width="30px">
                    </a>
                </div>
            </div>
        </div>
     <!-- head -->
    <div class="clearfix"></div><br>
    <!-- body -->
    <form action="frm_bestsale.php" id="form1" method="POST">
    <div class="container font14">
        <div class="row">
            <div class="col-xs-12 col-sm-6 form-group">
                <label>ແຕ່ວັນທີ</label>
                <input type="date" name="date1" class="form-control">
            </div>
            <div class="col-xs-12 col-sm-6 form-group">
                <label>ຫາວັນທີ</label>
                <input type="date" name="date2" class="form-control">
            </div>
            <div class="col-md-12 form-group">
                <button type="submit" name="btn" class="btn btn-outline-danger" style="width: 100%;">ຄົ້ນຫາ</button>
            </div>
            <div class="col-md-12 form-group">
                <button type="submit" name="btnAll" class="btn btn-outline-success" style="width: 100%;">ທັງໝົດ</button>
            </div>
        </div>
    </div>
    </form>
    <?php 
    if(isset($_POST['btnAll'])){
    ?>
        <div class="container font14">
            <div>
                <form action="Report_bestsale.php" method="POST" id="formReport" target="_blank">
                    <input type="hidden" name="name" value="<?php echo $rowshop['name']; ?>">
                    <input type="hidden" name="address" value="<?php echo $rowshop['address']; ?>">
                    <input type="hidden" name="tel" value="<?php echo $rowshop['tel']; ?>">
                    <input type="hidden" name="email" value="<?php echo $rowshop['email']; ?>">
                    <input type="hidden" name="img_path" value="<?php echo $rowshop['img_path']; ?>">
                    <button type="submit" name="btnAll" class="btn btn-outline-primary">
                        <img src="../../icon/print.ico" alt="" width="35px;">
                    </button>
                </form>
            </div>
            <div class="table-responsive">
                <table class="table" style="width: 1200px;">
                    <tr>
                        <th style="width: 25px;">#</th>
                        <th style="width: 110px;" scope="col">ສິນຄ້າ</th>
                        <th style="width: 150px;" scope="col">ຊື່ສິນຄ້າ</th>
                        <th style="width: 50px;" scope="col">ຍອດຂາຍ</th>
                        <th style="width: 170px;" scope="col">ລວມມູນຄ່າ</th>
                    </tr>
                    <?php
                        $sql = "select pro_name,sum(d.qty) as total_qty,sum(d.qty*d.price) as total,count(d.pro_id) as count_product,p.img_path,cated_name,brand_name,unit_name from selldetail d left join sell s on d.sell_id=s.sell_id left join product p on d.pro_id=p.pro_id left join categorydetail i on p.cated_id=i.cated_id left join brand b on p.brand_id=b.brand_id left join unit u on p.unit_id=u.unit_id group by d.pro_id order by count(d.pro_id) desc;";
                        $result = mysqli_query($link,$sql);
                        $No_ = 0;
                        while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                    ?>
                    <tr>
                        <td><?php echo $No_ += 1; ?></td>
                        <th scope="row" ><img src="../../image/<?php echo $row['img_path']; ?>" alt="" style="width: 100px;heigt: 100px;"></th>
                        <td>
                            <?php echo $row['cated_name']; ?> 
                            <?php echo $row['brand_name']; ?> 
                            <?php echo $row['pro_name']; ?><br><br>
                        </td>
                        <td> 
                            <?php echo $row['total_qty']; ?> <?php echo $row['unit_name']; ?><br>
                        </td>
                        <td> 
                            <h6 style="color: #CE3131;"><?php echo number_format($row['total'],2); ?> ກີບ</h6>
                        </td>
                    </tr>
                    <?php
                        }
                        $sql2 = "select sum(d.qty*d.price) as amount from selldetail d left join sell s on d.sell_id=s.sell_id left join product p on d.pro_id=p.pro_id left join categorydetail i on p.cated_id=i.cated_id left join brand b on p.brand_id=b.brand_id left join unit u on p.unit_id=u.unit_id;";
                        $result2 = mysqli_query($link,$sql2);
                        $row2 = mysqli_fetch_array($result2, MYSQLI_ASSOC);
                        $sql3 = "select sum(cupon_price) as cupon_price from sell";
                        $result3 = mysqli_query($link,$sql3);
                        $row3 = mysqli_fetch_array($result3, MYSQLI_ASSOC);
                        $amount = $row2['amount'] - $row3['cupon_price'];
                    ?>
                    <tr align="right" style="font-size: 26px;">
                        <td colspan="3">ມູນຄ່າຄູປ໋ອງສ່ວນລົດ: </td>
                        <td colspan="2"><?php echo number_format($row3['cupon_price'],2); ?> ກີບ</td>
                    </tr>
                    <tr align="right" style="font-size: 26px;">
                        <td colspan="3">ມູນຄ່າທັງໝົດ: </td>
                        <td colspan="2"><?php echo number_format($amount,2); ?> ກີບ</td>
                    </tr>
                </table>
            </div>
        </div>
    <?php 
    }
    ?>
    <?php
        if(isset($_POST['btn'])){
        $date1 = $_POST['date1'];
        $date2 = $_POST['date2'];
    ?>
        <div class="container font14">
            <div>
                <form action="Report_bestsale.php" method="POST" id="formReport">
                    <input type="hidden" name="name" value="<?php echo $rowshop['name']; ?>">
                    <input type="hidden" name="address" value="<?php echo $rowshop['address']; ?>">
                    <input type="hidden" name="tel" value="<?php echo $rowshop['tel']; ?>">
                    <input type="hidden" name="email" value="<?php echo $rowshop['email']; ?>">
                    <input type="hidden" name="img_path" value="<?php echo $rowshop['img_path']; ?>">
                    <input type="hidden" name="date1" value="<?php echo $date1; ?>">
                    <input type="hidden" name="date2" value="<?php echo $date2; ?>">
                    <button type="submit" name="btn" class="btn btn-outline-primary">
                        <img src="../../icon/print.ico" alt="" width="35px;">
                    </button>
                </form>
            </div>
            <div class="table-responsive">
                <table class="table" style="width: 1200px;">
                    <tr>
                        <th style="width: 25px;">#</th>
                        <th style="width: 110px;" scope="col">ສິນຄ້າ</th>
                        <th style="width: 150px;" scope="col">ຊື່ສິນຄ້າ</th>
                        <th style="width: 50px;" scope="col">ຍອດຂາຍ</th>
                        <th style="width: 170px;" scope="col">ລວມມູນຄ່າ</th>
                    </tr>
                    <?php
                        $sql = "select pro_name,sum(d.qty) as total_qty,sum(d.qty*d.price) as total,count(d.pro_id) as count_product,p.img_path,cated_name,brand_name,unit_name from selldetail d left join sell s on d.sell_id=s.sell_id left join product p on d.pro_id=p.pro_id left join categorydetail i on p.cated_id=i.cated_id left join brand b on p.brand_id=b.brand_id left join unit u on p.unit_id=u.unit_id where sell_date between '$date1' and '$date2' group by d.pro_id order by count(d.pro_id) desc;";
                        $result = mysqli_query($link,$sql);
                        $No_ = 0;
                        while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                    ?>
                    <tr>
                    <td><?php echo $No_ += 1; ?></td>
                    <th scope="row" ><img src="../../image/<?php echo $row['img_path']; ?>" alt="" style="width: 100px;heigt: 100px;"></th>
                            <td>
                                <?php echo $row['cated_name']; ?> 
                                <?php echo $row['brand_name']; ?> 
                                <?php echo $row['pro_name']; ?><br><br>
                            </td>
                            <td> 
                                <?php echo $row['total_qty']; ?> <?php echo $row['unit_name']; ?><br>
                            </td>
                            <td> 
                                <h6 style="color: #CE3131;"><?php echo number_format($row['total'],2); ?> ກີບ</h6>
                            </td>
                    </tr>
                    <?php
                        }
                        $sql2 = "select sum(d.qty*d.price) as amount from selldetail d left join sell s on d.sell_id=s.sell_id left join product p on d.pro_id=p.pro_id left join categorydetail i on p.cated_id=i.cated_id left join brand b on p.brand_id=b.brand_id left join unit u on p.unit_id=u.unit_id where sell_date between '$date1' and '$date2';";
                        $result2 = mysqli_query($link,$sql2);
                        $row2 = mysqli_fetch_array($result2, MYSQLI_ASSOC);
                        $sql3 = "select sum(cupon_price) as cupon_price from sell where sell_date between '$date1' and '$date2'";
                        $result3 = mysqli_query($link,$sql3);
                        $row3 = mysqli_fetch_array($result3, MYSQLI_ASSOC);
                        $amount = $row2['amount'] - $row3['cupon_price'];
                    ?>
                    <tr align="right" style="font-size: 26px;">
                        <td colspan="3">ມູນຄ່າຄູປ໋ອງສ່ວນລົດ: </td>
                        <td colspan="2"><?php echo number_format($row3['cupon_price'],2); ?> ກີບ</td>
                    </tr>
                    <tr align="right" style="font-size: 26px;">
                        <td colspan="3">ມູນຄ່າທັງໝົດ: </td>
                        <td colspan="2"><?php echo number_format($amount,2); ?> ກີບ</td>
                    </tr>
                </table>
            </div>
        </div>
    <?php 
    }
    ?>
    <!-- body -->
  </body>
</html>
<?php
    } 
?>
