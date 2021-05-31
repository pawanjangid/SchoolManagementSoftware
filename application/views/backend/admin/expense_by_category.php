<hr />
        <div class="row" style="height: 200px;">
            <!-- CALENDAR-->
            <div class="col-md-12 col-xs-12">    
                <div class="panel panel-primary " data-collapsed="0" style="height: 100px;">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <i class="entypo-info"></i>
                            <?php echo get_phrase('Get Info');?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo get_phrase('Select Expence Category');?></label>
                        <div class="col-sm-3">
                            <select name="expense_category_id" class="form-control selectboxit" required onchange="get_by_category(this.value);">
                                <option value=""><?php echo get_phrase('select_expense_category');?></option>
                                <?php 
                                    $categories = $this->db->get('expense_category')->result_array();
                                    foreach ($categories as $row):
                                ?>
                                <option value="<?php echo $row['expense_category_id'];?>"><?php echo $row['name'];?></option>
                            <?php endforeach;?>
                            </select>
                        </div>
                        
                    </div>
                </div>
    </div>
</div>
<div class="row" style="margin-top: 20px;">
    <div id="subject_holder" name="subject_holder">
        
    </div>
</div>


 
<script type="text/javascript">
    
    function get_by_category(cat) {
        //var cat = document.getElementById('expense_category_id').value;
    $.ajax({
            url: '<?php echo base_url();?>index.php?admin/get_by_category/' + cat,
            success: function(response)
            {
                jQuery('#subject_holder').html(response);
            }
        });
    }
</script>
  
