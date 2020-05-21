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
    <title>ລາຍງານລູກຄ້າ</title>
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
                    ລາຍງານລູກຄ້າ
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
    $sqlcount = "select count(*) as count_total from customers";
    $resultcount = mysqli_query($link,$sqlcount);
    $rowcount = mysqli_fetch_array($resultcount,MYSQLI_ASSOC);
    $countcus = $rowcount['count_total'];
    ?>
    <div class="container font14">
        <div>
            <form action="Report_customer.php" method="POST" id="formReport">
                <input type="hidden" name="name" value="<?php echo $rowshop['name']; ?>">
                <input type="hidden" name="address" value="<?php echo $rowshop['address']; ?>">
                <input type="hidden" name="tel" value="<?php echo $rowshop['tel']; ?>">
                <input type="hidden" name="email" value="<?php echo $rowshop['email']; ?>">
                <input type="hidden" name="img_path" value="<?php echo $rowshop['img_path']; ?>">
                <button type="submit" name="btnReport" class="btn btn-outline-primary">
                    <img src="../../icon/print.ico" alt="" width="35px;">
                </button>
            </form>
        </div>
        <div class="table-responsive" style="width: 1200px;">
            <table class="table">
            <tr class="warning">
                <th style="width:20px;">
                    #
                </th>
                <th style="width: 200px;">
                    ຊື່ ແລະ ນາມສະກຸນ
                </th>
                <th style="width:50px;">
                    ເພດ
                </th>
                <th style="width:250px;">
                    ທີ່ຢູ່
                </th>
                <th style="width:120px;">
                    ເບີໂທລະສັບ
                </th>
                <th style="width:120px;">
                    ອີເມວ
                </th>
                <th style="width:120px;">
                    ປະເພດລູກຄ້າ
                </th>
            </tr>
            <?php
                $sql = "select * from customers order by cus_name asc;";
                $result = mysqli_query($link,$sql);
                $No_ = 0;
                while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
            ?>
            <tr>
                <td><?php echo $No_ += 1; ?></td>
                <td><?php echo $row['cus_name'] ?> <?php echo $row['cus_surname'] ?></td>
                <td><?php echo $row['gender'] ?></td>
                <td><?php echo $row['address'] ?></td>
                <td><?php echo $row['tel'] ?></td>
                <td><?php echo $row['email'] ?></td>
                <td>
                <?php 
                    if(trim($row['fb_id']) == ""){
                        echo"ລູກຄ້າສະມາຊິກ";
                    }
                    else{
                        echo"Facebook";
                    }
                ?>
                </td>
            </tr>
            <?php
                }
            ?>
            <tr align="right">
                <td colspan="4" style="font-size: 26px;">ຈຳນວນທັງໝົດ:</td>
                <td colspan="2" style="font-size: 26px;"><?php echo $countcus; ?> ຄົນ</td>
            </tr>
            </table>
        </div>
    </div>

      <!-- body -->
  </body>
        <script src="../../js/bootstrap.min.js" type="javascript"></script>
        <script src="../../js/production_jQuery331.js"></script>
        <script src="../../js/style.js"></script>
</html>
