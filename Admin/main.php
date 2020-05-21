<?php
   session_start();
    if($_SESSION['ses_id'] == ''){
        echo"<meta http-equiv='refresh' content='1;URL=../index.php'>";        
    }
    else if($_SESSION['status'] != 1){
        echo"<meta http-equiv='refresh' content='1;URL=../Check/logout.php'>";
    }
    else{
        require '../ConnectDB/connectDB.php';
        date_default_timezone_set("Asia/Bangkok");
        $datenow = time();
        $Date = date("Y-m-d",$datenow);
        $sql = "select * from shop;";
        $result = mysqli_query($link,$sql);
        $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
?>
<!Doctype html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>ໜ້າຫຼັກ</title>
    <link rel="icon" href="../image/<?php echo $row['img_title'];?>">
        <link rel="stylesheet" href="../css/style.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  </head>
  <body >
    <!-- head -->
    <div class="header">
        <div class="container">
            <div class="tapbar fonthead">
                <?php echo $_SESSION['emp_name']; ?>
            </div>
            <div align="center" class="tapbar">
                <b> <?php echo $row['name']; ?></b>
            </div>
            <div class="tapbar" align="right">
                <a href="../Check/Logout.php">
                    <img src="../icon/close.ico" width="30px">
                </a>
            </div>
        </div>
    </div>
      <div class="clearfix"></div><br>
      <!-- body -->
      <div class="container">
        <div class="row font12">
            <div style="width: 33%;float: left;" align="center">
                <a href="Management/management.php" class="font12">
                     <img src="../icon/management.ico" width="60px" class="img-responsive" ><br>
                     <b>ຈັດການຂໍ້ມູນຫຼັກ</b>
                </a>
            </div>
            <div style="width: 33%;float: left;" align="center">
                <a href="accept/accept.php" class="font12">
                    <img src="../icon/accept.ico" width="60px" class="img-responsive" ><br>
                    <?php 
                        $sqlck = "select count(order_id) as ck from orders where status='ຍັງບໍ່ອະນຸມັດ' and seen1='NOTSEEN';";
                        $resultck = mysqli_query($link,$sqlck);
                        $rowck = mysqli_fetch_array($resultck, MYSQLI_ASSOC);
                     ?>
                   <b>ອະນຸມັດ</b>&nbsp&nbsp<span class="badge badge-danger"><?php echo $rowck['ck'];?></span>
                </a>
            </div>
            <div style="width: 33%;float: left;" align="center"><br>
                <a href="Report/report.php" class="font12">
                     <img src="../icon/report.ico" width="50px" class="img-responsive" ><br>
                    <b> ລາຍງານ</b>
                </a>
            </div>
        </div><br>
    </div>
  </body> 
</html>

<?php
    }
?>
