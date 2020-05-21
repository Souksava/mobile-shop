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
    <title>ລາຍງານ</title>
    <link rel="icon" href="../../image/<?php echo $row['img_title'];?>">
        <link rel="stylesheet" href="../../css/style.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  </head>
  <body >
    <!-- head -->
    <div class="header">
        <div class="container font14">
            <div class="tapbar">
                <a href="../main.php">
                    <img src="../../icon/back.ico" width="30px">
                </a>
            </div>
            <div align="center" class="tapbar">
                <b>ລາຍງານ</b>
            </div>
            <div class="tapbar" align="right">
                <a href="../../Check/Logout.php">
                    <img src="../../icon/close.ico" width="30px">
                </a>
            </div>
        </div>
    </div>
      <div class="clearfix"></div><br>
      <!-- body -->
      <div class="container">
        <div class="row font12">
            <div style="width: 33%;float: left;" align="center"><br>
                <a href="frm_customer.php" class="font12">
                     <img src="../../icon/report.ico" width="50px" class="img-responsive" ><br>
                    <b> ລາຍງານລູກຄ້າ</b>
                </a>
            </div>
            <div style="width: 33%;float: left;" align="center"><br>
                <a href="frm_product.php" class="font12">
                     <img src="../../icon/report.ico" width="50px" class="img-responsive" ><br>
                    <b> ລາຍງານສິນຄ້າ</b>
                </a>
            </div>
            <div style="width: 33%;float: left;" align="center"><br>
                <a href="frmsale.php" class="font12">
                     <img src="../../icon/report.ico" width="50px" class="img-responsive" ><br>
                    <b> ລາຍງານການຂາຍ</b>
                </a>
            </div>
        </div><br>
        <div class="row font12">
            <div style="width: 33%;float: left;" align="center"><br>
                <a href="frm_bestsale.php" class="font12">
                     <img src="../../icon/report.ico" width="50px" class="img-responsive" ><br>
                    <b> ສິນຄ້າຂາຍດີ</b>
                </a>
            </div>
            <div style="width: 33%;float: left;" align="center"><br>
                <a href="frm_revenue.php" class="font12">
                     <img src="../../icon/report.ico" width="50px" class="img-responsive" ><br>
                    <b>ລາຍງານລາຍຮັບ</b>
                </a>
            </div>
            <div style="width: 33%;float: left;" align="center"><br>
                <a href="frm_po.php" class="font12">
                     <img src="../../icon/report.ico" width="50px" class="img-responsive" ><br>
                    <b>ລາຍງານລາຍຈ່າຍ</b>
                </a>
            </div>
        </div>
        <div class="row font12">
            <div style="width: 33%;float: left;" align="center"><br>
                <a href="graph.php" class="font12">
                     <img src="../../icon/report.ico" width="50px" class="img-responsive" ><br>
                    <b>Dashboard Report</b>
                </a>
            </div>
        </div>
    </div>
  </body> 
</html>

<?php
    }
?>
