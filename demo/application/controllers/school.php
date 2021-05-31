<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');
class School extends CI_Controller
{


	function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->library('session');

		/*cache control*/
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
		$this->output->set_header('Pragma: no-cache');

	}

	/***default functin, redirects to login page if no school logged in yet***/
	public function index()
	{
		if ($this->session->userdata('school_login') != 1)
			redirect(base_url() . 'index.php?login', 'refresh');
		if ($this->session->userdata('school_login') == 1)
			redirect(base_url() . 'index.php?school/dashboard', 'refresh');
	}

	/***school DASHBOARD***/
	function dashboard()
	{
		if ($this->session->userdata('school_login') != 1)
			redirect(base_url(), 'refresh');
		$page_data['page_name']  = 'dashboard';
		$page_data['school_id'] = $this->session->userdata('school_id');
		$page_data['page_title'] = get_phrase('school_dashboard');
		$this->load->view('backend/index', $page_data);
	}

	/****MANAGE STUDENTS CLASSWISE*****/
	function student_add()
	{
		if ($this->session->userdata('school_login') != 1)
			redirect(base_url(), 'refresh');

		$page_data['page_name']  = 'student_add';
		$page_data['page_title'] = get_phrase('add_student');
		$this->load->view('backend/index', $page_data);
	}

	function student_bulk_add($param1 = '')
	{
		if ($this->session->userdata('school_login') != 1)
			redirect(base_url(), 'refresh');

		if($param1 == 'add_bulk_student') {

			$names     = $this->input->post('name');
			$rolls     = $this->input->post('roll');
			$fathernames    = $this->input->post('fathername');
			$mothernames = $this->input->post('mothername');
			$phones    = $this->input->post('phone');
			$addresses = $this->input->post('address');
			$genders   = $this->input->post('sex');

			$student_entries = sizeof($names);
			for($i = 0; $i < $student_entries; $i++) {
				$data['name']     =   $names[$i];
				$data['fathername']    =   $fathernames[$i];
				$data['mothername'] =   $mothernames[$i];
				$data['phone']    =   $phones[$i];
				$data['address']  =   $addresses[$i];
				$data['sex']      =   $genders[$i];
				$data['school_id'] = $this->session->userdata('school_id');

                //validate here, if the row(name, email, password) is empty or not
				if($data['name'] == '')
					continue;

				$this->db->insert('student' , $data);
				$student_id = $this->db->insert_id();

				$data2['enroll_code']   =   substr(md5(rand(0, 1000000)), 0, 7);
				$data2['student_id']    =   $student_id;
				$data2['class_id']      =   $this->input->post('class_id');
				if($this->input->post('section_id') != '') {
					$data2['section_id']    =   $this->input->post('section_id');
				}
				$data2['school_id'] = $this->session->userdata('school_id');
				$data2['roll']          =   $rolls[$i];
				$data2['date_added']    =   date("d/m/Y");
				$data2['year']          =   $this->db->get_where('school' , array('school_id' => $this->session->userdata('school_id')))->row()->running_year;

				$this->db->insert('enroll' , $data2);

			}
			$this->session->set_flashdata('flash_message' , get_phrase('students_added'));
			redirect(base_url() . 'index.php?school/student_information/' . $this->input->post('class_id') , 'refresh');
		}			

		$page_data['page_name']  = 'student_bulk_add';
		$page_data['page_title'] = get_phrase('add_bulk_student');
		$this->load->view('backend/index', $page_data);
	}

	function get_sections($class_id)
	{
		$page_data['class_id'] = $class_id;
		$this->load->view('backend/school/student_bulk_add_sections' , $page_data);
	}

	function student_information($class_id = '')
	{
		if ($this->session->userdata('school_login') != 1)
			redirect('login', 'refresh');
		$page_data['school_id'] = $this->session->userdata('school_id');
		$page_data['page_name']  	= 'student_information';
		$page_data['page_title'] 	= get_phrase('student_information'). " - ".get_phrase('class')." : ".
		$this->crud_model->get_class_name($class_id);
		$page_data['class_id'] 	= $class_id;
		$this->load->view('backend/index', $page_data);
	}
function products($product_category_id)
    {
        if ($this->session->userdata('school_login') != 1)
            redirect(base_url(), 'refresh');
        $page_data['product_category_id']  = $product_category_id;
        $page_data['page_name']  = 'products';
        $page_data['school_id'] =  $this->session->userdata('school_id');
        $page_data['page_title'] = get_phrase('Product_Category : ' . $this->db->get_where('product_category', array('product_category_id' =>  $product_category_id))->row()->name);
        $this->load->view('backend/index', $page_data);
    }



    function product_list($product_category_id)
	{
		if ($this->session->userdata('school_login') != 1)
            redirect(base_url(), 'refresh');
		if ($product_category_id == NULL) {
            redirect(base_url() . 'index.php?seller/product_list/1', 'refresh');

        }
        $page_data['product_category_id'] = $product_category_id;	
		$page_data['page_name']  = 'product_list';
		$page_data['page_title'] = get_phrase('Explorer_Product');
		$this->load->view('backend/index', $page_data);
	}

	    function addtocart($product_id = '')
    {
    	if ($this->session->userdata('school_login') != 1)
    		redirect(base_url(), 'refresh');
    	
    		$data['user_id'] = $this->session->userdata('school_id');
    		$data['product_id'] = $product_id;
    		$data['user']	= 'school';
    		$data['timestamp']   = strtotime(date());

    		$check = $this->db->get_where('cart', array('product_id' => $product_id,'user' => 'school'));
    		if ($check->num_rows() < 1) {
    			$this->db->insert('cart', $data);
    		}
    		
    }
    function continuetocart()
	{
		if ($this->session->userdata('school_login') != 1)
			redirect(base_url(), 'refresh');
		$page_data['page_name']  = 'Cart';
		$page_data['school_id'] = $this->session->userdata('school_id');
		$page_data['page_title'] = get_phrase('cart');
		$this->load->view('backend/index', $page_data);
	}
	
	function student_marksheet($student_id = '') {
		if ($this->session->userdata('school_login') != 1)
			redirect('login', 'refresh');
		$class_id     = $this->db->get_where('enroll' , array(
			'student_id' => $student_id , 'year' => $this->db->get_where('school' , array('school_id' => $this->session->userdata('school_id')))->row()->running_year
		))->row()->class_id;
		$student_name = $this->db->get_where('student' , array('student_id' => $student_id))->row()->name;
		$class_name   = $this->db->get_where('class' , array('class_id' => $class_id))->row()->name;
		$page_data['school_id'] = $this->session->userdata('school_id');
		$page_data['page_name']  =   'student_marksheet';
		$page_data['page_title'] =   get_phrase('marksheet_for') . ' ' . $student_name . ' (' . get_phrase('class') . ' ' . $class_name . ')';
		$page_data['student_id'] =   $student_id;
		$page_data['class_id']   =   $class_id;
		$page_data['running_year'] = $this->db->get_where('school' , array('school_id' => $this->session->userdata('school_id')))->row()->running_year;
		$this->load->view('backend/index', $page_data);
	}

	    function rankcalculate($class_id = '' , $section_id = '')
    {
    	if ($this->session->userdata('school_login') != 1)
    		redirect(base_url(), 'refresh');
    	$running_year = $this->db->get_where('school', array('school_id' => $this->session->userdata('school_id')))->row()->running_year;
    	$subject = $this->db->get_where('subject', array('class_id' => $class_id, 'type' => 1))->result_array();
    	$student = $this->db->get_where('enroll', array('class_id' => $class_id,'section_id'=>$section_id))->result_array();
    	$exams = $this->db->get_where('exam', array('class_id' => $class_id))->result_array();
    	foreach ($student as $row) {
    		$data['sum_marks'] = 0;
    		foreach ($subject as $row2) {
    			foreach ($exams as $row3) {
    			


    			$this->db->select_sum('mark_obtained');
    			$mark = $this->db->get_where('mark',array('student_id' => $row['student_id'],'class_id' => $class_id,'subject_id' => $row2['subject_id'],'exam_id'=>$row2['exam_id'], 'year'=>$running_year))->row()->mark_obtained;
    			
				$data['sum_marks'] = $data['sum_marks'] + $mark;

    			}
    		}
    		$this->db->where('enroll_id',$row['enroll_id']);
        	$this->db->update('enroll', $data);
    	}
    	$students=$this->db->order_by('sum_marks', 'desc')->get_where('enroll', array('class_id' => $class_id,'section_id'=>$section_id,'year'=>$running_year))->result_array();
    	$rank = 1;
    	foreach ($students as $row3) {
    		$data2['rank'] = $rank;
    		$rank = $rank+1;
    		$this->db->where('student_id', $row3['student_id']);
    		$this->db->where('year', $running_year);
        	$this->db->update('enroll', $data2);
    	}
    	$this->session->set_flashdata('flash_message' , get_phrase('Student_Ranked_Successfully'));
    	redirect(base_url() . 'index.php?school/student_information/' . $class_id , 'refresh');
    }

   
	function print_invoice($enroll_id) {
		if ($this->session->userdata('school_login') != 1)
			redirect('login', 'refresh');
		
		$page_data['enroll_id']   =   $enroll_id;
		$this->load->view('backend/school/print_invoice_view', $page_data);
	}

	function student_marksheet_print_view($student_id , $exam_id) {
		if ($this->session->userdata('school_login') != 1)
			redirect('login', 'refresh');
		$class_id     = $this->db->get_where('enroll' , array(
			'student_id' => $student_id , 'year' => $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description
		))->row()->class_id;
		$class_name   = $this->db->get_where('class' , array('class_id' => $class_id))->row()->name;
		$page_data['school_id'] = $this->session->userdata('school_id');
		$page_data['student_id'] =   $student_id;
		$page_data['class_id']   =   $class_id;
		$page_data['exam_id']    =   $exam_id;
		$this->load->view('backend/school/student_marksheet_print_view', $page_data);
	}
	function student_marksheet_print_view_uti($student_id , $exam_id) {
		if ($this->session->userdata('school_login') != 1)
			redirect('login', 'refresh');
		$class_id     = $this->db->get_where('enroll' , array(
			'student_id' => $student_id , 'year' => $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description
		))->row()->class_id;
		$class_name   = $this->db->get_where('class' , array('class_id' => $class_id))->row()->name;
		$page_data['school_id'] = $this->session->userdata('school_id');
		$page_data['student_id'] =   $student_id;
		$page_data['class_id']   =   $class_id;
		$page_data['exam_id']    =   $exam_id;
		$this->load->view('backend/school/student_marksheet_print_view_uti', $page_data);
	}
	function student_marksheet_print_view_all($student_id , $exam_id) {
		if ($this->session->userdata('school_login') != 1)
			redirect('login', 'refresh');
		$class_id     = $this->db->get_where('enroll' , array(
			'student_id' => $student_id , 'year' => $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description
		))->row()->class_id;
		$class_name   = $this->db->get_where('class' , array('class_id' => $class_id))->row()->name;
		$page_data['school_id'] = $this->session->userdata('school_id');
		$page_data['student_id'] =   $student_id;
		$page_data['class_id']   =   $class_id;
		$page_data['exam_id']    =   $exam_id;
		$this->load->view('backend/school/student_marksheet_print_view_all_hy', $page_data);
	}
	

	function charactor($student_id , $exam_id) {
		if ($this->session->userdata('school_login') != 1)
			redirect('login', 'refresh');
		$class_id     = $this->db->get_where('enroll' , array(
			'student_id' => $student_id , 'year' => $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description
		))->row()->class_id;
		$class_name   = $this->db->get_where('class' , array('class_id' => $class_id))->row()->name;
		$page_data['school_id'] = $this->session->userdata('school_id');
		$page_data['student_id'] =   $student_id;
		$page_data['class_id']   =   $class_id;
		$page_data['exam_id']    =   $exam_id;
		$this->load->view('backend/school/charactor', $page_data);
	}
	function feescerti($student_id , $exam_id) {
		if ($this->session->userdata('school_login') != 1)
			redirect('login', 'refresh');
		$class_id     = $this->db->get_where('enroll' , array(
			'student_id' => $student_id , 'year' => $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description
		))->row()->class_id;
		$class_name   = $this->db->get_where('class' , array('class_id' => $class_id))->row()->name;
		$page_data['school_id'] = $this->session->userdata('school_id');
		$page_data['student_id'] =   $student_id;
		$page_data['class_id']   =   $class_id;
		$page_data['exam_id']    =   $exam_id;
		$this->load->view('backend/school/feescerti', $page_data);
	}
