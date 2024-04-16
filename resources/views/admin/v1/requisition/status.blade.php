<?php 
if($item->status=='pending')
{
    ?>
    <span class="btn btn-danger btn-sm">{{ucfirst($item->status)}}</span>
    <?php 
}
else if($item->status=='approved')
{
    ?>
    <span class="btn btn-success btn-sm">{{ucfirst($item->status)}}</span>
    <?php 
}
else if($item->status=='PO Generated')
{
    ?> 
    <span class="btn btn-secondary btn-sm">{{ucfirst($item->status)}}</span>
    <?php 
}
else if($item->status=='GRN Generated')
{
    ?>
    <span class="btn btn-dark btn-sm">{{ucfirst($item->status)}}</span>
    <?php 
}
else{
?>
<span class="btn btn-info btn-sm">{{ucfirst($item->status)}}</span>
<?php } ?>
