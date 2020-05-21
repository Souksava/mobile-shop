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
    $emp_id = $_SESSION['emp_id'];
?>
<!Doctype html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>ຂາຍສິນຄ້າ</title>
    <link rel="icon" href="../../image/<?php echo $rowshop['img_title']; ?>">
    <link rel="stylesheet" href="../../css/style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  </head>
  <body >
      <div class="clearfix"></div><br>
      <!-- body -->
    <?php 
    $sqlsell = "select sum((p.price - p.promotion)*d.qty) as amount from listselldetail2 d left join product p on d.pro_id=p.pro_id  where d.emp_id='$emp_id';";
    $resultsell = mysqli_query($link,$sqlsell);
    $rowsell = mysqli_fetch_array($resultsell,MYSQLI_ASSOC);
    ?>
    <div class="container-fluid font12">
        <div>
            <img src="../../image/<?php echo $rowshop['img_path']; ?>" width="100px;" alt=""><br><br>
        </div>
		<div class="row">
			<div class="col-md-8">
                ລາຍການສິນຄ້າ
                <div class="table-responsive">
                    <table class="table" style="width: 900px;">
                        <tr>
                            <th style="width: 110px;" scope="col">ສິນຄ້າ</th>
                            <th style="width: 180px;" scope="col">ຊື່ສິນຄ້າ</th>
                            <th style="width: 60px;" scope="col">ຈຳນວນ</th>
                            <th style="width: 170px;" scope="col">ລາຄາ</th>
                            <th style="width: 170px;" scope="col">ລວມ</th>
                        </tr>
                        <?php 
                            $sqlshow = "select detail_id,d.pro_id,pro_name,cated_name,brand_name,unit_name,p.img_path,d.qty,p.price,p.price - p.promotion as newprice,p.promotion,(p.promotion/p.price) * 100 as perzen,d.qty*(p.price - p.promotion) as total from listselldetail2 d left join product p on d.pro_id=p.pro_id left join categorydetail i  on p.cated_id=i.cated_id left join brand b on p.brand_id=b.brand_id left join unit u on p.unit_id=u.unit_id where d.emp_id='$emp_id';";
                            $resultshow = mysqli_query($link,$sqlshow);
                            while($rowshow = mysqli_fetch_array($resultshow, MYSQLI_ASSOC)){
                        ?>
                        <tr>
                            <th scope="row" ><img src="../../image/<?php echo $rowshow['img_path']; ?>" alt="" style="width: 100px;heigt: 100px;"></th>
                            <td><?php echo $rowshow['cated_name']; ?> <?php echo $rowshow['brand_name']; ?> <?php echo $rowshow['pro_name']; ?> </td>
                            <td> 
                                <?php echo $rowshow['qty']; ?> <?php echo $rowshow['unit_name']; ?>
                            </td>
                            <td >
                                <h6 style="color: #CE3131;">ລາຄາ <?php echo number_format($rowshow['newprice'],2); ?> ກີບ</h6>
                               <h7>ລາຄາປົກກະຕິ <?php echo number_format($rowshow['price'],2); ?> ກີບ</h7>
                               <div style="color: #7E7C7C;font-size: 12px;">ສ່ວນຫຼຸດ <?php echo number_format($rowshow['promotion'],2); ?>  ກີບ (<?php echo number_format($rowshow['perzen'],2); ?> %)</div>
                            </td>
                            <td> 
                                <h6 style="color: #CE3131;"><?php echo number_format($rowshow['total'],2); ?> ກີບ</h6>
                            </td>
                        </tr>
                        <?php 
                            }
                        ?>
                    </table>
                    <hr size="3" align="center" width="100%">
                </div>
                <div align="right">
                    <div class="col-md-12 ">
                        ຍອມລວມ (ລວມພາສີມູນຄ່າເພີ່ມ) 
                    </div>
                    <div class="col-md-12">
                        <br> <h4 style="color: #CE3131;"><?php echo number_format($rowsell['amount'],2) ?> ກີບ</h4> 
                    </div>
                </div>
            </div>
            <div class="col-lg-3 font12">
                <div class="row row-cols-1 row-cols-md-1">
                    <div class="col mb-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 align="center" class="card-title"></h5>
                                <p class="card-text">
                                    <form action="sale2.php" id="form1" method="POST">
                                        <div class="row">
                                            <?php 
                                            $sqlbill = "select max(sell_id) as bill from sell;";
                                            $resultbill = mysqli_query($link,$sqlbill);
                                            $rowbill = mysqli_fetch_array($resultbill,MYSQLI_ASSOC);
                                            $bill = $rowbill['bill'] + 1;
                                            ?>
                                            <div class="col-md-12">
                                                ມູນຄ່າລວມ<br><br>
                                                <h4 style="color: #CE3131;"><?php echo number_format($rowsell['amount'],2) ?> ກີບ</h4> 
                                            </div>
                                            <hr size="3" align="center" width="100%">
                                            <div class="col-md-12 form-group">
                                                <div class="row">
                                                    <div class="col-xs-12 col-sm-6">
                                                        ອັດຕາແລກປ່ຽນ<br>
                                                        <p style="font-size: 12px;">
                                                            <?php 
                                                                $sqlrate = "select * from rate where rate_id !='LAK';";
                                                                $resultrate = mysqli_query($link,$sqlrate);
                                                                while($rowrate = mysqli_fetch_array($resultrate,MYSQLI_ASSOC)){
                                                                    echo number_format($rowrate['rate_buy'],2);echo"&nbsp;&nbsp;&nbsp;"; echo $rowrate['rate_id'];echo"<br>";
                                                                }
                                                            ?> 
                                                        </p>
                                                    </div>
                                                    <div align="right" class="col-xs-12 col-sm-6">
                                                        ເລກທີບິນ: <?php echo $bill;?>
                                                    </div>
                                                </div>
                                                <?php
                                                    $sqlpayment = "select * from credit_card;";
                                                    $resultpayment = mysqli_query($link,$sqlpayment);
                                                    while($rowpayment = mysqli_fetch_array($resultpayment,MYSQLI_ASSOC)){
                                                ?>
                                                <div class="row">
                                                    <div class="col-xs-12 col-sm-6">
                                                            ທະນາຄານ<br>
                                                            <p style="font-size: 12px;">
                                                                <?php echo $rowpayment['card_id']; ?>
                                                            </p>
                                                    </div>
                                                    <div align="right" class="col-xs-12 col-sm-6" style="font-size: 11px;">
                                                        <img src="../../image/<?php echo $rowpayment['img_path']; ?>" width="80px;" alt=""><br><br>
                                                        <?php
                                                            echo $rowpayment['ac_name'];echo"<br>";
                                                            echo $rowpayment['ac_no'];
                                                        ?>
                                                    </div>
                                                </div>
                                                <?php
                                                    }
                                                ?>
                                        </div>
                                    </form>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
			</div>
		</div>
    </div>
      <!-- body -->
  </body>
 
</html>
<?php
   } 
?>
