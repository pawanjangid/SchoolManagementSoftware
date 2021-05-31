<style type="text/css">
	tr {
		margin: 5px;
	}
</style>


<div class="row">
	<div class="col-md-12 col-sm-12 clearfix" style="text-align:center;padding-bottom: 20px;">
		<h2 style="font-weight:200; margin:0px;text-transform: uppercase;color: #0000ff;"><?php
if ($this->session->userdata('login_type') == 'school') {
	echo $this->db->get_where('school', array('school_id' => $this->session->userdata('school_id')))->row()->school_name;
}else {echo $system_name;}
?></h2>
    </div>
	<!-- Raw Links -->
	<div class="col-md-12 col-sm-12 clearfix " style="box-shadow: 0px 0px 10px #bababa;border-radius: 3px;">
		<?php if ($this->session->userdata('login_type') == 'school'):?>
        <ul class="list-inline links-list pull-left">
        <!-- Language Selector -->
        	<div id="session_static">
        					
	           <li>
	           		<h4>
	           			<a href="#" style="color: #696969;"
	           				 
	           				onclick="get_session_changer()">
	           				<?php echo get_phrase('running_session');?> : <?php echo $this->db->get_where('school' , array('school_id' =>$this->session->userdata('school_id')))->row()->running_year;?>
	           			</a>
	           		</h4>
	           </li>
           </div>
        </ul>
        <?php endif;?>
        
		<ul class="list-inline links-list pull-right">

		<li class="dropdown language-selector" style="margin-top: 3px;">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-close-others="true">
                        	<i class="far fa-bell" style="font-size: 16px;font-weight: 600;"></i>
                    </a>
				<ul class="dropdown-menu pull-left">
					<li>
						<a href="#">
							<span>Message #1</span>
						</a>
					</li>
					<li>
						<a href="#">
							<span>Message #2</span>
						</a>
					</li>
				</ul>
				
			</li>







		<li class="dropdown language-selector" style="margin-top: 3px;">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-close-others="true">
                        	<i class="fas fa-user"></i> <?php echo $this->session->userdata('login_type');?>
                    </a>

				<?php if ($account_type != 'parent'):?>
				<ul class="dropdown-menu <?php if ($text_align == 'right-to-left') echo 'pull-right'; else echo 'pull-left';?>">
					<li>
						<a href="<?php echo base_url();?><?php echo $account_type;?>/manage_profile">
                        	<i class="fas fa-user-edit"></i>
							<span><?php echo get_phrase('edit_profile');?></span>
						</a>
					</li>
					<li>
						<a href="<?php echo base_url();?><?php echo $account_type;?>/manage_profile">
                        	<i class="fas fa-key"></i>
							<span><?php echo get_phrase('change_password');?></span>
						</a>
					</li>
				</ul>
				<?php endif;?>
				<?php if ($account_type == 'parent'):?>
				<ul class="dropdown-menu <?php if ($text_align == 'right-to-left') echo 'pull-right'; else echo 'pull-left';?>">
					<li>
						<a href="<?php echo base_url();?>parents/manage_profile">
                        	<i class="fas fa-user-edit"></i>
							<span><?php echo get_phrase('edit_profile');?></span>
						</a>
					</li>
					<li>
						<a href="<?php echo base_url();?>parents/manage_profile">
                        	<i class="fas fa-key"></i>
							<span><?php echo get_phrase('change_password');?></span>
						</a>
					</li>
				</ul>
				<?php endif;?>
			</li>
			
			<li>
				<a href="<?php echo base_url();?>login/logout">
					Log Out <i class="fas fa-sign-out-alt"></i>
				</a>
			</li>
		</ul>
	</div>
	
</div>

<hr style="margin-top:0px;" />

<script type="text/javascript">
	function get_session_changer()
	{
		$.ajax({
            url: '<?php echo base_url();?>school/get_session_changer/',
            success: function(response)
            {
                jQuery('#session_static').html(response);
            }
        });
	}
</script>