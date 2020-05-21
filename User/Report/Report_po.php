
<?php
require_once __DIR__ . '../../../vendor/autoload.php';

function ShowData(){

    require '../../ConnectDB/connectDB.php';
    date_default_timezone_set("Asia/Bangkok");
    $datenow = time();
    $Date = date("Y-m-d",$datenow);
    if(isset($_POST['btnAll'])){
        $sql = "select imp_id,imp_bill,order_id,company,emp_name,i.pro_id,pro_name,unit_name,brand_name,cated_name,i.qty,i.price,i.qty*i.price as total,imp_date,imp_time,note,p.img_path from imports i left join product p on i.pro_id=p.pro_id left join brand b on p.brand_id=b.brand_id left join categorydetail d on p.cated_id=d.cated_id left join unit u on p.unit_id=u.unit_id left join suppliers s on i.sup_id=s.sup_id left join employees e on i.emp_id=e.emp_id;";
        $result = mysqli_query($link,$sql);
        $Bill = 0;
        while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
            $Bill = $Bill + 1 ;
            $output .='
                <tr align="center">
                    <td align="center">'.$Bill.'</td>
                    <td align="center"><img src="../../image/'.$row['img_path'].'" style="width: 100px;heigt: 100px;"></td>
                    <td align="center">'.$row["pro_id"].' <br> '.$row["cated_name"].' '.$row["brand_name"].' '.$row["pro_name"].'</td>
                    <td align="center">'.$row["qty"].' '.$row["unit_name"].'</td>
                    <td align="center">'.number_format($row["price"],2).'</td>
                    <td align="center">'.number_format($row["total"],2).'</td>
                    <td align="center">'.$row["imp_bill"].'</td>
                    <td align="center">'.$row["company"].'</td>
                    <td align="center">'.$row["emp_name"].'</td>
                    <td align="center">'.$row["imp_date"].'</td>
                    <td align="center">'.$row["note"].'</td>
                </tr>  
            ';
          
        }
        $sql2 = "select sum(qty*price) as amount from imports;";
        $result2 = mysqli_query($link,$sql2);
        $row2 = mysqli_fetch_array($result2,MYSQLI_ASSOC);
        $output .='
        <tr class="fontblack18">
            <td colspan="7" align="right"><h3><b>ມູນຄ່າທັງໝົດ : </b></h3></td>
            <td colspan="4" align="right"><h3><b>'.number_format($row2["amount"],2).' ກີບ</h3> </b></td>
        </tr>  
                ';
        return $output;
    }
    if(isset($_POST['btn'])){
        $date1 = $_POST['date1'];
        $date2 = $_POST['date2'];
        $sql = "select imp_id,imp_bill,order_id,company,emp_name,i.pro_id,pro_name,unit_name,brand_name,cated_name,i.qty,i.price,i.qty*i.price as total,imp_date,imp_time,note,p.img_path from imports i left join product p on i.pro_id=p.pro_id left join brand b on p.brand_id=b.brand_id left join categorydetail d on p.cated_id=d.cated_id left join unit u on p.unit_id=u.unit_id left join suppliers s on i.sup_id=s.sup_id left join employees e on i.emp_id=e.emp_id where imp_date between '$date1' and '$date2';";
        $result = mysqli_query($link,$sql);
        $Bill = 0;
        while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
            $Bill = $Bill + 1 ;
            $output .='
                <tr align="center">
                    <td align="center">'.$Bill.'</td>
                    <td align="center"><img src="../../image/'.$row['img_path'].'" style="width: 100px;heigt: 100px;"></td>
                    <td align="center">'.$row["pro_id"].' <br> '.$row["cated_name"].' '.$row["brand_name"].' '.$row["pro_name"].'</td>
                    <td align="center">'.$row["qty"].' '.$row["unit_name"].'</td>
                    <td align="center">'.number_format($row["price"],2).'</td>
                    <td align="center">'.number_format($row["total"],2).'</td>
                    <td align="center">'.$row["imp_bill"].'</td>
                    <td align="center">'.$row["company"].'</td>
                    <td align="center">'.$row["emp_name"].'</td>
                    <td align="center">'.$row["imp_date"].'</td>
                    <td align="center">'.$row["note"].'</td>
                </tr>  
            ';
          
        }
        $sql2 = "select sum(qty*price) as amount from imports where imp_date between '$date1' and '$date2';";
        $result2 = mysqli_query($link,$sql2);
        $row2 = mysqli_fetch_array($result2,MYSQLI_ASSOC);
        $output .='
        <tr class="fontblack18">
            <td colspan="7" align="right"><h3><b>ມູນຄ່າທັງໝົດ : </b></h3></td>
            <td colspan="4" align="right"><h3><b>'.number_format($row2["amount"],2).' ກີບ</h3> </b></td>
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
                        ລາຍງານລາຍຈ່າຍ<br>
                    </u>
                </h2>
            </div>
            <table width="100%" border="1" cellspacing="0" cellpadding="3" style="font-size: 8px;">
                <tr align="center" style="background-color: #dbdbd8">
                    <th style="width: 25px;">#</th>
                    <th style="width: 120px;" scope="col">ສິນຄ້າ</th>
                    <th style="width: 150px;" scope="col">ຊື່ສິນຄ້າ</th>
                    <th style="width: 80px;" scope="col">ຈຳນວນ</th>
                    <th style="width: 80px;" scope="col">ລາຄາ</th>
                    <th style="width: 100px;" scope="col">ລວມ</th>
                    <th style="width: 80px;" scope="col">ເລກທີບິນນຳເຂົ້າ</th>
                    <th style="width: 120px;" scope="col">ຜູ້ສະໜອງ</th>
                    <th style="width: 120px;" scope="col">ຜູ້ນຳເຂົ້າ</th>
                    <th style="width: 60px;" scope="col">ວັນທີ</th>
                    <th style="width: 80px;" scope="col">ໝາຍເຫດ</th>
                </tr>
                '.ShowData().'
                </table>
            ';
$mpdf = new \Mpdf\Mpdf([
    'format'            => 'A4-L',
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