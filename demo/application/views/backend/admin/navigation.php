<div class="sidebar-menu">
    <header class="logo-env" >

        <!-- logo -->
        <div class="logo" style="">
            <a href="<?php echo base_url(); ?>">
                <img src="uploads/logo.png"  style="max-height:60px;"/>
            </a>
        </div>

        <!-- logo collapse icon -->
        <div class="sidebar-collapse" style="">
            <a href="#" class="sidebar-collapse-icon with-animation">

                <i class="entypo-menu"></i>
            </a>
        </div>

        <!-- open/close menu icon (do not remove if you want to enable menu on mobile devices) -->
        <div class="sidebar-mobile-menu visible-xs">
            <a href="#" class="with-animation">
                <i class="entypo-menu"></i>
            </a>
        </div>
    </header>

    <div style=""></div>	
    <ul id="main-menu" class="">
        <!-- add class "multiple-expanded" to allow multiple submenus to open -->
        <!-- class "auto-inherit-active-class" will automatically add "active" class for parent elements who are marked already with class "active" -->


        <!-- DASHBOARD -->
        <li class="<?php if ($page_name == 'dashboard') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>index.php?admin/dashboard">
                <i class="entypo-suitcase"></i>
                <span><?php echo get_phrase('dashboard'); ?></span>
            </a>
        </li>


                <li class="<?php
        if ($page_name == 'seller' ||
                $page_name == 'modal_seller_add')
            echo 'opened active';
        ?> ">
            <a href="#">
                <i class="entypo-flow-tree"></i>
                <span><?php echo get_phrase('Seller'); ?></span>
            </a>
            <ul>
                <li class="<?php if ($page_name == 'modal_seller_add') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>index.php?admin/seller_page">
                        <span><i class="entypo-box"></i> <?php echo get_phrase('Seller_Add'); ?></span>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'seller') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>index.php?admin/seller">
                        <span><i class="entypo-cc-share"></i> <?php echo get_phrase('Sellers'); ?></span>
                    </a>
                </li>
            </ul>
        </li>

        <li class="<?php if ($page_name == 'product' || $page_name == 'product_category') echo 'opened active'; ?> ">
            <a href="#">
                <i class="entypo-docs"></i>
                <span><?php echo get_phrase('Products'); ?></span>
            </a>
            <ul>
                <li class="<?php if ($page_name == 'product_add') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>index.php?admin/product_add">
                        <span><i class="entypo-cc-share"></i> <?php echo get_phrase('Add_New_Product'); ?></span>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'product_category') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>index.php?admin/product_category">
                        <span><i class="entypo-cc-share"></i> <?php echo get_phrase('Product_Category'); ?></span>
                    </a>
                </li>
                <?php
                $product_category = $this->db->get('Product_Category')->result_array();
                foreach ($product_category as $row):
                    ?>
                    <li class="<?php if ($page_name == 'product' && $product_category_id == $row['product_category_id']) echo 'active'; ?>">
                        <a href="<?php echo base_url(); ?>index.php?admin/products/<?php echo $row['product_category_id']; ?>">
                            <span><i class="entypo-dot"></i><?php echo get_phrase('Desc : '); ?> <?php echo $row['name']; ?></span>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </li>

                        <li class="<?php
        if ($page_name == 'school_add' ||
                $page_name == 'institute')
            echo 'opened active';
        ?> ">
            <a href="#">
                <i class="entypo-flow-tree"></i>
                <span><?php echo get_phrase('Institute'); ?></span>
            </a>
            <ul>
                <li class="<?php if ($page_name == 'school_add') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>index.php?admin/institute_add">
                        <span><i class="entypo-box"></i> <?php echo get_phrase('Add_New_School'); ?></span>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'institute') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>index.php?admin/institute">
                        <span><i class="entypo-cc-share"></i> <?php echo get_phrase('Schools'); ?></span>
                    </a>
                </li>
            </ul>
        </li>
<li class="<?php
        if ($page_name == 'store_add' ||
                $page_name == 'store')
            echo 'opened active';
        ?> ">
            <a href="#">
                <i class="entypo-flow-tree"></i>
                <span><?php echo get_phrase('Store'); ?></span>
            </a>
            <ul>
                <li class="<?php if ($page_name == 'store_add') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>index.php?admin/store_add">
                        <span><i class="entypo-box"></i> <?php echo get_phrase('Add_New_Store'); ?></span>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'store') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>index.php?admin/store">
                        <span><i class="entypo-cc-share"></i> <?php echo get_phrase('Stores'); ?></span>
                    </a>
                </li>
            </ul>
        </li>



        <li class="<?php if ($page_name == 'noticeboard') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>index.php?admin/noticeboard">
                <i class="entypo-doc-text-inv"></i>
                <span><?php echo get_phrase('notice'); ?></span>
            </a>
        </li>

        <!-- MESSAGE -->
        <li class="<?php if ($page_name == 'message') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>index.php?admin/message">
                <i class="entypo-mail"></i>
                <span><?php echo get_phrase('message'); ?></span>
            </a>
        </li>

        <!-- SETTINGS -->
        <li class="<?php
        if ($page_name == 'system_settings' ||
                $page_name == 'manage_language' ||
                    $page_name == 'sms_settings')
                        echo 'opened active';
        ?> ">
            <a href="#">
                <i class="entypo-lifebuoy"></i>
                <span><?php echo get_phrase('settings'); ?></span>
            </a>
            <ul>
                <li class="<?php if ($page_name == 'system_settings') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>index.php?admin/system_settings">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('general_settings'); ?></span>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'sms_settings') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>index.php?admin/upload_settings">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('Upload_settings'); ?></span>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'manage_language') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>index.php?admin/manage_language">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('language_settings'); ?></span>
                    </a>
                </li>
            </ul>
        </li>

        <li >
            <a href="<?php echo base_url(); ?>excel/">
                <i class="entypo-import"></i>
                <span>Load data</span>
            </a>
        </li>
        <!-- ACCOUNT -->
        <li class="<?php if ($page_name == 'manage_profile') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>index.php?admin/manage_profile">
                <i class="entypo-lock"></i>
                <span><?php echo get_phrase('account'); ?></span>
            </a>
        </li>

        <li >
            <a href="<?php echo base_url(); ?>index.php?admin/contact_us">
                <i class="entypo-mobile"></i>
                <span> Contact Us</span>
            </a>
        </li>

    </ul>

</div>