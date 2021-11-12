<?php 
if(isset($crop)){
    
$crop = $crop[0];
?>
<form action="<?php echo URL_X.'Disease/delete';?>" method="POST">
    <input type="hidden" name="id" value="<?php echo $crop->id;?>">
<p>Are you sure want to delete <strong><?php echo $crop->disease_name;?></strong>?</p>
<p>
    <input accesskey="x" type="submit" class="btn btn-danger" value="Delete"/>
    <a accesskey="c" href="<?php echo URL_X.'Disease/';?>" class="btn btn-primary">Cancel</a>
</p>
</form>

<?php 
}
?>