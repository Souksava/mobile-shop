<?php
   session_start();
   if($_SESSION['ses_id'] == ''){
       echo"<meta http-equiv='refresh' content='1;URL=../../index.php'>";        
   }
   else if($_SESSION['status'] != 2){
       echo"<meta http-equiv='refresh' content='1;URL=./../Check/logout.php'>";
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
    <title>ສັ່ງຊື້ ແລະ ນຳເຂົ້າ</title>
    <link rel="icon" href="../../image/<?php echo $rowshop['img_title']; ?>">
    <link rel="stylesheet" href="../../css/style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  </head>
  <body >
    <!-- head -->
      <div class="header">
        <div class="container">
                <a href="../main.php" class="tapbar" align="left">
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
    <div class="container">
        <div class="row ">
            <div style="width: 33%;" align="center">
                <a href="frmOrder.php" class="font12">
                     <img src="../../icon/order.ico" width="60px" class="img-responsive" ><br>
                     <b>ສັ່ງຊື້ສິນຄ້າ</b>
                </a>
            </div>
            <div style="width: 33%;" align="center">
                <a href="accept.php" class="font12">
                    <img src="../../icon/accept.ico" width="60px" class="img-responsive" ><br>
                    <?php 
                        $sqlck = "select count(order_id) as ck from orders where status='ອະນຸມັດ' and seen2='NOTSEEN';";
                        $resultck = mysqli_query($link,$sqlck);
                        $rowck = mysqli_fetch_array($resultck, MYSQLI_ASSOC);
                        $sqlck2 = "select count(order_id) as ck from orders where status='ບໍ່ອະນຸມັດ' and seen2='NOTSEEN';";
                        $resultck2 = mysqli_query($link,$sqlck2);
                        $rowck2 = mysqli_fetch_array($resultck2, MYSQLI_ASSOC);
                     ?>
                    <b>ອະນຸມັດ</b>&nbsp&nbsp<span class="badge badge-success"><?php echo $rowck['ck'];?></span> <span class="badge badge-danger"><?php echo $rowck2['ck'];?></span>
                </a>
            </div>
            <div style="width: 33%;" align="center">
                <a href="import.php" class="font12">
                     <img src="../../icon/import.ico" width="60px" class="img-responsive"><br>
                     <b>ນຳເຂົ້າສິນຄ້າ</b>
                </a>
            </div>
        </div><br>
    </div>
      <!-- body -->
  </body>
 
</html>
<?php
   }
?>
