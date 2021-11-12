<?php 
if(isset($category)){
    
$category = $category[0];
?>
<form action="<?php echo URL_X.'States/delete';?>" method="POST">
    <input type="hidden" name="id" value="<?php echo $category->id;?>">
<p>Are you sure want to delete state <strong><?php echo $category->state_name;?></strong>?</p>
<p>
    <input accesskey="x" type="submit" class="btn btn-danger" value="Delete"/>
    <a accesskey="c" href="<?php echo URL_X.'States/';?>" class="btn btn-primary">Cancel</a>
</p>
</form>

<?php 
}
?>