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
?>
<!Doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>ສິນຄ້າ</title>
        <link rel="icon" href="../../image/<?php echo $rowshop['img_title']; ?>">
        <link rel="stylesheet" href="../../css/style.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <body >
        <div class="header">
            <div class="container">
                <div class="tapbar">
                    <a href="management.php">
                        <img src="../../icon/back.ico" width="30px">
                    </a>
                </div>
                <div align="center" class="tapbar fonthead">
                    ສິນຄ້າ
                </div>
                <div class="tapbar" align="right">
                    <a href="../../Check/Logout.php">
                        <img src="../../icon/close.ico" width="30px">
                    </a>
                </div>
            </div>
        </div>
        <br>
        <div class="container font14">
            <div class="row">
                <div style="float: left;width: 50%;padding-left: 10px;">
                    <b>ສິນຄ້າ</b>&nbsp <img src="../../icon/hidemenu.ico" width="10px">
                </div>
                <div align="right" style="width: 48%;float: right;">
                    <form action="product.php" id="form1" method="POST" enctype="multipart/form-data">
                        <a href="#" data-toggle="modal" data-target="#exampleModal">
                            <img src="../../icon/add.ico" alt="" width="30px">
                        </a>
                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">ສິນຄ້າ</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row" align="left">
                                            <div class="col-md-12 form-group">
                                                <label>ລະຫັດສິນຄ້າ</label>
                                                <input type="text" name="pro_id" class="form-control" placeholder="ລະຫັດສິນຄ້າ">
                                            </div>
                                            <div class="col-md-12 form-group">
                                                <label>ຊື່ສິນຄ້າ</label>
                                                <input type="text" name="pro_name" class="form-control" placeholder="ຊື່ສິນຄ້າ">
                                            </div>
                                            <div class="col-md-12 form-group">
                                                <label>ຈຳນວນ</label>
                                                <input type="number" name="qty" min="0" class="form-control" placeholder="ຈຳນວນ">
                                            </div>
                                            <div class="col-md-12 form-group">
                                                <label>ລາຄາ</label>
                                                <input type="number" min="0" name="price" class="form-control" placeholder="ລາຄາ">
                                            </div>
                                            <div class="col-md-12 form-group">
                                                <label>ປະເພດສິນຄ້າຍ່ອຍ</label>
                                                <select name="cate_id" id="" class="form-control">
                                                    <option value="">ເລືອກປະເພດສິນຄ້າຍ່ອຍ</option>
                                                    <?php
                                                        $sqlcate = "select * from categorydetail;";
                                                        $resultcate = mysqli_query($link, $sqlcate);
                                                        while($rowcate = mysqli_fetch_array($resultcate, MYSQLI_NUM)){
                                                        echo" <option value='$rowcate[0]'>$rowcate[1]</option>";
                                                        }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="col-md-12 form-group">
                                                <label>ຫົວໜ່ວຍ</label>
                                                <select name="unit_id" id="" class="form-control">
                                                    <option value="">ເລືອກຫົວໜ່ວຍສິນຄ້າ</option>
                                                    <?php
                                                        $sqlunit = "select * from unit;";
                                                        $resultunit = mysqli_query($link, $sqlunit);
                                                        while($rowunit = mysqli_fetch_array($resultunit, MYSQLI_NUM)){
                                                        echo" <option value='$rowunit[0]'>$rowunit[1]</option>";
                                                        }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="col-md-12 form-group">
                                                <label>ຍີ່ຫໍ້</label>
                                                <select name="brand_id" id="" class="form-control">
                                                    <option value="">ເລືອກຍີ່ຫໍ້</option>
                                                    <?php
                                                        $sqlbrand = "select * from brand;";
                                                        $resultbrand = mysqli_query($link, $sqlbrand);
                                                        while($rowbrand = mysqli_fetch_array($resultbrand, MYSQLI_NUM)){
                                                        echo" <option value='$rowbrand[0]'>$rowbrand[1]</option>";
                                                        }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="col-md-12 form-group">
                                                <label>ໂປໂມຊັນ ຫຼື ສ່ວນຫຼຸດ</label>
                                                <input type="text" name="promotion" class="form-control" placeholder="ໂປໂມຊັນ ຫຼື ສ່ວນຫຼຸດ">
                                            </div>
                                            <div class="col-md-12 form-group">
                                                <label>ເງື່ອນໄຂການສັ່ງຊື້</label>
                                                <input type="number" min="0" name="qtyalert" class="form-control" placeholder="ເງື່ອນໄຂການສັ່ງຊື້">
                                            </div>
                                            <div class="col-md-12 form-group">
                                                <label>ຮູບສິນຄ້າ</label>
                                                <input type="file" name="img_path" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">ຍົກເລີກ</button>
                                        <button type="submit" name="btnSave" class="btn btn-outline-primary">ບັນທຶກ</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <?php
            if(isset($_POST['btnSave'])){
                $pro_id = $_POST['pro_id'];
                $pro_name = $_POST['pro_name'];
                $qty = $_POST['qty'];
                $price = $_POST['price'];
                $cate_id = $_POST['cate_id'];
                $unit_id = $_POST['unit_id'];
                $brand_id = $_POST['brand_id'];
                $promotion = $_POST['promotion'];
                $qtyalert = $_POST['qtyalert'];
                $img_path = $_POST['img_path'];
                if(trim($pro_id) == ""){
                    echo"<script>";
                    echo"alert('ກະລຸນາໃສ່ລະຫັດສິນຄ້າ');";
                    echo"window.location.href='product.php';";
                    echo"</script>";
                }
                elseif(trim($pro_name) == ""){
                    echo"<script>";
                    echo"alert('ກະລຸນາໃສ່ຊື່ສິນຄ້າ');";
                    echo"window.location.href='product.php';";
                    echo"</script>";
                }
                elseif(trim($qty) == ""){
                    echo"<script>";
                    echo"alert('ກະລຸນາໃສ່ຈຳນວນ');";
                    echo"window.location.href='product.php';";
                    echo"</script>";
                }
                elseif(trim($price) == ""){
                    echo"<script>";
                    echo"alert('ກະລຸນາໃສ່ລາຄາ');";
                    echo"window.location.href='product.php';";
                    echo"</script>";
                }
                elseif(trim($cate_id) == ""){
                    echo"<script>";
                    echo"alert('ກະລຸນາເລືອກປະເພດສິນຄ້າ');";
                    echo"window.location.href='product.php';";
                    echo"</script>";
                }
                elseif(trim($unit_id) == ""){
                    echo"<script>";
                    echo"alert('ກະລຸນາເລືອກຫົວໜ່ວຍສິນຄ້າ');";
                    echo"window.location.href='product.php';";
                    echo"</script>";
                }
                elseif(trim($brand_id) == ""){
                    echo"<script>";
                    echo"alert('ກະລຸນາເລືອກຍີ່ຫໍ້');";
                    echo"window.location.href='product.php';";
                    echo"</script>";
                }
                elseif(trim($promotion) == ""){
                    echo"<script>";
                    echo"alert('ກະລຸນາໃສ່ໂປໂມຊັນສ່ວນຫຼຸດ');";
                    echo"window.location.href='product.php';";
                    echo"</script>";
                }
                elseif(trim($qtyalert) == ""){
                    echo"<script>";
                    echo"alert('ກະລຸນາເລືອກເງືອນໄຂການສັ່ງຊື້');";
                    echo"window.location.href='product.php';";
                    echo"</script>";
                }
                else {
                    $sqlckid = "select * from product where pro_id='$pro_id';";
                    $resultckid = mysqli_query($link,$sqlckid);
                    if(mysqli_num_rows($resultckid) > 0){
                        echo"<script>";
                        echo"alert('ບໍ່ສາມາດບັນທຶກຂໍ້ມູນໄດ້ ເນື່ອງຈາກລະຫັດສິນຄ້ານີ້ມີຢູ່ແລ້ວ');";
                        echo"window.location.href='product.php';";
                        echo"</script>";
                    }
                    else {
                        $ext = pathinfo(basename($_FILES["img_path"]["name"]), PATHINFO_EXTENSION);
                        $new_image_name = "img_".uniqid().".".$ext;
                        $image_path = "../../image/";
                        $upload_path = $image_path.$new_image_name;
                        move_uploaded_file($_FILES["img_path"]["tmp_name"], $upload_path);
                        $pro_img = $new_image_name;
                        $sqlinsert = "insert into product(pro_id,pro_name,qty,price,cated_id,unit_id,brand_id,promotion,qtyalert,img_path) values('$pro_id','$pro_name','$qty','$price','$cate_id','$unit_id','$brand_id','$promotion','$qtyalert','$pro_img')";
                        $resultinsert = mysqli_query($link,$sqlinsert);
                        if(!$resultinsert){
                            echo"<script>";
                            echo"alert('ບໍ່ສາມາດບັນທຶກຂໍ້ມູນໄດ້');";
                            echo"window.location.href='product.php';";
                            echo"</script>";
                        }
                        else {
                            echo"<script>";
                            echo"alert('ບັນທຶກຂໍ້ມູນສຳເລັດ');";
                            echo"window.location.href='product.php';";
                            echo"</script>";
                        }
                    }
                }
            }
        ?>
        <div class="clearfix"></div>
        <div class="container font14">
            <form action="product.php" id="fomrsearch" method="POST">
                <div style="width: 100%">
                    <input type="text" class="form-control" name="search" style="float: left;width: 50%;" placeholder="ລະຫັດ, ຊື່, ປະເພດ, ຫົວໜ່ວຍ, ຍີ່ຫໍ້">
                    <button class="btn btn-outline-primary" name="btnSearch" type="submit" style="float:left;margin-left: 10px">
                        ຄົ້ນຫາ
                    </button>
                </div>
            </form>
        </div>
        <div class="clearfix"></div><br>
        <?php
            if(isset($_POST['btnSearch'])){
            $search = "%".$_POST['search']."%";
        ?>
        <div class="container font12">
            <div>
                <?php
                    $s = $_POST['search'];
                    if($s != ""){
                        echo"ຄົ້ນຫາດ້ວຍ '$s'";
                    }
                ?>
            </div>
            <div class="row row-cols-1 row-cols-md-3">
                <?php
                    $sql = "select pro_id,pro_name,p.qty,price,p.cated_id,cated_name,p.unit_id,unit_name,p.brand_id,brand_name,promotion,qtyalert,p.img_path from product p left join categorydetail d on p.cated_id=d.cated_id left join unit u on p.unit_id=u.unit_id left join brand b on p.brand_id=b.brand_id where pro_id like '$search' or pro_name like '$search' or d.cated_name like '$search' or unit_name like '$search' or brand_name like '$search';";
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
                                ຊື່ສິນຄ້າ: <?php echo $row['pro_name']; ?> <br>  ປະເພດ: <?php echo $row['cated_name']; ?> <br>
                                ຍີ່ຫໍ້: <?php echo $row['brand_name']; ?> ຈຳນວນ: <?php echo $row['qty']; ?>  <?php echo $row['unit_name']; ?> <br>
                                ລາຄາ: <?php echo number_format($row['price'],2); ?> <br> ສ່ວນຫຼຸດ: <?php echo number_format($row['promotion'],2); ?><br>
                                ເງື່ອນໄຂການສັ່ງຊື້: <?php echo $row['qtyalert']; ?><br>
                                <br><br>
                                <a href="updatepro.php?id=<?php echo $row['pro_id']; ?>" class="btn btn-outline-success" style="width: 100%;">ແກ້ໄຂ</a><br><br>
                                <a href="delpro.php?id=<?php echo $row['pro_id']; ?>" class="btn btn-outline-danger" style="width: 100%;" >ລົບ</a>
                            </p>
                        </div>
                    </div>
                </div>
                <?php
                    }
                ?>
            </div>
        </div>
        <?php
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
