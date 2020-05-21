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
    <title>ຈັດການຂໍ້ມູນຫຼັກ</title>
    <link rel="icon" href="../../image/<?php echo $rowshop['img_title']; ?>">
    <link rel="stylesheet" href="../../css/style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
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
                ຈັດກນຂໍ້ມູນຫຼັກ
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
    <div class="container" > 
        <div class="row ">
            <div style="width: 100%;float: left;" align="center">
                <a href="employee.php" class="font12">
                    <img src="../../icon/employee.ico" width="60px" class="img-responsive" ><br>
                   <b>ຂໍ້ມູນພະນັກງານ</b>
                </a>
            </div>
        </div>
    </div>

      <!-- body -->
  </body>
</html>

<?php
    }
?>