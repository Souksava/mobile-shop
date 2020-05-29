<?php
    session_start();
    if($_SESSION['ses_id'] == ''){
        echo"<meta http-equiv='refresh' content='1;URL=../../index.php'>";        
    }
    else if($_SESSION['status'] != 1){
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
    <title>Accept</title>
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
                    <a href="../main.php">
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
        <div class="table-responsive">
            <table class="table table-striped">
            <tr class="warning">
                <th>
                    #
                </th>
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
                $sql = "select order_id,company,amount,emp_name,order_date,order_time,o.status from orders o join suppliers s on o.sup_id=s.sup_id join employees e on o.emp_id=e.emp_id where o.status='ຍັງບໍ່ອະນຸມັດ';";
                $result = mysqli_query($link,$sql);
                $No_ = 0;
                while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
            ?>
            <tr>
                <td><?php echo $No_ += 1; ?></td>
                <td><?php echo $row['order_id'] ?></td>
                <td><?php echo $row['company'] ?></td>
                <td><?php echo number_format($row['amount'],2) ?></td>
                <td><?php echo $row['emp_name'] ?></td>
                <td><?php echo $row['order_date'] ?></td>
                <td><?php echo $row['order_time'] ?></td>
                <td><?php echo $row['status'] ?></td>
                <td>
                    <a href="showorder.php?id=<?php echo $row['order_id'] ?>">
                        <img src="../../icon/info.ico" alt="" width="20px">&nbsp&nbsp
                    </a>
                </td>
            </tr>
            <?php
                }
                if(isset($_GET['accept'])=='found'){
                    echo'<script type="text/javascript">
                    swal("", "ບໍ່ສາມາດອະນຸມັດການສັ່ງຊື້ໄດ້ ກະລຸນາລອງໃໝ່ອີກຄັ້ງ !", "error");
                    </script>';
                }
                if(isset($_GET['accept'])=='success'){
                    echo'<script type="text/javascript">
                    swal("", "ອະນຸມັດການສັ່ງຊື້ສຳເລັດ !", "success");
                    </script>';
                }
                if(isset($_GET['notaccept'])=='found'){
                    echo'<script type="text/javascript">
                    swal("", "ປະຕິເສດການສັ່ງຊື້ບໍ່ສຳເລັດ ກະລຸນາລອງໃໝ່ອີກຄັ້ງ !", "error");
                    </script>';
                }
                if(isset($_GET['notaccept'])=='success'){
                    echo'<script type="text/javascript">
                    swal("", "ປະຕິເສດການສັ່ງຊື້ສຳເລັດ !", "success");
                    </script>';
                }
            ?>
            </table>
        </div>
    </div>

      <!-- body -->
  </body>
        <script src="../../js/bootstrap.min.js" type="javascript"></script>
        <script src="../../js/production_jQuery331.js"></script>
        <script src="../../js/style.js"></script>
</html>

<?php
    }
   
?>
