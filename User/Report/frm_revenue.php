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
    <title>ລາຍງານລາຍຮັບ</title>
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
                    ລາຍງານລາຍຮັບ
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
    <form action="frm_revenue.php" id="form1" method="POST">
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
                <form action="Report_revenue.php" method="POST" id="formReport" target="_blank">
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
                <table class="table" style="width: 1800px;">
                    <tr>
                        <th style="width: 25px;">#</th>
                        <th style="width: 110px;" scope="col">ສິນຄ້າ</th>
                        <th style="width: 150px;" scope="col">ຊື່ສິນຄ້າ</th>
                        <th style="width: 80px;" scope="col">ຈຳນວນ</th>
                        <th style="width: 120px;" scope="col">ລາຄາ</th>
                        <th style="width: 120px;" scope="col">ລວມ</th>
                        <th style="width: 80px;" scope="col">ວັນທີ</th>
                        <th style="width: 60px;" scope="col">ເລກທີບິນ</th>
                        <th style="width: 80px;" scope="col">ສະຖານະການຈ່າຍ</th>
                        <th style="width: 80px;" scope="col">ປະເພດການຂາຍ</th>
                        <th style="width: 100px;" scope="col">ລູກຄ້າ</th>
                        <th style="width: 100px;" scope="col">ຜູ້ຂາຍ</th>
                    </tr>
                    <?php
                        $sql = "select d.sell_id,pro_name,d.qty,d.price,d.qty*d.price as total,p.img_path,sell_date,status_cash,sell_type,unit_name,brand_name,cated_name,emp_name,cus_name from selldetail d left join sell s on d.sell_id=s.sell_id left join product p on d.pro_id=p.pro_id left join categorydetail i on p.cated_id=i.cated_id left join brand b on p.brand_id=b.brand_id left join unit u on p.unit_id=u.unit_id left join employees y on s.emp_id=y.emp_id left join customers t on s.cus_id=t.cus_id;";
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
                            <?php echo $row['pro_name']; ?> <br><br>
                        </td>
                        <td> 
                            <?php echo $row['qty']; ?> <?php echo $row['unit_name']; ?><br>
                        </td>
                        <td><?php echo number_format($row['price'],2) ?></td>
                        <td> 
                            <h6 style="color: #CE3131;"><?php echo number_format($row['total'],2); ?> ກີບ</h6>
                        </td>
                        <td><?php echo $row['sell_date'];?></td>
                        <td><?php echo $row['sell_id'];?></td>
                        <td><?php echo $row['status_cash'];?></td>
                        <td><?php echo $row['sell_type'];?></td>
                        <td><?php echo $row['cus_name'];?></td>
                        <td><?php echo $row['emp_name'];?></td>
                    </tr>
                    <?php
                        }
                        $sql2 = "select sum(d.qty*d.price) as amount from selldetail d left join sell s on d.sell_id=s.sell_id left join product p on d.pro_id=p.pro_id left join categorydetail i on p.cated_id=i.cated_id left join brand b on p.brand_id=b.brand_id left join unit u on p.unit_id=u.unit_id left join employees y on s.emp_id=y.emp_id left join customers t on s.cus_id=t.cus_id;";
                        $result2 = mysqli_query($link,$sql2);
                        $row2 = mysqli_fetch_array($result2, MYSQLI_ASSOC);
                        $sql3 = "select sum(cupon_price) as cupon_price from sell;";
                        $result3 = mysqli_query($link,$sql3);
                        $row3 = mysqli_fetch_array($result3, MYSQLI_ASSOC);
                        $amount = $row2['amount'] - $row3['cupon_price'];
                        $newamount = $amount;
                    ?>
                     <tr align="right" style="font-size: 26px;">
                        <td colspan="9">ມູນຄ່າທັງໝົດ: </td>
                        <td colspan="4"><?php echo number_format($row2['amount'],2); ?> ກີບ</td>
                    </tr>
                    <tr align="right" style="font-size: 26px;">
                        <td colspan="9">ຄູປ໋ອງສ່ວນລົດ: </td>
                        <td colspan="4"><?php echo number_format($row3['cupon_price'],2); ?> ກີບ</td>
                    </tr>
                    <tr align="right" style="font-size: 26px;">
                        <td colspan="9">ລາຍຮັບຕົວຈິງ: </td>
                        <td colspan="4"><?php echo number_format($newamount,2); ?> ກີບ</td>
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
                <form action="Report_revenue.php" method="POST" id="formReport" target="_blank">
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
                <table class="table" style="width: 1800px;">
                    <tr>
                        <th style="width: 25px;">#</th>
                        <th style="width: 110px;" scope="col">ສິນຄ້າ</th>
                        <th style="width: 150px;" scope="col">ຊື່ສິນຄ້າ</th>
                        <th style="width: 80px;" scope="col">ຈຳນວນ</th>
                        <th style="width: 120px;" scope="col">ລາຄາ</th>
                        <th style="width: 120px;" scope="col">ລວມ</th>
                        <th style="width: 80px;" scope="col">ວັນທີ</th>
                        <th style="width: 60px;" scope="col">ເລກທີບິນ</th>
                        <th style="width: 80px;" scope="col">ສະຖານະການຈ່າຍ</th>
                        <th style="width: 80px;" scope="col">ປະເພດການຂາຍ</th>
                        <th style="width: 100px;" scope="col">ລູກຄ້າ</th>
                        <th style="width: 100px;" scope="col">ຜູ້ຂາຍ</th>
                    </tr>
                    <?php
                        $sql = "select d.sell_id,pro_name,d.qty,d.price,d.qty*d.price as total,p.img_path,sell_date,status_cash,sell_type,unit_name,brand_name,cated_name,emp_name,cus_name from selldetail d left join sell s on d.sell_id=s.sell_id left join product p on d.pro_id=p.pro_id left join categorydetail i on p.cated_id=i.cated_id left join brand b on p.brand_id=b.brand_id left join unit u on p.unit_id=u.unit_id left join employees y on s.emp_id=y.emp_id left join customers t on s.cus_id=t.cus_id where sell_date between '$date1' and '$date2';";
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
                            <?php echo $row['qty']; ?> <?php echo $row['unit_name']; ?><br>
                        </td>
                        <td><?php echo number_format($row['price'],2) ?></td>
                        <td> 
                            <h6 style="color: #CE3131;"><?php echo number_format($row['total'],2); ?> ກີບ</h6>
                        </td>
                        <td><?php echo $row['sell_date'];?></td>
                        <td><?php echo $row['sell_id'];?></td>
                        <td><?php echo $row['status_cash'];?></td>
                        <td><?php echo $row['sell_type'];?></td>
                        <td><?php echo $row['cus_name'];?></td>
                        <td><?php echo $row['emp_name'];?></td>
                    </tr>
                    <?php
                        }
                        $sql2 = "select sum(d.qty*d.price) as amount from selldetail d left join sell s on d.sell_id=s.sell_id left join product p on d.pro_id=p.pro_id left join categorydetail i on p.cated_id=i.cated_id left join brand b on p.brand_id=b.brand_id left join unit u on p.unit_id=u.unit_id left join employees y on s.emp_id=y.emp_id left join customers t on s.cus_id=t.cus_id where sell_date between '$date1' and '$date2';";
                        $result2 = mysqli_query($link,$sql2);
                        $row2 = mysqli_fetch_array($result2, MYSQLI_ASSOC);
                        $sql3 = "select sum(cupon_price) as cupon_price from sell where sell_date between '$date1' and '$date2';";
                        $result3 = mysqli_query($link,$sql3);
                        $row3 = mysqli_fetch_array($result3, MYSQLI_ASSOC);
                        $amount = $row2['amount'] - $row3['cupon_price'];
                        $newamount = $amount;
                    ?>
                     <tr align="right" style="font-size: 26px;">
                        <td colspan="9">ມູນຄ່າທັງໝົດ: </td>
                        <td colspan="4"><?php echo number_format($row2['amount'],2); ?> ກີບ</td>
                    </tr>
                    <tr align="right" style="font-size: 26px;">
                        <td colspan="9">ຄູປ໋ອງສ່ວນລົດ: </td>
                        <td colspan="4"><?php echo number_format($row3['cupon_price'],2); ?> ກີບ</td>
                    </tr>
                    <tr align="right" style="font-size: 26px;">
                        <td colspan="9">ລາຍຮັບຕົວຈິງ: </td>
                        <td colspan="4"><?php echo number_format($newamount,2); ?> ກີບ</td>
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