function gamecerti($student_id , $exam_id) {
		if ($this->session->userdata('school_login') != 1)
			redirect('login', 'refresh');
		$class_id     = $this->db->get_where('enroll' , array(
			'student_id' => $student_id , 'year' => $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description
		))->row()->class_id;
		$class_name   = $this->db->get_where('class' , array('class_id' => $class_id))->row()->name;
		$page_data['school_id'] = $this->session->userdata('school_id');
		$page_data['student_id'] =   $student_id;
		$page_data['class_id']   =   $class_id;
		$page_data['exam_id']    =   $exam_id;
		$this->load->view('backend/school/gamecerti', $page_data);
	}
	function experience($teacher_id) {
		if ($this->session->userdata('school_login') != 1)
			redirect('login', 'refresh');
		$page_data['school_id'] = $this->session->userdata('school_id');
		$page_data['teacher_id'] =   $teacher_id;
		$this->load->view('backend/school/experience', $page_data);
	}
	function appointment($teacher_id) {
		if ($this->session->userdata('school_login') != 1)
			redirect('login', 'refresh');

		$page_data['teacher_id'] =   $teacher_id;
		$this->load->view('backend/school/appointment', $page_data);
	}

	function student($param1 = '', $param2 = '', $param3 = '')
	{
		if ($this->session->userdata('school_login') != 1)
			redirect('login', 'refresh');
		$running_year = $this->db->get_where('school', array('school_id'=>$this->session->userdata('school_id')))->row()->running_year;
		if ($param1 == 'create') {
			$data['name']           = $this->input->post('name');
			$data['totalfee']          = $this->input->post('aadhar');
			$data['birthday']       = strtotime(str_replace('/', '-', $this->input->post('birthday')));
			$data['sex']            = $this->input->post('sex');
			$data['address']        = $this->input->post('address');
			$data['phone']          = $this->input->post('phone');
			$data['email']          = $this->input->post('email');
			$data['fathername']          = $this->input->post('fathername');
			$data['mothername']          = $this->input->post('mothername');
			$data['nationality']         = $this->input->post('nationality');
			$data['category']            = $this->input->post('category');
			$data['date_of_admission']   = $this->input->post('date_of_admission');
            $data['remainingfee']      = $this->input->post('lastschool');
            $data['school_id'] = $this->session->userdata('school_id');
            //$data['password']       = sha1($this->input->post('password'));
            //$data['parent_id']      = $this->input->post('parent_id');
            //$data['dormitory_id']  = $this->input->post('dormitory_id');
            //$data['transport_id']  = $this->input->post('transport_id');
			$this->db->insert('student', $data);
			$student_id = $this->db->insert_id();

			$data2['student_id']     = $student_id;
			$data2['enroll_code']    = substr(md5(rand(0, 1000000)), 0, 7);
			$data2['class_id']       = $this->input->post('class_id');
			if ($this->input->post('section_id') != '') {
				$data2['section_id'] = $this->input->post('section_id');
			}
			$data2['school_id'] = $this->session->userdata('school_id');
			$data2['roll']           = $this->input->post('roll');
			$data2['srno']           = $this->input->post('srno');
			$data2['date_added']     = date("d/m/Y");
			$data2['year']           = $this->db->get_where('school', array('school_id'=>$this->session->userdata('school_id')))->row()->running_year;
			$this->db->insert('enroll', $data2);
			move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/student_image/' . $student_id . '.jpg');
			$this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
            //$this->email_model->account_opening_email('student', $data['email']); //SEND EMAIL ACCOUNT OPENING EMAIL
			redirect(base_url() . 'index.php?school/student_add/', 'refresh');
		}
		if ($param1 == 'do_update') {
			$data['name']           = $this->input->post('name');
			$data['birthday']       = strtotime(str_replace('/', '-', $this->input->post('birthday')));
			$data['sex']            = $this->input->post('sex');
			$data['address']        = $this->input->post('address');
			$data['phone']          = $this->input->post('phone');
			$data['email']          = $this->input->post('email');
			$data['fathername']       = $this->input->post('fathername');
			$data['mothername']       = $this->input->post('mothername');
			$data['parent_id']      = $this->input->post('parent_id');
			$data['dormitory_id']   = $this->input->post('dormitory_id');
			$data['transport_id']   = $this->input->post('transport_id');
			$data['nationality']         = $this->input->post('nationality');
			$data['category']            = $this->input->post('category');
			$data['date_of_admission']   = $this->input->post('date_of_admission');
			$data['school_id'] = $this->session->userdata('school_id');
			$this->db->where('student_id', $param2);
			$this->db->update('student', $data);
			$data2['school_id'] = $this->session->userdata('school_id');
			$data2['section_id']    =   $this->input->post('section_id');
			$data2['roll']          =   $this->input->post('roll');
			$data2['srno']           = $this->input->post('srno');
			$running_year = $this->db->get_where('school' , array('school_id' => $this->session->userdata('school_id')))->row()->running_year;
			$this->db->where('student_id' , $param2);
			$this->db->where('year' , $running_year);
			$this->db->update('enroll' , array(
				'section_id' => $data2['section_id'] , 'roll' => $data2['roll'] , 'srno' => $data2['srno']
			));

			move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/student_image/' . $param2 . '.jpg');
			$this->crud_model->clear_cache();
			$this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
			redirect(base_url() . 'index.php?school/student_information/' . $param3, 'refresh');
		} 

		if ($param2 == 'delete') {
			$this->db->where('student_id', $param3);
			$this->db->delete('student');
			$this->db->where('student_id', $param3);
			$this->db->delete('enroll');
			$this->session->set_flashdata('flash_message' , get_phrase('data_deleted'));
			redirect(base_url() . 'index.php?school/student_information/' . $param1, 'refresh');
		}
	}

    // STUDENT PROMOTION
	function student_promotion($param1 = '' , $param2 = '')
	{
		if ($this->session->userdata('school_login') != 1)
			redirect('login', 'refresh');

		if($param1 == 'promote') {
			$running_year  =   $this->input->post('running_year');  
			$from_class_id =   $this->input->post('promotion_from_class_id'); 
			$students_of_promotion_class =   $this->db->get_where('enroll' , array(
				'class_id' => $from_class_id , 'year' => $running_year
			))->result_array();
			foreach($students_of_promotion_class as $row) {
				$enroll_data['enroll_code']     =   substr(md5(rand(0, 1000000)), 0, 7);
				$enroll_data['student_id']      =   $row['student_id'];
				$enroll_data['class_id']        =   $this->input->post('promotion_status_'.$row['student_id']);
				$enroll_data['year']            =   $this->input->post('promotion_year');
				$enroll_data['srno']            =   $this->input->post('srno');
				$enroll_data['date_added']      =   strtotime(str_replace('/', '-', date('d/m/Y')));
				$enroll_data['school_id'] = $this->session->userdata('school_id');
				$this->db->insert('enroll' , $enroll_data);
			} 
			$this->session->set_flashdata('flash_message' , get_phrase('new_enrollment_successfull'));
			redirect(base_url() . 'index.php?school/student_promotion' , 'refresh');
		}

		$page_data['page_title']    = get_phrase('student_promotion');
		$page_data['page_name']  = 'student_promotion';
		$this->load->view('backend/index', $page_data);
	}

	function get_students_to_promote($class_id_from , $class_id_to , $running_year , $promotion_year)
	{
		$page_data['class_id_from']     =   $class_id_from;
		$page_data['class_id_to']       =   $class_id_to;
		$page_data['running_year']      =   $running_year;
		$page_data['promotion_year']    =   $promotion_year;
		$this->load->view('backend/school/student_promotion_selector' , $page_data);
	}


	/****MANAGE PARENTS CLASSWISE*****/
	function parent($param1 = '', $param2 = '', $param3 = '')
	{
		if ($this->session->userdata('school_login') != 1)
			redirect('login', 'refresh');
		if ($param1 == 'create') {
			$data['name']        			= $this->input->post('name');
			$data['email']       			= $this->input->post('email');
			$data['password']    			= sha1($this->input->post('password'));
			$data['phone']       			= $this->input->post('phone');
			$data['address']     			= $this->input->post('address');
			$data['profession']  			= $this->input->post('profession');
			$data['school_id'] = $this->session->userdata('school_id');
			$this->db->insert('parent', $data);
			$this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
            $this->email_model->account_opening_email('parent', $data['email']); //SEND EMAIL ACCOUNT OPENING EMAIL
            redirect(base_url() . 'index.php?school/parent/', 'refresh');
        }
        if ($param1 == 'edit') {
        	$data['name']                   = $this->input->post('name');
        	$data['email']                  = $this->input->post('email');
        	$data['phone']                  = $this->input->post('phone');
        	$data['address']                = $this->input->post('address');
        	$data['profession']             = $this->input->post('profession');
        	$data['school_id'] = $this->session->userdata('school_id');
        	$this->db->where('parent_id' , $param2);
        	$this->db->update('parent' , $data);
        	$this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
        	redirect(base_url() . 'index.php?school/parent/', 'refresh');
        }
        if ($param1 == 'delete') {
        	$this->db->where('parent_id' , $param2);
        	$this->db->delete('parent');
        	$this->session->set_flashdata('flash_message' , get_phrase('data_deleted'));
        	redirect(base_url() . 'index.php?school/parent/', 'refresh');
        }
        $page_data['page_title'] 	= get_phrase('all_parents');
        $page_data['page_name']  = 'parent';
        $this->load->view('backend/index', $page_data);
    }

    /*****Import Excel Data******/
    
        function import_student($param1 = '', $param2 = '', $param3 = '')
    {
    	if ($this->session->userdata('school_login') != 1)
    		redirect(base_url(), 'refresh');
    	if ($param1 == 'create') {
    		$class_id        = $this->input->post('class_id');
    		$section_id       = $this->input->post('section_id');
    		$year = $this->db->get_where('school' , array('school_id'=>$this->session->userdata('school_id')
		))->row()->running_year;
    		$filename=$_FILES["file_name"]["tmp_name"];
echo "<script>alert('working');</script>";
    				 if($_FILES["file_name"]["size"] > 0)
		 {	
		 	echo "<script>alert('working');</script>";
 
		  	$file = fopen($filename, "r");
	         while (($emapData = fgetcsv($file, 10000, ",")) !== FALSE)
	         {	
	         	$data['name']	= $emapData[0];
	         	$data['school_id'] = $this->session->userdata('school_id');
	         	$data['fathername'] = $emapData[1];
	         	$data['mothername'] = $emapData[2];
	         	$data['birthday']	= strtotime(str_replace('/', '-', $emapData[3]));
	         	$data['sex']		= $emapData[4];
	         	$data['religion']	= $emapData[5];
	         	$data['address']	= $emapData[6];
	         	$data['email']		= $emapData[7];
	         	$data['password']	= sha1(str_replace('/', '-', $emapData[3]));
	         	$data['category']	= $emapData[8];
	         	$data['nationality']= $emapData[9];
	         	$data['date_of_admission'] = strtotime(str_replace('/', '-', $emapData[10]));
	         	$this->db->insert('student',$data);
    			$student_id = $this->db->insert_id();
    			$data2['student_id'] = $student_id;
    			$data2['school_id'] = $this->session->userdata('school_id');
    			$data2['class_id']	 = $class_id;
    			$data2['section_id'] = $section_id;
    			$data2['srno']		 = $emapData[11];
    			$data2['roll']		 = $emapData[12];
    			$data2['date_added'] = strtotime(str_replace('/', '-', $emapData[11]));
    			$data2['year']		 = $year;
    			$this->db->where('student_id',$student_id);
    			$this->db->insert('enroll',$data2);
    			$this->session->set_flashdata('flash_message' , get_phrase('Data_Updated_Successfully'));
    		}

            fclose($file);
        }
        redirect(base_url() . 'index.php?school/student_information/'.$class_id, 'refresh');
       }
        $page_data['page_name']  = 'import_data';
        $page_data['page_title'] = get_phrase('Import_Student_Excel');
        $this->load->view('backend/index', $page_data);
    }
    
    /****MANAGE TEACHERS*****/
    function teacher($param1 = '', $param2 = '', $param3 = '')
    {
    	if ($this->session->userdata('school_login') != 1)
    		redirect(base_url(), 'refresh');
    	if ($param1 == 'create') {
    		$data['name']        = $this->input->post('name');
    		$data['birthday']    = strtotime(str_replace('/', '-', $this->input->post('birthday')));
    		$data['sex']         = $this->input->post('sex');
    		$data['school_id'] = $this->session->userdata('school_id');
    		$data['address']     = $this->input->post('address');
    		$data['phone']       = $this->input->post('phone');
    		$data['email']       = $this->input->post('email');
    		$data['post']		 = $this->input->post('post');
    		$data['subject']	 = $this->input->post('subject');
    		$data['joining_date']= strtotime(str_replace('/', '-', $this->input->post('joining_date')));
    		$data['experience']  = $this->input->post('experience');
    		$data['salary']		 = $this->input->post('salary');
    		$data['blood_group']       = $this->input->post('blood_group');
    		$data['password']    = sha1($this->input->post('password'));
    		$data['year'] = $this->db->get_where('school' , array('school_id'=>$this->session->userdata('school_id')
		))->row()->running_year;
    		$this->db->insert('teacher', $data);
    		$teacher_id = $this->db->insert_id();
    		move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/teacher_image/' . $teacher_id . '.jpg');
    		$this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
            $this->email_model->account_opening_email('teacher', $data['email']); //SEND EMAIL ACCOUNT OPENING EMAIL
            redirect(base_url() . 'index.php?school/teacher/', 'refresh');
        }
        if ($param1 == 'do_update') {
        	$data['name']        = $this->input->post('name');
    		$data['birthday']    = strtotime(str_replace('/', '-', $this->input->post('birthday')));
    		$data['sex']         = $this->input->post('sex');
//data['school_id'] = $this->session->userdata('school_id');
    		$data['address']     = $this->input->post('address');
    		$data['phone']       = $this->input->post('phone');
    		$data['email']       = $this->input->post('email');
    		$data['post']		 = $this->input->post('post');
    		$data['subject']	 = $this->input->post('subject');
    		$data['joining_date']= strtotime(str_replace('/', '-', $this->input->post('joining_date')));
    		$data['experience']  = $this->input->post('experience');
    		$data['salary']		 = $this->input->post('salary');
    		$data['blood_group']       = $this->input->post('blood_group');
    		$password_change = $this->input->post('password_change');
    		if ($password_change == 'yes') {
    			$data['password']    = sha1($this->input->post('password'));
    		}
    		

        	$this->db->where('teacher_id', $param2);
        	$this->db->update('teacher', $data);
        	move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/teacher_image/' . $param2 . '.jpg');
        	$this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
        	redirect(base_url() . 'index.php?school/teacher/', 'refresh');
        } else if ($param1 == 'personal_profile') {
        	$page_data['personal_profile']   = true;
        	$page_data['current_teacher_id'] = $param2;
        } else if ($param1 == 'edit') {
        	$page_data['edit_data'] = $this->db->get_where('teacher', array(
        		'teacher_id' => $param2
        	))->result_array();
        }
        if ($param1 == 'delete') {
        	$this->db->where('teacher_id', $param2);
        	$this->db->delete('teacher');
        	$this->session->set_flashdata('flash_message' , get_phrase('data_deleted'));
        	redirect(base_url() . 'index.php?school/teacher/', 'refresh');
        }
        $page_data['teachers']   = $this->db->get('teacher')->result_array();
        $page_data['page_name']  = 'teacher';
        $page_data['page_title'] = get_phrase('manage_teacher');
        $this->load->view('backend/index', $page_data);
    }
    
    /****MANAGE SUBJECTS*****/
    function subject($param1 = '', $param2 = '' , $param3 = '')
    {
    	if ($this->session->userdata('school_login') != 1)
    		redirect(base_url(), 'refresh');
    	if ($param1 == 'create') {
    		$data['name']       = $this->input->post('name');
    		$data['class_id']   = $this->input->post('class_id');
    		$data['type']       = $this->input->post('type');
    		$data['school_id'] = $this->session->userdata('school_id');
    		$data['teacher_id'] = $this->input->post('teacher_id');
    		$data['year']       = $this->db->get_where('school' , array('school_id' => $this->session->userdata('school_id')))->row()->running_year;
    		$this->db->insert('subject', $data);
    		$this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
    		redirect(base_url() . 'index.php?school/subject/'.$data['class_id'], 'refresh');
    	}
    	if ($param1 == 'do_update') {
    		$data['name']       = $this->input->post('name');
    		$data['class_id']   = $this->input->post('class_id');
    		$data['type']       = $this->input->post('type');
    		$data['school_id'] = $this->session->userdata('school_id');
    		$data['teacher_id'] = $this->input->post('teacher_id');
    		$data['year']       = $this->db->get_where('school' , array('school_id' => $this->session->userdata('school_id')))->row()->running_year;

    		$this->db->where('subject_id', $param2);
    		$this->db->update('subject', $data);
    		$this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
    		redirect(base_url() . 'index.php?school/subject/'.$data['class_id'], 'refresh');
    	} else if ($param1 == 'edit') {
    		$page_data['edit_data'] = $this->db->get_where('subject', array(
    			'subject_id' => $param2
    		))->result_array();
    	}
    	if ($param1 == 'delete') {
    		$this->db->where('subject_id', $param2);
    		$this->db->delete('subject');
    		$this->session->set_flashdata('flash_message' , get_phrase('data_deleted'));
    		redirect(base_url() . 'index.php?school/subject/'.$param3, 'refresh');
    	}
    	$page_data['class_id']   = $param1;
    	$page_data['subjects']   = $this->db->get_where('subject' , array('class_id' => $param1,'school_id' => $this->session->userdata('school_id')))->result_array();
    	$page_data['page_name']  = 'subject';
    	$page_data['page_title'] = get_phrase('manage_subject');
    	$this->load->view('backend/index', $page_data);
    }
    
    /****MANAGE CLASSES*****/
    function classes($param1 = '', $param2 = '')
    {
    	if ($this->session->userdata('school_login') != 1)
    		redirect(base_url(), 'refresh');
    	if ($param1 == 'create') {
    		$data['name']         = $this->input->post('name');
    		$data['school_id'] = $this->session->userdata('school_id');
    		$data['name_numeric'] = $this->input->post('name_numeric');
    		$data['teacher_id']   = $this->input->post('teacher_id');


    		$data['tution_fee'] = $this->input->post('tution_fee');
    		$data['session_fee'] = $this->input->post('session_fee');
    		$data['examination_fee'] = $this->input->post('examination_fee');
    		$data['computer_academics'] = $this->input->post('computer_academics');
    		$data['sports'] = $this->input->post('sports');
    		$data['extra_co_curricular'] = $this->input->post('extra_co_curricular');
    		$data['laboratory_fee'] = $this->input->post('laboratory_fee');
    		$data['development_fee'] = $this->input->post('development_fee');
    		$data['admission_fee'] = $this->input->post('admission_fee');
    		$data['other_fee'] = $this->input->post('other_fee');
    		$data['total_school_fee'] = $data['development_fee']+$data['admission_fee']+$data['examination_fee']+$data['laboratory_fee']+$data['extra_co_curricular']+$data['sports']+$data['computer_academics']+$data['session_fee']+$data['tution_fee']+$data['other_fee'];
    		$this->db->insert('class', $data);
    		$class_id = $this->db->insert_id();
            //create a section by default
    		$data2['class_id']  =   $class_id;
    		$data2['name']      =   'A';
    		$data2['school_id'] = $this->session->userdata('school_id');
    		$this->db->insert('section' , $data2);

    		$this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
    		redirect(base_url() . 'index.php?school/classes/', 'refresh');
    	}
    	if ($param1 == 'do_update') {
    		$data['name']         = $this->input->post('name');
    		$data['school_id'] = $this->session->userdata('school_id');
    		$data['name_numeric'] = $this->input->post('name_numeric');
    		$data['teacher_id']   = $this->input->post('teacher_id');
    		$data['examination_fee'] = $this->input->post('examination_fee');
    		$data['tution_fee'] = $this->input->post('tution_fee');
    		$data['session_fee'] = $this->input->post('session_fee');
    		$data['computer_academics'] = $this->input->post('computer_academics');
    		$data['sports'] = $this->input->post('sports');
    		$data['extra_co_curricular'] = $this->input->post('extra_co_curricular');
    		$data['laboratory_fee'] = $this->input->post('laboratory_fee');
    		$data['development_fee'] = $this->input->post('development_fee');
    		$data['admission_fee'] = $this->input->post('admission_fee');
    		$data['other_fee'] = $this->input->post('other_fee');
    		$data['total_school_fee'] = $data['development_fee']+$data['admission_fee']+$data['examination_fee']+$data['laboratory_fee']+$data['extra_co_curricular']+$data['sports']+$data['computer_academics']+$data['session_fee']+$data['tution_fee']+$data['other_fee'];
    		$this->db->where('class_id', $param2);
    		$this->db->update('class', $data);
    		$this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
    		redirect(base_url() . 'index.php?school/classes/', 'refresh');
    	} else if ($param1 == 'edit') {
    		$page_data['edit_data'] = $this->db->get_where('class', array(
    			'class_id' => $param2
    		))->result_array();
    	}
    	if ($param1 == 'delete') {
    		$this->db->where('class_id', $param2);
    		$this->db->delete('class');
    		$this->session->set_flashdata('flash_message' , get_phrase('data_deleted'));
    		redirect(base_url() . 'index.php?school/classes/', 'refresh');
    	}
    	$page_data['classes']    = $this->db->get_where('class', array('school_id'=> $this->session->userdata('school_id')))->result_array();
    	$page_data['page_name']  = 'class';
    	$page_data['page_title'] = get_phrase('manage_class');
    	$this->load->view('backend/index', $page_data);
    }
    function get_subject($class_id) 
    {
    	$subject = $this->db->get_where('subject' , array(
    		'class_id' => $class_id
    	))->result_array();
    	foreach ($subject as $row) {
    		echo '<option value="' . $row['subject_id'] . '">' . $row['name'] . '</option>';
    	}
    }
