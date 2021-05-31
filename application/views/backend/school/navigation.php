<?php $school = $this->db->get_where('school', array('school_id' => $this->session->userdata('school_id')))->row_array(); ?>
<div class="sidebar-menu">
    <header class="logo-env" >

        <!-- logo -->
        <div class="logo" style="">
            <a href="<?php echo base_url(); ?>">
                <img src="<?php echo base_url().'uploads/schools_logo/'.$school['image']; ?>"  style="max-height:60px;"/>
            </a>
        </div>

        <!-- logo collapse icon -->
        <div class="sidebar-collapse" style="">
            <a href="#" class="sidebar-collapse-icon with-animation">

               <i class="fas fa-bars"></i>
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
            <a href="<?php echo base_url(); ?>school/dashboard">
                <i class="fas fa-tachometer-alt" style="font-size: 16px;padding: 3px;"></i>
                <span><?php echo get_phrase('dashboard'); ?></span>
            </a>
        </li>

        <li class="<?php if (($page_name == 'student') || ($page_name == 'student_add')) echo 'opened active'; ?> ">
            <a href="#">
                <i class="fas fa-book-reader" style="font-size: 16px;padding: 3px;"></i>
                <span><?php echo get_phrase('Student'); ?></span>
            </a>
            <ul>
                <li class="<?php if ($page_name == 'student_add') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>school/student_add">
                        <span><i class="fas fa-user-plus" style="font-size: 16px;padding: 3px;"></i> <?php echo get_phrase('Add_Student'); ?></span>
                    </a>
                </li>
                <?php
                $class = $this->db->get_where('class', array('school_id' => $this->session->userdata('school_id')))->result_array();
                foreach ($class as $row):
                    ?>
                    <li class="<?php if ($page_name == 'student' && $class_id == $row['class_id']) echo 'active'; ?>">
                        <a href="<?php echo base_url(); ?>school/student_information/<?php echo $row['class_id']; ?>">
                            <span><i class="entypo-dot"></i><?php echo get_phrase('Class : '); ?> <?php echo $row['name']; ?></span>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </li>

    

        

        <li class="<?php if ($page_name == 'teacher') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>school/teacher">
                <i class="fas fa-chalkboard-teacher" style="font-size: 16px;padding: 3px;"></i>
                <span><?php echo get_phrase('teacher'); ?></span>
            </a>
        </li>
        <!-- CLASS -->
        <li class="<?php
        if ($page_name == 'class' ||
                $page_name == 'section' ||
                    $page_name == 'academic_syllabus')
            echo 'opened active';
        ?> ">
            <a href="#">
                <i class="fas fa-door-open" style="font-size: 16px;padding: 3px;"></i>
                <span><?php echo get_phrase('class'); ?></span>
            </a>
            <ul>
                <li class="<?php if ($page_name == 'class') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>school/classes">
                        <span><i class="fas fa-cogs"></i> <?php echo get_phrase('manage_classes'); ?></span>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'section') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>school/section">
                        <span><i class="fas fa-tools"></i> <?php echo get_phrase('manage_sections'); ?></span>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'academic_syllabus') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>school/academic_syllabus">
                        <span><i class="fas fa-vote-yea"></i><?php echo get_phrase('academic_syllabus'); ?></span>
                    </a>
                </li>
            </ul>
        </li>

        <!-- SUBJECT -->
        <li class="<?php if ($page_name == 'subject') echo 'opened active'; ?> ">
            <a href="#">
                <i class="fas fa-book" style="font-size: 16px;padding: 3px;"></i>
                <span><?php echo get_phrase('subject'); ?></span>
            </a>
            <ul>
                <?php
                $classes = $this->db->get_where('class',array('school_id' => $this->session->userdata('school_id')))->result_array();
                foreach ($classes as $row):
                    ?>
                    <li class="<?php if ($page_name == 'subject' && $class_id == $row['class_id']) echo 'active'; ?>">
                        <a href="<?php echo base_url(); ?>school/subject/<?php echo $row['class_id']; ?>">
                            <i class="fas fa-arrow-circle-right" style="font-size: 16px;padding: 3px;"></i>
                            <span><?php echo get_phrase('class'); ?> <?php echo $row['name']; ?></span>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </li>

        <!-- CLASS ROUTINE -->
        <li class="<?php if ($page_name == 'class_routine_view' ||
                                $page_name == 'class_routine_add') 
                                    echo 'opened active'; ?> ">
            <a href="#">
                <i class="fas fa-user-clock" style="font-size: 16px;padding: 3px;"></i>
                <span><?php echo get_phrase('class_routine'); ?></span>
            </a>
            <ul>
                <?php
                $classes = $this->db->get_where('class', array('school_id' => $this->session->userdata('school_id')))->result_array();
                foreach ($classes as $row):
                    ?>
                    <li class="<?php if ($page_name == 'class_routine_view' && $class_id == $row['class_id']) echo 'active'; ?>">
                        <a href="<?php echo base_url(); ?>school/class_routine_view/<?php echo $row['class_id']; ?>">
                            <i class="fas fa-dot-circle"></i>
                            <span><?php echo get_phrase('class'); ?> <?php echo $row['name']; ?></span>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </li>
        <!--create documents -->
        <li class="<?php
        if ($page_name == 'select_option' ||
                $page_name == 'add_question')
            echo 'opened active';
        ?> ">
            <a href="#">
                <i class="fab fa-leanpub" style="font-size: 16px;padding: 3px;"></i>
                <span><?php echo get_phrase('Live_Test'); ?></span>
            </a>
            <ul>
                <li class="<?php if ($page_name == 'select_option') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>school/select_option">
                        <span><i class="far fa-question-circle"></i> <?php echo get_phrase('Add_Question'); ?></span>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'questions') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>school/questions">
                        <span><i class="fas fa-question"></i> <?php echo get_phrase('Questions'); ?></span>
                    </a>
                </li>
            </ul>
        </li>

        <li>
            <a href="https://docs.google.com" target="_blank">
                <i class="far fa-file" style="font-size: 16px;padding: 3px;"></i>
                <span>Create Documents</span>
            </a>
        </li>
        <!-- DAILY ATTENDANCE -->
        <li class="<?php if ($page_name == 'manage_attendance' ||
                                $page_name == 'manage_attendance_view' || $page_name == 'attendance_report' || $page_name == 'attendance_report_view') 
                                    echo 'opened active'; ?> ">
            <a href="#">
                <i class="fas fa-chart-area" style="font-size: 16px;padding: 3px;"></i>
                <span><?php echo get_phrase('daily_attendance'); ?></span>
            </a>
            <ul>
                
                    <li class="<?php if (($page_name == 'manage_attendance' || $page_name == 'manage_attendance_view')) echo 'active'; ?>">
                        <a href="<?php echo base_url(); ?>school/manage_attendance">
                            <span><i class="far fa-id-badge"></i><?php echo get_phrase('daily_atendance'); ?></span>
                        </a>
                    </li>
               
            </ul>
            <ul>
                
                    <li class="<?php if (( $page_name == 'attendance_report' || $page_name == 'attendance_report_view')) echo 'active'; ?>">
                        <a href="<?php echo base_url(); ?>school/attendance_report">
                            <span><i class="fas fa-flag"></i><?php echo get_phrase('attendance_report'); ?></span>
                        </a>
                    </li>
               
            </ul>
        </li>


        <!-- EXAMS -->
        <li class="<?php
        if ($page_name == 'exam' ||
                $page_name == 'grade' ||
                $page_name == 'marks_manage' ||
                    $page_name == 'exam_marks_sms' ||
                        $page_name == 'tabulation_sheet' ||
                            $page_name == 'marks_manage_view' || $page_name == 'question_paper' || $page_name == 'marksheet_templetes')
                                echo 'opened active';
        ?> ">
            <a href="#">
                <i class="fas fa-user-edit" style="font-size: 16px;padding: 3px;"></i>
                <span><?php echo get_phrase('exam'); ?></span>
            </a>
            <ul>
                <li class="<?php if ($page_name == 'exam') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>school/exam">
                        <span><i class="fas fa-list-alt"></i> <?php echo get_phrase('exam_list'); ?></span>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'grade') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>school/grade">
                        <span><i class="fas fa-user-graduate"></i> <?php echo get_phrase('exam_grades'); ?></span>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'marks_manage' || $page_name == 'marks_manage_view') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>school/marks_manage">
                        <span><i class="fas fa-tasks"></i> <?php echo get_phrase('manage_marks'); ?></span>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'marksheet_templetes') echo 'active'; ?>">
                    <a href="<?php echo base_url(); ?>school/marksheet_templetes">
                        <span><i class="fas fa-clipboard-list"></i> <?php echo get_phrase('Marksheet_Templetes'); ?></span>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'tabulation_sheet') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>school/tabulation_sheet">
                        <span><i class="fas fa-table"></i> <?php echo get_phrase('tabulation_sheet'); ?></span>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'question_paper') echo 'active'; ?>">
                    <a href="https://docs.google.com" target="_blank">
                        <span><i class="fas fa-sticky-note"></i> <?php echo get_phrase('question_papers'); ?></span>
                    </a>
                </li>
            </ul>
        </li>

        <!-- PAYMENT -->
        <!-- <li class="<?php //if ($page_name == 'invoice') echo 'active'; ?> ">
            <a href="<?php //echo base_url(); ?>school/invoice">
                <i class="entypo-credit-card"></i>
                <span><?php //echo get_phrase('payment'); ?></span>
            </a>
        </li> -->

        <!-- ACCOUNTING -->
        <li class="<?php
        if ($page_name == 'income' ||
                $page_name == 'expense' ||
                    $page_name == 'expense_category' ||
                        $page_name == 'student_payment')
                            echo 'opened active';
        ?> ">
            <a href="#">
                <i class="fas fa-rupee-sign" style="font-size: 16px;padding: 3px;"></i>
                <span><?php echo get_phrase('accounting'); ?></span>
            </a>
            <ul>

                <li class="<?php if ($page_name == 'income') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>school/income">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('student_payments'); ?></span>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'expense') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>school/expense">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('expense'); ?></span>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'expense_category') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>school/expense_category">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('expense_category'); ?></span>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'expense_by_category') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>school/expense_by_category">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('expense_by_category'); ?></span>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'teacher_salary') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>school/teacher_salary">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('Update_teacher_salary'); ?></span>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'balance_sheet') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>school/balance_sheet">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('Balance_Sheet'); ?></span>
                    </a>
                </li>
            </ul>
        </li>

		<!-- transfer certificate-->
        <li class="<?php
        if ($page_name == 'student_transfer_certificate' ||
                        $page_name == 'list_transfer_certificate')
                            echo 'opened active';
        ?> ">
            <a href="#">
                <i class="fas fa-file" style="font-size: 16px;padding: 3px;"></i>
                <span>Transfer Certificate</span>
            </a>
            <ul>
                <li class="<?php if ($page_name == 'student_payment') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>school/student_transfer_certificate">
                        <span><i class="entypo-dot"></i>Create T.C.</span>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'income') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>school/list_transfer_certificate">
                        <span><i class="entypo-dot"></i>Manage T.C.</span>
                    </a>
                </li>
            </ul>
        </li>


        <!-- LIBRARY -->
        <li class="<?php if ($page_name == 'book') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>school/book">
                <i class="fas fa-mail-bulk" style="font-size: 16px;padding: 3px;"></i>
                <span><?php echo get_phrase('library'); ?></span>
            </a>
        </li>

        <!-- TRANSPORT -->
        <li class="<?php if ($page_name == 'transport') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>school/transport">
                <i class="fas fa-map-marked" style="font-size: 16px;padding: 3px;"></i>
                <span><?php echo get_phrase('transport'); ?></span>
            </a>
        </li>

        <!-- DORMITORY -->
        <li class="<?php if ($page_name == 'dormitory') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>school/dormitory">
                <i class="entypo-home"></i>
                <span><?php echo get_phrase('dormitory'); ?></span>
            </a>
        </li>

        <!-- NOTICEBOARD -->
        <li class="<?php if ($page_name == 'noticeboard') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>school/noticeboard">
                <i class="entypo-doc-text-inv"></i>
                <span><?php echo get_phrase('noticeboard'); ?></span>
            </a>
        </li>

        <!-- MESSAGE -->
        <li class="<?php if ($page_name == 'message') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>school/message">
                <i class="fas fa-sms" style="font-size: 16px;padding: 3px;"></i>
                <span><?php echo get_phrase('message'); ?></span>
            </a>
        </li>

        <!-- SETTINGS -->
        <li class="<?php
        if ($page_name == 'system_settings')
                        echo 'opened active';
        ?> ">
            <a href="<?php echo base_url(); ?>school/system_settings">
                <i class="fas fa-cog" style="font-size: 16px;padding: 3px;"></i>
                <span><?php echo get_phrase('settings'); ?></span>
            </a>
        </li>
        <li class="<?php if ($page_name == 'import_data') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>school/import_student">
                <i class="fas fa-file-import" style="font-size: 16px;padding: 3px;"></i>
                <span><?php echo get_phrase('Import_Excel'); ?></span>
            </a>
        </li>
       
        <li class="<?php if ($page_name == 'manage_profile') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>school/manage_profile">
                <i class="fas fa-user-cog" style="font-size: 16px;padding: 3px;"></i>
                <span><?php echo get_phrase('account'); ?></span>
            </a>
        </li>


    </ul>

</div>