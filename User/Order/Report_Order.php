
<?php
require_once __DIR__ . '../../../vendor/autoload.php';

function ShowData(){

    require '../../ConnectDB/connectDB.php';
    date_default_timezone_set("Asia/Bangkok");
    $datenow = time();
    $Date = date("Y-m-d",$datenow);
    $order_id = $_POST['order_id'];
    $rate = $_POST['rate'];
    if(isset($_POST['btn'])){
        $sql = "select pro_name,unit_name,cated_name,brand_name,d.qty,d.price,d.qty*d.price as total from orderdetail d left join orders o on d.order_id=o.order_id left join product p on d.pro_id=p.pro_id left join categorydetail l on p.cated_id=l.cated_id left join brand b on p.brand_id=b.brand_id left join unit u on p.unit_id=u.unit_id where d.order_id='$order_id' and o.status='ອະນຸມັດ';";
        $result = mysqli_query($link,$sql);
        $Bill = 0;
        while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
            $Bill = $Bill + 1 ;
            $output .='
                <tr align="center">
                    <td align="center">'.$Bill.'</td>
                    <td align="left">'.$row["cated_name"].' '.$row["brand_name"].' '.$row["pro_name"].'</td>
                    <td align="center">'.$row["qty"].'</td>
                    <td align="center">'.number_format($row["price"],2).' '.$rate.'</td>
                    <td align="center">'.number_format($row["total"],2).' '.$rate.'</td>
                </tr>
            
            ';
          
        }
        $sqlAmount = "select sum(qty*price) as amount from orderdetail d left join orders o on d.order_id=o.order_id where d.order_id='$order_id' and o.status='ອະນຸມັດ';";
        $result7 = mysqli_query($link, $sqlAmount);
        $rowAmount = mysqli_fetch_array($result7, MYSQLI_ASSOC);
        $output .='
        <tr class="fontblack18">
            <td colspan="3" align="right"><h3><b>ມູນຄ່າທັງໝົດ: </b></h3></td>
            <td colspan="2" align="right"><h3><b>'.number_format($rowAmount["amount"],2).'  '.$rate.'</h3> </b></td>
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
$emp_name = $_POST['emp_name'];
$emp_surname = $_POST['emp_surname'];
$emp_email = $_POST['emp_email'];
$emp_tel = $_POST['emp_tel'];
$company = $_POST['company'];
$sup_tel = $_POST['sup_tel'];
$sup_fax = $_['sup_fax'];
$sup_email = $_POST['sup_email'];
$sup_address = $_POST['sup_address'];
$order_id2 = $_POST['order_id'];
$content = '
        <div align="left" >
            <div style="float: left; width: 55%; ">
                <img src="../../image/'.$img_path.'" width="150px">
            </div>
        </div>
        <div style="float: left; width: 65%; ">
            <p>
                <h4 style="color: red;">'.$name.'</h4>
                <b style="font-size: 10px;">
                   '.$address.'
                </b>
            </P>
        </div>
        <div style="float: left;text-align: center;">
            <h3>
                <br><br>
                ໃບສັ່ງຊື້ສິນຄ້າ/Purchase Order<br>
            </h3>
        </div>
       <table width="100%" border="1" cellspacing="0" cellpadding="3" style="font-size: 8px;">
            <tr>
                <td style="width: 65%;">
                    <b>
                    ຜູ້ສະໜອງ: '.$company.'
                    </b>
                    <p>
                        <b>Address: </b>'.$sup_address.'<br>
                        <b>Email: </b>'.$sup_email.' <b>Phone: </b>'.$sup_tel.' <b>Fax: </b>'.$sup_fax.'

                    </p>
                </td>
                <td style="width: 35%;">
                    <p>
                        <b>ເລກທີບິນ: </b>'.$order_id2.'<br>
                        <b>ວັນທີສັ່ງຊື້: </b>'.$Date.'<br>
                        <b>ຜູ້ສັ່ງຊື້: </b>'.$emp_name.' | '.$emp_tel.' <br>
                        <b>Email: </b> '.$emp_email.'
                    </p>
                </td>
            </tr>
       </table><br>
            <table width="100%" border="1" cellspacing="0" cellpadding="3" style="font-size: 8px;">
                <tr align="center" style="background-color: #dbdbd8">
                    <th style="width: 25px;">#</th>
                    <th style="width: 150px;">ສິນຄ້າ</th>
                    <th style="width: 90px;">ຈຳນວນ</th>
                    <th style="width: 120px;">ລາຄາ</th>
                    <th style="width: 120px;">ລວມ</th>
                </tr>
                '.ShowData().'
                </table>
            ';
$content .= '<br><br>
            <table width="100%" border="1" cellspacing="0" cellpadding="3" style="font-size: 8px;">
                <tr>
                    <td>
<pre>
   Director   
   
   




   



   Authorized Person  _______________________

                     (                         )    
                     

                     Date _____________________


</pre>
                    </td>
                    <td>
<pre>
    Purchaser







    Authorized Person  _______________________

                     (   '.$emp_name.' '.$emp_surname.'   )    
                               
                     

                     
                    Date _____________________


</pre>
                    </td>
                </tr>
            </table><br>
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