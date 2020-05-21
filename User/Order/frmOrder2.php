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
        $Time = date("H:i:s",$datenow);
        $sqlshop = "select * from shop;";
        $resultshop = mysqli_query($link,$sqlshop);
        $rowshop = mysqli_fetch_array($resultshop,MYSQLI_ASSOC);
        $emp_id = $_SESSION['emp_id'];
        $sqlamount = "select sum(qty*price) as amount from listorderdetail where emp_id='$emp_id';";
        $resultamount = mysqli_query($link,$sqlamount);
        $rowamount = mysqli_fetch_array($resultamount,MYSQLI_ASSOC);
        $sqlbill = "select max(order_id) as billno from orders;";
        $resultbill = mysqli_query($link,$sqlbill);
        $rowbill = mysqli_fetch_array($resultbill,MYSQLI_ASSOC);
        $order_id = $rowbill['billno'] + 1;
?>
<!Doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>ສັ່ງຊື້</title>
        <link rel="icon" href="../../image/<?php echo $rowshop['img_title']; ?>">
        <link rel="stylesheet" href="../../css/style.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <body>
        <div class="header">
            <div class="container">
                <div class="tapbar">
                    <a href="frmOrder.php">
                        <img src="../../icon/back.ico" width="30px">
                    </a>
                </div>
                <div align="center" class="tapbar fonthead">
                    ສັ່ງຊື້
                </div>
                <div class="tapbar" align="right">
                    <a href="../../Check/Logout.php">
                        <img src="../../icon/close.ico" width="30px">
                    </a>
                </div>
            </div>
        </div>
        <br>
        <div class="clearfix"></div>
        <div class="container font14">
            <form action="frmOrder2.php" method="POST" id="formorder">
                <div class="row">
                    <div class="col-xs-12 col-sm-6 col-md-4 form-group">
                        <label>ລະຫັດສິນຄ້າ</label><br>
                        <input type="text" name="pro_id" class="form-control" placeholder="ລະຫັດສິນຄ້າ" value="<?php  if(isset($_GET['id'])){ echo $id = $_GET['id'];} ?>" autofocus>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-4 form-group">
                        <label>ຈຳນວນ</label><br>
                        <input type="number" min="1" name="qty" class="form-control" placeholder="ຈຳນວນ">
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-4 form-group">
                        <label>ລາຄາ</label><br>
                        <input type="number" min="500" name="price" class="form-control" placeholder="ລາຄາ">
                    </div>
                </div>
                <div class="row" align="center">
                    <div class="col-md-12 form-group">
                        <button style="width: 90%;" name="btnAdd" class="btn btn-outline-primary">ເພີ່ມລາຍການ</button>
                    </div>
                </div>
            </form>
            <hr size="3" align="center" width="100%">
        </div>
        <form action="frmOrder2.php" id="form1" method="POST" enctype="multipart/form-data">
        <div class="container font14">
            <div class="row">
                <div class="col-xs-12 col-sm-6 col-md-4 form-group"><br>
                    <label>ເລກທີໃບສັ່ງຊື້: <?php echo $order_id ?></label>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-4 form-group">
                    <label>ຜູ້ສະໜອງ</label>
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
            <div class="row row-cols-1 row-cols-md-3">
                <?php

                    $sql = "select detail_id,d.pro_id,pro_name,d.qty,d.price,unit_name,cated_name,brand_name,p.img_path from listorderdetail d left join product p on d.pro_id=p.pro_id left join categorydetail i on p.cated_id=i.cated_id left join unit u on p.unit_id=u.unit_id left join brand b on p.brand_id=b.brand_id where emp_id='$emp_id';";
                    $result = mysqli_query($link,$sql);
                    $NO_ = 0;
                    while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                ?>
                <div class="col mb-4">
                    <div class="card h-100">
                        <a href="../../image/<?php echo $row['img_path'] ?>">
                            <img src="../../image/<?php echo $row['img_path'] ?>" height="280px" class="card-img-top" alt="">
                        </a>
                        <div class="card-body">
                            <h6 class="card-title">ລະຫັດ: <?php echo $row['pro_id']; ?></h6>
                            <p class="card-text">
                                ຍີ່ຫໍ້: <?php echo $row['brand_name']; ?> <br>
                                ຊື່ສິນຄ້າ: <?php echo $row['pro_name']; ?> <br>
                                ປະເພດ: <?php echo $row['cated_name']; ?> <br>
                                ຈຳນວນ: <?php echo $row['qty']; ?>  <?php echo $row['unit_name']; ?> <br>
                                ລາຄາ: <?php echo number_format($row['price'],2); ?> <br>
                                <br><br>
                                <a href="dellistorder.php?id=<?php echo $row['detail_id']; ?>" class="btn btn-outline-danger" style="width: 100%;" >ລົບ</a>
                            </p>
                        </div>
                    </div>
                </div>
                <?php
                    }
                ?>
            </div>
            <div class="row">
                <h4>ລວມມູນຄ່າ: <?php echo number_format($rowamount['amount'],2);?> ກີບ</h4>
            </div>
        </div><br>
        <div class="container font12" align="center">
            <a href="#" style="width: 90%;" data-toggle="modal" data-target="#exampleModal" class="btn btn-outline-success"> 
                ບັນທຶກການສັ່ງຊື້
            </a>
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">ທ່ານຕ້ອງການສັ່ງຊື້ສິນຄ້າ ຫຼື ບໍ່</h5>
                            <input type="hidden" name="amount" value="<?php echo $rowamount['amount']; ?>">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">ຍົກເລີກ</button>
                            <button type="submit" name="btnSave" class="btn btn-outline-primary">ບັນທຶກ</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </form>
        <?php
            if(isset($_POST['btnAdd'])){
                $pro_id = $_POST['pro_id'];
                $qty = $_POST['qty'];
                $price = $_POST['price'];
                if(trim($pro_id) == ""){
                    echo"<script>";
                    echo"alert('ກະລຸນາໃສ່ລະຫັດສິນຄ້າ');";
                    echo"window.location.href='frmOrder2.php';";
                    echo"</script>";
                }
                else if(trim($qty) == ""){
                    echo"<script>";
                    echo"alert('ກະລຸນາໃສ່ຈຳນວນ');";
                    echo"window.location.href='frmOrder2.php';";
                    echo"</script>";
                }
                else if(trim($price) == ""){
                    echo"<script>";
                    echo"alert('ກະລຸນາປ້ອນລາຄາ');";
                    echo"window.location.href='frmOrder2.php';";
                    echo"</script>";
                }
                else {
                    $sqlck = "select * from listorderdetail where pro_id='$pro_id' and emp_id='$emp_id';";
                    $resultck = mysqli_query($link,$sqlck);
                    if(mysqli_num_rows($resultck) > 0){
                        $sqladd = "update listorderdetail set qty=qty+'$qty' where pro_id='$pro_id' and emp_id='$emp_id';";
                        $resultadd = mysqli_query($link,$sqladd);
                        echo"<script>";
                        echo"window.location.href='frmOrder2.php';";
                        echo"</script>";
                    }
                    else {
                        $sqladd = "insert into listorderdetail(pro_id,qty,price,emp_id) values('$pro_id','$qty','$price','$emp_id');";
                        $resultadd = mysqli_query($link,$sqladd);
                        echo"<script>";
                        echo"window.location.href='frmOrder2.php';";
                        echo"</script>";
                    }
                }
            }
            if(isset($_POST['btnSave'])){
                $sup_id = $_POST['sup_id'];
                $amount = $_POST['amount'];
                if(trim($sup_id) == ""){
                    echo"<script>";
                    echo"alert('ກະລຸນາເລືອກຜູ້ສະໜອງ');";
                    echo"window.location.href='frmOrder2.php';";
                    echo"</script>";
                }
                else if(trim($amount) == "" or trim($amount) == ""){
                    echo"<script>";
                    echo"alert('ເພີ່ມລາຍການສັ່ງຊື້');";
                    echo"window.location.href='frmOrder2.php';";
                    echo"</script>";
                }
                else {
                    $sqlbill2 = "select max(order_id) as billno from orders;";
                    $resultbill2 = mysqli_query($link,$sqlbill2);
                    $rowbill2 = mysqli_fetch_array($resultbill2,MYSQLI_ASSOC);
                    $order_id2 = $rowbill2['billno'] + 1;
                    $sqlsave = "insert into orders(order_id,emp_id,sup_id,amount,order_date,order_time,status,seen1,seen2) values('$order_id2','$emp_id','$sup_id','$amount','$Date','$Time','ຍັງບໍ່ອະນຸມັດ','NOTSEEN','NOTSEEN');";
                    $resultsave = mysqli_query($link,$sqlsave);
                    if(!$resultsave){
                        echo"<script>";
                        echo"alert('ບໍ່ສາມາດບັນທຶກຂໍ້ມູນໄດ້');";
                        echo"window.location.href='frmOrder2.php';";
                        echo"</script>";
                    }
                    else {
                        $sqlsave2 = "insert into orderdetail(pro_id,qty,price,order_id) select pro_id,qty,price,'$order_id2' from listorderdetail where emp_id='$emp_id';";
                        $resultsave2 = mysqli_query($link,$sqlsave2);
                        if(!$resultsave2){
                            echo"<script>";
                            echo"alert('ບໍ່ສາມາດບັນທຶກຂໍ້ມູນໄດ້');";
                            echo"window.location.href='frmOrder2.php';";
                            echo"</script>";
                        }
                        else {
                            $sqlclear = "delete from listorderdetail where emp_id='$emp_id';";
                            $resultclear = mysqli_query($link,$sqlclear);
                            echo"<script>";
                            echo"alert('ບັນທຶກການສັ່ງຊື້ສຳເລັດ');";
                            echo"window.location.href='frmOrder2.php';";
                            echo"</script>";
                        }

                    }
                }
            }
        ?>
    </body>
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</html>
<?php
    }
?>
