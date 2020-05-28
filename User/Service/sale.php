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
    <!-- head -->
      <div class="header">
        <div class="container">
                <a href="../main.php" class="tapbar" align="left">
                    <img src="../../icon/back.ico" width="30px">
                </a>
            <div align="center" class="tapbar fonthead">
                <b>ຂາຍສິນຄ້າ</b>
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
       <div class="row">
            <div class="col-md-8">
                <form action="sale.php" id="form1" method="POST">
                    <div class="input-group">        
                        <input type="text" name="pro_id"  placeholder="ລະຫັດສິນຄ້າ" class="form-control" autofocus>
                        <input type="number" min="0" name="qty" placeholder="ຈຳນວນ" class="form-control">
                        <div class="input-group-prepend">
                            <button type="submit" name="btnAdd" class="btn btn-outline-primary">ເພີ່ມລາຍການ</button>
                        </div>
                    </div>
                </form>
            </div>
       </div>
    </div>
    <?php 
    if(isset($_POST['btnAdd'])){
        $pro_id = $_POST['pro_id'];
        $qty = $_POST['qty'];
        if(trim($qty) == ""){
            $qty = "1";
        }
        if(trim($pro_id) == ""){
            echo"<script>";
            echo"window.location.href='sale.php?pro_id=null';";
            echo"</script>";
        }
        else{
            $sqlckstock = "select * from product where pro_id='$pro_id';";
            $resultckstock = mysqli_query($link,$sqlckstock);
            $rowstock = mysqli_fetch_array($resultckstock,MYSQLI_ASSOC);
            $qtystock = $rowstock['qty'];
            if($qty > $qtystock){
                echo"<script>";
                echo"window.location.href='sale.php?qty=than';";
                echo"</script>";
            }
            else{
                $sqlck = "select * from listselldetail2 where pro_id='$pro_id' and emp_id='$emp_id';";
                $resultck = mysqli_query($link,$sqlck);
                if(mysqli_num_rows($resultck) > 0){
                    $sqlupdate = "update listselldetail2 set qty=qty+'$qty' where pro_id='$pro_id' and emp_id='$emp_id';";
                    $resultupdate = mysqli_query($link,$sqlupdate);
                }
                else{
                    $sqladd = "insert into listselldetail2(pro_id,qty,emp_id) values('$pro_id','$qty','$emp_id');";
                    $resultadd = mysqli_query($link,$sqladd);
                    $sqldel3 = "update product set qty=qty-'$qty' where pro_id='$pro_id';";
                    $resultdel3 = mysqli_query($link,$sqldel3);
                }
            }
        }
    }
    if(isset($_GET['id'])){
        $detail_id = $_GET['id'];
        $sqlckqty = "select * from listselldetail2 where detail_id='$detail_id';";
        $resultckqty = mysqli_query($link,$sqlckqty);
        $rowckqty = mysqli_fetch_array($resultckqty,MYSQLI_ASSOC);
        $qtyadd = $rowckqty['qty'];
        $pro_idadd = $rowckqty['pro_id'];
        $sqldel2 = "update product set qty=qty+'$qtyadd' where pro_id='$pro_idadd';";
        $resultdel2 = mysqli_query($link,$sqldel2);
        $sqldel = "delete from listselldetail2 where detail_id='$detail_id' and emp_id='$emp_id';";
        $resultdel = mysqli_query($link,$sqldel);
    }
    if(isset($_GET['pro_id'])=='null'){
        echo'<script type="text/javascript">
        swal("", "ກະລຸນາປ້ອນລະຫັດສິນຄ້າ !", "info");
        </script>';
    }
    if(isset($_GET['qty'])=='than'){
        echo'<script type="text/javascript">
        swal("", "ບໍ່ສາມາດເພີ່ມລາຍການຂາຍໄດ້ເນື່ອງຈາກທ່ານປ້ອນຈຳນວນເກີນສະຕ໋ອກສິນຄ້າ", "info");
        </script>';
    }
    if(isset($_GET['amount'])=='null'){
        echo'<script type="text/javascript">
        swal("", "ກະລຸນາເພີ່ມລາຍການສິນຄ້າ !", "info");
        </script>';
    }
    if(isset($_GET['save1'])=='false1'){
        echo'<script type="text/javascript">
        swal("", "ບໍ່ສາມາດບັນທຶກການຂາຍໄດ້ !!", "error");
        </script>';
    }
    if(isset($_GET['save2'])=='false2'){
        echo'<script type="text/javascript">
        swal("", "ບໍ່ສາມາດບັນທຶກການຂາຍໄດ້ !!", "error");
        </script>';
    }
    if(isset($_GET['savet'])=='true'){
        echo'<script type="text/javascript">
        swal("", "ບັນທຶກການຂາຍສຳເລັດ !!", "success");
        </script>';
    }
    $sqlsell = "select sum((p.price - p.promotion)*d.qty) as amount from listselldetail2 d left join product p on d.pro_id=p.pro_id  where d.emp_id='$emp_id';";
    $resultsell = mysqli_query($link,$sqlsell);
    $rowsell = mysqli_fetch_array($resultsell,MYSQLI_ASSOC);
    ?>
    <div class="container-fluid font12">
		<div class="row">
			<div class="col-md-8">
                <a href="board_sell.php" target="_blank">ລາຍການສິນຄ້າ</a>
                <div class="table-responsive">
                    <table class="table" style="width: 900px;">
                        <tr>
                            <th style="width: 110px;" scope="col">ສິນຄ້າ</th>
                            <th style="width: 180px;" scope="col">ຊື່ສິນຄ້າ</th>
                            <th style="width: 60px;" scope="col">ຈຳນວນ</th>
                            <th style="width: 170px;" scope="col">ລາຄາ</th>
                            <th style="width: 170px;" scope="col">ລວມ</th>
                            <th style="width: 75px;"></th>
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
                            <td>
                                <a href="sale.php?id=<?php echo $rowshow['detail_id']; ?>">
                                    <img src="../../icon/delete.ico" style="width: 20px;" alt="">
                                </a>
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
                        <br><h4 style="color: #CE3131;"><?php echo number_format($rowsell['amount'],2) ?> ກີບ</h4> 
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
                                                ເລກທີບິນ: <?php echo $bill;?><br><br>
                                                <h4 style="color: #CE3131;"><?php echo number_format($rowsell['amount'],2) ?> ກີບ</h4> 
                                            </div>
                                            <hr size="3" align="center" width="100%">
                                            <div class="col-md-12 form-group">
                                                <label>ລະຫັດລູກຄ້າ ຫຼື ສະມາຊິກ</label>
                                                <input type="text" name="cus_id" class="form-control" placeholder="ລະຫັດລູກຄ້າ ຫຼື ສະມາຊິກ">
                                            </div>
                                            <div class="col-md-12 form-group">
                                                <label>ບັດຄູປ໋ອງສ່ວນລົດ</label>
                                                <input type="text" name="cupon" class="form-control" placeholder="ບັດຄູປ໋ອງສ່ວນລົດ">
                                                <input type="hidden" name="amount" value="<?php echo $rowsell['amount']; ?>">
                                            </div>
                                            <div class="col-md-12 form-group">
                                                <label>ຈຳນວນຫຼຸດລາຄາພິເສດ</label>
                                                <input type="number" name="discount" class="form-control" placeholder="ຈຳນວນຫຼຸດລາຄາພິເສດ">
                                            </div>
                                            <div class="col-md-12" align="center">
                                                <button type="submit" name="btnSale" name="btncontinue" class="btn btn-outline-success">
                                                    ດຳເນີນການຂາຍ
                                                </button>
                                            </div>
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
