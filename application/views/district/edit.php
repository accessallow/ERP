<?php
if (!isset($district)) {

    $district->id = "";
    $district->district_name = "";
} else {
    $district = $district[0];
}
?>


<form class="form-horizontal" role="form"   
      data-parsley-validate 
      action="<?php echo URL_X . 'District/edit/'; ?>" method="POST">

    <input type="hidden" name="id" value="<?php echo $district->id; ?>" placeholder=""/> 


    <div class="form-group">
        <label for="" class="col-sm-2 control-label">State</label>
        <div class="col-sm-4">

            <select name="state_id"
                    accesskey="n"
                    class="form-control" required>
                <option value="">Choose a state</option>
                <?php foreach ($states as $d) { ?>
                    <option value="<?php echo $d->id ?>"
                    <?php if ($d->id == $district->state_id) echo "selected"; ?>    
                            >
                        <?php echo $d->state_name; ?></option>
                <?php } ?>
            </select>
        </div>
    </div>



    <div class="form-group">
        <label for="" class="col-sm-2 control-label">District Name</label>
        <div class="col-sm-4">
            <input type="text" 
                   autofocus="autofocus"
                   class="form-control" required name="district_name" value="<?php echo $district->district_name; ?>" placeholder=""/> 
        </div>
    </div>


    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <input accesskey="s" type="submit" class="btn btn-success" value="Save"/>
            <input type="reset" class="btn" value="Clear"/>
            <a  accesskey="c" href="<?php echo site_url('District'); ?>" class="btn btn-primary">Back</a>
        </div>
    </div>
</form>