function expense_by_category()
    {
    	if ($this->session->userdata('school_login') != 1)
    		redirect(base_url(), 'refresh');
        
    	$page_data['school_id'] = $this->session->userdata('school_id');
    	$page_data['page_name']  = 'expense_by_category';
    	$page_data['page_title'] = get_phrase('expense_by_category');
    	$this->load->view('backend/index', $page_data);
    }
function balance_sheet()
    {
    	if ($this->session->userdata('school_login') != 1)
    		redirect(base_url(), 'refresh');
        
    	$page_data['school_id'] = $this->session->userdata('school_id');
    	$page_data['page_name']  = 'balance_sheet';
    	$page_data['page_title'] = get_phrase('Balance_Sheet');
    	$this->load->view('backend/index', $page_data);
    }

function get_by_category($category) 
    {	
    	if ($this->session->userdata('school_login') != 1)
    		redirect(base_url(), 'refresh');
    	$running_year = $this->db->get_where('school' , array('school_id' =>$this->session->userdata('school_id')))->row()->running_year;
    	$expense = $this->db->get_where('payment',array('payment_type' => 'expense','expense_category_id' => $category,'year'=>$running_year))->result_array();
    	echo '<table class="table table-bordered datatable">';
    	echo '<thead><tr>';
    	echo '<th><div>Serial</div></th>';
    	echo '<th><div>Title</div></th>';
    	echo '<th><div>description</div></th>';
    	echo '<th><div>amount</div></th>';
    	echo '<th><div>Options</div></th>';
    	echo '</tr></thead>';
    	$count = 1;
    	$totalamount = 0;
    	foreach ($expense as $key) {
    		$url = base_url() . 'index.php?school/more_expense_info/' . $key['payment_id'];
    		echo '<tr><td>' . $count . '</td>';
    		echo '<td>' . $key['title'] . '</td>';
    		echo '<td>' . $key['description'] . '</td>';
    		$totalamount =$totalamount+ $key['amount'];
    		echo '<td>' . $key['amount'] . '</td>';
    		echo '<td><a href="' . $url . '" class="btn btn-info">Get More info</a></td>';
    		$count++;
    	}

    	echo '</table>';
    	echo '<b style="font-size:18px;">Total expense =' . $totalamount  . '</b>';
    }
function get_by_date($date) 
    { 	
    	if ($this->session->userdata('school_login') != 1)
    		redirect(base_url(), 'refresh');

    	$running_year = $this->db->get_where('school' , array('school_id' =>$this->session->userdata('school_id')))->row()->running_year;
    	$expense = $this->db->get_where('payment',array('payment_type' => 'expense','timestamp' => $date,'year'=>$running_year))->result_array();
    	echo '<table class="table table-bordered datatable">';
    	echo '<thead><tr>';
    	echo '<th><div>Serial</div></th>';
    	echo '<th><div>Title</div></th>';
    	echo '<th><div>description</div></th>';
    	echo '<th><div>amount</div></th>';
    	echo '<th><div>Options</div></th>';
    	echo '</tr></thead>';
    	$count = 1;
    	$totalamount = 0;
    	foreach ($expense as $key) {
    		$url = base_url() . 'index.php?school/more_info/' . $key['student_id'];
    		echo '<tr><td>' . $count . '</td>';
    		echo '<td>' . $key['title'] . '</td>';
    		echo '<td>' . $key['description'] . '</td>';
    		$totalamount =$totalamount+ $key['amount'];
    		echo '<td>' . $key['amount'] . '</td>';
    		echo '<td><a href="' . $url . '" class="btn btn-info">Get More info</a></td>';
    		$count++;
    	}

    	echo '</table>';
    	echo '<b style="font-size:18px;">Total expense =' . $totalamount  . '</b>';
    }

    //get info by number
        function get_by_number($number) 
    {	
    	if ($this->session->userdata('school_login') != 1)
    		redirect(base_url(), 'refresh');

    	$running_year = $this->db->get_where('school' , array('school_id' => $this->session->userdata('school_id')))->row()->running_year;
    	$student = $this->db->get_where('student' , array('phone' => $number,'school_id' => $this->session->userdata('school_id')))->result_array();
    	$count = 1;
    	echo '<table class="table table-bordered datatable">';
    	echo '<thead><tr>';
    	echo '<th><div>Serial</div></th>';
    	echo '<th><div>Name</div></th>';
    	echo '<th><div>Father name</div></th>';
    	echo '<th><div>Class</div></th>';
    	echo '<th><div>Options</div></th>';
    	echo '</tr></thead>';
    	foreach ($student as $key) {
    		$class_id = $this->db->get_where('enroll', array('student_id' => $key['student_id'],'school_id'=>$this->session->userdata('school_id')))->row()->class_id;
    		$url = base_url() . 'index.php?school/more_info/' . $key['student_id'];
    		$class_name = $this->db->get_where('class', array('class_id' => $class_id))->row()->name;
    		echo '<tr><td>' . $count . '</td>';
    		echo '<td>' . $key['name'] . '</td>';
    		echo '<td>' . $key['fathername'] . '</td>';
    		echo '<td>' . $class_name . '</td>';
    		echo '<td><a href="' . $url . '" class="btn btn-info">Get More info</a></td>';
    		$count++;
    	}

    	echo '</table>';
    }
