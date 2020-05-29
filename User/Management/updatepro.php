<?php
    session_start();
    if($_SESSION['ses_id'] == ''){
       echo"<meta http-equiv='refresh' content='1;URL=../index.php'>";        
    }
    else if($_SESSION['status'] != 2){
       echo"<meta http-equiv='refresh' content='1;URL=../Check/logout.php'>";
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
        <title>ແກ້ໄຂຂໍ້ມູນ</title>
        <link rel="icon" href="../../image/<?php echo $rowshop['img_title']; ?>">
        <link rel="stylesheet" href="../../css/style.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <body >
        <div class="header">
            <div class="container">
                <div class="tapbar">
                    <a href="product.php">
                        <img src="../../icon/back.ico" width="30px">
                    </a>
                </div>
                <div align="center" class="tapbar fonthead">
                    ແກ້ໄຂຂໍ້ມູນ
                </div>
                <div class="tapbar" align="right">
                    <a href="../../Check/Logout.php">
                        <img src="../../icon/close.ico" width="30px">
                    </a>
                </div>
            </div>
        </div>
        <br>
        <?php 
            $id = $_GET['id'];
            $sqlget = "select pro_id,pro_name,p.qty,price,p.cated_id,cated_name,p.unit_id,unit_name,p.brand_id,brand_name,promotion,qtyalert,p.img_path from product p left join categorydetail c on p.cated_id=c.cated_id left join unit u on p.unit_id=u.unit_id left join brand b on p.brand_id=b.brand_id where pro_id='$id'";
            $resultget = mysqli_query($link,$sqlget);
            $row = mysqli_fetch_array($resultget, MYSQLI_ASSOC);

        ?>
        <div class="container font14">
            <form action="updatepro.php" id="update" method="POST" enctype="multipart/form-data">
                <div class="row" align="left">
                    <div class="col-xs-12 col-sm-6 form-group">
                        <label>ຊື່ສິນຄ້າ</label>
                        <input type="text" name="pro_name" class="form-control" value="<?php echo $row['pro_name'] ?>" placeholder="ຊື່ສິນຄ້າ">
                        <input type="hidden" name="pro_id" class="form-control" value="<?php echo $row['pro_id'] ?>" >
                    </div>
                    <div class="col-xs-12 col-sm-6 form-group">
                        <label>ຈຳນວນ</label>
                        <input type="number" name="qty" min="0" class="form-control" value="<?php echo $row['qty'] ?>"  placeholder="ຈຳນວນ">
                    </div>
                    <div class="col-xs-12 col-sm-6 form-group">
                        <label>ລາຄາ</label>
                        <input type="number" min="0" name="price" class="form-control" value="<?php echo $row['price'] ?>"  placeholder="ລາຄາ">
                    </div>
                    <div class="col-xs-12 col-sm-6 form-group">
                        <label>ປະເພດສິນ</label>
                        <select name="cate_id" id="" class="form-control">
                            <option value="<?php echo $row['cated_id'] ?>" ><?php echo $row['cated_name'] ?> </option>
                            <?php
                                $cate_id2 = $row['cated_id'];
                                $sqlcate = "select * from categorydetail where cated_id != '$cate_id2';";
                                $resultcate = mysqli_query($link, $sqlcate);
                                while($rowcate = mysqli_fetch_array($resultcate, MYSQLI_NUM)){
                                    echo" <option value='$rowcate[0]'>$rowcate[1]</option>";
                                }
                            ?>
                        </select>
                    </div>
                    <div class="col-xs-12 col-sm-6 form-group">
                        <label>ຫົວໜ່ວຍ</label>
                        <select name="unit_id" id="" class="form-control">
                            <option value="<?php echo $row['unit_id'] ?>" ><?php echo $row['unit_name'] ?> </option>
                                <?php
                                    $unit_id2 = $row['unit_id'];
                                    $sqlunit = "select * from unit where unit_id!='$unit_id2';";
                                    $resultunit = mysqli_query($link, $sqlunit);
                                    while($rowunit = mysqli_fetch_array($resultunit, MYSQLI_NUM)){
                                        echo" <option value='$rowunit[0]'>$rowunit[1]</option>";
                                    }
                                ?>
                        </select>
                    </div>
                    <div class="col-xs-12 col-sm-6 form-group">
                        <label>ຍີ່ຫໍ້</label>
                        <select name="brand_id" id="" class="form-control">
                            <option value="<?php echo $row['brand_id'] ?>" ><?php echo $row['brand_name'] ?> </option>
                                <?php
                                    $brand_id2 = $row['brand_id'];
                                    $sqlbrand = "select * from brand where brand_id != '$brand_id2';";
                                    $resultbrand = mysqli_query($link, $sqlbrand);
                                    while($rowbrand = mysqli_fetch_array($resultbrand, MYSQLI_NUM)){
                                        echo" <option value='$rowbrand[0]'>$rowbrand[1]</option>";
                                    }
                                ?>
                        </select>
                    </div>
                    <div class="col-xs-12 col-sm-6 form-group">
                        <label>ໂປໂມຊັນ ຫຼື ສ່ວນຫຼຸດ</label>
                        <input type="text" name="promotion" class="form-control" value="<?php echo $row['promotion']; ?> " placeholder="ໂປໂມຊັນ ຫຼື ສ່ວນຫຼຸດ">
                    </div>
                    <div class="col-xs-12 col-sm-6 form-group">
                        <label>ເງື່ອນໄຂການສັ່ງຊື້</label>
                        <input type="number" min="0" name="qtyalert" class="form-control" value="<?php echo $row['qtyalert']; ?>" placeholder="ເງື່ອນໄຂການສັ່ງຊື້">
                    </div>
                    <div class="col-xs-12 col-sm-6 form-group">
                        <label>ຮູບສິນຄ້າ</label>
                        <input type="file" name="img_path" class="form-control">
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-6 form-group">
                        <button type="submit" class="btn btn-outline-success" name="btnUpdate" style="width: 100%;">
                           ແກ້ໄຂຂໍ້ມູນ
                        </button>
                    </div>
                </div>
            </form>
        <?php
            if(isset($_POST['btnUpdate'])){
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
                    echo"window.location.href='product.php?pro_id=null';";
                    echo"</script>";
                }
                elseif(trim($pro_name) == ""){
                    echo"<script>";
                    echo"window.location.href='product.php?pro_name=null';";
                    echo"</script>";
                }
                elseif(trim($qty) == ""){
                    echo"<script>";
                    echo"window.location.href='product.php?qty=null';";
                    echo"</script>";
                }
                elseif(trim($price) == ""){
                    echo"<script>";
                    echo"window.location.href='product.php?price=null';";
                    echo"</script>";
                }
                elseif(trim($cate_id) == ""){
                    echo"<script>";
                    echo"window.location.href='product.php?cate_id=null';";
                    echo"</script>";
                }
                elseif(trim($unit_id) == ""){
                    echo"<script>";
                    echo"window.location.href='product.php?unit_id=null';";
                    echo"</script>";
                }
                elseif(trim($brand_id) == ""){
                    echo"<script>";
                    echo"window.location.href='product.php?brand_id=null';";
                    echo"</script>";
                }
                elseif(trim($qtyalert) == ""){
                    echo"<script>";
                    echo"window.location.href='product.php?qtyalert=null';";
                    echo"</script>";
                }
                elseif(trim($promotion) == ""){
                    echo"<script>";
                    echo"window.location.href='product.php?promotion=null';";
                    echo"</script>";
                }
                else {
                    if($_FILES['img_path']['name'] == ""){
                        $sqlupdate = "update product set pro_name='$pro_name',qty='$qty',price='$price',cated_id='$cate_id',unit_id='$unit_id',brand_id='$brand_id',promotion='$promotion',qtyalert='$qtyalert' where pro_id='$pro_id';";
                        $resultupdate = mysqli_query($link,$sqlupdate);
                        if(!$resultupdate){
                            echo"<script>";
                            echo"window.location.href='product.php?update=found';";
                            echo"</script>";
                        }
                        else {
                            echo"<script>";
                            echo"window.location.href='product.php?update=success';";
                            echo"</script>";
                        }
                    }
                    else {
                        //ເມື່ອປ່ຽນຮູບພາບແລ້ວລົບພາບເກົ່າ
                        $sqlsec = "select img_path from product where pro_id='$pro_id';";
                        $resultsec = mysqli_query($link, $sqlsec);
                        $data2 = mysqli_fetch_array($resultsec, MYSQLI_ASSOC);
                        $path = __DIR__.DIRECTORY_SEPARATOR.'../../image'.DIRECTORY_SEPARATOR.$data2['img_path'];
                        if(file_exists($path) && !empty($data2['img_path'])){
                            unlink($path);
                        }
                        //ສິ້ນສຸດ
                        //ຕັ້ງຊື່ຮູບພາບອັດຕະໂນມັດ
                        $ext = pathinfo(basename($_FILES['img_path']['name']), PATHINFO_EXTENSION);
                        $new_image_name = 'img_'.uniqid().".".$ext;
                        $image_path = "../../image/";
                        $upload_path = $image_path.$new_image_name;
                        move_uploaded_file($_FILES['img_path']['tmp_name'], $upload_path);
                        $pro_image = $new_image_name;
                        //ສິນສຸດການຕັ້ງຊື່
                        $sqlupdate = "update product set pro_name='$pro_name',qty='$qty',price='$price',cated_id='$cate_id',unit_id='$unit_id',brand_id='$brand_id',promotion='$promotion',qtyalert='$qtyalert',img_path='$pro_image' where pro_id='$pro_id';";
                        $resultupdate = mysqli_query($link,$sqlupdate);
                        if(!$resultupdate){
                            echo"<script>";
                            echo"window.location.href='product.php?update=found';";
                            echo"</script>";
                        }
                        else {
                            echo"<script>";
                            echo"window.location.href='product.php?update=success';";
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
