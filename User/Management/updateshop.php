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
                    <a href="shop.php">
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
            $sqlget = "select * from shop where id='$id';";
            $resultget = mysqli_query($link,$sqlget);
            $row = mysqli_fetch_array($resultget, MYSQLI_ASSOC);

        ?>
        <div class="container font14">
            <form action="updateshop.php" id="update" method="POST" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-xs-12 col-sm-6 form-group">
                        <label>ຊື່ຮ້ານ</label>
                        <input type="text" name="name" class="form-control" value="<?php echo $row['name']?>">
                        <input type="hidden" name="id" class="form-control" value="<?php echo $row['id']?>" placeholder="ຊື່ຮ້ານ">
                    </div>
                    <div class="col-xs-12 col-sm-6 form-group">
                        <label>ທີ່ຕັ້ງຮ້ານ</label>
                        <input type="text" name="address" class="form-control" value="<?php echo $row['address']?>" placeholder="ທີ່ຕັ້ງຮ້ານ">
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-6 form-group">
                        <label>ເບີໂທລະສັບ</label>
                        <input type="text" name="tel" class="form-control" value="<?php echo $row['tel']?>" placeholder="ເບີໂທລະສັບ">
                    </div>
                    <div class="col-xs-12 col-sm-6 form-group">
                        <label>ທີ່ຢູ່ອີເມວ</label>
                        <input type="email" name="email" class="form-control" value="<?php echo $row['email']?>" placeholder="ທີ່ຢູ່ອີເມວ">
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-6 form-group">
                        <label>ຮູບໂລໂກ</label>
                        <input type="file" name="img_path" class="form-control" >
                    </div>
                    <div class="col-xs-12 col-sm-6 form-group">
                        <label>ຮູບສ່ວນຫົວເວັບໄຊ</label>
                        <input type="file" name="img_title" class="form-control">
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-6 form-group">
                        <label>ວັນສ້າງຕັ້ງຮ້ານ </label>
                        <input type="date" name="date_shop" value="<?php echo $row['date_shop']?>" class="form-control">
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 form-group">
                        <button type="submit" class="btn btn-outline-success" name="btnUpdate" style="width: 100%;">
                           ແກ້ໄຂຂໍ້ມູນ
                        </button>
                    </div>
                </div>
            </form>
        <?php
            if(isset($_POST['btnUpdate'])){
                $shop_id = $_POST['id'];
                $name = $_POST['name'];
                $address = $_POST['address'];
                $tel = $_POST['tel'];
                $email = $_POST['email'];
                $date_shop = $_POST['date_shop'];
                $img_path = $_FILES['img_path']['name'];
                $img_title = $_FILES['img_title']['name'];
                if(trim($date_shop) == ""){
                    $date_shop = "0000-00-00";
                }
                if(trim($shop_id) == ""){
                    echo"<script>";
                    echo"alert('ບໍ່ສາມາດແກ້ໄຂຂໍ້ມູນໄດ້ ກະລຸນາລອງໃໝ່ອີກຄັ້ງ');";
                    echo"window.location.href='shop.php';";
                    echo"</script>";
                }
                elseif(trim($name) == ""){
                    echo"<script>";
                    echo"window.location.href='shop.php?name=null';";
                    echo"</script>";
                }
                elseif(trim($address) == ""){
                    echo"<script>";
                    echo"window.location.href='shop.php?address=null';";
                    echo"</script>";
                }
                elseif(trim($tel) == ""){
                    echo"<script>";
                    echo"window.location.href='shop.php?tel=null';";
                    echo"</script>";
                }
                elseif(trim($email) == ""){
                    echo"<script>";
                    echo"window.location.href='shop.php?email=null';";
                    echo"</script>";
                }
                else {
                    if($img_path == "" and $img_title != ""){
                        $sqlsec = "select img_title from shop where id='$shop_id';";
                        $resultsec = mysqli_query($link, $sqlsec);
                        $data2 = mysqli_fetch_array($resultsec, MYSQLI_ASSOC);
                        $path = __DIR__.DIRECTORY_SEPARATOR.'../../image/'.DIRECTORY_SEPARATOR.$data2['img_title'];
                        if(file_exists($path) && !empty($data2['img_title'])){
                            unlink($path);
                        }
                        $ext = pathinfo(basename($_FILES['img_title']['name']), PATHINFO_EXTENSION);
                        $new_image_name = 'img_'.uniqid().".".$ext;
                        $image_path = "../../image/";
                        $upload_path = $image_path.$new_image_name;
                        move_uploaded_file($_FILES['img_title']['tmp_name'], $upload_path);
                        $pro_image = $new_image_name;  
                        $sqlupdate = "update shop set name='$name',address='$address',tel='$tel',email='$email',date_shop='$date_shop',img_title='$pro_image' where id='$shop_id';";
                        $resultupdate = mysqli_query($link,$sqlupdate);
                        if(!$resultupdate){
                            echo"<script>";
                            echo"window.location.href='shop.php?update=found';";
                            echo"</script>";
                        }
                        else {
                            echo"<script>";
                            echo"window.location.href='shop.php?update=success';";
                            echo"</script>";
                        }
                    }
                    else if($img_path != "" and $img_title == ""){
                        $sqlsec = "select img_path from shop where id='$shop_id';";
                        $resultsec = mysqli_query($link, $sqlsec);
                        $data2 = mysqli_fetch_array($resultsec, MYSQLI_ASSOC);
                        $path = __DIR__.DIRECTORY_SEPARATOR.'../../image/'.DIRECTORY_SEPARATOR.$data2['img_path'];
                        if(file_exists($path) && !empty($data2['img_path'])){
                            unlink($path);
                        }
                        $ext = pathinfo(basename($_FILES['img_path']['name']), PATHINFO_EXTENSION);
                        $new_image_name = 'img_'.uniqid().".".$ext;
                        $image_path = "../../image/";
                        $upload_path = $image_path.$new_image_name;
                        move_uploaded_file($_FILES['img_path']['tmp_name'], $upload_path);
                        $pro_image = $new_image_name;  
                        $sqlupdate = "update shop set name='$name',address='$address',tel='$tel',email='$email',date_shop='$date_shop',img_path='$pro_image' where id='$shop_id';";
                        $resultupdate = mysqli_query($link,$sqlupdate);
                        if(!$resultupdate){
                            echo"<script>";
                            echo"window.location.href='shop.php?update=found';";
                            echo"</script>";
                        }
                        else {
                            echo"<script>";
                            echo"window.location.href='shop.php?update=success';";
                            echo"</script>";
                        }
                    }
                    else if($img_path != "" and $img_title != ""){
                        $sqlsec = "select img_path from shop where id='$shop_id';";
                        $resultsec = mysqli_query($link, $sqlsec);
                        $data2 = mysqli_fetch_array($resultsec, MYSQLI_ASSOC);
                        $path = __DIR__.DIRECTORY_SEPARATOR.'../../image/'.DIRECTORY_SEPARATOR.$data2['img_path'];
                        if(file_exists($path) && !empty($data2['img_path'])){
                            unlink($path);
                        }
                        $ext = pathinfo(basename($_FILES['img_path']['name']), PATHINFO_EXTENSION);
                        $new_image_name = 'img_'.uniqid().".".$ext;
                        $image_path = "../../image/";
                        $upload_path = $image_path.$new_image_name;
                        move_uploaded_file($_FILES['img_path']['tmp_name'], $upload_path);
                        $pro_image = $new_image_name; 

                        $sqlsec2 = "select img_title from shop where id='$shop_id';";
                        $resultsec2 = mysqli_query($link, $sqlsec2);
                        $data3 = mysqli_fetch_array($resultsec2, MYSQLI_ASSOC);
                        $path2 = __DIR__.DIRECTORY_SEPARATOR.'../../image/'.DIRECTORY_SEPARATOR.$data3['img_title'];
                        if(file_exists($path2) && !empty($data3['img_title'])){
                            unlink($path2);
                        }
                        $ext2 = pathinfo(basename($_FILES['img_title']['name']), PATHINFO_EXTENSION);
                        $new_image_name2 = 'img_'.uniqid().".".$ext2;
                        $image_path2 = "../../image/";
                        $upload_path2 = $image_path2.$new_image_name2;
                        move_uploaded_file($_FILES['img_title']['tmp_name'], $upload_path2);
                        $pro_image2 = $new_image_name2;  
                        $sqlupdate = "update shop set name='$name',address='$address',tel='$tel',email='$email',date_shop='$date_shop',img_path='$pro_image',img_title='$pro_image2' where id='$shop_id';";
                        $resultupdate = mysqli_query($link,$sqlupdate);
                        if(!$resultupdate){
                            echo"<script>";
                            echo"window.location.href='shop.php?update=found';";
                            echo"</script>";
                        }
                        else {
                            echo"<script>";
                            echo"window.location.href='shop.php?update=success';";
                            echo"</script>";
                        }
                    }
                    else {
                        $sqlupdate = "update shop set name='$name',address='$address',tel='$tel',email='$email',date_shop='$date_shop' where id='$shop_id';";
                        $resultupdate = mysqli_query($link,$sqlupdate);
                        if(!$resultupdate){
                            echo"<script>";
                            echo"window.location.href='shop.php?update=found';";
                            echo"</script>";
                        }
                        else {
                            echo"<script>";
                            echo"window.location.href='shop.php?update=success';";
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
