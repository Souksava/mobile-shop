<?php
    session_start();
    if($_SESSION['ses_id'] == ''){
        echo"<meta http-equiv='refresh' content='1;URL=../../index.php'>";        
    }
    else if($_SESSION['status'] != 2){
        echo"<meta http-equiv='refresh' content='1;URL=../../Check/logout.php'>";
    }
    else{}
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
    <title>ລາຍການສັ່ງຊື້</title>
    <link rel="icon" href="../../image/<?php echo $rowshop['img_title']; ?>">
    <link rel="stylesheet" href="../../css/style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  </head>
  <body >
  <?php 
   if(isset($_GET['savef'])=='fail'){
    echo'<script type="text/javascript">
    swal("", "ບໍ່ສາມາດຕອບຮັບສິນຄ້າໄດ້ !!", "error");
    </script>';
    }
    if(isset($_GET['savef2'])=='false'){
        echo'<script type="text/javascript">
        swal("", "ບໍ່ສາມາດຕອບຮັບສິນຄ້າໄດ້ !!", "error");
        </script>';
    }
    if(isset($_GET['savet'])=='true'){
        echo'<script type="text/javascript">
        swal("", "ຕອບຮັບສິນຄ້າສຳເລັດ !!", "success");
        </script>';
    }
    if(isset($_GET['delivery'])=='null'){
        echo'<script type="text/javascript">
        swal("", "ກະລຸນາປ້ອນຄ່າສົ່ງ !!", "info");
        </script>';
    }
    if(isset($_GET['note'])=='null'){
        echo'<script type="text/javascript">
        swal("", "ກະລຸນາປ້ອນລາຍລະອຽດການຕອບຮັບສິນຄ້າ !!", "info");
        </script>';
    }
  ?>
    <!-- head -->
        <div class="header">
            <div class="container">
                <div class="tapbar">
                    <a href="../main.php">
                        <img src="../../icon/back.ico" width="30px">
                    </a>
                </div>
                <div align="center" class="tapbar fonthead">
                    ລາຍການສັ່ງຊື້
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
            <table class="table">
            <tr class="warning">
                <th>
                    #
                </th>
                <th>
                    ເລກທີບິນ
                </th>
                <th>
                    ລູກຄ້າ
                </th>
                <th>
                    ຍອດລວມ
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
                <th>
                    ການຈ່າຍເງິນ
                </th>
                <th></th>
            </tr>
            <?php
                $sql = "select sell_id,cus_name,sell_date,sell_time,amount,s.status,status_cash from sell s left join customers c on s.cus_id=c.cus_id where status='ສັ່ງຊື້' order by s.sell_id desc;";
                $result = mysqli_query($link,$sql);
                $No_ = 0;
                while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
            ?>
            <tr>
                <td><?php echo $No_ += 1; ?></td>
                <td><?php echo $row['sell_id'] ?></td>
                <td><?php echo $row['cus_name'] ?></td>
                <td><?php echo number_format($row['amount'],2) ?></td>
                <td><?php echo $row['sell_date'] ?></td>
                <td><?php echo $row['sell_time'] ?></td>
                <td><?php echo $row['status'] ?></td>
                <td><?php echo $row['status_cash'] ?></td>
                <td>
                    <a href="cusorder.php?id=<?php echo $row['sell_id'] ?>">
                        <img src="../../icon/info.ico" alt="" width="20px">&nbsp&nbsp
                    </a>
                </td>
            </tr>
            <?php
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
