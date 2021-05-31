<hr />

<?php echo form_open(base_url() . 'index.php?school/attendance_report_selector/'); ?>
<div class="row">

    <?php
    $query = $this->db->get_where('class', array('school_id' =>$this->session->userdata('school_id')));
    if ($query->num_rows() > 0):
        $class = $query->result_array();
        
        ?>

        <div class="col-md-3">
            <div class="form-group">
                <label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('class'); ?></label>
                <select class="form-control selectboxit" name="class_id" onchange="select_section(this.value)">
                    <option value=""><?php echo get_phrase('select_class'); ?></option>
                    <?php foreach ($class as $row): ?>
                    <option value="<?php echo $row['class_id']; ?>" ><?php echo $row['name']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
    <?php endif; ?>


    <div id="section_holder">
        <div class="col-md-3">
            <div class="form-group">
                <label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('section'); ?></label>
                <select class="form-control selectboxit" name="section_id">
                    <option value=""><?php echo get_phrase('select_class_first') ?></option>

                </select>
            </div>
        </div>
    </div>
    <div class="col-md-3">
         <div class="form-group">
                <label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('section'); ?></label>
        <select name="month" class="form-control selectboxit" id="month" onchange="show_year()">
            <?php
            for ($i = 1; $i <= 12; $i++):
                if ($i == 1)
                    $m = 'january';
                else if ($i == 2)
                    $m = 'february';
                else if ($i == 3)
                    $m = 'march';
                else if ($i == 4)
                    $m = 'april';
                else if ($i == 5)
                    $m = 'may';
                else if ($i == 6)
                    $m = 'june';
                else if ($i == 7)
                    $m = 'july';
                else if ($i == 8)
                    $m = 'august';
                else if ($i == 9)
                    $m = 'september';
                else if ($i == 10)
                    $m = 'october';
                else if ($i == 11)
                    $m = 'november';
                else if ($i == 12)
                    $m = 'december';
                ?>
                <option value="<?php echo $i; ?>"
                      <?php if($month == $i) echo 'selected'; ?>  >
                            <?php echo $m; ?>
                </option>
                <?php
            endfor;
            ?>
        </select>
         </div>
    </div>
    
    <?php
            $year = explode('-', $running_year);
            ?>
            <div class="col-md-3">
            <div class="form-group">
                <label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('Year'); ?></label>
                <select class="form-control selectboxit" name="selectyear" onchange="select_section(this.value)">
                    <option value=""><?php echo get_phrase('select_year'); ?></option>
                    <?php foreach ($year as $row2): ?>
                        <option value="<?php echo $row2; ?>"<?php if ($row2 == $selectyear) echo 'selected'; ?> ><?php echo $row2; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
<input type="hidden" name="operation" value="selection">
	<div class="col-md-3" style="margin-top: 20px;">
		<button type="submit" class="btn btn-info"><?php echo get_phrase('show_report');?></button>
	</div>
</div>

<?php echo form_close(); ?>







<script type="text/javascript">
    function select_section(class_id) {

        $.ajax({
            url: '<?php echo base_url(); ?>index.php?school/get_section/' + class_id,
            success: function (response)
            {

                jQuery('#section_holder').html(response);
            }
        });
    }
</script>