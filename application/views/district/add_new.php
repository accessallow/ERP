<h3>Add new district</h3>

<?php if($this->session->flashdata('message')){?>
<div class="alert alert-success" role="alert">
    <span class="glyphicon glyphicon-ok"></span>
    <strong><?php echo $this->session->flashdata('message');?></strong>
</div>
<?php } ?>

<hr/>
<form class="form-horizontal"   data-parsley-validate role="form" action="<?php echo site_url('District/add_new'); ?>" method="POST">
    
    <div class="form-group" >
        <label for="" class="col-sm-2 control-label">State</label>
        <div class="col-sm-4">

            <select name="state_id" 
                    class="form-control"
                    accesskey="b"
                    required>
                <option value="" selected>Choose state</option>
                <?php foreach ($states as $d) { ?>
                    <option value="<?php echo $d->id ?>"><?php echo $d->state_name; ?></option>
                <?php } ?>
            </select>
        </div>
    </div>
    
    <div class="form-group">
        <label for="" class="col-sm-2 control-label">District Name</label>
        <div class="col-sm-4">
            <input type="text"
                   autofocus="autofocus"
                   class="form-control" required name="district_name" placeholder=""/> 
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