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
    <title>ລາຍງານການຂາຍ</title>
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
                    ລາຍງານການຂາຍ
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
        <form action="frm_product.php" id="form1" method="POST">
            <div class="row">
                <div class="col-md-8">
                    <div class="input-group">        
                        <input type="text" name="Search"  placeholder="ລະຫັດສິນຄ້າ, ຊື່ສິນຄ້າ, ປະເພດສິນຄ້າ, ຍີ່ຫໍ້, ຫົວໜ່ວຍສິນຄ້າ" class="form-control" autofocus>
                        <div class="input-group-prepend">
                            <button type="submit" name="btnSearch" class="btn btn-outline-danger">ຄົ້ນຫາ</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div><br>
    <?php 
        if(isset($_POST['btnSearch'])){
            $Search2 = $_POST['Search'];
            $Search = "%".$_POST['Search']."%";
    ?>
        <div class="container font14">
            <div class="row">
                <div>
                    <form action="Report_product.php" method="POST" id="formReport">
                        <input type="hidden" name="name" value="<?php echo $rowshop['name']; ?>">
                        <input type="hidden" name="address" value="<?php echo $rowshop['address']; ?>">
                        <input type="hidden" name="tel" value="<?php echo $rowshop['tel']; ?>">
                        <input type="hidden" name="email" value="<?php echo $rowshop['email']; ?>">
                        <input type="hidden" name="img_path" value="<?php echo $rowshop['img_path']; ?>">
                        <input type="hidden" name="Search" value="<?php echo $Search2; ?>">
                        <button type="submit" name="btnReport" class="btn btn-outline-primary">
                            <img src="../../icon/print.ico" alt="" width="35px;">
                        </button>
                    </form>
                </div>
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table" style="width: 1100px;">
                            <tr>
                                <th style="width: 25px;">#</th>
                                <th style="width: 110px;" scope="col">ສິນຄ້າ</th>
                                <th style="width: 180px;" scope="col">ຊື່ສິນຄ້າ</th>
                                <th style="width: 100px;" scope="col">ຈຳນວນ</th>
                                <th style="width: 170px;" scope="col">ລາຄາ</th>
                                <th style="width: 170px;" scope="col">ລວມ</th>
                            </tr>
                            <?php 
                                $sqlshow = "select p.pro_id,pro_name,cated_name,brand_name,unit_name,p.img_path,p.qty,p.price,p.price - p.promotion as newprice,p.promotion,(p.promotion/p.price) * 100 as perzen,p.qty*(p.price - p.promotion) as total from  product p left join categorydetail i  on p.cated_id=i.cated_id left join brand b on p.brand_id=b.brand_id left join unit u on p.unit_id=u.unit_id where p.pro_id like '$Search' or pro_name like '$Search' or brand_name like '$Search' or unit_name like '$Search' or cated_name like '$Search';";
                                $resultshow = mysqli_query($link,$sqlshow);
                                $bill = 0;
                                while($rowshow = mysqli_fetch_array($resultshow, MYSQLI_ASSOC)){
                            ?>
                            <tr>
                                <td><?php echo $bill += 1;?></td>
                                <th scope="row" ><img src="../../image/<?php echo $rowshow['img_path']; ?>" alt="" style="width: 100px;heigt: 100px;"></th>
                                <td><?php echo $rowshow['cated_name']; ?> <?php echo $rowshow['brand_name']; ?> <?php echo $rowshow['pro_name']; ?></td>
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
                                $sqlsum = "select sum(p.qty*(p.price - p.promotion)) as amount from  product p left join categorydetail i  on p.cated_id=i.cated_id left join brand b on p.brand_id=b.brand_id left join unit u on p.unit_id=u.unit_id where p.pro_id like '$Search' or pro_name like '$Search' or brand_name like '$Search' or unit_name like '$Search' or cated_name like '$Search';";
                                $resultsum = mysqli_query($link,$sqlsum);
                                $rowsum = mysqli_fetch_array($resultsum, MYSQLI_ASSOC);
                            ?>
                        </table>
                        <hr size="3" align="center" width="100%">
                    </div>
                    <div align="right" style="font-size: 26px;">
                        <div class="col-md-12 ">
                            ຍອມລວມ (ລວມພາສີມູນຄ່າເພີ່ມ) 
                        </div>
                        <div class="col-md-12">
                            <br><h4 style="color: #CE3131;"><?php echo number_format($rowsum['amount'],2) ?> ກີບ</h4> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php 
        }
        ?>
    <!-- body -->
  </body>
        <script src="../../js/bootstrap.min.js" type="javascript"></script>
        <script src="../../js/production_jQuery331.js"></script>
        <script src="../../js/style.js"></script>
</html>

<?php
    }
?>
