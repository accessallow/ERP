<?php 
if(isset($district)){
    
$district = $district[0];
?>
<form action="<?php echo URL_X.'District/delete';?>" method="POST">
    <input type="hidden" name="id" value="<?php echo $district->id;?>">
<p>Are you sure want to delete district <strong><?php echo $district->district_name;?></strong>?</p>
<p>
    <input accesskey="x" type="submit" class="btn btn-danger" value="Delete"/>
    <a accesskey="c" href="<?php echo URL_X.'District/';?>" class="btn btn-primary">Cancel</a>
</p>
</form>

<?php 
}
?>