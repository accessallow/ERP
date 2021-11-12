<?php 
if(isset($category)){
    
$category = $category[0];
?>
<form action="<?php echo URL_X.'Versions/delete';?>" method="POST">
    <input type="hidden" name="id" value="<?php echo $category->id;?>">
<p>Are you sure want to delete version <strong><?php echo $category->product_category_name;?></strong>?</p>
<p>
    <input accesskey="x" type="submit" class="btn btn-danger" value="Delete"/>
    <a accesskey="c" href="<?php echo URL_X.'Versions/';?>" class="btn btn-primary">Cancel</a>
</p>
</form>

<?php 
}
?>