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
   $emp_id = $_SESSION['emp_id'];
   if(isset($_GET['id'])){
       $sell_id = $_GET['id'];
   }
   $sqlsell = "select sell_id,cus_name,sell_date,sell_time,amount,s.status,status_cash,s.img_path,sell_type,cupon_key,cupon_price,place_deli from sell s left join customers c on s.cus_id=c.cus_id where sell_id='$sell_id';";
   $resultsell = mysqli_query($link,$sqlsell);
   $rowsell = mysqli_fetch_array($resultsell,MYSQLI_ASSOC);
   $sqlseen = "update sell set seen1='SEEN' where sell_id='$sell_id';";
   $resultsenn = mysqli_query($link,$sqlseen);
?>
<!Doctype html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>ສັ່ງຊື້ online</title>
    <link rel="icon" href="../../image/<?php echo $rowshop['img_title']; ?>">
    <link rel="stylesheet" href="../../css/style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  </head>
  <body >
    <!-- head -->
      <div class="header">
        <div class="container">
                <a href="listorder.php" class="tapbar" align="left">
                    <img src="../../icon/back.ico" width="30px">
                </a>
            <div align="center" class="tapbar fonthead">
                <b>ສັ່ງຊື້ online</b>
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
    <div class="container-fluid font12">
		<div class="row">
			<div class="col-md-8">
                ລາຍການສັ່ງຊື້
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
                            $sqlshow = "select d.pro_id,pro_name,cate_name,cated_name,brand_name,unit_name,p.img_path,d.qty,d.price,p.price as pro_price,d.promotion,(d.promotion/p.price) * 100 as perzen,d.qty*d.price as total,color_name,p.qty as pro_qty from selldetail d left join product p on d.pro_id=p.pro_id left join categorydetail i  on p.cated_id=i.cated_id left join category c on i.cate_id=c.cate_id left join brand b on p.brand_id=b.brand_id left join unit u on p.unit_id=u.unit_id left join product_color o on d.color_id=o.color_id where sell_id='$sell_id';";
                            $resultshow = mysqli_query($link,$sqlshow);
                            while($rowshow = mysqli_fetch_array($resultshow, MYSQLI_ASSOC)){
                        ?>
                        <tr>
                            <th scope="row" ><img src="../../image/<?php echo $rowshow['img_path']; ?>" alt="" style="width: 100px;heigt: 100px;"></th>
                            <td>
                                <?php echo $rowshow['cate_name']; ?> 
                                <?php echo $rowshow['brand_name']; ?> 
                                <?php echo $rowshow['pro_name']; ?>
                                <?php echo $rowshow['cated_name']; ?> <br><br>
                                <?php 
                                  if($rowshow['qty'] > $rowshow['pro_qty']){
                                    $qtysell = $rowshow['qty'];
                                    $pro_qty = $rowshow['pro_qty'];
                                    $newqty = $qtysell - $pro_qty;
                                    echo "<label style='color: #CE3131;'>ສັ່ງຊື້ເກີນສະຕ໋ອກຈຳນວນ: ".$newqty."</label>";
                                }
                                ?>
                            </td>
                            <td> 
                                <?php echo $rowshow['qty']; ?> <?php echo $rowshow['unit_name']; ?><br>
                                <?php 
                                    if($rowshow['color_name'] != ""){
                                        echo"ສີ".$rowshow['color_name']."";
                                    }
                                    else{
                                        echo"";
                                    }
                                ?>
                            </td>
                            <td >
                                <h6 style="color: #CE3131;">ລາຄາ <?php echo number_format($rowshow['price'],2); ?> ກີບ</h6>
                               <h7>ລາຄາປົກກະຕິ <?php echo number_format($rowshow['pro_price'],2); ?> ກີບ</h7>
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
                        <br><h4 style="color: #CE3131;"><?php echo number_format($rowsell['amount'],2) ?> ກີບ</h4> 
                        <label style="color: #7E7C7C;font-size: 12px;">ຄູປ໋ອງສ່ວນລົດ: <?php echo number_format($rowsell['cupon_price'],2); ?> ກີຍ</label>                   
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
                                    <form action="cusorder.php" id="form1" method="POST">
                                        <div class="row">
                                            <div class="col-md-12">
                                                ເລກທີບິນ: <?php echo $rowsell['sell_id'];?>
                                            </div>
                                            <div class="col-md-12">
                                                ລູກຄ້າ: <?php echo $rowsell['cus_name'];?>
                                            </div>
                                            <div class="col-md-12">
                                                ວັນທີ: <?php echo $rowsell['sell_date'];?> | <?php echo $rowsell['sell_time'];?>
                                            </div>
                                            <div class="col-md-12">
                                                ສະຖານະ:  <?php echo $rowsell['status'];?>
                                            </div>
                                            <div class="col-md-12">
                                                ສະຖານະການຈ່າຍ:  <?php echo $rowsell['status_cash'];?>
                                            </div><br><br>
                                            <div class="col-md-12">
                                                <?php 
                                                    if($rowsell['img_path'] == "0"){
                                                ?>
                                                    <a href="../../icon/0.png"><img src="../../icon/0.png" alt="" style="width: 100%;"></a>
                                                <?php
                                                    }
                                                    else{
                                                ?>
                                                    <a href="../../image/<?php echo $rowsell['img_path'];?>"><img src="../../image/<?php echo $rowsell['img_path'];?>" alt="" style="width: 100%;"></a>
                                                <?php
                                                    }
                                                ?>
                                            </div><br><br>
                                            <div class="col-md-12">
                                                ລາຍລະອຽດສະຖານທີຈັດສົ່ງ
                                            </div>
                                            <div class="col-md-12">
                                                <?php echo $rowsell['place_deli'];?>
                                            </div>
                                            <hr size="3" align="center" width="100%">
                                            <div class="col-md-12 form-group">
                                            <label>ຄ່າສົ່ງສິນຄ້າ</label>
                                                <input type="number" min="0" name="delivery" class="form-control" placeholder="ຄ່າສົ່ງສິນຄ້າ">
                                                <input type="hidden" name="sell_id" value="<?php echo $rowsell['sell_id']; ?>">
                                            </div>
                                            <div class="col-md-12 form-group">
                                                <label>ລາຍລະອຽດຕອບກັບການສັ່ງຊື້</label>
                                                <textarea name="note" id="" cols="30" rows="5" class="form-control" placeholder=" ລາຍລະອຽດຕອບກັບການສັ່ງຊື້"></textarea>
                                            </div>
                                            <div class="col-md-12" align="center">
                                                <button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#staticBackdrop">
                                                    ຕອບຮັບການສັ່ງຊື້
                                                </button>
                                                <!-- Modal -->
                                                <div class="modal fade" id="staticBackdrop" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="staticBackdropLabel">ຢືນຢັນ</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                ທ່ານຕ້ອງການຕອບຮັບການສັ່ງຊື້ ຫຼື ບໍ່ ?
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">ຍົກເລີກ</button>
                                                                <button type="submit" name="btnAnswer" class="btn btn-outline-success">ຕອບຮັບ</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
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
    <?php 
    if(isset($_POST['btnAnswer'])){
        $id = $_POST['sell_id'];
        $delivery = $_POST['delivery'];
        $note = mysqli_real_escape_string($link,$_POST['note']);
        if(trim($id) == ""){
            echo"<script>";
            echo"window.location.href='listorder.php?savef=fail';";
            echo"</script>";
        }
        elseif(trim($delivery) == ""){
            echo"<script>";
            echo"window.location.href='listorder.php?delivery=null';";
            echo"</script>";
        }
        elseif(trim($note) == ""){
            echo"<script>";
            echo"window.location.href='listorder.php?note=null';";
            echo"</script>";
        }
        else{
            $sqlanswer = "update sell set status='ສັ່ງຊື້ສຳເລັດ',delivery='$delivery',note='$note',emp_id='$emp_id' where sell_id='$id';";
            $resultanswer = mysqli_query($link,$sqlanswer);
            if(!$resultanswer){
                echo"<script>";
                echo"window.location.href='listorder.php?savef2=false';";
                echo"</script>";
            }
            else{
                $sqlselldetail = "select * from selldetail where sell_id='$id';";
                $resultselldetail = mysqli_query($link,$sqlselldetail);
                while($row = mysqli_fetch_array($resultselldetail,MYSQLI_ASSOC)){
                    $pro_id = $row['pro_id'];
                    $qty = $row['qty'];
                    $sqlstock = "update product set qty=qty-'$qty' where pro_id='$pro_id';";
                    $resultstock = mysqli_query($link,$sqlstock);
                }
                echo"<script>";
                echo"window.location.href='listorder.php?savet=true';";
                echo"</script>";
            }
        }
    }
    
    ?>
      <!-- body -->
  </body>
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</html>
