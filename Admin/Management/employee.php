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
        <title>ພະນັກງານ</title>
        <link rel="icon" href="../../image/<?php echo $rowshop['img_title']; ?>">
        <link rel="stylesheet" href="../../css/style.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <body >
        <div class="header">
            <div class="container">
                <div class="tapbar">
                    <a href="management.php">
                        <img src="../../icon/back.ico" width="30px">
                    </a>
                </div>
                <div align="center" class="tapbar fonthead">
                    ພະນັກງານ
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
                    <b>ພະນັກງານ</b>&nbsp <img src="../../icon/hidemenu.ico" width="10px">
                </div>
                <div align="right" style="width: 48%;float: right;">
                    <form action="employee.php" id="form1" method="POST" enctype="multipart/form-data">
                        <a href="#" data-toggle="modal" data-target="#exampleModal">
                            <img src="../../icon/add.ico" alt="" width="30px">
                        </a>
                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">ເພີ່ມພະນັກງານ</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row" align="left">
                                            <div class="col-xs-12 col-sm-6 form-group">
                                                <label>ລະຫັດ</label>
                                                <input type="text" name="emp_id" class="form-control" placeholder="ລະຫັດພະນັກງານ">
                                            </div>
                                            <div class="col-xs-12 col-sm-6 form-group">
                                                <label>ຊື່ພະນັກງານ</label>
                                                <input type="text" name="emp_name" class="form-control" placeholder="ຊື່ພະນັກງານ">
                                            </div>
                                            <div class="col-xs-12 col-sm-6 form-group">
                                                <label>ນາມສະກຸນ</label>
                                                <input type="text" name="emp_surname" class="form-control" placeholder="ນາມສະກຸນ">
                                            </div>
                                            <div class="col-xs-12 col-sm-6 form-group">
                                                <label>ເພດ</label>
                                                <select name="gender" id="" class="form-control">
                                                    <option value="">ເລືອກເພດ</option>
                                                    <option value="ຍິງ">ຍິງ</option>
                                                    <option value="ຊາຍ">ຊາຍ</option>
                                                </select>
                                            </div>
                                            <div class="col-xs-12 col-sm-6 form-group">
                                                <label>ວັນເດືອນປີເກີດ</label>
                                                <input type="date" name="dob" class="form-control">
                                            </div>
                                            <div class="col-xs-12 col-sm-6 form-group">
                                                <label>ທີ່ຢູ່ປັດຈຸບັນ</label>
                                                <input type="text" name="address" class="form-control" placeholder="ທີ່ຢູ່ປັດຈຸບັນ">
                                            </div>
                                            <div class="col-xs-12 col-sm-6 form-group">
                                                <label>ເບີໂທລະສັບ</label>
                                                <input type="text" name="tel" class="form-control" placeholder="ເບີໂທລະສັບ">
                                            </div>
                                            <div class="col-xs-12 col-sm-6 form-group">
                                                <label>ທີ່ຢູ່ອີເມວ</label>
                                                <input type="email" name="email" class="form-control" placeholder="ທີ່ຢູ່ອີເມວ">
                                            </div>
                                            <div class="col-xs-12 col-sm-6 form-group">
                                                <label>ລະຫັດເຂົ້າໃຊ້ລະບົບ</label>
                                                <input type="password" name="pass" class="form-control" placeholder="ລະຫັດເຂົ້າໃຊ້ລະບົບ">
                                            </div>
                                            <div class="col-xs-12 col-sm-6 form-group">
                                                <label>ສະຖານະຜູ້ໃຊ້ລະບົບ</label>
                                                <select name="status" id="" class="form-control">
                                                    <option value="">ເລືອກສະຖານະຜູ້ໃຊ້ລະບົບ</option>
                                                    <?php
                                                        $sqlauther = "select * from status;";
                                                        $resultauther = mysqli_query($link, $sqlauther);
                                                        while($rowauther = mysqli_fetch_array($resultauther, MYSQLI_NUM)){
                                                        echo" <option value='$rowauther[0]'>$rowauther[1]</option>";
                                                        }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="col-xs-12 col-sm-6 form-group">
                                                <label>ວັນທີເຂົ້າການ</label>
                                                <input type="date" name="work_start" class="form-control">
                                            </div>
                                            <div class="col-xs-12 col-sm-6 form-group">
                                                <label>ວັນທີອອກການ</label>
                                                <input type="date" name="end_work" class="form-control">
                                            </div>
                                            <div class="col-xs-12 col-sm-6 form-group">
                                                <label>ຮູບພາບຜູ້ໃຊ້ລະບົບ</label>
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
                    $sqlckid = "select * from employees where emp_id='$emp_id';";
                    $resultckid = mysqli_query($link,$sqlckid);
                    $sqlemail = "select * from employees where email='$email';";
                    $resultemail = mysqli_query($link,$sqlemail);
                    if(mysqli_num_rows($resultckid) > 0){
                        echo"<script>";
                        echo"window.location.href='employee.php?employee=same';";
                        echo"</script>";
                    }
                    elseif (mysqli_num_rows($resultemail) > 0) {
                        echo"<script>";
                        echo"window.location.href='employee.php?emailsame=same';";
                        echo"</script>";
                    }
                    else {
                        $ext = pathinfo(basename($_FILES["img_path"]["name"]), PATHINFO_EXTENSION);
                        $new_image_name = "img_".uniqid().".".$ext;
                        $image_path = "../../image/";
                        $upload_path = $image_path.$new_image_name;
                        move_uploaded_file($_FILES["img_path"]["tmp_name"], $upload_path);
                        $pro_img = $new_image_name;
                        $sqlinsert = "insert into employees(emp_id,emp_name,emp_surname,gender,dob,address,tel,email,pass,status,work_start,end_work,img_path) values('$emp_id','$emp_name','$emp_surname','$gender','$dob','$address','$tel','$email','$pass','$status','$work_start','$end_work','$pro_img');";
                        $resultinsert = mysqli_query($link, $sqlinsert);
                        if(!$resultinsert){
                            echo"<script>";
                            echo"window.location.href='employee.php?save=found';";
                            echo"</script>";
                        }
                        else {
                            echo"<script>";
                            echo"window.location.href='employee.php?save=success';";
                            echo"</script>";
                        }
                    }
                }
            }
            if(isset($_GET['emp_id'])=='null'){
                echo'<script type="text/javascript">
                swal("", "ກະລຸນາປ້ອນລະຫັດຜູ້ໃຊ້ລະບົບ !", "info");
                </script>';
            }
            if(isset($_GET['emp_name'])=='null'){
                echo'<script type="text/javascript">
                swal("", "ກະລຸນາປ້ອນຊື່ຜູ້ໃຊ້ລະບົບ !", "info");
                </script>';
            }
            if(isset($_GET['gender'])=='null'){
                echo'<script type="text/javascript">
                swal("", "ກະລຸນາເລືອກເພດ !", "info");
                </script>';
            }
            if(isset($_GET['tel'])=='null'){
                echo'<script type="text/javascript">
                swal("", "ກະລຸນາປ້ອນເບີໂທລະສັບ !", "info");
                </script>';
            }
            if(isset($_GET['status'])=='null'){
                echo'<script type="text/javascript">
                swal("", "ກະລຸນາເລືອກສະຖານະຜູ້ໃຊ້ລະບົບ !", "info");
                </script>';
            }
            if(isset($_GET['work_start'])=='null'){
                echo'<script type="text/javascript">
                swal("", "ກະລຸນາເລືອກວັນທີເລີ່ມວຽກ !", "info");
                </script>';
            }
            if(isset($_GET['employee'])=='same'){
                echo'<script type="text/javascript">
                swal("", "ບໍ່ສາມາດບັນທຶກຂໍ້ມູນໄດ້ ເນື່ອງຈາກລະຫັດຜູ້ໃຊ້ນີ້ມີຢູ່ແລ້ວ ກະລຸນາໃສ່ລະຫັດທີ່ແຕກຕ່າງ !", "error");
                </script>';
            }
            if(isset($_GET['emailsame'])=='same'){
                echo'<script type="text/javascript">
                swal("", "ບໍ່ສາມາດບັນທຶກຂໍ້ມູນໄດ້ ເນື່ອງຈາກອີ່ເມວຜູ້ໃຊ້ນີ້ມີຢູ່ແລ້ວ ກະລຸນາໃສ່ອີເມວທີ່ແຕກຕ່າງ !", "error");
                </script>';
            }
            if(isset($_GET['save'])=='found'){
                echo'<script type="text/javascript">
                swal("", "ບັນທຶກຂໍ້ມູນບໍ່ສຳເລັດ !", "error");
                </script>';
            }
            if(isset($_GET['save'])=='success'){
                echo'<script type="text/javascript">
                swal("", "ບັນທຶກຂໍ້ມູນສຳເລັດ !", "success");
                </script>';
            }
            if(isset($_GET['update'])=='success'){
                echo'<script type="text/javascript">
                swal("", "ແກ້ໄຂຂໍ້ມູນສຳເລັດ !", "success");
                </script>';
            }
            if(isset($_GET['update'])=='found'){
                echo'<script type="text/javascript">
                swal("", "ແກ້ໄຂຂໍ້ມູນບໍ່ສຳເລັດ ກະລຸນາລອງໃໝ່ອີກຄັ້ງ !", "error");
                </script>';
            }
            if(isset($_GET['order'])=='found'){
                echo'<script type="text/javascript">
                swal("", "ບໍ່ສາມາດລົບຂໍ້ມູນໄດ້ ເນື່ອງຈາກພະນັກງານຄົນນີ້ໄດ້ເຄີຍທຳການສັ່ງຊື້ສິນຄ້າແລ້ວ !", "error");
                </script>';
            }
            if(isset($_GET['import'])=='found'){
                echo'<script type="text/javascript">
                swal("", "ບໍ່ສາມາດລົບຂໍ້ມູນໄດ້ ເນື່ອງຈາກພະນັກງານຄົນນີ້ໄດ້ເຄີຍທຳການນຳເຂົ້າສິນຄ້າແລ້ວ !", "error");
                </script>';
            }
            if(isset($_GET['sell'])=='found'){
                echo'<script type="text/javascript">
                swal("", "ບໍ່ສາມາດລົບຂໍ້ມູນໄດ້ ເນື່ອງຈາກພະນັກງານຄົນນີ້ໄດ້ເຄີຍທຳການຂາຍສິນຄ້າແລ້ວ !", "error");
                </script>';
            }
            if(isset($_GET['del'])=='found'){
                echo'<script type="text/javascript">
                swal("", "ລົບຂໍ້ມູນບໍ່ສຳເລັດ ກະລຸນາລອງໃໝ່ອີກຄັ້ງ !", "error");
                </script>';
            }
            if(isset($_GET['del'])=='success'){
                echo'<script type="text/javascript">
                swal("", "ລົບຂໍ້ມູນສຳເລັດ !", "success");
                </script>';
            }
            if(isset($_GET['update'])=='found'){
                echo'<script type="text/javascript">
                swal("", "ບໍ່ສາມາດແກ້ໄຂຂໍ້ມູນໄດ້ ກະລຸນາລອງໃໝ່ອີກຄັ້ງ !", "error");
                </script>';
            }
            if(isset($_GET['update'])=='success'){
                echo'<script type="text/javascript">
                swal("", "ແກ້ໄຂຂໍ້ມູນສຳເລັດ !", "success");
                </script>';
            }
            
        ?>
        <div class="clearfix"></div>
        <div class="container font14">
            <form action="employee.php" id="fomrsearch" method="POST">
                <div style="width: 100%">
                    <input type="text" class="form-control" name="search" style="float: left;width: 50%;" placeholder="ລະຫັດ, ຊື່, ນາມສະກຸນ, ເພດ">
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
                    $sql = "select emp_id,emp_name,emp_surname,gender,dob,address,tel,email,md5(pass) as pass,name,work_start,end_work,img_path,DATEDIFF('$Date',dob)/365 AS age from employees e left join status s on e.status=s.id where emp_id like '$search' or emp_name like '$search' or emp_surname like '$search' or gender like '$search' order by emp_id desc;";
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
                            <h6 class="card-title">ລະຫັດ: <?php echo $row['emp_id']; ?></h6>
                            <p class="card-text">
                                ຊື່ ແລະ ນາມສະກຸນ: <?php echo $row['emp_name']; ?>  <?php echo $row['emp_surname']; ?> ເພດ: <?php echo $row['gender']; ?> <br>
                                ວັນເດືອນປີເກີດ: <?php echo $row['dob']; ?> ອາຍຸ: <?php echo number_format($row['age']); ?><br>
                                ທີ່ຢູ່ປັດຈຸບັນ: <?php echo $row['address']; ?><br>
                                ທີ່ຢູ່ອີເມວ: <?php echo $row['email']; ?> <br>
                                ເບີໂທລະສັບ: <?php echo $row['tel']; ?> <br>
                                ລະຫັດຜູ້ໃຊ້ລະບົບ: <?php echo $row['pass']; ?><br>
                                ສະຖານະຜູ້ໃຊ້ລະບົບ: <?php echo $row['name']; ?><br>
                                ວັນທີເຂົ້າການ: <?php echo $row['work_start']; ?> ວັນທີອອກການ: <?php echo $row['end_work']; ?><br><br>
                                <a href="updateemp.php?id=<?php echo $row['emp_id']; ?>" class="btn btn-outline-success" style="width: 100%;">ແກ້ໄຂ</a><br><br>
                                <a href="deleteemp.php?id=<?php echo $row['emp_id']; ?>" class="btn btn-outline-danger" style="width: 100%;" >ລົບ</a>
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
