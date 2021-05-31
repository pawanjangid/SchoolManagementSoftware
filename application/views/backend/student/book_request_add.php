<div class="row">
    <div class="col-md-12">
        <div class="panel panel-primary" data-collapsed="0">
            <div class="panel-heading">
                <div class="panel-title" >
                    <i class="entypo-plus-circled"></i>
                    <?php echo get_phrase('request_new_book');?>
                </div>
            </div>

            <div class="panel-body">
                
                <?php echo form_open(base_url() . 'index.php?student/book_request/create' , array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>
    
                    <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo get_phrase('book'); ?></label>
                        <div class="col-sm-6">
                            <select name="book_id" class="form-control selectboxit" required>
                                <option value=""><?php echo get_phrase('select_a_book'); ?></option>
                                <?php 
                                $books = $this->db->get('book')->result_array();
                                foreach ($books as $row) { ?>
                                    <option value="<?php echo $row['book_id']; ?>">
                                        <?php echo $row['name'];?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo get_phrase('issue_starting_date');?></label>
                        <div class="col-sm-6">
                            <input type="text" class="datepicker form-control" name="issue_start_date"
                                data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" value="" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo get_phrase('issue_ending_date');?></label>
                        <div class="col-sm-6">
                            <input type="text" class="datepicker form-control" name="issue_end_date"
                                data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" value="" />
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-5">
                            <button type="submit" class="btn btn-info"><?php echo get_phrase('submit');?></button>
                        </div>
                    </div>

                <?php echo form_close();?>

            </div>
        </div>
    </div>
</div>
















