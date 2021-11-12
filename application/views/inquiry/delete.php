

<form action="<?php echo URL_X.'Inquiry/delete/'.$inquiry->id;?>" method="POST">
    <input type="hidden" name="inquiry_id" value="<?php echo $inquiry->id;?>">
<p>Are you sure want to delete inquiry of <strong><?php echo $inquiry->customer_name;?></strong>?</p>
<p>
    <input type="submit" 
           accesskey="x"
           class="btn btn-danger" value="Delete - x"/>
    <a 
        accesskey="c"
        href="<?php echo URL_X.'Inquiry/dashboard';?>" class="btn btn-primary">Cancel- c</a>
</p>
</form>

