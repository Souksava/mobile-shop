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
    $Date2 = date("Y-m-d",$datenow);
    $sqlshop = "select * from shop;";
    $resultshop = mysqli_query($link,$sqlshop);
    $rowshop = mysqli_fetch_array($resultshop,MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Dashboard</title>
  <!-- Tell the browser to be responsive to screen width -->
  <link rel="icon" href="../../image/<?php echo $rowshop['img_title']; ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../../css/style.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">

</head>
<body class="hold-transition sidebar-mini layout-fixed">
      <!-- head -->
      <div class="header">
            <div class="container">
                <div class="tapbar">
                    <a href="report.php">
                        <img src="../../icon/back.ico" width="30px">
                    </a>
                </div>
                <div align="center" class="tapbar fonthead">
                Dashboard
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
  <div class="container font14">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Dashboard</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <?php 
                  $sqlorder = "select count(sell_id) as count_order from sell where sell_date = '$Date2';";
                  $resultorder = mysqli_query($link,$sqlorder);
                  $roworder = mysqli_fetch_array($resultorder,MYSQLI_ASSOC);
                ?>
                <h4><?php echo $roworder['count_order']; ?> ລາຍການ</h4>
                <p>ຈຳນວນລາຍການຂາຍລາຍວັນ</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="frmsale.php" class="small-box-footer">ຂໍ້ມູນເພີ່ມເຕີມ <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <?php 
                $sqlrevenue = "select sum(amount) as amount from sell where sell_date = '$Date2';";
                $resultrevenue = mysqli_query($link,$sqlrevenue);
                $rowrevenue = mysqli_fetch_array($resultrevenue,MYSQLI_ASSOC);
                ?>
                <h4><?php echo number_format($rowrevenue['amount'],2); ?> ກີບ</h4>

                <p>ຍອດລາຍຮັບລາຍວັນ</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="frmsale.php" class="small-box-footer">ຂໍ້ມູນເພີ່ມເຕີມ <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

          <!-- ./col -->
        </div>
        <!-- /.row -->
  </div><br>
  <div class="container font14">
    <?php 
       $query = "select date_format(sell_date,'%M') as month,sum(amount) as amount from sell where year(sell_date) = date_format(now(),'%Y') group by month(sell_date);";
       $result = mysqli_query($link, $query);
       $resultchart = mysqli_query($link, $query);  
       //for chart
       $datesave = array();
       $totol = array();

       while($rs = mysqli_fetch_array($resultchart)){ 
       $datesave[] = "\"".$rs['month']."\""; 
       $totol[] = "\"".$rs['amount']."\""; 
       }
       $datesave = implode(",", $datesave); 
       $totol = implode(",", $totol); 
       date_default_timezone_set("Asia/Bangkok");
       $datenow = time();
       $Date = date("Y",$datenow);
    ?>
       <h3 align="center">ລາຍງານລາຍຮັບໃນແບບກຣາຟ ໃນປີ <?php echo $Date; ?></h3>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.bundle.js"></script>
        <hr>
        <p align="center">
            <!--devbanban.com-->
            <canvas id="myChart" width="100%" height="30px"></canvas>
            <script>
                var ctx = document.getElementById("myChart").getContext('2d');
                var myChart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: [<?php echo $datesave;?>
                    
                        ],
                        datasets: [{
                            label: 'Report Graphs Month (LAK)',
                            data: [<?php echo $totol;?>
                            ],
                            backgroundColor: [
                                'rgba(75, 91, 236,0.4)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(255, 206, 86, 0.2)',
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(153, 102, 255, 0.2)',
                                'rgba(255, 159, 64, 0.2)'
                            ],
                            borderColor: [
                                'rgba(10, 23, 143,1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(153, 102, 255, 1)',
                                'rgba(255, 159, 64, 1)'
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero:true
                                }
                            }]
                        }
                    }
                });
            </script>  
        </p><br><br>
        <?php 
          $query2 = "select date_format(imp_date,'%M') as month,sum(qty*price) as amount from imports where year(imp_date) = date_format(now(),'%Y') group by month(imp_date);";
          $result2 = mysqli_query($link, $query2);
          $resultchart2 = mysqli_query($link, $query2);  


          //for chart
          $datesave2 = array();
          $totol2 = array();

          while($rs2 = mysqli_fetch_array($resultchart2)){ 
            $datesave2[] = "\"".$rs2['month']."\""; 
            $totol2[] = "\"".$rs2['amount']."\""; 
          }
          $datesave2 = implode(",", $datesave2); 
          $totol2 = implode(",", $totol2); 
        ?>
        <h3 align="center">ລາຍງານລາຍຈ່າຍໃນແບບກຣາຟ ໃນປີ <?php echo $Date; ?></h3>

        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.bundle.js"></script>
        <hr>
        <p align="center">

        <!--devbanban.com-->

        <canvas id="myChart2" width="100%" height="30px"></canvas>
        <script>
        var ctx2 = document.getElementById("myChart2").getContext('2d');
        var myChart2 = new Chart(ctx2, {
            type: 'line',
            data: {
                labels: [<?php echo $datesave2;?>
            
                ],
                datasets: [{
                    label: 'Report Graphs Month (LAK)',
                    data: [<?php echo $totol2;?>
                    ],
                    backgroundColor: [
                        'rgba(245, 19, 19,0.6)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(143, 10, 10,1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero:true
                        }
                    }]
                }
            }
        });
        </script>  
        </p>
  </div>
     


<!-- AdminLTE App -->
<script src="dist/js/adminlte.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
</body>
</html>
