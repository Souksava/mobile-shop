
<?php
require_once __DIR__ . '../../../vendor/autoload.php';

function ShowData(){

    require '../../ConnectDB/connectDB.php';
    date_default_timezone_set("Asia/Bangkok");
    $datenow = time();
    $Date = date("Y-m-d",$datenow);
    $Search = "%".$_POST['Search']."%";
    if(isset($_POST['btnAll'])){
        $sql = "select sell_id,cus_name,sell_date,sell_time,amount,status_cash,emp_name from sell s left join customers c on s.cus_id=c.cus_id left join employees e on s.emp_id=e.emp_id order by s.sell_id asc;";
        $result = mysqli_query($link,$sql);
        $Bill = 0;
        while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
            $Bill = $Bill + 1 ;
            $output .='
                <tr align="center">
                    <td align="center">'.$Bill.'</td>
                    <td align="center">'.$row["sell_id"].'</td>
                    <td align="center">'.$row["cus_name"].'</td>
                    <td align="center">'.$row["emp_name"].'</td>
                    <td align="center">'.number_format($row["amount"],2).'</td>
                    <td align="center">'.$row["sell_date"].'</td>
                    <td align="center">'.$row["sell_time"].'</td>
                    <td align="center">'.$row["status_cash"].'</td>
                </tr>
            
            ';
          
        }
        $sql2 = "select sum(amount) as amount from sell s left join customers c on s.cus_id=c.cus_id order by s.sell_id asc;";
        $result2 = mysqli_query($link,$sql2);
        $row2 = mysqli_fetch_array($result2, MYSQLI_ASSOC);
        $output .='
        <tr class="fontblack18">
            <td colspan="6" align="right"><h3><b>ຍອມລວມ (ລວມພາສີມູນຄ່າເພີ່ມ) : </b></h3></td>
            <td colspan="3" align="right"><h3><b>'.number_format($row2["amount"],2).' ກີບ</h3> </b></td>
        </tr>    
                ';
        return $output;
    }
    if(isset($_POST['btn'])){
        $Search = $_POST['Search'];
        $date1 = $_POST['date1'];
        $date2 = $_POST['date2'];
        $sql = "select sell_id,cus_name,sell_date,sell_time,amount,status_cash,emp_name from sell s left join customers c on s.cus_id=c.cus_id left join employees e on s.emp_id=e.emp_id where s.sell_id='$Search' or emp_name='$Search' or cus_name='$Search' or sell_date between '$date1' and '$date2' order by s.sell_id asc;";
        $result = mysqli_query($link,$sql);
        $Bill = 0;
        while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
            $Bill = $Bill + 1 ;
            $output .='
            <tr align="center">
                <td align="center">'.$Bill.'</td>
                <td align="center">'.$row["sell_id"].'</td>
                <td align="center">'.$row["cus_name"].'</td>
                <td align="center">'.$row["emp_name"].'</td>
                <td align="center">'.number_format($row["amount"],2).'</td>
                <td align="center">'.$row["sell_date"].'</td>
                <td align="center">'.$row["sell_time"].'</td>
                <td align="center">'.$row["status_cash"].'</td>
            </tr>
            ';
          
        }
        $sql2 = "select sum(amount) as amount from sell s left join customers c on s.cus_id=c.cus_id left join employees e on s.emp_id=e.emp_id where s.sell_id='$Search' or emp_name='$Search' or cus_name='$Search' or sell_date between '$date1' and '$date2' order by s.sell_id asc;";
        $result2 = mysqli_query($link,$sql2);
        $row2 = mysqli_fetch_array($result2, MYSQLI_ASSOC);
        $output .='
        <tr class="fontblack18">
            <td colspan="6" align="right"><h3><b>ຍອມລວມ (ລວມພາສີມູນຄ່າເພີ່ມ) : </b></h3></td>
            <td colspan="3" align="right"><h3><b>'.number_format($row2["amount"],2).' ກີບ</h3> </b></td>
        </tr>    
                ';
        return $output;
    }

}   
date_default_timezone_set("Asia/Bangkok");
$datenow = time();
$Date = date("F d, Y",$datenow);
$name = $_POST['name'];
$address = $_POST['address'];
$tel = $_POST['tel'];
$email = $_POST['email'];
$img_path = $_POST['img_path'];
$content = '
            <div align="left" >
                <div style="float: left; width: 55%;">
                    <img src="../../image/'.$img_path.'" width="150px">
                </div>
            </div>
            <div style="float: left; width: 70%; ">
                <p>
                    <h4 style="color: red;">'.$name.'</h4>
                    <div>
                       <div style="font-size: 10px;">
                           '.$address.'
                       </div>
                    </div>
                </P>
            </div><br>
            <div style="clear: both;"></div>
            <div style="text-align: center;">
                <h2>
                    <u>
                        ຂໍ້ມູນການຂາຍ<br>
                    </u>
                </h2>
            </div>
            <table width="100%" border="1" cellspacing="0" cellpadding="3" style="font-size: 8px;">
                <tr align="center" style="background-color: #dbdbd8">
                    <th style="width: 25px;">#</th>
                    <th style="width: 50px;">ເລກທີບິນ</th>
                    <th style="width: 100px;">ລູກຄ້າ</th>
                    <th style="width: 100px;">ຜູ້ຂາຍ</th>
                    <th style="width: 120px;">ຍອດລວມ</th>
                    <th style="width: 100px;">ວັນທີ</th>
                    <th style="width: 100px;">ເວລາ</th>
                    <th style="width: 100px;">ການຈ່າຍເງິນ</th>
                </tr>
                '.ShowData().'
                </table>
            ';
$mpdf = new \Mpdf\Mpdf([
    'format'            => 'A4',
    'mode'              => 'utf-8',      
    'tempDir'           => '/tmp',
    'default_font_size' => 8,
    'margin_bottom' => 18, 
    'margin_footer' => 5, 
	'default_font' => 'saysettha_ot'
]);
$mpdf->defaultfooterline = 0;
$footer = '<p align="center" style="font-size: 8px;">Page {PAGENO} of {nb}<br>
'.$address.'<br>
Tel: '.$tel.', Email: '.$email.'</p>';
$mpdf->SetFooter($footer,'sample');
$mpdf->WriteHTML($content);
$mpdf->Output('ລາຍງານສິນຄ້າ.pdf','I');
?>