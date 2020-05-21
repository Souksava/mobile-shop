
<?php
require_once __DIR__ . '../../../vendor/autoload.php';

function ShowData(){

    require '../../ConnectDB/connectDB.php';
    date_default_timezone_set("Asia/Bangkok");
    $datenow = time();
    $Date = date("Y-m-d",$datenow);
    if(isset($_POST['btnReport'])){
        $sql = "select * from customers order by cus_name asc;";
        $result = mysqli_query($link,$sql);
        $Bill = 0;
        while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
            $Bill = $Bill + 1 ;
            $output .='
                <tr align="center">
                    <td align="center">'.$Bill.'</td>
                    <td align="center">'.$row["cus_name"].' '.$row["cus_surname"].'</td>
                    <td align="center">'.$row["gender"].'</td>
                    <td align="center">'.$row["address"].'</td>
                    <td align="center">'.$row["tel"].'</td>
                    <td align="center">'.$row["email"].'</td>
                </tr>
            
            ';
          
        }
        $sqlAmount = "select count(*) as count_total from customers;";
        $result7 = mysqli_query($link, $sqlAmount);
        $rowAmount = mysqli_fetch_array($result7, MYSQLI_ASSOC);
        $output .='
        <tr class="fontblack18">
            <td colspan="4" align="right"><h3><b>ຈຳນວນທັງໝົດ:  </b></h3></td>
            <td colspan="2" align="right"><h3><b>'.$rowAmount["count_total"].' ຄົນ</h3> </b></td>
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
                        ຂໍ້ມູນລູກຄ້າ<br>
                    </u>
                </h2>
            </div>
            <table width="100%" border="1" cellspacing="0" cellpadding="3" style="font-size: 8px;">
                <tr align="center" style="background-color: #dbdbd8">
                    <th style="width: 25px;">#</th>
                    <th style="width: 150px;">ຊື່ ແລະ ນາມສະກຸນ</th>
                    <th style="width: 80px;">ເພດ</th>
                    <th style="width: 200px;">ທີ່ຢູ່</th>
                    <th style="width: 100px;">ເບີໂທລະສັບ</th>
                    <th style="width: 100px;">ອີເມວ</th>
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
$mpdf->Output('ລາຍງານລູກຄ້າ.pdf','I');
?>