//get info by SR number
    function get_by_srno($srno) 
    {	

    	if ($this->session->userdata('school_login') != 1)
    		redirect(base_url(), 'refresh');

    	$running_year = $this->db->get_where('school' , array('school_id' => $this->session->userdata('school_id')))->row()->running_year;
    	$student_id = $this->db->get_where('enroll' , array('srno' => $srno,'year' => $running_year,'school_id' =>$this->session->userdata('school_id')))->row()->student_id;
    	$student = $this->db->get_where('student', array('student_id' => $student_id,'school_id' =>$this->session->userdata('school_id')))->result_array();

    	$count = 1;
    	echo '<table class="table table-bordered datatable">';
    	echo '<thead><tr>';
    	echo '<th><div>Serial</div></th>';
    	echo '<th><div>Name</div></th>';
    	echo '<th><div>Father name</div></th>';
    	echo '<th><div>Class</div></th>';
    	echo '<th><div>Options</div></th>';
    	echo '</tr></thead>';
    	foreach ($student as $key) {
    		$class_id = $this->db->get_where('enroll', array('student_id' => $key['student_id'],'school_id'=>$this->session->userdata('school_id')))->row()->class_id;
    		$url = base_url() . 'index.php?school/more_info/' . $key['student_id'];
    		$class_name = $this->db->get_where('class', array('class_id' => $class_id,'school_id'=>$this->session->userdata('school_id')))->row()->name;
    		echo '<tr><td>' . $count . '</td>';
    		echo '<td>' . $key['name'] . '</td>';
    		echo '<td>' . $key['fathername'] . '</td>';
    		echo '<td>' . $class_name . '</td>';
    		echo '<td><a href="' . $url . '" class="btn btn-info">Get More info</a></td>';
    		$count++;
    	}

    	echo '</table>';
    }

    //teacher salary
    function get_teacher_salary($teacher_id) 
    {	

    	if ($this->session->userdata('school_login') != 1)
    		redirect(base_url(), 'refresh');
    	if (is_null($teacher_id)) {
    		return 0;
    	}
    	$running_year = $this->db->get_where('school' , array('school_id' => $this->session->userdata('school_id')))->row()->running_year;
    	$payment = $this->db->get_where('payment', array('teacher_id' => $teacher_id))->result_array();

    	$count = 1;
    	echo '<table class="table table-bordered datatable">';
    	echo '<thead><tr>';
    	echo '<th><div>Serial</div></th>';
    	echo '<th><div>Name</div></th>';
    	echo '<th><div>amount</div></th>';
    	echo '<th><div>Date</div></th>';
    	echo '</tr></thead>';
    	$amount = 0;
    	foreach ($payment as $key) {
    		$teacher = $this->db->get_where('teacher', array('teacher_id' => $teacher_id))->row()->name;
    		echo '<tr><td>' . $count . '</td>';
    		echo '<td>' . $teacher . '</td>';
    		$amount = $amount+$key['amount'];
    		echo '<td>' . $key['amount'] . '</td>';
    		echo '<td>' . date('d-m-Y',$key['timestamp']) . '</td>';
    		
    		$count++;
    	}

    	echo '</table>';
    	echo "Total Amount Paid to this Teacher is : " . $amount;
    }
    //more info
 function more_info($student_id)
    {	

    	if ($this->session->userdata('school_login') != 1)
    		redirect(base_url(), 'refresh');
        
    	$page_data['school_id'] = $this->session->userdata('school_id');
    	$page_data['page_name']  = 'more_info';
    	$page_data['page_title'] = get_phrase('more_info');
    	$page_data['student_id']   = $student_id;
    	$this->load->view('backend/index', $page_data);
    }


    // tracher salary
    function teacher_salary($teacher_id)
    {
    	if ($this->session->userdata('school_login') != 1)
    		redirect(base_url(), 'refresh');
        
    	$page_data['school_id'] = $this->session->userdata('school_id');
    	$page_data['page_name']  = 'teacher_salary';
    	$page_data['page_title'] = get_phrase('teacher salary');
    	$page_data['teacher_id']   = $teacher_id;
    	$this->load->view('backend/index', $page_data);
    }
    //
    function update_salary($teacher_id)
    {	

    	if ($this->session->userdata('school_login') != 1)
    		redirect(base_url(), 'refresh');

    	$data['teacher_id'] = $this->input->post('teacher_id');
    	$data['amount'] = $this->input->post('amount');
    	$data['school_id'] = $this->session->userdata('school_id');
    	$data['timestamp'] = strtotime(str_replace('/', '-', $this->input->post('date')));
    	$data['expense_category_id'] =$this->input->post('expense_category_id');
    	$data['description'] = 'Teacher Salary';
    	$data['payment_type'] = 'expense';
    	$data['title'] =  'Teacher salary';
    	$data['year'] = $this->db->get_where('school',array('school_id'=>$this->session->userdata('school_id')))->row()->running_year;
	$this->db->insert('payment', $data);
	$this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
    	redirect(base_url() . 'index.php?school/teacher_salary/', 'refresh');

    }
    // ACADEMIC SYLLABUS
    function academic_syllabus($class_id = '')
    {
    	if ($this->session->userdata('school_login') != 1)
    		redirect(base_url(), 'refresh');
        // detect the first class
    	if ($class_id == '')
    		$class_id           =   $this->db->get_where('class', array('school_id' => $this->session->userdata('school_id')))->first_row()->class_id;
    	$page_data['school_id'] = $this->session->userdata('school_id');
    	$page_data['page_name']  = 'academic_syllabus';
    	$page_data['page_title'] = get_phrase('academic_syllabus');
    	$page_data['class_id']   = $class_id;
    	$this->load->view('backend/index', $page_data);
    }

    function upload_academic_syllabus()
    {	

    	if ($this->session->userdata('school_login') != 1)
    		redirect(base_url(), 'refresh');

    	$data['academic_syllabus_code'] =   substr(md5(rand(0, 1000000)), 0, 7);
    	$data['title']                  =   $this->input->post('title');
    	$data['description']            =   $this->input->post('description');
    	$data['class_id']               =   $this->input->post('class_id');
    	$data['subject_id']             =   $this->input->post('subject_id');
    	$data['uploader_type']          =   $this->session->userdata('login_type');
    	$data['uploader_id']            =   $this->session->userdata('login_user_id');
    	$data['year']                   =   $this->db->get_where('settings',array('type'=>'running_year'))->row()->description;
    	$data['school_id'] = $this->session->userdata('school_id');
    	$data['timestamp']              =   date("d/m/Y");
    	$files = $_FILES['file_name'];
    	$this->load->library('upload');
    	$config['upload_path']   =  'uploads/syllabus/';
    	$config['allowed_types'] =  '*';
    	$_FILES['file_name']['name']     = $files['name'];
    	$_FILES['file_name']['type']     = $files['type'];
    	$_FILES['file_name']['tmp_name'] = $files['tmp_name'];
    	$_FILES['file_name']['size']     = $files['size'];
    	$this->upload->initialize($config);
    	$this->upload->do_upload('file_name');

    	$data['file_name'] = $_FILES['file_name']['name'];

    	$this->db->insert('academic_syllabus', $data);
    	$this->session->set_flashdata('flash_message' , get_phrase('syllabus_uploaded'));
    	redirect(base_url() . 'index.php?school/academic_syllabus/' . $data['class_id'] , 'refresh');

    }

    function download_academic_syllabus($academic_syllabus_code)
    {	

    	if ($this->session->userdata('school_login') != 1)
    		redirect(base_url(), 'refresh');

    	$file_name = $this->db->get_where('academic_syllabus', array(
    		'academic_syllabus_code' => $academic_syllabus_code
    	))->row()->file_name;
    	$this->load->helper('download');
    	$data = file_get_contents("uploads/syllabus/" . $file_name);
    	$name = $file_name;

    	force_download($name, $data);
    }

    /****MANAGE SECTIONS*****/
    function section($class_id = '')
    {
    	if ($this->session->userdata('school_login') != 1)
    		redirect(base_url(), 'refresh');
        // detect the first class
    	if ($class_id == '')
    		$class_id           =   $this->db->get('class')->first_row()->class_id;
    	$page_data['school_id'] = $this->session->userdata('school_id');
    	$page_data['page_name']  = 'section';
    	$page_data['page_title'] = get_phrase('manage_sections');
    	$page_data['class_id']   = $class_id;
    	$this->load->view('backend/index', $page_data);    
    }

    function sections($param1 = '' , $param2 = '')
    {
    	if ($this->session->userdata('school_login') != 1)
    		redirect(base_url(), 'refresh');
    	if ($param1 == 'create') {
    		$data['school_id'] = $this->session->userdata('school_id');
    		$data['name']       =   $this->input->post('name');
    		$data['nick_name']  =   $this->input->post('nick_name');
    		$data['class_id']   =   $this->input->post('class_id');
    		$data['teacher_id'] =   $this->input->post('teacher_id');
    		$this->db->insert('section' , $data);
    		$this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
    		redirect(base_url() . 'index.php?school/section/' . $data['class_id'] , 'refresh');
    	}

    	if ($param1 == 'edit') {
    		$data['name']       =   $this->input->post('name');
    		$data['nick_name']  =   $this->input->post('nick_name');
    		$data['class_id']   =   $this->input->post('class_id');
    		$data['school_id'] = $this->session->userdata('school_id');
    		$data['teacher_id'] =   $this->input->post('teacher_id');
    		$this->db->where('section_id' , $param2);
    		$this->db->update('section' , $data);
    		$this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
    		redirect(base_url() . 'index.php?school/section/' . $data['class_id'] , 'refresh');
    	}

    	if ($param1 == 'delete') {
    		$this->db->where('section_id' , $param2);
    		$this->db->delete('section');
    		$this->session->set_flashdata('flash_message' , get_phrase('data_deleted'));
    		redirect(base_url() . 'index.php?school/section' , 'refresh');
    	}
    }

    function get_class_section($class_id)
    {	
    	if ($this->session->userdata('school_login') != 1)
    		redirect(base_url(), 'refresh');

    	$sections = $this->db->get_where('section' , array(
    		'class_id' => $class_id
    	))->result_array();
    	foreach ($sections as $row) {
    		echo '<option value="' . $row['section_id'] . '">' . $row['name'] . '</option>';
    	}
    }

    function get_class_subject($class_id)
    {	
    	if ($this->session->userdata('school_login') != 1)
    		redirect(base_url(), 'refresh');

    	$subjects = $this->db->get_where('subject' , array(
    		'class_id' => $class_id
    	))->result_array();
    	foreach ($subjects as $row) {
    		echo '<option value="' . $row['subject_id'] . '">' . $row['name'] . '</option>';
    	}
    }

    function get_class_students($class_id)
    {
    	$students = $this->db->get_where('enroll' , array(
    		'class_id' => $class_id , 'year' => $this->db->get_where('school' , array('school_id' => $this->session->userdata('school_id')))->row()->running_year
    	))->result_array();
    	foreach ($students as $row) {
    		$name = $this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->name;
    		echo '<option value="' . $row['student_id'] . '">' . $name . '</option>';
    	}
    }

    function get_class_students_mass($class_id)
    {
    	$students = $this->db->get_where('enroll' , array(
    		'class_id' => $class_id , 'year' => $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description
    	))->result_array();
    	echo '<div class="form-group">
    	<label class="col-sm-3 control-label">' . get_phrase('students') . '</label>
    	<div class="col-sm-9">';
    	foreach ($students as $row) {
    		$name = $this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->name;
    		echo '<div class="checkbox">
    		<label><input type="checkbox" class="check" name="student_id[]" value="' . $row['student_id'] . '">' . $name .'</label>
    		</div>';
    	}
    	echo '<br><button type="button" class="btn btn-default" onClick="select()">'.get_phrase('select_all').'</button>';
    	echo '<button style="margin-left: 5px;" type="button" class="btn btn-default" onClick="unselect()"> '.get_phrase('select_none').' </button>';
    	echo '</div></div>';
    }



    /****MANAGE EXAMS*****/
    function exam($param1 = '', $param2 = '' , $param3 = '')
    {
    	if ($this->session->userdata('school_login') != 1)
    		redirect(base_url(), 'refresh');
    	if ($param1 == 'create') {
    		$data['name']    = $this->input->post('name');
    		$data['class_id']    = $this->input->post('class_id');
    		$data['maxmarks']    = $this->input->post('maxmarks');
    		$data['school_id'] = $this->session->userdata('school_id');
        //$data['comment'] = $this->input->post('comment');
    		$data['year']    = $this->db->get_where('school' , array('school_id' => $this->session->userdata('school_id')))->row()->running_year;
    		$this->db->insert('exam', $data);
    		$this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
    		redirect(base_url() . 'index.php?school/exam/', 'refresh');
    	}
    	if ($param1 == 'edit' && $param2 == 'do_update') {
    		$data['name']    = $this->input->post('name');
    		$data['maxmarks']    = $this->input->post('maxmarks');
    		$data['class_id']    = $this->input->post('class_id');
    		$data['school_id'] = $this->session->userdata('school_id');
    		$data['year']    = $this->db->get_where('school' , array('school_id' => $this->session->userdata('school_id')))->row()->running_year;

    		$this->db->where('exam_id', $param3);
    		$this->db->update('exam', $data);
    		$this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
    		redirect(base_url() . 'index.php?school/exam/', 'refresh');
    	} else if ($param1 == 'edit') {
    		$page_data['edit_data'] = $this->db->get_where('exam', array(
    			'exam_id' => $param2
    		))->result_array();
    	}
    	if ($param1 == 'delete') {
    		$this->db->where('exam_id', $param2);
    		$this->db->delete('exam');
    		$this->session->set_flashdata('flash_message' , get_phrase('data_deleted'));
    		redirect(base_url() . 'index.php?school/exam/', 'refresh');
    	}
    	$page_data['exams']      = $this->db->get_where('exam', array('school_id' => $this->session->userdata('school_id')))->result_array();
    	$page_data['page_name']  = 'exam';
    	$page_data['page_title'] = get_phrase('manage_exam');
    	$this->load->view('backend/index', $page_data);
    }

    /****** SEND EXAM MARKS VIA SMS ********/
    function exam_marks_sms($param1 = '' , $param2 = '')
    {
    	if ($this->session->userdata('school_login') != 1)
    		redirect(base_url(), 'refresh');

    	if ($param1 == 'send_sms') {

    		$exam_id    =   $this->input->post('exam_id');
    		$class_id   =   $this->input->post('class_id');
    		$receiver   =   $this->input->post('receiver');
    		$running_year = $this->db->get_where('school' , array('school_id' => $this->session->userdata('school_id')))->row()->running_year;
    		$school_name = $this->db->get_where('school' , array('school_id' => $this->session->userdata('school_id')))->row()->school_name;
    		$sms_api = $this->db->get_where('school' , array('school_id' => $this->session->userdata('school_id')))->row()->school_sms_api;
    		$sms_sender_id = $this->db->get_where('school' , array('school_id' => $this->session->userdata('school_id')))->row()->school_sender_id;

            // get all the students of the selected class
    		$students = $this->db->get_where('enroll' , array('class_id' => $class_id,'year' => $running_year))->result_array();
            // get the marks of the student for selected exam
    		foreach ($students as $row1) {
    			$sum = 0;
    			$receiver_phone = $this->db->get_where('student' , array('student_id' => $row1['student_id']))->row()->phone;
    			$result = $this->db->get_where('mark', array('student_id' => $row1['student_id'], 'exam_id' => $exam_id, 'year' =>  $running_year))->result_array();
    			foreach ($result as $key) {
    				$sum = $sum + $key['mark_obtained'];
    			}
    			$rank = $this->db->get_where('enroll' , array('student_id' => $row1['student_id']))->row()->rank;
    			
    			$student_name = $this->db->get_where('student' , array('student_id' => $row1['student_id']))->row()->name;
    			$message = $school_name . ', Dear ' . $student_name . ', your obtained marks is ' . $sum . ' rank is ' . $rank ;
    			$url= "http://sms.parkentechnology.com/httpapi/httpapi?token=".urlencode($sms_api)."&sender=".urlencode($sms_sender_id)."&number=".urlencode($receiver_phone)."&route=2&type=1&sms=".urlencode($message);
            
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $curl_scraped_page = curl_exec($ch);
            curl_close($ch);
    		}
			$this->session->set_flashdata('flash_message' , get_phrase('message_sent'));
    		redirect(base_url() . 'index.php?school/exam_marks_sms' , 'refresh');
    	}

    	$page_data['page_name']  = 'exam_marks_sms';
    	$page_data['page_title'] = get_phrase('send_marks_by_sms');
    	$this->load->view('backend/index', $page_data);
    }

    /****MANAGE EXAM MARKS*****/
    function marks2($exam_id = '', $class_id = '', $subject_id = '')
    {
    	if ($this->session->userdata('school_login') != 1)
    		redirect(base_url(), 'refresh');

    	if ($this->input->post('operation') == 'selection') {
    		$page_data['exam_id']    = $this->input->post('exam_id');
    		$page_data['class_id']   = $this->input->post('class_id');
    		$page_data['subject_id'] = $this->input->post('subject_id');

    		if ($page_data['exam_id'] > 0 && $page_data['class_id'] > 0 && $page_data['subject_id'] > 0) {
    			redirect(base_url() . 'index.php?school/marks2/' . $page_data['exam_id'] . '/' . $page_data['class_id'] . '/' . $page_data['subject_id'], 'refresh');
    		} else {
    			$this->session->set_flashdata('mark_message', 'Choose exam, class and subject');
    			redirect(base_url() . 'index.php?school/marks2/', 'refresh');
    		}
    	}
    	if ($this->input->post('operation') == 'update') {
    		$students = $this->db->get_where('enroll' , array('class_id' => $class_id , 'year' => $running_year))->result_array();
    		foreach($students as $row) {
    			$data['mark_obtained'] = $this->input->post('mark_obtained_' . $row['student_id']);
    			$data['comment']       = $this->input->post('comment_' . $row['student_id']);

    			$this->db->where('mark_id', $this->input->post('mark_id_' . $row['student_id']));
    			$this->db->update('mark', array('mark_obtained' => $data['mark_obtained'] , 'comment' => $data['comment']));
    		}
    		$this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
    		redirect(base_url() . 'index.php?school/marks2/' . $this->input->post('exam_id') . '/' . $this->input->post('class_id') . '/' . $this->input->post('subject_id'), 'refresh');
    	}
    	$page_data['exam_id']    = $exam_id;
    	$page_data['class_id']   = $class_id;
    	$page_data['subject_id'] = $subject_id;

    	$page_data['page_info'] = 'Exam marks';

    	$page_data['page_name']  = 'marks2';
    	$page_data['page_title'] = get_phrase('manage_exam_marks');
    	$this->load->view('backend/index', $page_data);
    }

    function marks_manage()
    {
    	if ($this->session->userdata('school_login') != 1)
    		redirect(base_url(), 'refresh');
    	$page_data['page_name']  =   'marks_manage';
    	$page_data['page_title'] = get_phrase('manage_exam_marks');
    	$this->load->view('backend/index', $page_data);
    }

    function marks_manage_view($exam_id = '' , $class_id = '' , $section_id = '' , $subject_id = '')
    {
    	if ($this->session->userdata('school_login') != 1)
    		redirect(base_url(), 'refresh');
    	$page_data['exam_id']    =   $exam_id;
    	$page_data['class_id']   =   $class_id;
    	$page_data['subject_id'] =   $subject_id;
    	$page_data['section_id'] =   $section_id;
    	$page_data['page_name']  =   'marks_manage_view';
    	$page_data['page_title'] = get_phrase('manage_exam_marks');
    	$this->load->view('backend/index', $page_data);
    }

    function marks_selector()
    {
    	if ($this->session->userdata('school_login') != 1)
    		redirect(base_url(), 'refresh');

    	$data['exam_id']    = $this->input->post('exam_id');
    	$data['class_id']   = $this->input->post('class_id');
    	$data['school_id']	= $this->session->userdata('school_id');
    	$data['section_id'] = $this->input->post('section_id');
    	$data['subject_id'] = $this->input->post('subject_id');
    	$data['year']       = $this->db->get_where('settings' , array('type'=>'running_year'))->row()->description;
    	$query = $this->db->get_where('mark' , array(
    		'exam_id' => $data['exam_id'],
    		'school_id' => $this->session->userdata('school_id'),
    		'class_id' => $data['class_id'],
    		'section_id' => $data['section_id'],
    		'subject_id' => $data['subject_id'],
    		'year' => $data['year']
    	));
    	if($query->num_rows() < 1) {
    		$students = $this->db->get_where('enroll' , array(
    			'class_id' => $data['class_id'] , 'section_id' => $data['section_id'] , 'year' => $data['year']
    		,'school_id' => $this->session->userdata('school_id')))->result_array();
    		foreach($students as $row) {
    			$data['student_id'] = $row['student_id'];

    			$this->db->insert('mark' , $data);
    		}
    	}
    	redirect(base_url() . 'index.php?school/marks_manage_view/' . $data['exam_id'] . '/' . $data['class_id'] . '/' . $data['section_id'] . '/' . $data['subject_id'] , 'refresh');

    }

    function marks_update($exam_id = '' , $class_id = '' , $section_id = '' , $subject_id = '')
    {
    	$running_year = $this->db->get_where('school' , array('school_id' => $this->session->userdata('school_id')))->row()->running_year;
    	$marks_of_students = $this->db->get_where('mark' , array(
    		'exam_id' => $exam_id,
    		'class_id' => $class_id,
    		'section_id' => $section_id,
    		'year' => $running_year,
    		'subject_id' => $subject_id,
    		'school_id'	=> $this->session->userdata('school_id')
    	))->result_array();

    	$subject_type = $this->db->get_where('subject' , array('subject_id' => $subject_id))->row()->type;


    	foreach($marks_of_students as $row) {
    		$obtained_marks = $this->input->post('marks_obtained_'.$row['mark_id']);
    		$comment = $this->input->post('comment_'.$row['mark_id']);
    		$this->db->where('mark_id' , $row['mark_id']);
    		$this->db->update('mark' , array('mark_obtained' => $obtained_marks , 'comment' => $comment , 'subject_type' => $subject_type));
    	}
    	$this->session->set_flashdata('flash_message' , get_phrase('marks_updated'));
    	redirect(base_url().'index.php?school/marks_manage_view/'.$exam_id.'/'.$class_id.'/'.$section_id.'/'.$subject_id , 'refresh');
    }


