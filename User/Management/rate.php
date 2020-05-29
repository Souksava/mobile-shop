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
        <title>ສະກຸນເງິນ</title>
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
                    ສະກຸນເງິນ
                </div>
                <div class="tapbar" align="right">
                    <a href="../../Check/Logout.php">
                        <img src="../../icon/close.ico" width="30px">
                    </a>
                </div>
            </div>
        </div>
        <div class="clearfix"></div><br>
      
        <div class="container font12">
            <div class="table-responsive">
                <table class="table table-striped">
                        <tr align="center">
                            <th colspan="4" scope="col" class="font14">ສະກຸນເງິນ</th>
                        </tr>
                    <?php 
                        $sql = "select * from rate;";
                        $result = mysqli_query($link,$sql);
                        while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                    ?>
                  
                        <tr>
                            <td><?php echo $row['rate_id']; ?></td>
                            <td><?php echo $row['rate_buy']; ?></td>
                            <td><?php echo $row['rate_sell']; ?></td>
                            <td>
                                <a href="updaterate.php?id=<?php echo $row['rate_id']; ?>">
                                    <img src="../../icon/edit.ico" alt="" width="20px">
                                </a>
                            </td>
                        </tr>
                    <?php
                        }
                    ?>
                </table>
            </div>
        </div>
        <?php
            if(isset($_GET['rate_buy'])=='null'){
                echo'<script type="text/javascript">
                swal("", "ກະລຸນາປ້ອນເລດຊື້ !", "info");
                </script>';
            }
            if(isset($_GET['rate_sell'])=='null'){
                echo'<script type="text/javascript">
                swal("", "ກະລຸນາປ້ອນເລດຂາຍ !", "info");
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
    </body>
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</html>

<?php

    }

?>