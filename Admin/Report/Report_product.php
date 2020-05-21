
<?php
require_once __DIR__ . '../../../vendor/autoload.php';

function ShowData(){

    require '../../ConnectDB/connectDB.php';
    date_default_timezone_set("Asia/Bangkok");
    $datenow = time();
    $Date = date("Y-m-d",$datenow);
    $Search = "%".$_POST['Search']."%";
    if(isset($_POST['btnReport'])){
        $sql = "select p.pro_id,pro_name,cated_name,brand_name,unit_name,p.img_path,p.qty,p.price,p.price - p.promotion as newprice,p.promotion,(p.promotion/p.price) * 100 as perzen,p.qty*(p.price - p.promotion) as total from  product p left join categorydetail i  on p.cated_id=i.cated_id left join brand b on p.brand_id=b.brand_id left join unit u on p.unit_id=u.unit_id where p.pro_id like '$Search' or pro_name like '$Search' or brand_name like '$Search' or unit_name like '$Search' or cated_name like '$Search';";
        $result = mysqli_query($link,$sql);
        $Bill = 0;
        while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
            $Bill = $Bill + 1 ;
            $output .='
                <tr align="center">
                    <td align="center">'.$Bill.'</td>
                    <td align="center"><img src="../../image/'.$row["img_path"].'" style="width: 100px;heigt: 100px;"></td>
                    <td align="left">'.$row["cated_name"].' '.$row["brand_name"].' '.$row["pro_name"].'</td>
                    <td align="center">'.$row["qty"].'</td>
                    <td align="left">
                        <h6 style="color: #CE3131;">ລາຄາ '.number_format($row["newprice"],2).' </h6><br>
                        ລາຄາປົກກະຕິ '.number_format($row["price"],2).'<br>
                        <label style="color: #7E7C7C;font-size: 12px;">ສ່ວນຫຼຸດ '.number_format($row['promotion'],2).' ('.number_format($row['perzen'],2).'%) </label><br>
                    </td>
                    <td align="center">'.number_format($row["total"],2).'</td>
                </tr>
            
            ';
          
        }
        $sqlAmount = "select sum(p.qty*(p.price - p.promotion)) as amount from  product p left join categorydetail i  on p.cated_id=i.cated_id left join brand b on p.brand_id=b.brand_id left join unit u on p.unit_id=u.unit_id where p.pro_id like '$Search' or pro_name like '$Search' or brand_name like '$Search' or unit_name like '$Search' or cated_name like '$Search';";
        $result7 = mysqli_query($link, $sqlAmount);
        $rowAmount = mysqli_fetch_array($result7, MYSQLI_ASSOC);
        $output .='
        <tr class="fontblack18">
            <td colspan="4" align="right"><h3><b>ຍອມລວມ (ລວມພາສີມູນຄ່າເພີ່ມ) : </b></h3></td>
            <td colspan="2" align="right"><h3><b>'.number_format($rowAmount["amount"],2).' ກີບ</h3> </b></td>
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
                        ຂໍ້ມູນສິນຄ້າ<br>
                    </u>
                </h2>
            </div>
            <table width="100%" border="1" cellspacing="0" cellpadding="3" style="font-size: 8px;">
                <tr align="center" style="background-color: #dbdbd8">
                    <th style="width: 25px;">#</th>
                    <th style="width: 150px;">ສິນຄ້າ</th>
                    <th style="width: 200px;">ຊື່ສິນຄ້າ</th>
                    <th style="width: 90px;">ຈຳນວນ</th>
                    <th style="width: 120px;">ລາຄາ</th>
                    <th style="width: 120px;">ລວມ</th>
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