function insert_new_student($class_id = '',$section_id = '' , $student_id = '')
    {
    	$running_year = $this->db->get_where('school' , array('school_id' => $this->session->userdata('school_id')))->row()->running_year;
    	$exam = $this->db->get_where('exam', array('class_id' => $class_id))->result_array();
    	$subject = $this->db->get_where('subject', array('class_id' => $class_id))->result_array();

    	foreach ($exam_id as $row1) {
    		foreach ($subject as $row2) {
    			$data['student_id'] = $student_id;
    			$data['subject_id'] = $subject_id;
    			$data['subject_type'] = $row2['type'];
    			$data['class_id'] = $class_id;
    			$data['section_id'] = $section_id;
    			$data['exam_id'] = $row1['exam_id'];
    			$data['year'] = $running_year;
    			$this->db->insert('mark',$data);
    		}
    	}

    	
    	$this->session->set_flashdata('flash_message' , get_phrase('marks_updated'));
    	redirect(base_url().'index.php?school/marks_manage_view/'.$exam_id.'/'.$class_id.'/'.$section_id.'/'.$subject_id , 'refresh');
    }


 
    // TABULATION SHEET
    function tabulation_sheet($class_id = '', $section_id , $exam_id = '') {
    	if ($this->session->userdata('school_login') != 1)
    		redirect(base_url(), 'refresh');

    	if ($this->input->post('operation') == 'selection') {
    		$page_data['exam_id']    = $this->input->post('exam_id');
    		$page_data['class_id']   = $this->input->post('class_id');
    		$page_data['section_id']   = $this->input->post('section_id');

    		if ($page_data['exam_id'] > 0 && $page_data['class_id'] > 0) {
    			redirect(base_url() . 'index.php?school/tabulation_sheet/' . $page_data['class_id'] . '/'. $page_data['section_id'] . '/'. $page_data['exam_id'] , 'refresh');
    		} else {
    			$this->session->set_flashdata('mark_message', 'Choose class and exam');
    			redirect(base_url() . 'index.php?school/tabulation_sheet/', 'refresh');
    		}
    	}
    	$page_data['exam_id']    = $exam_id;
    	$page_data['class_id']   = $class_id;
    	$page_data['section_id']   = $section_id;
    	$page_data['page_info'] = 'Exam marks';

    	$page_data['page_name']  = 'tabulation_sheet';
    	$page_data['page_title'] = get_phrase('tabulation_sheet');
    	$this->load->view('backend/index', $page_data);

    }

    function tabulation_sheet_print_view($class_id,$section_id , $exam_id) {
    	if ($this->session->userdata('school_login') != 1)
    		redirect(base_url(), 'refresh');
    	$page_data['class_id'] = $class_id;
    	$page_data['exam_id']  = $exam_id;
    	$page_data['section_id']  = $section_id;
    	$this->load->view('backend/school/tabulation_sheet_print_view' , $page_data);
    }

	function marks_get_subject($class_id)
    {
    	$page_data['class_id'] = $class_id;
    	$this->load->view('backend/school/marks_get_subject' , $page_data);
    }

    function marks_get_section($class_id)
    {
    	$page_data['class_id'] = $class_id;
    	$this->load->view('backend/school/marks_get_section' , $page_data);
    }
    function marks_get_exam($class_id)
    {
    	$page_data['class_id'] = $class_id;
    	$this->load->view('backend/school/marks_get_exam' , $page_data);
    }


    /****MANAGE GRADES*****/
    function grade($param1 = '', $param2 = '')
    {
    	if ($this->session->userdata('school_login') != 1)
    		redirect(base_url(), 'refresh');
    	if ($param1 == 'create') {
    		$data['name']        = $this->input->post('name');
    		$data['grade_point'] = $this->input->post('grade_point');
    		$data['mark_from']   = $this->input->post('mark_from');
    		$data['mark_upto']   = $this->input->post('mark_upto');
    		$data['comment']     = $this->input->post('comment');
    		$data['school_id']	= $this->session->userdata('school_id');
    		$this->db->insert('grade', $data);
    		$this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
    		redirect(base_url() . 'index.php?school/grade/', 'refresh');
    	}
    	if ($param1 == 'do_update') {
    		$data['name']        = $this->input->post('name');
    		$data['grade_point'] = $this->input->post('grade_point');
    		$data['mark_from']   = $this->input->post('mark_from');
    		$data['mark_upto']   = $this->input->post('mark_upto');
    		$data['comment']     = $this->input->post('comment');
    		$data['school_id']	= $this->session->userdata('school_id');
    		$this->db->where('grade_id', $param2);
    		$this->db->update('grade', $data);
    		$this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
    		redirect(base_url() . 'index.php?school/grade/', 'refresh');
    	} else if ($param1 == 'edit') {
    		$page_data['edit_data'] = $this->db->get_where('grade', array(
    			'grade_id' => $param2
    		))->result_array();
    	}
    	if ($param1 == 'delete') {
    		$this->db->where('grade_id', $param2);
    		$this->db->delete('grade');
    		$this->session->set_flashdata('flash_message' , get_phrase('data_deleted'));
    		redirect(base_url() . 'index.php?school/grade/', 'refresh');
    	}
    	$page_data['grades']     = $this->db->get_where('grade', array('school_id' => $this->session->userdata('school_id')))->result_array();
    	$page_data['page_name']  = 'grade';
    	$page_data['page_title'] = get_phrase('manage_grade');
    	$this->load->view('backend/index', $page_data);
    }

    /**********MANAGING CLASS ROUTINE******************/
    function class_routine($param1 = '', $param2 = '', $param3 = '')
    {
    	if ($this->session->userdata('school_login') != 1)
    		redirect(base_url(), 'refresh');
    	if ($param1 == 'create') {
    		$data['class_id']       = $this->input->post('class_id');
    		if($this->input->post('section_id') != '') {
    			$data['section_id'] = $this->input->post('section_id');
    		}
    		$data['school_id'] = $this->session->userdata('school_id');
    		$data['subject_id']     = $this->input->post('subject_id');
    		$data['time_start']     = $this->input->post('time_start') + (12 * ($this->input->post('starting_ampm') - 1));
    		$data['time_end']       = $this->input->post('time_end') + (12 * ($this->input->post('ending_ampm') - 1));
    		$data['time_start_min'] = $this->input->post('time_start_min');
    		$data['time_end_min']   = $this->input->post('time_end_min');
    		$data['day']            = $this->input->post('day');
    		$data['year']           = $this->db->get_where('school' , array('school_id' => $this->session->userdata('school_id')))->row()->running_year;
    		$this->db->insert('class_routine', $data);
    		$this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
    		redirect(base_url() . 'index.php?school/class_routine_add/', 'refresh');
    	}
    	if ($param1 == 'do_update') {
    		$data['class_id']       = $this->input->post('class_id');
    		if($this->input->post('section_id') != '') {
    			$data['section_id'] = $this->input->post('section_id');
    		}
    		$data['school_id'] = $this->session->userdata('school_id');
    		$data['subject_id']     = $this->input->post('subject_id');
    		$data['time_start']     = $this->input->post('time_start') + (12 * ($this->input->post('starting_ampm') - 1));
    		$data['time_end']       = $this->input->post('time_end') + (12 * ($this->input->post('ending_ampm') - 1));
    		$data['time_start_min'] = $this->input->post('time_start_min');
    		$data['time_end_min']   = $this->input->post('time_end_min');
    		$data['day']            = $this->input->post('day');
    		$data['year']           = $this->db->get_where('school' , array('school_id' => $this->session->userdata('school_id')))->row()->running_year;

    		$this->db->where('class_routine_id', $param2);
    		$this->db->update('class_routine', $data);
    		$this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
    		redirect(base_url() . 'index.php?school/class_routine_view/' . $data['class_id'], 'refresh');
    	} else if ($param1 == 'edit') {
    		$page_data['edit_data'] = $this->db->get_where('class_routine', array(
    			'class_routine_id' => $param2
    		))->result_array();
    	}
    	if ($param1 == 'delete') {
    		$class_id = $this->db->get_where('class_routine' , array('class_routine_id' => $param2))->row()->class_id;
    		$this->db->where('class_routine_id', $param2);
    		$this->db->delete('class_routine');
    		$this->session->set_flashdata('flash_message' , get_phrase('data_deleted'));
    		redirect(base_url() . 'index.php?school/class_routine_view/' . $class_id, 'refresh');
    	}

    }

    function class_routine_add()
    {
    	if ($this->session->userdata('school_login') != 1)
    		redirect(base_url(), 'refresh');
    	$page_data['page_name']  = 'class_routine_add';
    	$page_data['page_title'] = get_phrase('add_class_routine');
    	$this->load->view('backend/index', $page_data);
    }

    function class_routine_view($class_id)
    {
    	if ($this->session->userdata('school_login') != 1)
    		redirect(base_url(), 'refresh');
    	$page_data['page_name']  = 'class_routine_view';
    	$page_data['class_id']  =   $class_id;
    	$page_data['page_title'] = get_phrase('class_routine');
    	$this->load->view('backend/index', $page_data);
    }

    function class_routine_print_view($class_id , $section_id)
    {
    	if ($this->session->userdata('school_login') != 1)
    		redirect('login', 'refresh');
    	$page_data['class_id']   =   $class_id;
    	$page_data['section_id'] =   $section_id;
    	$this->load->view('backend/school/class_routine_print_view' , $page_data);
    }

    function get_class_section_subject($class_id)
    {
    	$page_data['class_id'] = $class_id;
    	$this->load->view('backend/school/class_routine_section_subject_selector' , $page_data);
    }

    function section_subject_edit($class_id , $class_routine_id)
    {
    	$page_data['class_id']          =   $class_id;
    	$page_data['class_routine_id']  =   $class_routine_id;
    	$this->load->view('backend/school/class_routine_section_subject_edit' , $page_data);
    }

    function manage_attendance()
    {
    	if($this->session->userdata('school_login')!=1)
    		redirect(base_url() , 'refresh');

    	$page_data['page_name']  =  'manage_attendance';
    	$page_data['page_title'] =  get_phrase('manage_attendance_of_class');
    	$this->load->view('backend/index', $page_data);
    }

    function manage_attendance_view($class_id = '' , $section_id = '' , $timestamp = '')
    {
    	if($this->session->userdata('school_login')!=1)
    		redirect(base_url() , 'refresh');
    	$class_name = $this->db->get_where('class' , array(
    		'class_id' => $class_id
    	))->row()->name;
    	$page_data['class_id'] = $class_id;
    	$page_data['timestamp'] = $timestamp;
    	$page_data['page_name'] = 'manage_attendance_view';
    	$section_name = $this->db->get_where('section' , array(
    		'section_id' => $section_id
    	))->row()->name;
    	$page_data['section_id'] = $section_id;
    	$page_data['page_title'] = get_phrase('manage_attendance_of_class') . ' ' . $class_name . ' : ' . get_phrase('section') . ' ' . $section_name;
    	$this->load->view('backend/index', $page_data);
    }
    function get_section($class_id) {
    	$page_data['class_id'] = $class_id; 
    	$this->load->view('backend/school/manage_attendance_section_holder' , $page_data);
    }
    function attendance_selector()
    {
    	$data['class_id']   = $this->input->post('class_id');
    	$data['year']       = $this->input->post('year');
    	$data['timestamp']  = strtotime($this->input->post('timestamp'));
    	$data['section_id'] = $this->input->post('section_id');
    	$data['school_id']	= $this->session->userdata('school_id');
    	$query = $this->db->get_where('attendance' ,array(
    		'class_id'=>$data['class_id'],
    		'section_id'=>$data['section_id'],
    		'year'=>$data['year'],
    		'timestamp'=>$data['timestamp'],'school_id'=>$this->session->userdata('school_id')
    	));
    	if($query->num_rows() < 1) {
    		$students = $this->db->get_where('enroll' , array(
    			'class_id' => $data['class_id'] , 'section_id' => $data['section_id'] , 'year' => $data['year']
    		,'school_id'=>$this->session->userdata('school_id')))->result_array();

    		foreach($students as $row) {
    			$attn_data['class_id']   = $data['class_id'];
    			$attn_data['year']       = $data['year'];
    			$attn_data['school_id']	 = $this->session->userdata('school_id');
    			$attn_data['timestamp']  = $data['timestamp'];
    			$attn_data['section_id'] = $data['section_id'];
    			$attn_data['student_id'] = $row['student_id'];
    			$this->db->insert('attendance' , $attn_data);  
    		}

    	}
    	redirect(base_url().'index.php?school/manage_attendance_view/'.$data['class_id'].'/'.$data['section_id'].'/'.$data['timestamp'],'refresh');
    }

    function attendance_update($class_id = '' , $section_id = '' , $timestamp = '')
    {
    	$running_year = $this->db->get_where('school' , array('school_id' => $this->session->userdata('school_id')))->row()->running_year;
    	//$active_sms_service = $this->db->get_where('settings' , array('type' => 'active_sms_service'))->row()->description;
    	$attendance_of_students = $this->db->get_where('attendance', array(
                                'class_id' => $class_id,
                                'section_id' => $section_id,
                                'year' => $running_year,
                                'school_id' =>$this->session->userdata('school_id'),
                                'timestamp' => $timestamp
                            ))->result_array();
    	foreach($attendance_of_students as $row) {
    		$attendance_status = $this->input->post('status_'.$row['attendance_id']);
    		$this->db->where('attendance_id' , $row['attendance_id']);
    		$this->db->update('attendance' , array('status' => $attendance_status));

    		// if ($attendance_status == 2) {

    		// 	if ($active_sms_service != '' || $active_sms_service != 'disabled') {
    		// 		$student_name   = $this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->name;
    		// 		$parent_id      = $this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->parent_id;
    		// 		$receiver_phone = $this->db->get_where('parent' , array('parent_id' => $parent_id))->row()->phone;
    		// 		$message        = 'Your child' . ' ' . $student_name . 'is absent today.';
    		// 		$this->sms_model->send_sms($message,$receiver_phone);
    		// 	}
    		// }
    	}
    	$this->session->set_flashdata('flash_message' , get_phrase('attendance_updated'));
    	redirect(base_url().'index.php?school/manage_attendance_view/'.$class_id.'/'.$section_id.'/'.$timestamp , 'refresh');
    }

    /****** DAILY ATTENDANCE *****************/
    function manage_attendance2($date='',$month='',$year='',$class_id='' , $section_id = '' , $session = '')
    {
    	if($this->session->userdata('school_login')!=1)
    		redirect(base_url() , 'refresh');

    	$active_sms_service = $this->db->get_where('settings' , array('type' => 'active_sms_service'))->row()->description;
    	$running_year = $this->db->get_where('school' , array('school_id' => $this->session->userdata('school_id')))->row()->running_year;


    	if($_POST)
    	{
			// Loop all the students of $class_id
    		$this->db->where('class_id' , $class_id);
    		if($section_id != '') {
    			$this->db->where('section_id' , $section_id);
    		}
            //$session = base64_decode( urldecode( $session ) );
    		$this->db->where('year' , $session);
    		$students = $this->db->get('enroll')->result_array();
    		foreach ($students as $row)
    		{
    			$attendance_status  =   $this->input->post('status_' . $row['student_id']);

    			$this->db->where('student_id' , $row['student_id']);
    			$this->db->where('date' , $date);
    			$this->db->where('year' , $year);
    			$this->db->where('class_id' , $row['class_id']);
    			if($row['section_id'] != '' && $row['section_id'] != 0) {
    				$this->db->where('section_id' , $row['section_id']);
    			}
    			$this->db->where('session' , $session);

    			$this->db->update('attendance' , array('status' => $attendance_status));

    			if ($attendance_status == 2) {

    				if ($active_sms_service != '' || $active_sms_service != 'disabled') {
    					$student_name   = $this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->name;
    					$parent_id      = $this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->parent_id;
    					$receiver_phone = $this->db->get_where('parent' , array('parent_id' => $parent_id))->row()->phone;
    					$message        = 'Your child' . ' ' . $student_name . 'is absent today.';
    					$this->sms_model->send_sms($message,$receiver_phone);
    				}
    			}

    		}

    		$this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
    		redirect(base_url() . 'index.php?school/manage_attendance/'.$date.'/'.$month.'/'.$year.'/'.$class_id.'/'.$section_id.'/'.$session , 'refresh');
    	}
    	$page_data['date']       =	$date;
    	$page_data['month']      =	$month;
    	$page_data['year']       =	$year;
    	$page_data['class_id']   =  $class_id;
    	$page_data['section_id'] =  $section_id;
    	$page_data['session']    =  $session;

    	$page_data['page_name']  =	'manage_attendance';
    	$page_data['page_title'] =	get_phrase('manage_daily_attendance');
    	$this->load->view('backend/index', $page_data);
    }
    function attendance_selector2()
    {
        //$session = $this->input->post('session');
        //$encoded_session = urlencode( base64_encode( $session ) );
    	redirect(base_url() . 'index.php?school/manage_attendance/'.$this->input->post('date').'/'.
    		$this->input->post('month').'/'.
    		$this->input->post('year').'/'.
    		$this->input->post('class_id').'/'.
    		$this->input->post('section_id').'/'.
    		$this->input->post('session') , 'refresh');
    }
        ///////ATTENDANCE REPORT /////
    function attendance_report() {
    	$page_data['month']        = date('m');
    	$page_data['page_name']    = 'attendance_report';
    	$page_data['page_title']   = get_phrase('attendance_report');
    	$this->load->view('backend/index',$page_data);
    }
    function attendance_report_view($class_id = '' , $section_id = '', $month = '', $selectyear='') {
    	if($this->session->userdata('school_login')!=1)
    		redirect(base_url() , 'refresh');
    	$class_name = $this->db->get_where('class' , array(
    		'class_id' => $class_id
    	))->row()->name;
    	$page_data['class_id'] = $class_id;
    	$page_data['month']    = $month;
    	$page_data['selectyear'] = $selectyear;
    	$page_data['page_name'] = 'attendance_report_view';
    	$section_name = $this->db->get_where('section' , array(
    		'section_id' => $section_id
    	))->row()->name;
    	$page_data['section_id'] = $section_id;
    	$page_data['page_title'] = get_phrase('attendance_report_of_class') . ' ' . $class_name . ' : ' . get_phrase('section') . ' ' . $section_name;
    	$this->load->view('backend/index', $page_data);
    }
    function attendance_report_print_view($class_id ='' , $section_id = '' , $month = '', $selectyear='') {
    	if ($this->session->userdata('school_login') != 1)
    		redirect(base_url(), 'refresh');
    	$page_data['class_id'] = $class_id;
    	$page_data['section_id']  = $section_id;
    	$page_data['month'] = $month;
    	$page_data['selectyear'] = $selectyear;
    	$this->load->view('backend/school/attendance_report_print_view' , $page_data);
    }

    function attendance_report_selector()
    {
    	$data['class_id']   = $this->input->post('class_id');
    	$data['selectyear']       = $this->input->post('selectyear');
    	$data['month']  = $this->input->post('month');
    	$data['section_id'] = $this->input->post('section_id');
    	redirect(base_url().'index.php?school/attendance_report_view/'.$data['class_id'].'/'.$data['section_id'].'/'.$data['month'].'/'.$data['selectyear'],'refresh');
    }

    /******MANAGE BILLING / INVOICES WITH STATUS*****/
    function invoice($param1 = '', $param2 = '', $param3 = '')
    {
    	if ($this->session->userdata('school_login') != 1)
    		redirect(base_url(), 'refresh');
    	if ($param1 == 'take_payment') {
    		$data['enroll_id']   =   $param2;
    		$data['school_id']	= $this->session->userdata('school_id');
    		$data['title']        =   $this->input->post('title');
    		$data['description']  =   $this->input->post('description');
    		$data['payment_type'] =   'income';
    		$data['method']       =   $this->input->post('method');
    		$data['amount']       =   $this->input->post('amount');
    		$data['discount']     =   $this->input->post('discount');
    		$data['timestamp']    =  strtotime(str_replace('/', '-', $this->input->post('timestamp')));
    		$data['year']         =   $this->db->get_where('school' , array('school_id' => $this->session->userdata('school_id')))->row()->running_year;
    		$class_id = $this->db->get_where('enroll',array('enroll_id' => $param2))->row()->class_id;
    		$this->db->insert('payment' , $data);
    		$this->session->set_flashdata('flash_message' , get_phrase('payment_successfull'));
    		redirect(base_url() . 'index.php?school/student_information/' . $class_id, 'refresh');
    	}

    	if ($param1 == 'delete') {
    		$this->db->where('invoice_id', $param2);
    		$this->db->delete('invoice');
    		$this->session->set_flashdata('flash_message' , get_phrase('data_deleted'));
    		redirect(base_url() . 'index.php?school/income', 'refresh');
    	}
    	$page_data['page_name']  = 'invoice';
    	$page_data['page_title'] = get_phrase('manage_invoice/payment');
    	$this->db->order_by('creation_timestamp', 'desc');
    	$page_data['invoices'] = $this->db->get('invoice')->result_array();
    	$this->load->view('backend/index', $page_data);
    }

    /**********ACCOUNTING********************/
    function income($param1 = '' , $param2 = '')
    {
    	if ($this->session->userdata('school_login') != 1)
    		redirect('login', 'refresh');
    	$page_data['page_name']  = 'income';
    	$page_data['page_title'] = get_phrase('School_Income');
    	$this->load->view('backend/index', $page_data); 
    }

    function student_payment($param1 = '' , $param2 = '' , $param3 = '') {

    	if ($this->session->userdata('school_login') != 1)
    		redirect('login', 'refresh');
    	$page_data['page_name']  = 'student_payment';
    	$page_data['page_title'] = get_phrase('create_student_payment');
    	$this->load->view('backend/index', $page_data); 
    }

    function student_transfer_certificate($param1 = '' , $param2 = '' , $param3 = '') {

    	if ($this->session->userdata('school_login') != 1)
    		redirect('login', 'refresh');

    	if ($param1 == 'create') {
    		$data['student_id']         = $this->input->post('student_id');
    		$data['class_id']         = $this->input->post('class_id');
    		$data['srno']			  = $this->db->get_where('enroll' , array('student_id' => $data['student_id']))->row()->srno;
    		$data['ncc_value']         = $this->input->post('ncc_value');
    		$data['promotion']         = $this->input->post('promotion');
    		$data['reason']         = $this->input->post('reason');
    		$data['creation_timestamp'] = $this->input->post('date');
    		$data['year']               = $this->db->get_where('school' , array('school_id' => $this->session->userdata('school_id')))->row()->running_year;
    		$data2['tc_status'] = 1;
    		$this->db->insert('transfercertificate', $data);
    		$this->db->where('student_id', $data['student_id']);
			$this->db->update('enroll',$data2);
    	}
    	$page_data['page_name']  = 'student_transfer_certificate';
    	$page_data['page_title'] = "Transfer certificate";
    	$this->load->view('backend/index', $page_data); 
    }

    function list_transfer_certificate($param1 = '' , $param2 = ''){
    	if ($this->session->userdata('school_login') != 1)
    		redirect('login', 'refresh');
    	$page_data['page_name']  = 'list_transfer_certificate';
    	$page_data['page_title'] = "Manage Student T.C.";
    	$this->db->order_by('creation_timestamp', 'desc');
    	$page_data['transfercertificates'] = $this->db->get('transfercertificate')->result_array();
    	$this->load->view('backend/index', $page_data); 
    }
    function contact_us() {

    	if ($this->session->userdata('school_login') != 1)
    		redirect('login', 'refresh');
    	$page_data['page_name']  = 'contact_us';
    	$page_data['page_title'] = "Contact Us";
    	$this->load->view('backend/index', $page_data); 
    }
    function about_developer() {

    	if ($this->session->userdata('school_login') != 1)
    		redirect('login', 'refresh');
    	$page_data['page_name']  = 'about_developer';
    	$page_data['page_title'] = "About Developer";
    	$this->load->view('backend/index', $page_data); 
    }





    function expense($param1 = '' , $param2 = '')
    {
    	if ($this->session->userdata('school_login') != 1)
    		redirect('login', 'refresh');
    	if ($param1 == 'create') {
    		$data['title']               =   $this->input->post('title');
    		$data['expense_category_id'] =   $this->input->post('expense_category_id');
    		$data['description']         =   $this->input->post('description');
    		$data['payment_type']        =   'expense';
    		$data['school_id']			 =   $this->session->userdata('school_id');
    		$data['method']              =   $this->input->post('method');
    		$data['amount']              =   $this->input->post('amount');
    		$data['timestamp']           =   strtotime(str_replace('/', '-', $this->input->post('timestamp')));
    		$data['year']                =   $this->db->get_where('school' , array('school_id' => $this->session->userdata('school_id')))->row()->running_year;
    		$this->db->insert('payment' , $data);
    		$this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
    		redirect(base_url() . 'index.php?school/expense', 'refresh');
    	}

    	if ($param1 == 'edit') {
    		$data['title']               =   $this->input->post('title');
    		$data['expense_category_id'] =   $this->input->post('expense_category_id');
    		$data['description']         =   $this->input->post('description');
    		$data['payment_type']        =   'expense';
    		$data['method']              =   $this->input->post('method');
    		$data['amount']              =   $this->input->post('amount');
    		$data['timestamp']           =   strtotime(str_replace('/', '-', $this->input->post('timestamp')));
    		$data['year']                =   $this->db->get_where('school' , array('school_id' => $this->session->userdata('school_id')))->row()->running_year;
    		$this->db->where('payment_id' , $param2);
    		$this->db->update('payment' , $data);
    		$this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
    		redirect(base_url() . 'index.php?school/expense', 'refresh');
    	}

    	if ($param1 == 'delete') {
    		$this->db->where('payment_id' , $param2);
    		$this->db->delete('payment');
    		$this->session->set_flashdata('flash_message' , get_phrase('data_deleted'));
    		redirect(base_url() . 'index.php?school/expense', 'refresh');
    	}

    	$page_data['page_name']  = 'expense';
    	$page_data['page_title'] = get_phrase('expenses');
    	$this->load->view('backend/index', $page_data); 
    }

    function expense_category($param1 = '' , $param2 = '')
    {
    	if ($this->session->userdata('school_login') != 1)
    		redirect('login', 'refresh');
    	if ($param1 == 'create') {
    		$data['name']   =   $this->input->post('name');
    		$data['school_id'] = $this->session->userdata('school_id');
    		$this->db->insert('expense_category' , $data);
    		$this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
    		redirect(base_url() . 'index.php?school/expense_category');
    	}
    	if ($param1 == 'edit') {
    		$data['name']   =   $this->input->post('name');
    		$this->db->where('expense_category_id' , $param2);
    		$this->db->update('expense_category' , $data);
    		$this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
    		redirect(base_url() . 'index.php?school/expense_category');
    	}
    	if ($param1 == 'delete') {
    		$this->db->where('expense_category_id' , $param2);
    		$this->db->delete('expense_category');
    		$this->session->set_flashdata('flash_message' , get_phrase('data_deleted'));
    		redirect(base_url() . 'index.php?school/expense_category');
    	}

    	$page_data['page_name']  = 'expense_category';
    	$page_data['page_title'] = get_phrase('expense_category');
    	$this->load->view('backend/index', $page_data);
    }

    /**********MANAGE LIBRARY / BOOKS********************/
    function book($param1 = '', $param2 = '', $param3 = '')
    {
    	if ($this->session->userdata('school_login') != 1)
    		redirect('login', 'refresh');
    	if ($param1 == 'create') {
    		$data['name']        = $this->input->post('name');
    		$data['description'] = $this->input->post('description');
    		$data['price']       = $this->input->post('price');
    		$data['author']      = $this->input->post('author');
    		$data['class_id']    = $this->input->post('class_id');
            //$data['status']      = $this->input->post('status');
    		$this->db->insert('book', $data);
    		$this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
    		redirect(base_url() . 'index.php?school/book', 'refresh');
    	}
    	if ($param1 == 'do_update') {
    		$data['name']        = $this->input->post('name');
    		$data['description'] = $this->input->post('description');
    		$data['price']       = $this->input->post('price');
    		$data['author']      = $this->input->post('author');
    		$data['class_id']    = $this->input->post('class_id');
            //$data['status']      = $this->input->post('status');

    		$this->db->where('book_id', $param2);
    		$this->db->update('book', $data);
    		$this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
    		redirect(base_url() . 'index.php?school/book', 'refresh');
    	} else if ($param1 == 'edit') {
    		$page_data['edit_data'] = $this->db->get_where('book', array(
    			'book_id' => $param2
    		))->result_array();
    	}
    	if ($param1 == 'delete') {
    		$this->db->where('book_id', $param2);
    		$this->db->delete('book');
    		$this->session->set_flashdata('flash_message' , get_phrase('data_deleted'));
    		redirect(base_url() . 'index.php?school/book', 'refresh');
    	}
    	$page_data['books']      = $this->db->get('book', array('school_id' => $this->session->userdata('school_id')))->result_array();
    	$page_data['page_name']  = 'book';
    	$page_data['page_title'] = get_phrase('manage_library_books');
    	$this->load->view('backend/index', $page_data);

    }
    /**********MANAGE TRANSPORT / VEHICLES / ROUTES********************/
    function transport($param1 = '', $param2 = '', $param3 = '')
    {
    	if ($this->session->userdata('school_login') != 1)
    		redirect('login', 'refresh');
    	if ($param1 == 'create') {
    		$data['route_name']        = $this->input->post('route_name');
    		$data['number_of_vehicle'] = $this->input->post('number_of_vehicle');
    		$data['description']       = $this->input->post('description');
    		$data['route_fare']        = $this->input->post('route_fare');
    		$this->db->insert('transport', $data);
    		$this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
    		redirect(base_url() . 'index.php?school/transport', 'refresh');
    	}
    	if ($param1 == 'do_update') {
    		$data['route_name']        = $this->input->post('route_name');
    		$data['number_of_vehicle'] = $this->input->post('number_of_vehicle');
    		$data['description']       = $this->input->post('description');
    		$data['route_fare']        = $this->input->post('route_fare');

    		$this->db->where('transport_id', $param2);
    		$this->db->update('transport', $data);
    		$this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
    		redirect(base_url() . 'index.php?school/transport', 'refresh');
    	} else if ($param1 == 'edit') {
    		$page_data['edit_data'] = $this->db->get_where('transport', array(
    			'transport_id' => $param2
    		))->result_array();
    	}
    	if ($param1 == 'delete') {
    		$this->db->where('transport_id', $param2);
    		$this->db->delete('transport');
    		$this->session->set_flashdata('flash_message' , get_phrase('data_deleted'));
    		redirect(base_url() . 'index.php?school/transport', 'refresh');
    	}
    	$page_data['transports'] = $this->db->get('transport', array('school_id' => $this->session->userdata('school_id')))->result_array();
    	$page_data['page_name']  = 'transport';
    	$page_data['page_title'] = get_phrase('manage_transport');
    	$this->load->view('backend/index', $page_data);

    }
    /**********MANAGE DORMITORY / HOSTELS / ROOMS ********************/
    function dormitory($param1 = '', $param2 = '', $param3 = '')
    {
    	if ($this->session->userdata('school_login') != 1)
    		redirect('login', 'refresh');
    	if ($param1 == 'create') {
    		$data['name']           = $this->input->post('name');
    		$data['number_of_room'] = $this->input->post('number_of_room');
    		$data['description']    = $this->input->post('description');
    		$this->db->insert('dormitory', $data);
    		$this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
    		redirect(base_url() . 'index.php?school/dormitory', 'refresh');
    	}
    	if ($param1 == 'do_update') {
    		$data['name']           = $this->input->post('name');
    		$data['number_of_room'] = $this->input->post('number_of_room');
    		$data['description']    = $this->input->post('description');

    		$this->db->where('dormitory_id', $param2);
    		$this->db->update('dormitory', $data);
    		$this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
    		redirect(base_url() . 'index.php?school/dormitory', 'refresh');
    	} else if ($param1 == 'edit') {
    		$page_data['edit_data'] = $this->db->get_where('dormitory', array(
    			'dormitory_id' => $param2
    		))->result_array();
    	}
    	if ($param1 == 'delete') {
    		$this->db->where('dormitory_id', $param2);
    		$this->db->delete('dormitory');
    		$this->session->set_flashdata('flash_message' , get_phrase('data_deleted'));
    		redirect(base_url() . 'index.php?school/dormitory', 'refresh');
    	}
    	$page_data['dormitories'] = $this->db->get('dormitory', array('school_id' => $this->session->userdata('school_id')))->result_array();
    	$page_data['page_name']   = 'dormitory';
    	$page_data['page_title']  = get_phrase('manage_dormitory');
    	$this->load->view('backend/index', $page_data);

    }

    /***MANAGE EVENT / NOTICEBOARD, WILL BE SEEN BY ALL ACCOUNTS DASHBOARD**/
    function noticeboard($param1 = '', $param2 = '', $param3 = '')
    {
    	if ($this->session->userdata('school_login') != 1)
    		redirect(base_url(), 'refresh');

    	if ($param1 == 'create') {
    		$data['notice_title']     = $this->input->post('notice_title');
    		$data['notice']           = $this->input->post('notice');
    		$data['create_timestamp'] = strtotime(str_replace('/', '-', $this->input->post('create_timestamp')));
    		$data['school_id']		  = $this->session->userdata('school_id');
    		$this->db->insert('noticeboard', $data);
    		$check_sms_send = $this->input->post('check_sms');
    		$this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
    		redirect(base_url() . 'index.php?school/noticeboard/', 'refresh');
    	}
    	if ($param1 == 'do_update') {
    		$data['notice_title']     = $this->input->post('notice_title');
    		$data['notice']           = $this->input->post('notice');
    		$data['create_timestamp'] = strtotime($this->input->post('create_timestamp'));
    		$data['school_id']		  = $this->session->userdata('school_id');
    		$this->db->where('notice_id', $param2);
    		$this->db->update('noticeboard', $data);

    		$check_sms_send = $this->input->post('check_sms');

    		

    		$this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
    		redirect(base_url() . 'index.php?school/noticeboard/', 'refresh');
    	}

    	if ($param1 == 'delete') {
    		$this->db->where('notice_id', $param2);
    		$this->db->delete('noticeboard');
    		$this->session->set_flashdata('flash_message' , get_phrase('data_deleted'));
    		redirect(base_url() . 'index.php?school/noticeboard/', 'refresh');
    	}
    	if ($param1 == 'mark_as_archive') {
    		$this->db->where('notice_id' , $param2);
    		$this->db->update('noticeboard' , array('status' => 0));
    		redirect(base_url() . 'index.php?school/noticeboard/', 'refresh');
    	}

    	if ($param1 == 'remove_from_archived') {
    		$this->db->where('notice_id' , $param2);
    		$this->db->update('noticeboard' , array('status' => 1));
    		redirect(base_url() . 'index.php?school/noticeboard/', 'refresh');
    	}
    	$page_data['page_name']  = 'noticeboard';
    	$page_data['page_title'] = get_phrase('manage_noticeboard');
    	$this->load->view('backend/index', $page_data);
    }
    function reload_noticeboard() {
    	$this->load->view('backend/school/noticeboard');
    }
    /* private messaging */

    function message($param1 = '', $param2 = '', $param3 = '') {
    	if ($this->session->userdata('school_login') != 1)
    		redirect(base_url(), 'refresh');
    	if ($param1 == 'single') {
    		$student_id   = $this->input->post('Contact_number');
    		$data['contact_number'] = $this->db->get_where('student',array('student_id' => $student_id))->row()->phone;
    		$data['message'] = $this->input->post('smstext');
    		$message=$this->input->post('smstext');
            $sender=$this->db->get_where('school' , array('school_id' =>$this->session->userdata('school_id')))->row()->school_sender_id; //ex:INVITE
            $sms_api=$this->db->get_where('school' , array('school_id' =>$this->session->userdata('school_id')))->row()->school_sms_api;
            $mobile_number=$data['contact_number'];
            $mobile_number=substr($mobile_number,-10);
            $url= "http://sms.parkentechnology.com/httpapi/httpapi?token=".urlencode($sms_api)."&sender=".urlencode($sender)."&number=".urlencode($mobile_number)."&route=2&type=1&sms=".urlencode($message);
            //$url= "http://sms.parkentechnology.com/httpapi/httpapi?token=".urlencode($sms_api)."&sender=".urlencode($sender)."&number=".urlencode($mobile_number)."&route=1&type=3&sms=".urlencode($message);
           
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $curl_scraped_page = curl_exec($ch);
            curl_close($ch);
            $this->session->set_flashdata('flash_message',"SMS Sent Successfully");
        }
        if ($param1 == 'bulk_sms') {
        	foreach ($this->input->post('student_id') as $id) {
        		$number=$this->db->get_where('student',array('student_id'=>$id))->row()->phone;
        		$number=substr($number,-10);
        		$numbers = $numbers . $number.',';
        	}
        	echo $numbers;
        	$message=$this->input->post('Bulk_SMS');
            $sender=$this->db->get_where('school' , array('school_id' =>$this->session->userdata('school_id')))->row()->school_sender_id; //ex:INVITE
            $sms_api=$this->db->get_where('school' , array('school_id' =>$this->session->userdata('school_id')))->row()->school_sms_api;
            $mobile_number=$numbers;
           	$url= "http://sms.parkentechnology.com/httpapi/httpapi?token=".urlencode($sms_api)."&sender=".urlencode($sender)."&number=".urlencode($mobile_number)."&route=2&type=1&sms=".urlencode($message);
           
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $curl_scraped_page = curl_exec($ch);
            curl_close($ch);
            $this->session->set_flashdata('flash_message',"SMS Sent Successfully");
        }
        if ($param1 == 'whole_sms') {
        	$array1 = $this->db->query("SELECT `phone` FROM `student` where `school_id` = $this->session->userdata('school_id')")->result_array();
        	$arr = array_map (function($value){ return $value['phone'];} , $array1);
        	$tmp = implode(', ', $arr);
        	for ($i=0; $i < count($arr); $i++) { 
        		$number=substr($arr[$i],-10);
        		$numbers = $numbers . $number.',';
        	}
        	$message=$this->input->post('Whole_SMS');
           $sender=$this->db->get_where('school' , array('school_id' =>$this->session->userdata('school_id')))->row()->school_sender_id; //ex:INVITE
            $sms_api=$this->db->get_where('school' , array('school_id' =>$this->session->userdata('school_id')))->row()->school_sms_api;
            $mobile_number=$numbers;
           	$url= "http://sms.parkentechnology.com/httpapi/httpapi?token=".urlencode($sms_api)."&sender=".urlencode($sender)."&number=".urlencode($mobile_number)."&route=2&type=1&sms=".urlencode($message);
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $curl_scraped_page = curl_exec($ch);
            curl_close($ch);
            $this->session->set_flashdata('flash_message',"SMS Sent Successfully");
        }
        file_put_contents('sentmessages.txt', $url.PHP_EOL, FILE_APPEND);
        $page_data['message_inner_page_name']   = $param1;
        $page_data['page_name']                 = 'message';
        $page_data['page_title']                = 'Send SMS';
        $this->load->view('backend/index', $page_data);
    }
    
    /*****SITE/SYSTEM SETTINGS*********/
    function system_settings($param1 = '', $param2 = '', $param3 = '')
    {
    	if ($this->session->userdata('school_login') != 1)
    		redirect(base_url() . 'index.php?login', 'refresh');

    	if ($param1 == 'do_update') {
    		$data['school_name'] = $this->input->post('school_name');
    		$data['head_authority'] = $this->input->post('head_authority');
    		$data['school_sms_api'] = $this->input->post('school_sms_api');
    		$data['dice_code'] = $this->input->post('dice_code');
    		$data['school_sender_id'] = $this->input->post('school_sender_id');
    		$data['school_name_hin'] = $this->input->post('school_name_hin');
    		$data['school_address'] = $this->input->post('school_address');
    		$data['school_contact_primary'] = $this->input->post('school_contact_primary');
    		$data['school_reg_number'] = $this->input->post('school_reg_number');
    		$data['email'] = $this->input->post('email');
    		$data['running_year'] = $this->input->post('running_year');
    		$this->db->where('school_id' , $this->session->userdata('school_id'));
    		$this->db->update('school' , $data);
    		$this->session->set_flashdata('flash_message' , get_phrase('data_updated')); 
    		redirect(base_url() . 'index.php?school/system_settings/', 'refresh');
    	}
    	if ($param1 == 'upload_logo') {
    		echo "<script>alert('Hello');</script";
    		move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/school_image/logo.png');
    		echo '<script>alert(' . $_FILES['userfile'] . ';</script>';
    		$this->session->set_flashdata('flash_message', get_phrase('settings_updated'));
    		redirect(base_url() . 'index.php?school/system_settings/', 'refresh');
    	}
    	$page_data['page_name']  = 'system_settings';
    	$page_data['page_title'] = get_phrase('system_settings');
    	// $page_data['settings']   = $this->db->get('settings')->result_array();
    	$this->load->view('backend/index', $page_data);
    }





    function get_session_changer()
    {
    	$this->load->view('backend/school/change_session');
    }

    function change_session()
    {
    	$data['running_year'] = $this->input->post('running_year');
    	$this->db->where('school_id' , $this->session->userdata('school_id'));
    	$this->db->update('school' , $data);
    	$this->session->set_flashdata('flash_message' , get_phrase('session_changed')); 
    	redirect(base_url() . 'index.php?school/dashboard/', 'refresh'); 
    }
    
    /***** UPDATE PRODUCT *****/
    
    function update( $task = '', $purchase_code = '' ) {

    	if ($this->session->userdata('school_login') != 1)
    		redirect(base_url(), 'refresh');

        // Create update directory.
    	$dir    = 'update';
    	if ( !is_dir($dir) )
    		mkdir($dir, 0777, true);

    	$zipped_file_name   = $_FILES["file_name"]["name"];
    	$path               = 'update/' . $zipped_file_name;

    	move_uploaded_file($_FILES["file_name"]["tmp_name"], $path);

        // Unzip uploaded update file and remove zip file.
    	$zip = new ZipArchive;
    	$res = $zip->open($path);
    	if ($res === TRUE) {
    		$zip->extractTo('update');
    		$zip->close();
    		unlink($path);
    	}

    	$unzipped_file_name = substr($zipped_file_name, 0, -4);
    	$str                = file_get_contents('./update/' . $unzipped_file_name . '/update_config.json');
    	$json               = json_decode($str, true);



		// Run php modifications
    	require './update/' . $unzipped_file_name . '/update_script.php';

        // Create new directories.
    	if(!empty($json['directory'])) {
    		foreach($json['directory'] as $directory) {
    			if ( !is_dir( $directory['name']) )
    				mkdir( $directory['name'], 0777, true );
    		}
    	}

        // Create/Replace new files.
    	if(!empty($json['files'])) {
    		foreach($json['files'] as $file)
    			copy($file['root_directory'], $file['update_directory']);
    	}

    	$this->session->set_flashdata('flash_message' , get_phrase('product_updated_successfully'));
    	redirect(base_url() . 'index.php?school/system_settings');
    }

    /*****SMS SETTINGS*********/
    function sms_settings($param1 = '' , $param2 = '')
    {
    	if ($this->session->userdata('school_login') != 1)
    		redirect(base_url() . 'index.php?login', 'refresh');
    	if ($param1 == 'clickatell') {

    		$data['description'] = $this->input->post('clickatell_user');
    		$this->db->where('type' , 'clickatell_user');
    		$this->db->update('settings' , $data);

    		$data['description'] = $this->input->post('clickatell_password');
    		$this->db->where('type' , 'clickatell_password');
    		$this->db->update('settings' , $data);

    		$data['description'] = $this->input->post('clickatell_api_id');
    		$this->db->where('type' , 'clickatell_api_id');
    		$this->db->update('settings' , $data);

    		$this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
    		redirect(base_url() . 'index.php?school/sms_settings/', 'refresh');
    	}

    	if ($param1 == 'twilio') {

    		$data['description'] = $this->input->post('twilio_account_sid');
    		$this->db->where('type' , 'twilio_account_sid');
    		$this->db->update('settings' , $data);

    		$data['description'] = $this->input->post('twilio_auth_token');
    		$this->db->where('type' , 'twilio_auth_token');
    		$this->db->update('settings' , $data);

    		$data['description'] = $this->input->post('twilio_sender_phone_number');
    		$this->db->where('type' , 'twilio_sender_phone_number');
    		$this->db->update('settings' , $data);

    		$this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
    		redirect(base_url() . 'index.php?school/sms_settings/', 'refresh');
    	}

    	if ($param1 == 'active_service') {

    		$data['description'] = $this->input->post('active_sms_service');
    		$this->db->where('type' , 'active_sms_service');
    		$this->db->update('settings' , $data);

    		$this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
    		redirect(base_url() . 'index.php?school/sms_settings/', 'refresh');
    	}

    	$page_data['page_name']  = 'sms_settings';
    	$page_data['page_title'] = get_phrase('sms_settings');
    	$page_data['settings']   = $this->db->get('settings')->result_array();
    	$this->load->view('backend/index', $page_data);
    }
    
    /*****LANGUAGE SETTINGS*********/
    function manage_language($param1 = '', $param2 = '', $param3 = '')
    {
    	if ($this->session->userdata('school_login') != 1)
    		redirect(base_url() . 'index.php?login', 'refresh');

    	if ($param1 == 'edit_phrase') {
    		$page_data['edit_profile'] 	= $param2;	
    	}
    	if ($param1 == 'update_phrase') {
    		$language	=	$param2;
    		$total_phrase	=	$this->input->post('total_phrase');
    		for($i = 1 ; $i < $total_phrase ; $i++)
    		{
				//$data[$language]	=	$this->input->post('phrase').$i;
    			$this->db->where('phrase_id' , $i);
    			$this->db->update('language' , array($language => $this->input->post('phrase'.$i)));
    		}
    		redirect(base_url() . 'index.php?school/manage_language/edit_phrase/'.$language, 'refresh');
    	}
    	if ($param1 == 'do_update') {
    		$language        = $this->input->post('language');
    		$data[$language] = $this->input->post('phrase');
    		$this->db->where('phrase_id', $param2);
    		$this->db->update('language', $data);
    		$this->session->set_flashdata('flash_message', get_phrase('settings_updated'));
    		redirect(base_url() . 'index.php?school/manage_language/', 'refresh');
    	}
    	if ($param1 == 'add_phrase') {
    		$data['phrase'] = $this->input->post('phrase');
    		$this->db->insert('language', $data);
    		$this->session->set_flashdata('flash_message', get_phrase('settings_updated'));
    		redirect(base_url() . 'index.php?school/manage_language/', 'refresh');
    	}
    	if ($param1 == 'add_language') {
    		$language = $this->input->post('language');
    		$this->load->dbforge();
    		$fields = array(
    			$language => array(
    				'type' => 'LONGTEXT'
    			)
    		);
    		$this->dbforge->add_column('language', $fields);

    		$this->session->set_flashdata('flash_message', get_phrase('settings_updated'));
    		redirect(base_url() . 'index.php?school/manage_language/', 'refresh');
    	}
    	if ($param1 == 'delete_language') {
    		$language = $param2;
    		$this->load->dbforge();
    		$this->dbforge->drop_column('language', $language);
    		$this->session->set_flashdata('flash_message', get_phrase('settings_updated'));

    		redirect(base_url() . 'index.php?school/manage_language/', 'refresh');
    	}
    	$page_data['page_name']        = 'manage_language';
    	$page_data['page_title']       = get_phrase('manage_language');
		//$page_data['language_phrases'] = $this->db->get('language')->result_array();
    	$this->load->view('backend/index', $page_data);	
    }

    /*****BACKUP / RESTORE / DELETE DATA PAGE**********/
    function backup_restore($operation = '', $type = '')
    {
    	if ($this->session->userdata('school_login') != 1)
    		redirect(base_url(), 'refresh');

    	if ($operation == 'create') {
    		$this->crud_model->create_backup($type);
    	}
    	if ($operation == 'restore') {
    		$this->crud_model->restore_backup();
    		$this->session->set_flashdata('backup_message', 'Backup Restored');
    		redirect(base_url() . 'index.php?school/backup_restore/', 'refresh');
    	}
    	if ($operation == 'delete') {
    		$this->crud_model->truncate($type);
    		$this->session->set_flashdata('backup_message', 'Data removed');
    		redirect(base_url() . 'index.php?school/backup_restore/', 'refresh');
    	}

    	$page_data['page_info']  = 'Create backup / restore from backup';
    	$page_data['page_name']  = 'backup_restore';
    	$page_data['page_title'] = get_phrase('manage_backup_restore');
    	$this->load->view('backend/index', $page_data);
    }

    /******MANAGE OWN PROFILE AND CHANGE PASSWORD***/
    function manage_profile($param1 = '', $param2 = '', $param3 = '')
    {
    	if ($this->session->userdata('school_login') != 1)
    		redirect(base_url() . 'index.php?login', 'refresh');
    	if ($param1 == 'update_profile_info') {
    		$data['name']  = $this->input->post('name');
    		$data['email'] = $this->input->post('email');

    		$this->db->where('school_id', $this->session->userdata('school_id'));
    		$this->db->update('school', $data);
    		move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/school_image/' . $this->session->userdata('school_id') . '.jpg');
    		$this->session->set_flashdata('flash_message', get_phrase('account_updated'));
    		redirect(base_url() . 'index.php?school/manage_profile/', 'refresh');
    	}
    	if ($param1 == 'change_password') {
    		$data['password']             = sha1($this->input->post('password'));
    		$data['new_password']         = sha1($this->input->post('new_password'));
    		$data['confirm_new_password'] = sha1($this->input->post('confirm_new_password'));

    		$current_password = $this->db->get_where('school', array(
    			'school_id' => $this->session->userdata('school_id')
    		))->row()->password;
    		if ($current_password == $data['password'] && $data['new_password'] == $data['confirm_new_password']) {
    			$this->db->where('school_id', $this->session->userdata('school_id'));
    			$this->db->update('school', array(
    				'password' => $data['new_password']
    			));
    			$this->session->set_flashdata('flash_message', get_phrase('password_updated'));
    		} else {
    			$this->session->set_flashdata('flash_message', get_phrase('password_mismatch'));
    		}
    		redirect(base_url() . 'index.php?school/manage_profile/', 'refresh');
    	}
    	$page_data['page_name']  = 'manage_profile';
    	$page_data['page_title'] = get_phrase('manage_profile');
    	$page_data['edit_data']  = $this->db->get_where('school', array(
    		'school_id' => $this->session->userdata('school_id')
    	))->result_array();
    	$this->load->view('backend/index', $page_data);
    }

    // VIEW QUESTION PAPERS
    function question_paper($param1 = "", $param2 = "")
    {
    	if ($this->session->userdata('school_login') != 1)
    	{
    		$this->session->set_userdata('last_page', current_url());
    		redirect(base_url(), 'refresh');
    	}

    	$data['page_name']  = 'question_paper';
    	$data['page_title'] = get_phrase('question_paper');
    	$this->load->view('backend/index', $data);
    }

     // MANAGE PARENTS CLASSWISE
    function librarian($param1 = '', $param2 = '', $param3 = '')
    {
    	if ($this->session->userdata('school_login') != 1)
    		redirect('login', 'refresh');

    	if ($param1 == 'create') {
    		$data['name']       = $this->input->post('name');
    		$data['email']      = $this->input->post('email');
    		$data['password']   = sha1($this->input->post('password'));

    		$this->db->insert('librarian', $data);

    		$this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
            $this->email_model->account_opening_email('librarian', $data['email'], $this->input->post('password')); //SEND EMAIL ACCOUNT OPENING EMAIL
            redirect(base_url() . 'index.php?school/librarian/', 'refresh');
        }

        if ($param1 == 'edit') {
        	$data['name']   = $this->input->post('name');
        	$data['email']  = $this->input->post('email');

        	$this->db->where('librarian_id' , $param2);
        	$this->db->update('librarian' , $data);

        	$this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
        	redirect(base_url() . 'index.php?school/librarian/', 'refresh');
        }

        if ($param1 == 'delete') {
        	$this->db->where('librarian_id' , $param2);
        	$this->db->delete('librarian');

        	$this->session->set_flashdata('flash_message' , get_phrase('data_deleted'));
        	redirect(base_url() . 'index.php?school/librarian/', 'refresh');
        }

        $page_data['page_title']    = get_phrase('all_librarians');
        $page_data['page_name']     = 'librarian';
        $this->load->view('backend/index', $page_data);
    }

function upload_settings($param1 = '', $param2 = '', $param3 = '')
    {	


    	if ($this->session->userdata('school_login') != 1)
    		redirect(base_url() . 'index.php?login', 'refresh');

    	if ($param1 == 'upload_header') {
    		$data['name']       = $this->input->post('system_email');
    		move_uploaded_file($_FILES['userfile']['tmp_name'], './uploads/teacher_image/'.'header.png');
    		echo "<script>". $data['name'] ."</script>";
    	}
    	if ($param1 == 'upload_logo') {
    		move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/student_image/trte.jpg');
    	}


    	$page_data['page_name']  = 'upload_section';
    	$page_data['page_title'] = get_phrase('Upload_section');
    	$this->load->view('backend/index', $page_data);
    }
}
