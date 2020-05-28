
<?php
require_once __DIR__ . '../../../vendor/autoload.php';

function ShowData(){

    require '../../ConnectDB/connectDB.php';
    date_default_timezone_set("Asia/Bangkok");
    $datenow = time();
    $Date = date("Y-m-d",$datenow);
    if(isset($_POST['btnAll'])){
        $sql = "select d.sell_id,pro_name,d.qty,d.price,d.qty*d.price as total,p.img_path,sell_date,status_cash,sell_type,unit_name,brand_name,cated_name,emp_name,cus_name from selldetail d left join sell s on d.sell_id=s.sell_id left join product p on d.pro_id=p.pro_id left join categorydetail i on p.cated_id=i.cated_id left join brand b on p.brand_id=b.brand_id left join unit u on p.unit_id=u.unit_id left join employees y on s.emp_id=y.emp_id left join customers t on s.cus_id=t.cus_id;";
        $result = mysqli_query($link,$sql);
        $Bill = 0;
        while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
            $Bill = $Bill + 1 ;
            $output .='
                <tr align="center">
                    <td align="center">'.$Bill.'</td>
                    <td align="center"><img src="../../image/'.$row['img_path'].'" style="width: 100px;heigt: 100px;"></td>
                    <td align="center">'.$row["cated_name"].' '.$row["brand_name"].' '.$row["pro_name"].'</td>
                    <td align="center">'.$row["qty"].' '.$row["unit_name"].'</td>
                    <td align="center">'.number_format($row["price"],2).'</td>
                    <td align="center">'.number_format($row["total"],2).'</td>
                    <td align="center">'.$row["sell_date"].'</td>
                    <td align="center">'.$row["sell_id"].'</td>
                    <td align="center">'.$row["sell_type"].'</td>
                    <td align="center">'.$row["cus_name"].'</td>
                    <td align="center">'.$row["emp_name"].'</td>
                </tr>  
            ';
          
        }
        $sql2 = "select sum(d.qty*d.price) as amount from selldetail d left join sell s on d.sell_id=s.sell_id left join product p on d.pro_id=p.pro_id left join categorydetail i on p.cated_id=i.cated_id left join brand b on p.brand_id=b.brand_id left join unit u on p.unit_id=u.unit_id left join employees y on s.emp_id=y.emp_id left join customers t on s.cus_id=t.cus_id;";
        $result2 = mysqli_query($link,$sql2);
        $row2 = mysqli_fetch_array($result2, MYSQLI_ASSOC);
        $sql3 = "select sum(cupon_price) as cupon_price,sum(cus_discount) as cus_discount,sum(discount) as discount from sell;";
        $result3 = mysqli_query($link,$sql3);
        $row3 = mysqli_fetch_array($result3, MYSQLI_ASSOC);
        $amount = $row2['amount'] - ($row3['cupon_price'] + $row3['cus_discount'] + $row3['discount']);
        $newamount = $amount;
        $output .='
        <tr class="fontblack18">
            <td colspan="7" align="right"><h3><b>ມູນຄ່າທັງໝົດ : </b></h3></td>
            <td colspan="4" align="right"><h3><b>'.number_format($row2["amount"],2).' ກີບ</h3> </b></td>
        </tr>  
        <tr class="fontblack18">
            <td colspan="7" align="right"><h3><b>ຄູປ໋ອງສ່ວນລົດ : </b></h3></td>
            <td colspan="4" align="right"><h3><b>'.number_format($row3["cupon_price"],2).' ກີບ</h3> </b></td>
        </tr>  
        <tr class="fontblack18">
            <td colspan="7" align="right"><h3><b>ສ່ວນລົດລູກຄ້າສະມາຊິກ : </b></h3></td>
            <td colspan="4" align="right"><h3><b>'.number_format($row3["cus_discount"],2).' ກີບ</h3> </b></td>
        </tr>   
        <tr class="fontblack18">
            <td colspan="7" align="right"><h3><b>ສ່ວນລົດພິເສດ : </b></h3></td>
            <td colspan="4" align="right"><h3><b>'.number_format($row3["discount"],2).' ກີບ</h3> </b></td>
        </tr>   
        <tr class="fontblack18">
            <td colspan="7" align="right"><h3><b>ລາຍຮັບຕົວຈິງ : </b></h3></td>
            <td colspan="4" align="right"><h3><b>'.number_format($newamount,2).' ກີບ</h3> </b></td>
        </tr>    

                ';
        return $output;
    }
    if(isset($_POST['btn'])){
        $date1 = $_POST['date1'];
        $date2 = $_POST['date2'];
        $sql = "select d.sell_id,pro_name,d.qty,d.price,d.qty*d.price as total,p.img_path,sell_date,status_cash,sell_type,unit_name,brand_name,cated_name,emp_name,cus_name from selldetail d left join sell s on d.sell_id=s.sell_id left join product p on d.pro_id=p.pro_id left join categorydetail i on p.cated_id=i.cated_id left join brand b on p.brand_id=b.brand_id left join unit u on p.unit_id=u.unit_id left join employees y on s.emp_id=y.emp_id left join customers t on s.cus_id=t.cus_id where sell_date between '$date1' and '$date2';";
        $result = mysqli_query($link,$sql);
        $Bill = 0;
        while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
            $Bill = $Bill + 1 ;
            $output .='
                <tr align="center">
                    <td align="center">'.$Bill.'</td>
                    <td align="center"><img src="../../image/'.$row['img_path'].'" style="width: 100px;heigt: 100px;"></td>
                    <td align="center">'.$row["cated_name"].' '.$row["brand_name"].' '.$row["pro_name"].'</td>
                    <td align="center">'.$row["qty"].' '.$row["unit_name"].'</td>
                    <td align="center">'.number_format($row["price"],2).'</td>
                    <td align="center">'.number_format($row["total"],2).'</td>
                    <td align="center">'.$row["sell_date"].'</td>
                    <td align="center">'.$row["sell_id"].'</td>
                    <td align="center">'.$row["sell_type"].'</td>
                    <td align="center">'.$row["cus_name"].'</td>
                    <td align="center">'.$row["emp_name"].'</td>
                </tr>  
            ';
          
        }
        $sql2 = "select sum(d.qty*d.price) as amount from selldetail d left join sell s on d.sell_id=s.sell_id left join product p on d.pro_id=p.pro_id left join categorydetail i on p.cated_id=i.cated_id left join brand b on p.brand_id=b.brand_id left join unit u on p.unit_id=u.unit_id left join employees y on s.emp_id=y.emp_id left join customers t on s.cus_id=t.cus_id where sell_date between '$date1' and '$date2';";
        $result2 = mysqli_query($link,$sql2);
        $row2 = mysqli_fetch_array($result2, MYSQLI_ASSOC);
        $sql3 = "select sum(cupon_price) as cupon_price,sum(cus_discount) as cus_discount,sum(discount) as discount from sell where sell_date between '$date1' and '$date2';";
        $result3 = mysqli_query($link,$sql3);
        $row3 = mysqli_fetch_array($result3, MYSQLI_ASSOC);
        $amount = $row2['amount'] - ($row3['cupon_price'] + $row3['cus_discount'] + $row3['discount']);
        $newamount = $amount;
        $output .='
        <tr class="fontblack18">
            <td colspan="7" align="right"><h3><b>ມູນຄ່າທັງໝົດ : </b></h3></td>
            <td colspan="4" align="right"><h3><b>'.number_format($row2["amount"],2).' ກີບ</h3> </b></td>
        </tr>  
        <tr class="fontblack18">
            <td colspan="7" align="right"><h3><b>ຄູປ໋ອງສ່ວນລົດ : </b></h3></td>
            <td colspan="4" align="right"><h3><b>'.number_format($row3["cupon_price"],2).' ກີບ</h3> </b></td>
        </tr>   
        <tr class="fontblack18">
            <td colspan="7" align="right"><h3><b>ສ່ວນລົດລູກຄ້າສະມາຊິກ : </b></h3></td>
            <td colspan="4" align="right"><h3><b>'.number_format($row3["cus_discount"],2).' ກີບ</h3> </b></td>
        </tr>   
        <tr class="fontblack18">
            <td colspan="7" align="right"><h3><b>ສ່ວນລົດພິເສດ : </b></h3></td>
            <td colspan="4" align="right"><h3><b>'.number_format($row3["discount"],2).' ກີບ</h3> </b></td>
        </tr>   
        <tr class="fontblack18">
            <td colspan="7" align="right"><h3><b>ລາຍຮັບຕົວຈິງ : </b></h3></td>
            <td colspan="4" align="right"><h3><b>'.number_format($newamount,2).' ກີບ</h3> </b></td>
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
                        ລາຍງານລາຍຮັບ<br>
                    </u>
                </h2>
            </div>
            <table width="100%" border="1" cellspacing="0" cellpadding="3" style="font-size: 8px;">
                <tr align="center" style="background-color: #dbdbd8">
                    <th style="width: 25px;">#</th>
                    <th style="width: 110px;" scope="col">ສິນຄ້າ</th>
                    <th style="width: 150px;" scope="col">ຊື່ສິນຄ້າ</th>
                    <th style="width: 80px;" scope="col">ຈຳນວນ</th>
                    <th style="width: 120px;" scope="col">ລາຄາ</th>
                    <th style="width: 120px;" scope="col">ລວມ</th>
                    <th style="width: 80px;" scope="col">ວັນທີ</th>
                    <th style="width: 60px;" scope="col">ເລກທີບິນ</th>
                    <th style="width: 80px;" scope="col">ປະເພດການຂາຍ</th>
                    <th style="width: 100px;" scope="col">ລູກຄ້າ</th>
                    <th style="width: 100px;" scope="col">ຜູ້ຂາຍ</th>
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