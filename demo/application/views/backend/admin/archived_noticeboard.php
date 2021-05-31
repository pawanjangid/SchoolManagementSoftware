 
<table cellpadding="0" cellspacing="0" border="0" class="table table-bordered datatable" id="table_export">
    <thead>
        <tr>
            <th><div>#</div></th>
<th><div><?php echo get_phrase('title'); ?></div></th>
<th><div><?php echo get_phrase('notice'); ?></div></th>
<th><div><?php echo get_phrase('date'); ?></div></th>
<th><div><?php echo get_phrase('options'); ?></div></th>
</tr>
</thead>
<tbody>
    <?php
    $count = 1;
    $notices = $this->db->get_where('noticeboard', array('status' => 0))->result_array();
    foreach ($notices as $row):
        ?>
        <tr>
            <td><?php echo $count++; ?></td>
            <td><?php echo $row['notice_title']; ?></td>
            <td class="span5"><?php echo $row['notice']; ?></td>
            <td><?php echo date('d M,Y', $row['create_timestamp']); ?></td>
            <td>
                <div class="btn-group">
                    <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
                        Action <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu dropdown-default pull-right" role="menu">
                        <li>
                            <a href="#" onclick="showAjaxModal('<?php echo base_url(); ?>index.php?modal/popup/modal_view_notice/<?php echo $row['notice_id']; ?>');">
                                <i class="entypo-credit-card"></i>
                                <?php echo get_phrase('print/view_notice'); ?>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo base_url() ?>index.php?admin/noticeboard/remove_from_archived/<?php echo $row['notice_id'] ?>" >
                                <i class="entypo-home"></i>
                                <?php echo get_phrase('remove_from_archive'); ?>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <!-- EDITING LINK -->
                        <li>
                            <a href="#" onclick="showAjaxModal('<?php echo base_url(); ?>index.php?modal/popup/modal_edit_notice/<?php echo $row['notice_id']; ?>');">
                                <i class="entypo-pencil"></i>
                                <?php echo get_phrase('edit'); ?>
                            </a>
                        </li>
                        <li class="divider"></li>

                        <!-- DELETION LINK -->
                        <li>
                            <a href="#" onclick="confirm_modal('<?php echo base_url(); ?>index.php?admin/noticeboard/delete/<?php echo $row['notice_id']; ?>');">
                                <i class="entypo-trash"></i>
                                <?php echo get_phrase('delete'); ?>
                            </a>
                        </li>
                    </ul>
                </div>
            </td>
        </tr>
    <?php endforeach; ?>
</tbody>
</table>
