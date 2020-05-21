
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
    <title>ອະນຸມັດ</title>
    <link rel="icon" href="../../image/<?php echo $rowshop['img_title']; ?>">
    <link rel="stylesheet" href="../../css/style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  </head>
  <body >
    <!-- head -->
        <div class="header">
            <div class="container">
                <div class="tapbar">
                    <a href="order.php">
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
    <div class="container font14">
        <form action="accept.php" method="POST" id="form1">
            <div class="row" align="center">
                <div class="col-md-12 col-sm-6 form-group">
                    <input type="text" class="form-control" name="bill" placeholder="ເລກທີບິນ">
                </div>
                <div class="col-md-12 col-sm-6 form-group">
                    <label>ວັນທີສັ່ງຊື້</label><br>
                    <input type="date" name="dateorder" class="form-control">
                </div>
                <div class="col-md-12 form-group">
                    <select name="status" id="" class="form-control">
                        <option value="">ເລືອກສະຖານະການສັ່ງຊື້</option>
                        <option value="ອະນຸມັດ">ອະນຸມັດ</option>
                        <option value="ຍັງບໍ່ອະນຸມັດ">ຍັງບໍ່ອະນຸມັດ</option>
                        <option value="ບໍ່ອະນຸມັດ">ບໍ່ອະນຸມັດ</option>
                    </select>
                </div>
                <div class="col-md-12 form-group">
                    <button type="submit" name="btnshow" class="btn btn-outline-success" style="width: 90%;">
                        ສະແດງໃບບິນ
                    </button>
                </div>
            </div>
        </form>
        <hr width="90%" />
    </div>
    <div class="container font14">
        <div class="table-responsive">
            <table class="table table-striped">
            <tr class="warning">
                <th>
                    ເລກທີບິນ
                </th>
                <th>
                    ຜູ້ສະໜອງ
                </th>
                <th>
                    ລວມ
                </th>
                <th>
                    ຜູ້ສັ່ງຊື້
                </th>
                <th>
                    ວັນທີ
                </th>
                <th>
                    ເວລາ
                </th>
                <th>
                    ສະຖານະ
                </th>
                <th></th>
            </tr>
            <?php
                if(isset($_POST['btnshow'])){
                   $bill = $_POST['bill'];
                   $date = $_POST['dateorder'];
                   $status = $_POST['status'];  
                   if(trim($date) == ""){
                       $date = "0000-00-00";
                   }
                    $sql = "select order_id,emp_name,company,amount,order_date,order_time,o.status from orders o left join employees e on o.emp_id=e.emp_id left join suppliers s  on o.sup_id=s.sup_id where order_id='$bill' or order_date='$date' or o.status='$status';";
                    $result = mysqli_query($link,$sql);
                    while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
            ?>
            <tr>
                <td><?php echo $row['order_id'] ?></td>
                <td><?php echo $row['company'] ?></td>
                <td><?php echo number_format($row['amount'],2) ?></td>
                <td><?php echo $row['emp_name'] ?></td>
                <td><?php echo $row['order_date'] ?></td>
                <td><?php echo $row['order_time'] ?></td>
                <td><?php echo $row['status'] ?></td>
                <td>
                    <a href="Showorder.php?id=<?php echo $row['order_id'] ?>">
                        <img src="../../icon/info.ico" alt="" width="25px">&nbsp&nbsp
                    </a>
                    <a href="delorder.php?id=<?php echo $row['order_id'] ?>">
                        <img src="../../icon/delete.ico" alt="" width="25px">
                    </a>
                </td>
            </tr>
            <?php
                }
            }
            ?>
            </table>
        </div>
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
