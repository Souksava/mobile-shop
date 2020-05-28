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
    $Time = date("H:i:s",$datenow);
    $sqlshop = "select * from shop;";
    $resultshop = mysqli_query($link,$sqlshop);
    $rowshop = mysqli_fetch_array($resultshop,MYSQLI_ASSOC);
    $emp_id = $_SESSION['emp_id'];
    $sqlamount = "select sum(qty*price) as amount from listorderdetail where emp_id='$emp_id';";
    $resultamount = mysqli_query($link,$sqlamount);
    $rowamount = mysqli_fetch_array($resultamount,MYSQLI_ASSOC);
?>
<!Doctype html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>ນຳເຂົ້າສິນຄ້າ</title>
        <link rel="icon" href="../../image/<?php echo $rowshop['img_title']; ?>">
        <link rel="stylesheet" href="../../css/style.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  </head>
  <body >
    <!-- head -->
        <div class="header">
            <div class="container">
                <div class="tapbar">
                    <a href="import.php">
                        <img src="../../icon/back.ico" width="30px">
                    </a>
                </div>
                <div align="center" class="tapbar fonthead">
                    ນຳເຂົ້າສິນຄ້າ
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
        if(isset($_GET['id'])){
            $id= $_GET['id'];   
            $sqlget = "select pro_id,qty,d.order_id,d.sup_id,company,o.price from orderdetail o join orders d on o.order_id=d.order_id join suppliers s on d.sup_id=s.sup_id where detail_id='$id';";
            $resultget = mysqli_query($link,$sqlget);
            $rowget = mysqli_fetch_array($resultget, MYSQLI_ASSOC);
            $sup_ids = $rowget['sup_id'];
      ?>
    <div class="container font14" align="center">
        <form action="import2.php" method="POST" id="form1">
            <div class="row">
                <div class="col-xs-12 col-sm-6 form-group"> 
                    <input type="text" name="pro_id" value="<?php echo $rowget['pro_id']; ?>" id="" class="form-control" placeholder="ລະຫັດສິນຄ້າ ຫຼື ບາໂຄດ">
                </div>
                <div class="col-xs-12 col-sm-6 form-group"> 
                    <input type="number" name="qty" value="<?php echo $rowget['qty']; ?>" min="1" id="" class="form-control" placeholder="ຈຳນວນ">
                </div>
                <div class="col-xs-12 col-sm-6 form-group"> 
                    <input type="number" name="price" value="<?php echo $rowget['price']; ?>" min="0" id="" class="form-control" placeholder="ລາຄາ">
                </div>
                <div class="col-xs-12 col-sm-6 form-group"> 
                    <input type="text" name="note" value="" min="0" id="" class="form-control" placeholder="ໝາຍເຫດ">
                </div>
                <div class="col-xs-12 col-sm-6 form-group"> 
                    <input type="number" name="order_id" value="<?php echo $rowget['order_id']; ?>" min="0" id="" class="form-control" placeholder="ເລກທີບິນສັ່ງຊື້">
                </div>
                <div class="col-xs-12 col-sm-6 form-group"> 
                    <input type="text" name="imp_bill" value="" min="0" id="" class="form-control" placeholder="ເລກທີບິນນຳເຂົ້າ">
                </div>
                <div class="col-xs-12 col-sm-6 form-group">
                    <select name="sup_id" id="" class="form-control">
                        <option value="<?php echo $rowget['sup_id']; ?>"><?php echo $rowget['company']; ?></option>
                        <?php
                            $sqlsup = "select * from suppliers where sup_id != '$sup_ids';";
                            $resultsup = mysqli_query($link, $sqlsup);
                            while($rowsup = mysqli_fetch_array($resultsup, MYSQLI_NUM)){
                            echo" <option value='$rowsup[0]'>$rowsup[1]</option>";
                            }
                        ?> 
                    </select>
                </div> <br>
            </div>
            <div align="center">
                <button type="submit" name="btnAdd" class="btn btn-outline-info" style="width: 90%;">
                    ນຳເຂົ້າສິນຄ້າ
                </button>
            </div>
        </form>
    </div>
    <?php 
        }
        else {
    ?>
    <div class="container font14" align="center">
        <form action="import2.php" method="POST" id="form1">
            <div class="row">
                <div class="col-xs-12 col-sm-6 form-group"> 
                    <label>ລະຫັດສິນຄ້າ ຫຼື ບາໂຄດ</label><br>
                    <input type="text" name="pro_id"  id="" class="form-control" placeholder="ລະຫັດສິນຄ້າ ຫຼື ບາໂຄດ">
                </div>
                <div class="col-xs-12 col-sm-6 form-group"> 
                    <label>ຈຳນວນ</label><br>
                    <input type="number" name="qty"  min="1" id="" class="form-control" placeholder="ຈຳນວນ">
                </div>
                <div class="col-xs-12 col-sm-6 form-group"> 
                    <label>ລາຄາ</label><br>
                    <input type="number" name="price"  min="0" id="" class="form-control" placeholder="ລາຄາ">
                </div>
                <div class="col-xs-12 col-sm-6 form-group"> 
                    <label>ໝາຍເຫດ</label><br>
                    <input type="text" name="note" value="" min="0" id="" class="form-control" placeholder="ໝາຍເຫດ">
                </div>
                <div class="col-xs-12 col-sm-6 form-group"> 
                    <label>ເລກທີບິນສັ່ງຊື້</label><br>
                    <input type="number" name="order_id"  min="0" id="" class="form-control" placeholder="ເລກທີບິນສັ່ງຊື້">
                </div>
                <div class="col-xs-12 col-sm-6 form-group"> 
                    <label>ເລກທີບິນນຳເຂົ້າ</label><br>
                    <input type="text" name="imp_bill" value="" min="0" id="" class="form-control" placeholder="ເລກທີບິນນຳເຂົ້າ">
                </div>
                <div class="col-xs-12 col-sm-6 form-group">
                    <label>ຜູ້ສະໜອງ</label><br>
                    <select name="sup_id" id="" class="form-control">
                        <option value="">ເລືອກຜູ້ສະໜອງ</option>
                        <?php
                            $sqlsup = "select * from suppliers;";
                            $resultsup = mysqli_query($link, $sqlsup);
                            while($rowsup = mysqli_fetch_array($resultsup, MYSQLI_NUM)){
                            echo" <option value='$rowsup[0]'>$rowsup[1]</option>";
                            }
                        ?> 
                    </select>
                </div> 
            </div>
            <div align="center">
                <button type="submit" name="btnAdd" class="btn btn-outline-info" style="width: 90%;">
                    ນຳເຂົ້າສິນຄ້າ
                </button>
            </div>
        </form>
    </div>
    <?php 
        }
    ?>
    <?php
        if(isset($_POST['btnAdd'])){
            $pro_id = $_POST['pro_id'];
            $qty = $_POST['qty'];
            $price = $_POST['price'];
            $note = $_POST['note'];
            $order_id = $_POST['order_id'];
            $imp_bill = $_POST['imp_bill'];
            $sup_id = $_POST['sup_id'];
            date_default_timezone_set("Asia/Bangkok");
            $datenow = time();
            $Date = date("Y-m-d",$datenow);
            $Time = date("H:i:s",$datenow);
            if(trim($pro_id) == ""){
                echo"<script>";
                echo"alert('ກະລຸນາປ້ອນລະຫັດສິນຄ້າ ຫຼື ບາໂຄດ');";
                echo"window.location.href='import2.php';";
                echo"</script>";
            }
            elseif(trim($qty) == ""){
                echo"<script>";
                echo"alert('ກະລຸນາປ້ອນຈຳນວນນຳເຂົ້າສິນຄ້າ');";
                echo"window.location.href='import2.php';";
                echo"</script>";
            }
            elseif(trim($price) == ""){
                echo"<script>";
                echo"alert('ກະລຸນາປ້ອນລາຄາ');";
                echo"window.location.href='import2.php';";
                echo"</script>";
            }
            elseif(trim($order_id) == ""){
                echo"<script>";
                echo"alert('ກະລຸນາປ້ອນເລກທີບິນສັ່ງຊື້');";
                echo"window.location.href='import2.php';";
                echo"</script>";
            }
            elseif(trim($imp_bill) == ""){
                echo"<script>";
                echo"alert('ກະລຸນາປ້ອນເລກທີບິນນຳເຂົ້າ');";
                echo"window.location.href='import2.php';";
                echo"</script>";
            }
            elseif(trim($sup_id) == ""){
                echo"<script>";
                echo"alert('ກະລຸນາເລືອກຜູ້ສະໜອງ');";
                echo"window.location.href='import2.php';";
                echo"</script>";
            }
            else{
                $sqlbill = "select * from orders where order_id='$order_id' and status='ອະນຸມັດ';";
                $resultbill = mysqli_query($link,$sqlbill);
                $sqlckpro = "select * from product where pro_id='$pro_id';";
                $resultckpro = mysqli_query($link,$sqlckpro);
                $sqlck = "select * from listimports where pro_id='$pro_id' and emp_id='$emp_id';";
                $resultck = mysqli_query($link,$sqlck);
                if(mysqli_num_rows($resultbill) == 0){
                    echo"<script>";
                    echo"alert('ຂໍອະໄພບໍ່ສາມາດນຳເຂົ້າສິນຄ້າໄດ້ ເນື່ອງຈາກບິນສັ່ງຊື້ນີ້ຍັງບໍ່ທັນໄດ້ອະນຸມັດ, ກະລຸນາປ້ອນບິນສັ່ງຊື້ທີ່ອະນຸມັດແລ້ວ');";
                    echo"window.location.href='import2.php';";
                    echo"</script>";
                }
                else if(mysqli_num_rows($resultckpro) == 0){
                    echo"<script>";
                    echo"alert('ສິນຄ້ານີ້ບໍ່ມີໃນລະບົບ ກະລຸນາເພີ່ມສິນຄ້າຢູ່ທີ່ຈັດການຂໍ້ມູນສິນຄ້າ');";
                    echo"window.location.href='import2.php';";
                    echo"</script>";
                }
                elseif (mysqli_num_rows($resultck) > 0) {
                    $sqladd = "update listimports set qty=qty+'$qty' where pro_id='$pro_id' and emp_id='$emp_id';"; 
                    $resultadd = mysqli_query($link,$sqladd);
                    if(!$resultadd){
                        echo"<script>";
                        echo"alert('ເພີ່ມລາຍການນຳເຂົ້າສິນຄ້າບ່ສຳເລັດ');";
                        echo"window.location.href='import2.php';";
                        echo"</script>";
                    }
                    else {
                        $sqlupdate = "update product set qty=qty+'$qty' where pro_id='$pro_id';";
                        $resultupdate = mysqli_query($link,$sqlupdate);
                        echo"<script>";
                        echo"window.location.href='import2.php';";
                        echo"</script>";
                    }
                }
                else {
                        $sqladd = "insert into listimports(imp_bill,order_id,sup_id,emp_id,pro_id,qty,price,imp_date,imp_time,note) values('$imp_bill','$order_id','$sup_id','$emp_id','$pro_id','$qty','$price','$Date','$Time','$note');";
                        $resultadd = mysqli_query($link,$sqladd);
                        if(!$resultadd){
                            echo"<script>";
                            echo"alert('ບໍ່ສາມາດນຳເຂົ້າສິນຄ້າໄດ້');";
                            echo"window.location.href='import2.php';";
                            echo"</script>";
                        }
                        else {
                            $sqlupdate2 = "update product set qty=qty+'$qty' where pro_id='$pro_id';";
                            $resultupdate2 = mysqli_query($link,$sqlupdate2);
                            echo"<script>";
                            echo"window.location.href='import2.php';";
                            echo"</script>";
                        }
                   }
            }

        }
    ?><br>
    <div class="container font14">
        <div class="table-responsive">
            <table class="table table-striped" style="width: 1800px;">
              <tr class="info">
                  <th style="width: 150px;">ລະຫັດສິນຄ້າ ຫຼື ບາໂຄດ</th>
                  <th style="width: 100px;">ຍີ່ຫໍ້</th>
                  <th style="width: 200px;">ຊື່ສິນຄ້າ</th>
                  <th style="width: 120px;">ປະເພດ</th>
                  <th style="width: 120px;">ຈຳນວນ</th>
                  <th style="width: 100px;">ລາຄາ</th>
                  <th style="width: 130px;">ລວມ</th>
                  <th style="width: 120px;">ເລກທີບິນສັ່ງຊື້</th>
                  <th style="width: 120px;">ເລກທີບິນນຳເຂົ້າ</th>
                  <th style="width: 120px;">ຜູ້ສະໜອງ</th>
                  <th style="width: 80px;">ໝາຍເຫດ</th>
                  <th style="width: 60px;"></th>
              </tr>
              <?php 
                $sqlsec = "select l.imp_id,l.imp_bill,l.order_id,brand_name,company,emp_name,l.pro_id,pro_name,unit_name,cated_name,l.qty,l.price,l.qty*l.price as total,l.note from listimports l left join product p on l.pro_id=p.pro_id left join categorydetail i on p.cated_id=i.cated_id left join unit u on p.unit_id=u.unit_id left join suppliers s on l.sup_id=s.sup_id join employees e on l.emp_id=e.emp_id left join brand b on p.brand_id=b.brand_id where l.emp_id='$emp_id';";
                $resultsec = mysqli_query($link,$sqlsec);
                while($row = mysqli_fetch_array($resultsec, MYSQLI_ASSOC)){
              ?>
              <tr>
                  <td><?php echo $row['pro_id'];?></td>
                  <td><?php echo $row['brand_name'];?></td>
                  <td><?php echo $row['pro_name'];?></td>
                  <td><?php echo $row['cated_name'];?></td>
                  <td><?php echo $row['qty'];?> <?php echo $row['unit_name'];?></td>
                  <td><?php echo number_format($row['price'],2);?></td>
                  <td><?php echo number_format($row['total'],2);?></td>
                  <td><?php echo $row['order_id'];?></td>
                  <td><?php echo $row['imp_bill'];?></td>
                  <td><?php echo $row['company'];?></td>
                  <td><?php echo $row['note'];?></td>
                  <td align="center">
                      <a href="delimp.php?id=<?php echo $row['imp_id'];?>">
                          <img src="../../icon/delete.ico" alt="" width="24px">
                      </a>
                  </td>
              </tr>
              <?php 
                }
            
                $sqlsum = "select sum(qty*price) as Total from listimports where emp_id='$emp_id';";
                $resultsum = mysqli_query($link, $sqlsum);
                $total = mysqli_fetch_array($resultsum, MYSQLI_ASSOC);
              
                ?>
                
                <tr>
                    <td colspan="7" align="right" class="font26"><h3><b>ມູນຄ່າທັງໝົດ</b></h3></td>
                    <td colspan="5" align="right" class="font26"><h3><b><?php echo number_format($total['Total'],2); ?> ກີບ</b> </h3></td>
                </tr>
            </table>
        </div>
        <div class="row" align="center">
            <div class="col-md-12 form-group">
                <button type="button" name="btnSave" class="btn btn-outline-primary" style="width: 90%;" data-toggle="modal" data-target="#myModal">
                    <span class="glyphicon glyphicon-download-alt" aria-hidden="true"></span>
                    ບັນທຶກການນຳເຂົ້າສິນຄ້າ
                </button>
                <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                       
                    </div>
                    <div class="modal-body">
                        ທ່ານຕ້ອງການບັນທຶກການນຳເຂົ້າສິນຄ້າ ຫຼື ບໍ່ ?
                    </div>
                    <div class="modal-footer">
                        <form action="import2.php" method="POST" id="formsave">
                            <input type="hidden" name="total" value="<?php echo $total['Total']; ?>">
                            <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">ຍົກເລີກ</button>
                            <button type="submit" name="btnSave" class="btn btn-outline-primary">ບັນທຶກ</button>
                        </form>
                    </div>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
    <?php
        if(isset($_POST['btnSave'])){
            $sumimp = $_POST['total'];
            date_default_timezone_set("Asia/Bangkok");
            $datenow = time();
            $Date = date("Y-m-d",$datenow);
            $Time = date("H:i:s",$datenow);
            if(trim($sumimp) == 0){
                echo"<script>";
                echo"alert('ກະລຸນາເພີ່ມລາຍການນຳເຂົ້າສິນຄ້າ');";
                echo"window.location.href='import2.php';";
                echo"</script>";
            }
            else {
                $sqlsave = "insert into imports(imp_bill,order_id,sup_id,emp_id,pro_id,qty,price,imp_date,imp_time,note) select imp_bill,order_id,sup_id,emp_id,pro_id,qty,price,imp_date,imp_time,note from listimports;";
                $resultsave = mysqli_query($link,$sqlsave);
                if(!$resultsave){
                    echo"<script>";
                    echo"alert('ບັນທຶກຂໍ້ມູນບໍ່ສຳເລັດ');";
                    echo"window.location.href='import2.php';";
                    echo"</script>";
                }
                else {
                    $sqlclear = "delete from listimports where emp_id='$emp_id';";
                    $resultclear = mysqli_query($link,$sqlclear);
                        echo"<script>";
                        echo"alert('ບັນທຶກຂໍ້ມູນສຳເລັດ');";
                        echo"window.location.href='import.php';";
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
<?php
   }
?>
