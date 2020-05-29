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
        $order_id = $_GET['id'];
        $sqlseen = "update orders set seen1='SEEN' where status='ຍັງບໍ່ອະນຸມັດ' and order_id='$order_id';";
        $resultseen = mysqli_query($link,$sqlseen);
?>
<!Doctype html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>ລາຍລະອຽດ</title>
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
                    <a href="accept.php">
                        <img src="../../icon/back.ico" width="30px">
                    </a>
                </div>
                <div align="center" class="tapbar fonthead">
                    ອະນຸມັດ
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
        $sqlget = "select order_id,company,amount,emp_name,upper(emp_surname) as emp_surname,order_date,e.tel as emp_tel,e.email as emp_email,s.address,s.tel,s.email,order_time,o.status,o.img_path from orders o join suppliers s on o.sup_id=s.sup_id join employees e on o.emp_id=e.emp_id where order_id='$order_id';";
        $resultget = mysqli_query($link, $sqlget);
        $rowget = mysqli_fetch_array($resultget, MYSQLI_ASSOC);
        $sqlcompany = "select * from shop;";
        $resultcompany = mysqli_query($link,$sqlcompany);
        $rowcompany = mysqli_fetch_array($resultcompany, MYSQLI_ASSOC);
    ?>
    <form action="showorder.php" method="POST" id="form1">
    <div class="container font14">
        <div class="row">
            <div style="float: left;width: 50%;">
                <label>ເລກທີບິນສັ່ງຊື້: <?php echo $rowget['order_id'];?></label><br>
                <label>ວັນທີສັ່ງຊື້: <?php echo $rowget['order_date'];?></label><br>
                <label>ເວລາ: <?php echo $rowget['order_time'];?></label><br>
                <input type="hidden" name="order_id" value="<?php echo $order_id; ?>">
                <button type="button" data-toggle="modal" data-target="#exampleModal" class="btn btn-outline-success">ອະນຸມັດ</button>
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">ທ່ານຕ້ອງການອະນຸມັດການສັ່ງຊື້ ຫຼື ບໍ່</h5>
                                <input type="hidden" name="amount" value="<?php echo $rowamount['amount']; ?>">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">ຍົກເລີກ</button>
                                <button type="submit" name="btnAccept" class="btn btn-outline-primary">ຕ້ອງການ</button>
                            </div>
                        </div>
                    </div>
                </div>
                <button type="button" data-toggle="modal" data-target="#exampleModal2" class="btn btn-outline-danger">ບໍ່ອະນຸມັດ</button><br>
                <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">ທ່ານຕ້ອງບໍ່ອະນຸມັດລາຍການສັ່ງຊື້ ຫຼື ບໍ່ ?</h5>
                                <input type="hidden" name="amount" value="<?php echo $rowamount['amount']; ?>">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">ຍົກເລີກ</button>
                                <button type="submit" name="btnNot" class="btn btn-outline-primary">ຕ້ອງການ</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div style="float: right;width: 50%;" align="right">
                <label>ຜູ້ສະໜອງ: <?php echo $rowget['company'];?></label><br>
                <label>ຜູ້ສັ່ງຊື້: <?php echo $rowget['emp_name'];?></label><br>
                <label>ສະຖານະ: <?php echo $rowget['status'];?></label><br>
                <a href="#" data-toggle="modal" data-target="#myModal">
                    <img src="../../Stock/Management/images/<?php echo $rowget['img_path']; ?>" alt="" width="40px" height="40px" alt="" class="img-circle" /><br>
                </a>
                <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog" role="document" style="margin-left: 0px;">
                        <img src="../../Stock/Management/images/<?php echo $rowget['img_path']; ?>" width="100%"  class="imagelist" />
                    </div>
                </div>
            </div>
        </div>
    </div><br>
    </form>
    <div class="container font14">
        <div class="table-responsive">
            <table class="table table-striped">
                <tr class="info">
                    <th>#</th>
                    <th>ລະຫັດສິນຄ້າ ຫຼື ບາໂຄດ</th>
                    <th>ຍີ່ຫໍ້</th>
                    <th>ຊື່ສິນຄ້າ</th>
                    <th>ປະເພດ</th>
                    <th>ຈຳນວນ</th>
                    <th>ຫົວໜ່ວຍ</th>
                    <th>ລາຄາ</th>
                    <th>ລວມ</th>
                </tr>
                <?php
                $sql = "select o.pro_id,pro_name,unit_name,brand_name,cated_name,o.qty,o.price,o.qty*o.price as total from orderdetail o left join product p on o.pro_id=p.pro_id left join categorydetail i on p.cated_id=i.cated_id left join unit u on p.unit_id=u.unit_id left join brand b on p.brand_id=b.brand_id where order_id='$order_id';";
                $result = mysqli_query($link, $sql);
                $no_ = 0;
                while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                ?>
                <tr>
                        <td><?php echo $no_ = $no_ + 1;?></td>
                        <td><?php echo $row['pro_id'];?></td>
                        <td><?php echo $row['brand_name'];?></td>
                        <td><?php echo $row['pro_name'];?></td>
                        <td><?php echo $row['cated_name'];?></td>
                        <td><?php echo $row['qty'];?></td>
                        <td><?php echo $row['unit_name'];?></td>
                        <td><?php echo number_format($row['price'],2);?></td>
                        <td><?php echo number_format($row['total'],2);?></td>
                </tr>
                <?php
                }
                
                $sqltotal = "select sum(qty*price) as total from orderdetail where order_id='$order_id';";
                $resulttotal = mysqli_query($link, $sqltotal);
                $rowtotal = mysqli_fetch_array($resulttotal, MYSQLI_ASSOC);
                ?>
                <tr class="font14 warning">
                    <td colspan="5" align="right"><h3><b>ລວມມູນຄ່າ:</b></h3></td>
                    <td colspan="4" align="right"><h3> <?php echo number_format($rowtotal['total'],2); ?></h3></td>
                </tr>
            </table>
        </div>
    </div>
    <?php 
        if(isset($_POST['btnAccept'])){
            $order_id = $_POST['order_id'];
            $sql = "update orders set status='ອະນຸມັດ' where order_id='$order_id';";
            $result = mysqli_query($link,$sql);
            if(!$result){
                echo"<script>";
                echo"window.location.href='accept.php?accept=found';";
                echo"</script>";
            }
            else {
                echo"<script>";
                echo"window.location.href='accept.php?accept=success';";
                echo"</script>";
            }
        }
        if(isset($_POST['btnNot'])){
            $order_id = $_POST['order_id'];
            $sql = "update orders set status='ບໍ່ອະນຸມັດ' where order_id='$order_id';";
            $result = mysqli_query($link,$sql);
            if(!$result){
                echo"<script>";
                echo"window.location.href='accept.php?notaccept=found';";
                echo"</script>";
            }
            else {
                echo"<script>";
                echo"window.location.href='accept.php?notaccept=success';";
                echo"</script>";
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
