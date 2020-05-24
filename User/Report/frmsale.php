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
    <title>ລາຍງານການຂາຍ</title>
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
                ລາຍງານການຂາຍ
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
    <form action="frmsale.php" id="form1" method="POST">
    <div class="container font14">
        <div class="row">
            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 form-group">
                <label>ເລກທີບິນ, ລູກຄ້າ, ຜູ້ຂາຍ</label>
                <input type="text" name="Search" placeholder="ເລກທີບິນ, ລູກຄ້າ, ຜູ້ຂາຍ" class="form-control" autofocus>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-4  form-group">
                <label>ແຕ່ວັນທີ</label>
                <input type="date" name="date1" class="form-control">
            </div>
            <div class="col-xs-12 col-sm-6 col-md-4 form-group">
                <label>ຫາວັນທີ</label>
                <input type="date" name="date2" class="form-control">
            </div>
            <div class="col-md-12 form-group">
                <button type="submit" name="btn" class="btn btn-outline-danger" style="width: 100%;">ຄົ້ນຫາ</button>
            </div>
            <div class="col-md-12 form-group">
                <button type="submit" name="btnAll" class="btn btn-outline-success" style="width: 100%;">ການຂາຍທັງໝົດ</button>
            </div>
        </div>
    </div>
    </form>
    <?php 
    if(isset($_POST['btnAll'])){
    ?>
        <div class="container font14">
            <div>
                <form action="Report_sale.php" method="POST" id="formReport" target="_blank">
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
                <table class="table" style="width: 1100px;">
                    <tr>
                        <th>#</th>
                        <th>ເລກທີບິນ</th>
                        <th>ລູກຄ້າ</th>
                        <th>ຜູ້ຂາຍ</th>
                        <th>ຍອດລວມ</th>
                        <th>ວັນທີ</th>
                        <th>ເວລາ</th>
                        <th>ການຈ່າຍເງິນ</th>
                        <th></th>
                    </tr>
                    <?php
                        $sql = "select sell_id,cus_name,sell_date,sell_time,amount,status_cash,emp_name from sell s left join customers c on s.cus_id=c.cus_id left join employees e on s.emp_id=e.emp_id order by s.sell_id asc;";
                        $result = mysqli_query($link,$sql);
                        $No_ = 0;
                        while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                    ?>
                    <tr>
                        <td><?php echo $No_ += 1; ?></td>
                        <td><?php echo $row['sell_id'] ?></td>
                        <td><?php echo $row['cus_name'] ?></td>
                        <td><?php echo $row['emp_name'] ?></td>
                        <td><?php echo number_format($row['amount'],2) ?></td>
                        <td><?php echo $row['sell_date'] ?></td>
                        <td><?php echo $row['sell_time'] ?></td>
                        <td><?php echo $row['status_cash'] ?></td>
                        <td>
                            <a href="frm_sale2.php?id=<?php echo $row['sell_id'] ?>">
                                <img src="../../icon/info.ico" alt="" width="20px">&nbsp&nbsp
                            </a>
                        </td>
                    </tr>
                    <?php
                        }
                        $sql2 = "select sum(amount) as amount from sell s left join customers c on s.cus_id=c.cus_id order by s.sell_id asc;";
                        $result2 = mysqli_query($link,$sql2);
                        $row2 = mysqli_fetch_array($result2, MYSQLI_ASSOC);
                    ?>
                    <tr align="right" style="font-size: 26px;">
                        <td colspan="7">ມູນຄ່າທັງໝົດ: </td>
                        <td colspan="3"><?php echo number_format($row2['amount'],2); ?> ກີບ</td>
                    </tr>
                </table>
            </dv>
        </div>
    <?php 
    }
    ?>
    <?php 
    if(isset($_POST['btn'])){
        $Search = $_POST['Search'];
        $date1 = $_POST['date1'];
        $date2 = $_POST['date2'];
    ?>
        <div class="container font14">
            <div>
                <form action="Report_sale.php" method="POST" id="formReport" target="_blank">
                    <input type="hidden" name="name" value="<?php echo $rowshop['name']; ?>">
                    <input type="hidden" name="address" value="<?php echo $rowshop['address']; ?>">
                    <input type="hidden" name="tel" value="<?php echo $rowshop['tel']; ?>">
                    <input type="hidden" name="email" value="<?php echo $rowshop['email']; ?>">
                    <input type="hidden" name="img_path" value="<?php echo $rowshop['img_path']; ?>">
                    <input type="hidden" name="Search" value="<?php echo $Search; ?>">
                    <input type="hidden" name="date1" value="<?php echo $date1; ?>">
                    <input type="hidden" name="date2" value="<?php echo $date2; ?>">
                    <button type="submit" name="btn" class="btn btn-outline-primary">
                        <img src="../../icon/print.ico" alt="" width="35px;">
                    </button>
                </form>
            </div>
            <div class="table-responsive">
                <table class="table" style="width: 1100px;">
                    <tr>
                        <th>#</th>
                        <th>ເລກທີບິນ</th>
                        <th>ລູກຄ້າ</th>
                        <th>ຜູ້ຂາຍ</th>
                        <th>ຍອດລວມ</th>
                        <th>ວັນທີ</th>
                        <th>ເວລາ</th>
                        <th>ການຈ່າຍເງິນ</th>
                        <th></th>
                    </tr>
                    <?php
                        $sql = "select sell_id,cus_name,sell_date,sell_time,amount,status_cash,emp_name from sell s left join customers c on s.cus_id=c.cus_id left join employees e on s.emp_id=e.emp_id where s.sell_id='$Search' or emp_name='$Search' or cus_name='$Search' or sell_date between '$date1' and '$date2' order by s.sell_id asc;";
                        $result = mysqli_query($link,$sql);
                        $No_ = 0;
                        while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                    ?>
                    <tr>
                        <td><?php echo $No_ += 1; ?></td>
                        <td><?php echo $row['sell_id'] ?></td>
                        <td><?php echo $row['cus_name'] ?></td>
                        <td><?php echo $row['emp_name'] ?></td>
                        <td><?php echo number_format($row['amount'],2) ?></td>
                        <td><?php echo $row['sell_date'] ?></td>
                        <td><?php echo $row['sell_time'] ?></td>
                        <td><?php echo $row['status_cash'] ?></td>
                        <td>
                            <a href="frm_sale2.php?id=<?php echo $row['sell_id'] ?>">
                                <img src="../../icon/info.ico" alt="" width="20px">&nbsp&nbsp
                            </a>
                        </td>
                    </tr>
                    <?php
                        }
                        $sql2 = "select sum(amount) as amount from sell s left join customers c on s.cus_id=c.cus_id left join employees e on s.emp_id=e.emp_id where s.sell_id='$Search' or emp_name='$Search' or cus_name='$Search' or sell_date between '$date1' and '$date2' order by s.sell_id asc;";
                        $result2 = mysqli_query($link,$sql2);
                        $row2 = mysqli_fetch_array($result2, MYSQLI_ASSOC);
                    ?>
                    <tr align="right" style="font-size: 26px;">
                        <td colspan="7">ມູນຄ່າທັງໝົດ: </td>
                        <td colspan="3"><?php echo number_format($row2['amount'],2); ?> ກີບ</td>
                    </tr>
                </table>
            </dv>
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
