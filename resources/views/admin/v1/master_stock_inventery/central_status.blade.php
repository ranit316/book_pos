

<!--- best seller start --->

<?php 

$all_sale_ids = [];
$temp_1 = \App\Models\Sale::where('store_id',loginStore()->id)->where('status','paid')->get();
foreach($temp_1 as $temp_1_val)
{
    $all_sale_ids[]=$temp_1_val->id;
}
//print_r($all_sale_ids);

$total_sale = \App\Models\SaleDetails::whereIn('sale_id',$all_sale_ids)->where('product_id',$item->id)->sum('qty');
//echo $total_sale;
if($total_sale > 1000)
{
?>
<span class="badge bg-purple">Best Seller</span>
<?php 
}
?>
<!--- best seller end --->

<?php 
$avl_stk = \App\Models\MasterStockInventery::where('product_id', $item->id)->where('store_id', loginStore()->id)->sum('qty');
//echo $avl_stk;
$text='';
$class='';
$need=false;
if($avl_stk == 0)
{
    $text='Out of Stock';
    $class='danger';
    $need=true;
}
else if($avl_stk < 50)
{
    $text='Very Low';
    $class='danger';
    $need=true;
}
else if($avl_stk <= 100)
{
    $text='Med Low';
    $class='info';
    $need=true;
}else if ($avl_stk > 100){
    $text='High';
    $class='success';
    $need=true;
}
if($need)
{
    echo '<span class="badge bg-'.$class.'">'.$text.'</span>';
}
?>