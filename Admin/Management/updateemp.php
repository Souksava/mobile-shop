<?php
    session_start();
    if($_SESSION['ses_id'] == ''){
       echo"<meta http-equiv='refresh' content='1;URL=../index.php'>";        
    }
    else if($_SESSION['status'] != 1){
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
                    <a href="employee.php">
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
            $sqlget = "select emp_id,emp_name,emp_surname,gender,dob,address,tel,email,pass,status,name,work_start,end_work,img_path from employees e left join status s on e.status=s.id where emp_id='$id';";
            $resultget = mysqli_query($link,$sqlget);
            $row = mysqli_fetch_array($resultget, MYSQLI_ASSOC);

        ?>
        <div class="container font14">
            <form action="updateemp.php" id="update" method="POST" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-xs-12 col-sm-6 form-group">
                        <label>ຊື່ພະນັກງານ</label>
                        <input type="text" name="emp_name" class="form-control" value="<?php echo $row['emp_name']?>" placeholder="ຊື່ພະນັກງານ">
                        <input type="hidden" name="emp_id" class="form-control" value="<?php echo $row['emp_id']?>" placeholder="ລະຫັດພະນັກງານ">
                    </div>
                    <div class="col-xs-12 col-sm-6 form-group">
                        <label>ນາມສະກຸນ</label>
                        <input type="text" name="emp_surname" class="form-control" value="<?php echo $row['emp_surname']?>" placeholder="ນາມສະກຸນ">
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-6 form-group">
                        <label>ເພດ</label>
                        <select name="gender" id="" class="form-control">
                            <option value="<?php echo $row['gender']?>"><?php echo $row['gender']?></option>
                            <option value="ຍິງ">ຍິງ</option>
                            <option value="ຊາຍ">ຊາຍ</option>
                        </select>
                    </div>
                    <div class="col-xs-12 col-sm-6 form-group">
                        <label>ວັນເດືອນປີເກີດ</label>
                        <input type="date" name="dob" value="<?php echo $row['dob']?>" class="form-control">
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-6 form-group">
                        <label>ທີ່ຢູ່ປັດຈຸບັນ</label>
                        <input type="text" name="address" class="form-control" value="<?php echo $row['address']?>" placeholder="ທີ່ຢູ່ປັດຈຸບັນ">
                    </div>
                    <div class="col-xs-12 col-sm-6 form-group">
                        <label>ເບີໂທລະສັບ</label>
                        <input type="text" name="tel" class="form-control" value="<?php echo $row['tel']?>" placeholder="ເບີໂທລະສັບ">
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-6 form-group">
                        <label>ທີ່ຢູ່ອີເມວ</label>
                        <input type="email" name="email" class="form-control" value="<?php echo $row['email']?>" placeholder="ທີ່ຢູ່ອີເມວ">
                    </div>
                    <div class="col-xs-12 col-sm-6 form-group">
                        <label>ລະຫັດເຂົ້າໃຊ້ລະບົບ</label>
                        <input type="password" name="pass" class="form-control" value="<?php echo $row['pass']?>" placeholder="ລະຫັດເຂົ້າໃຊ້ລະບົບ">
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-6 form-group">
                        <label>ສະຖານະຜູ້ໃຊ້ລະບົບ</label>
                        <select name="status" id="" class="form-control">
                            <option value="<?php echo $row['status']?>"><?php echo $row['name']?></option>
                                <?php
                                    $status = $row['status'];
                                    $sqlauther = "select * from status where id !='$status';";
                                    $resultauther = mysqli_query($link, $sqlauther);
                                    while($rowauther = mysqli_fetch_array($resultauther, MYSQLI_NUM)){
                                        echo" <option value='$rowauther[0]'>$rowauther[1]</option>";
                                    }
                                ?>
                        </select>
                    </div>
                    <div class="col-xs-12 col-sm-6 form-group">
                        <label>ວັນທີເຂົ້າການ</label>
                        <input type="date" name="work_start" value="<?php echo $row['work_start']?>" class="form-control">
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-6 form-group">
                        <label>ວັນທີອອກການ</label>
                        <input type="date" name="end_work" value="<?php echo $row['end_work']?>" class="form-control">
                    </div>
                    <div class="col-xs-12 col-sm-6 form-group">
                        <label>ຮູບພາບຜູ້ໃຊ້ລະບົບ</label>
                        <input type="file" name="img_path" class="form-control">
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
                $emp_id = $_POST['emp_id']; 
                $emp_name = $_POST['emp_name'];
                $emp_surname = $_POST['emp_surname'];
                $gender = $_POST['gender'];
                $dob = $_POST['dob'];
                $address = $_POST['address'];
                $email = $_POST['email'];
                $tel = $_POST['tel'];
                $pass = $_POST['pass'];
                $status = $_POST['status'];
                $work_start = $_POST['work_start'];
                $end_work = $_POST['end_work'];
                if(trim($dob) == ""){
                    $dob = "0000-00-00";
                }
                if(trim($end_work) == ""){
                    $end_work = "0000-00-00";
                }
                if(trim($work_start) == ""){
                    $work_start = "0000-00-00";
                }
                if(trim($emp_id) == ""){
                    echo"<script>";
                    echo"window.location.href='employee.php?emp_id=null';";
                    echo"</script>";
                }
                elseif(trim($emp_name) == ""){
                    echo"<script>";
                    echo"window.location.href='employee.php?emp_name=null';";
                    echo"</script>";
                }
                elseif(trim($gender) == ""){
                    echo"<script>";
                    echo"window.location.href='employee.php?gender=null';";
                    echo"</script>";
                }
                elseif(trim($tel) == ""){
                    echo"<script>";
                    echo"window.location.href='employee.php?tel=null';";
                    echo"</script>";
                }
                elseif(trim($status) == ""){
                    echo"<script>";
                    echo"window.location.href='employee.php?status=null';";
                    echo"</script>";
                }
                elseif(trim($work_start) == ""){
                    echo"<script>";
                    echo"window.location.href='employee.php?work_start=null';";
                    echo"</script>";
                }
                else {
                    if($_FILES['img_path']['name'] == ""){
                        $sqlupdate = "update employees set emp_name='$emp_name',emp_surname='$emp_surname',gender='$gender',dob='$dob',address='$address',tel='$tel',email='$email',pass='$pass',status='$status',work_start='$work_start',end_work='$end_work' where emp_id='$emp_id';";
                        $resultupdate = mysqli_query($link,$sqlupdate);
                        if(!$resultupdate){
                            echo"<script>";
                            echo"window.location.href='employee.php?update=found';";
                            echo"</script>";
                        }
                        else {
                            echo"<script>";
                            echo"window.location.href='employee.php?update=success';";
                            echo"</script>";
                        }
                    }
                    else {
                        //ເມື່ອປ່ຽນຮູບພາບແລ້ວລົບພາບເກົ່າ
                        $sqlsec = "select img_path from employees where emp_id='$emp_id';";
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
                        $sqlupdate = "update employees set emp_name='$emp_name',emp_surname='$emp_surname',gender='$gender',dob='$dob',address='$address',tel='$tel',email='$email',pass='$pass',status='$status',work_start='$work_start',end_work='$end_work',img_path='$pro_image' where emp_id='$emp_id';";
                        $resultupdate = mysqli_query($link,$sqlupdate);
                        if(!$resultupdate){
                            echo"<script>";
                            echo"window.location.href='employee.php?update=found';";
                            echo"</script>";
                        }
                        else {
                            echo"<script>";
                            echo"window.location.href='employee.php?update=success';";
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
