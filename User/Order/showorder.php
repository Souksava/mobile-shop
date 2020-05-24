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
        $order_id = $_GET['id'];
        $sqlseen = "update orders set seen2='SEEN' where status='ອະນຸມັດ' and order_id='$order_id';";
        $resultseen = mysqli_query($link,$sqlseen);
        $sqlseen2 = "update orders set seen2='SEEN' where status='ບໍ່ອະນຸມັດ' and order_id='$order_id';";
        $resultseen2 = mysqli_query($link,$sqlseen2);
?>
<!Doctype html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>ລາຍລະອຽດ</title>
    <link rel="icon" href="../../image/<?php echo $rowshop['img_title']; ?>">
    <link rel="stylesheet" href="../../css/style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  </head>
  <body >
    <!-- head -->
    <div class="header">
            <div class="container">
                <div class="tapbar">
                    <a href="accept.php">
                        <img src="../../icon/back.ico" width="30px">
                    </a>
                </div>
                <div align="center" class="tapbar fonthead">
                    ອະນຸມັດ
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
    <?php
        $sqlget = "select order_id,company,amount,emp_name,upper(emp_surname) as emp_surname,order_date,e.tel as emp_tel,e.email as emp_email,s.address,s.tel,s.email,order_time,o.status,o.img_path,s.fax from orders o join suppliers s on o.sup_id=s.sup_id join employees e on o.emp_id=e.emp_id where order_id='$order_id';";
        $resultget = mysqli_query($link, $sqlget);
        $rowget = mysqli_fetch_array($resultget, MYSQLI_ASSOC);
        $sqlcompany = "select * from shop;";
        $resultcompany = mysqli_query($link,$sqlcompany);
        $rowcompany = mysqli_fetch_array($resultcompany, MYSQLI_ASSOC);
    ?>
    <form action="Report_Order.php" method="POST" id="form1" target="_blank">
    <div class="container font14">
        <div class="row">
            <div style="float: left;width: 50%;">
                <label>ເລກທີບິນສັ່ງຊື້: <?php echo $rowget['order_id'];?></label><br>
                <label>ວັນທີສັ່ງຊື້: <?php echo $rowget['order_date'];?></label><br>
                <label>ເວລາ: <?php echo $rowget['order_time'];?></label><br>
                    <input type="hidden" name="name" value="<?php echo $rowshop['name']; ?>">
                    <input type="hidden" name="address" value="<?php echo $rowshop['address']; ?>">
                    <input type="hidden" name="tel" value="<?php echo $rowshop['tel']; ?>">
                    <input type="hidden" name="email" value="<?php echo $rowshop['email']; ?>">
                    <input type="hidden" name="img_path" value="<?php echo $rowshop['img_path']; ?>">
                    <input type="hidden" name="emp_name" value="<?php echo $rowget['emp_name']; ?>">
                    <input type="hidden" name="emp_surname" value="<?php echo $rowget['emp_surname']; ?>">
                    <input type="hidden" name="emp_email" value="<?php echo $rowget['emp_email']; ?>">
                    <input type="hidden" name="emp_tel" value="<?php echo $rowget['emp_tel']; ?>">
                    <input type="hidden" name="sup_tel" value="<?php echo $rowget['tel']; ?>">
                    <input type="hidden" name="company" value="<?php echo $rowget['company']; ?>">
                    <input type="hidden" name="sup_fax" value="<?php echo $rowget['fax']; ?>">
                    <input type="hidden" name="sup_email" value="<?php echo $rowget['email']; ?>">
                    <input type="hidden" name="sup_address" value="<?php echo $rowget['address']; ?>">
                    <input type="hidden" name="order_id" value="<?php echo $order_id; ?>">
                    <button type="submit" name="btn" class="btn btn-outline-primary">
                        <img src="../../icon/print.ico" alt="" width="35px;">
                    </button>
               
            </div>
            <div style="float: right;width: 50%;" align="right">
                <label>ຜູ້ສະໜອງ: <?php echo $rowget['company'];?></label><br>
                <label>ຜູ້ສັ່ງຊື້: <?php echo $rowget['emp_name'];?></label><br>
                <label>ສະຖານະ: <?php echo $rowget['status'];?></label><br>
                <a href="#" data-toggle="modal" data-target="#myModal">
                    <img src="../../Stock/Management/images/<?php echo $rowget['img_path']; ?>" alt="" width="40px" height="40px" alt="" class="img-circle" /><br>
                </a>
                <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog" role="document" style="margin-left: 0px;">
                        <img src="../../Stock/Management/images/<?php echo $rowget['img_path']; ?>" width="100%"  class="imagelist" />
                    </div>
                </div>
            </div>
        </div><br>
        <div class="row">
            <div class="col-xs-12 col-sm-6 col-md-4 form-group">
                <select name="rate" class="form-control" id="">
                    <option value="">ເລືອກສະກຸນເງິນ</option>
                    <option value="LAK">LAK</option>
                    <option value="THB">THB</option>
                    <option value="USD">USD</option>
                </select>
            </div>
        </div>
    </div><br>
    </form>
    <div class="container font14">
        <div class="table-responsive">
            <table class="table table-striped">
                <tr class="info">
                    <th>#</th>
                    <th>ລະຫັດສິນຄ້າ ຫຼື ບາໂຄດ</th>
                    <th>ຍີ່ຫໍ້</th>
                    <th>ຊື່ສິນຄ້າ</th>
                    <th>ປະເພດ</th>
                    <th>ຈຳນວນ</th>
                    <th>ຫົວໜ່ວຍ</th>
                    <th>ລາຄາ</th>
                    <th>ລວມ</th>
                </tr>
                <?php
                $sql = "select o.pro_id,pro_name,unit_name,cated_name,brand_name,o.qty,o.price,o.qty*o.price as total from orderdetail o left join product p on o.pro_id=p.pro_id left join categorydetail i on p.cated_id=i.cated_id left join unit u on p.unit_id=u.unit_id left join brand b on p.brand_id=b.brand_id where order_id='$order_id';";
                $result = mysqli_query($link, $sql);
                $no_ = 0;
                while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                ?>
                <tr>
                        <td><?php echo $no_ = $no_ + 1;?></td>
                        <td><?php echo $row['pro_id'];?></td>
                        <td><?php echo $row['brand_name'];?></td>
                        <td><?php echo $row['pro_name'];?></td>
                        <td><?php echo $row['cated_name'];?></td>
                        <td><?php echo $row['qty'];?></td>
                        <td><?php echo $row['unit_name'];?></td>
                        <td><?php echo number_format($row['price'],2);?></td>
                        <td><?php echo number_format($row['total'],2);?></td>
                </tr>
                <?php
                }
                
                $sqltotal = "select sum(qty*price) as total from orderdetail where order_id='$order_id';";
                $resulttotal = mysqli_query($link, $sqltotal);
                $rowtotal = mysqli_fetch_array($resulttotal, MYSQLI_ASSOC);
                ?>
                <tr class="font14 warning">
                    <td colspan="5" align="right"><h3><b>ລວມມູນຄ່າ:</b></h3></td>
                    <td colspan="4" align="right"><h3> <?php echo number_format($rowtotal['total'],2); ?></h3></td>
                </tr>
            </table>
        </div>
    </div>

      <!-- body -->
  </body>
        <script src="../../js/production_jQuery331.js"></script>
        <script src="../../js/bootstrap.min.js"></script>
        <script src="../../js/Style.js"></script>
</html>

<?php
    }
?>
