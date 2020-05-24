<?php
   session_start();
require_once __DIR__ . '../../../vendor/autoload.php';
require '../../ConnectDB/connectDB.php';
$emp_id = $_SESSION['emp_id'];
$emp_name = $_SESSION['emp_name'];
$sqlshop = "select * from shop";
$resultshop = mysqli_query($link,$sqlshop);
$rowshop = mysqli_fetch_array($resultshop,MYSQLI_ASSOC);
$sqlsell = "select max(sell_id) as sell_id,max(sell_date) as sell_date,max(sell_time) as sell_time from sell where emp_id='$emp_id';";
$resultsell = mysqli_query($link,$sqlsell);
$rowsell = mysqli_fetch_array($resultsell,MYSQLI_ASSOC);
$name = $rowshop['name'];
$address = $rowshop['address'];
$tel = $rowshop['tel'];
$img_path = $rowshop['img_path'];
$sell_id = $rowsell['sell_id'];
$sell_date = $rowsell['sell_date'];
$sell_time = $rowsell['sell_time'];
function ShowData(){
        require '../../ConnectDB/connectDB.php';
        $emp_id = $_SESSION['emp_id'];
        $sqlsell = "select max(sell_id) as sell_id from sell where emp_id='$emp_id';";
        $resultsell = mysqli_query($link,$sqlsell);
        $rowsell = mysqli_fetch_array($resultsell,MYSQLI_ASSOC);
        $sell_id = $rowsell['sell_id'];
        $sql = "select d.pro_id,pro_name,cated_name,brand_name,unit_name,p.img_path,d.qty,d.price,p.price as pro_price,d.promotion,(d.promotion/p.price) * 100 as perzen,d.qty*d.price as total,p.qty as pro_qty from selldetail d left join product p on d.pro_id=p.pro_id left join categorydetail i  on p.cated_id=i.cated_id left join brand b on p.brand_id=b.brand_id left join unit u on p.unit_id=u.unit_id where d.sell_id='$sell_id';";
        $result = mysqli_query($link,$sql);
        $Bill = 0;
        while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
            $Bill = $Bill + 1 ;
            $output .='
                <tr align="left">
                    <td align="left">'.$Bill.'</td>
                    <td align="left">'.$row["cated_name"].' '.$row["brand_name"].' '.$row["pro_name"].' </td>
                    <td align="left">'.$row["qty"].'x '.number_format($row["price"]).'</td>
                    <td align="left">'.number_format($row["total"]).'</td>
                </tr>
            ';
        }
        return $output;
}   
function ShowData2(){
        require '../../ConnectDB/connectDB.php';
        $emp_id = $_SESSION['emp_id'];
        $sqlsell = "select max(sell_id) as sell_id from sell where emp_id='$emp_id';";
        $resultsell = mysqli_query($link,$sqlsell);
        $rowsell = mysqli_fetch_array($resultsell,MYSQLI_ASSOC);
        $sell_id = $rowsell['sell_id'];
        $sqldis = "select discount from sell where emp_id='124' and sell_id='$sell_id';";
        $resultdis = mysqli_query($link,$sqldis);
        $rowdis = mysqli_fetch_array($resultdis,MYSQLI_ASSOC);
        $discount = $rowdis['discount'];
        $sqlsum = "select sum(qty*price) as amount from selldetail where sell_id='$sell_id';";
        $resultsum = mysqli_query($link,$sqlsum);
        $rowsum = mysqli_fetch_array($resultsum, MYSQLI_ASSOC);
        $sqlsum2 = "select sum(cupon_price) as cupon_price from sell where sell_id='$sell_id';";
        $resultsum2 = mysqli_query($link,$sqlsum2);
        $rowsum2 = mysqli_fetch_array($resultsum2, MYSQLI_ASSOC);
        $cupon_price = $rowsum2['cupon_price'];
        $amount = $rowsum['amount'] - ($cupon_price + $discount);
            $output .='
                <div align="right" style="font-size: 10px;">
                    <b style="font-size: 10px;">ຍອມລວມ (ລວມພາສີມູນຄ່າເພີ່ມ) </b><br>
                    <b align="right" style="font-size: 16px;">'.number_format($amount,2).' ກີບ</b><br>
                    <label style="font-size: 6px;">ຄູປ໋ອງສ່ວນລົດ: '.number_format($cupon_price,2).' ກີບ</label> <br>  
                    <label style="font-size: 6px;">ສ່ວນຫຼຸດພິເສດ: '.number_format($discount,2).' ກີບ</label>                   
                </div>
                
            ';
        return $output;
}   
$content = '
            <div align="center" >
                <a href="sale.php"><img src="../../image/'.$img_path.'" width="60px"></a>
            </div>
            <div align="center" style="font-size: 8px;text-align: center;">
                <p>
                   <b> ຮ້ານ '.$name.'</b><br>
                    '.$address.'<br>
                    ເບີໂທ: '.$tel.'
                </P>
            </div>
            <div style="width: 100%;font-size: 12px;">
                <div style="width: 50%;float: left;">
                    ພະນັກງານຂາຍ: '.$emp_name.'<br>
                    ວັນທີ: '.$sell_date.'<br>
                    ເວລາ: '.$sell_time.'
                </div>
                <div align="right" style="float: right;width: 45%;">
                    ເລກທີບິນ: '.$sell_id.'<br>
                    ລູກຄ້າທົ່ວໄປ
                </div>
            </div>
            <div style="text-align: center;font-size: 16px;">
                <b>ບິນຂາຍສິນຄ້າ</b>
            </div>
            <hr size="3" align="center" width="100%" /> 
            <table style="font-size: 12px;">
                <tr>
                    <th align="left" style="width: 30px;">#</th>
                    <th align="left" style="width: 250px;">ສີນຄ້າ</th>
                    <th align="left" style="width: 140px;">ຈຳນວນ</th>
                    <th align="left" style="width: 160px;">ລວມ</th>
                </tr>
                '.ShowData().'
                </table>
                <hr size="3" align="center" width="100%" />  
                '.ShowData2().' 

';
$mpdf = new \Mpdf\Mpdf([
    'format'        => 'A5',
    'mode'              => 'utf-8',      
    'tempDir'           => '/tmp',
    'default_font_size' => 8,
    'margin_left' => 3.5, 
    'margin_right' => 3.5, 
    'margin_top' => 3.5,
    'margin_bottom' => 0.5, 
    'margin_footer' => 0.5, 
	'default_font' => 'saysettha_ot'
]);
$mpdf->WriteHTML($content);
$mpdf->Output('ລາຍງານສິນຄ້າ.pdf','I');
?>