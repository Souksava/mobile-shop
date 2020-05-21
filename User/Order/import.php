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
    <title>ນຳເຂົ້າສິນຄ້າ</title>
    <link rel="icon" href="../../image/<?php echo $rowshop['img_title']; ?>">
    <link rel="stylesheet" href="../../css/style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  </head>
  <body >
    <!-- head -->
    <div class="header">
        <div class="container">
                <a href="order.php" class="tapbar" align="left">
                    <img src="../../icon/back.ico" width="30px">
                </a>
            <div align="center" class="tapbar fonthead">
                <b>ສັ່ງຊື້ ແລະ ນຳເຂົ້າ</b>
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
    <div class="container font14">
        <form action="import.php" method="POST" id="form1">
            <div class="row" align="center">
                <div class="col-md-12 form-group">
                    <input type="text" name="order_id" class="form-control" placeholder="ເລກທີບິນ">
                </div>
                <div class="col-md-12 form-group">
                    <button type="submit" name="btnshow" class="btn btn-outline-info" style="width: 90%;">
                        ສະແດງລາຍການ
                    </button>
                </div>
            </div>
        </form>
        <hr width="90%" />
    </div>
    <?php 
      if(isset($_POST['btnshow'])){
        $order_id = $_POST['order_id'];
        $sqlget = "select order_id,emp_name,company,amount,order_date,order_time,o.status from orders o join employees e on o.emp_id=e.emp_id join suppliers s on o.sup_id=s.sup_id where order_id='$order_id';";
        $resultget = mysqli_query($link,$sqlget);
        $rowget = mysqli_fetch_array($resultget, MYSQLI_ASSOC);
      
    ?>
    <div class="container font14">
        <div style="float: left; width: 50%;">
            <label>ເລກທີບິນ: <?php echo $rowget['order_id'];?></label><br>
            <label>ວັນທີສັ່ງຊື້: <?php echo $rowget['order_date'];?></label><br>
            <label>ເວລາ: <?php echo $rowget['order_time'];?></label>
        </div>
        <div style="float: right; width: 50%;text-align: right">
            <label>ຜູ້ສະໜອງ: <?php echo $rowget['company'];?></label><br>
            <label>ຜູ້ສັ່ງຊື້: <?php echo $rowget['emp_name'];?></label><br>
            <label>ສະຖານະ: <?php echo $rowget['status'];?></label>
        </div>
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
                    <th></th>
                </tr>
            <?php
                $sql = "select detail_id,o.order_id,company,o.pro_id,pro_name,cated_name,o.qty,unit_name,o.price,o.qty*o.price as total,brand_name from orderdetail o left join product p on o.pro_id=p.pro_id left join categorydetail i on p.cated_id=i.cated_id left join unit u on p.unit_id=u.unit_id left join orders d on o.order_id=d.order_id left join suppliers s on d.sup_id=s.sup_id left join brand b on p.brand_id=b.brand_id where o.order_id='$order_id';";
                $result = mysqli_query($link,$sql);
                $No_ = 0;
                while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
            ?>
                <tr>
                    <td><?php echo $No_ += 1;?></td>
                    <td><?php echo $row['pro_id'];?></td>
                    <td><?php echo $row['brand_name'];?></td>
                    <td><?php echo $row['pro_name'];?></td>
                    <td><?php echo $row['cated_name'];?></td>
                    <td><?php echo $row['qty'];?></td>
                    <td><?php echo $row['unit_name'];?></td>
                    <td><?php echo number_format($row['price'],2);?></td>
                    <td><?php echo number_format($row['total'],2);?></td>
                    <td align="right">
                        <a href="import2.php?id=<?php echo $row['detail_id'];?>" class="btn btn-outline-success">
                            ນຳເຂົ້າສິນຄ້າ
                            <span class="glyphicon glyphicon-menu-right" aria-hidden="true"></span>
                        </a>
                    </td>
                </tr>
            <?php
                }
                mysqli_close($link);
            ?>
            </table>
        </div>
        <?php
                
        }
        ?>
    </div>
      <!-- body -->
  </body>
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</html>
<?php
    }
?>
