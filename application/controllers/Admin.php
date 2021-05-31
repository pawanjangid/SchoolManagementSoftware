<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');
class Admin extends CI_Controller
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

	/***default functin, redirects to login page if no admin logged in yet***/
	public function index()
	{
		if ($this->session->userdata('admin_login') != 1)
			redirect(base_url() . 'index.php?login', 'refresh');
		if ($this->session->userdata('admin_login') == 1)
			redirect(base_url() . 'index.php?admin/dashboard', 'refresh');
	}

	/***ADMIN DASHBOARD***/
	function dashboard()
	{
		if ($this->session->userdata('admin_login') != 1)
			redirect(base_url(), 'refresh');
		$page_data['page_name']  = 'dashboard';
		$page_data['page_title'] = get_phrase('admin_dashboard');
		$this->load->view('backend/index', $page_data);
	}

	
	function seller_page()
	{
		if ($this->session->userdata('admin_login') != 1)
			redirect(base_url(), 'refresh');

		$page_data['page_name']  = 'modal_seller_add';
		$page_data['page_title'] = get_phrase('Seller');
		$this->load->view('backend/index', $page_data);
	}
	function seller()
	{
		if ($this->session->userdata('admin_login') != 1)
			redirect(base_url(), 'refresh');

		$page_data['page_name']  = 'seller';
		$page_data['page_title'] = get_phrase('Sellers');
		$this->load->view('backend/index', $page_data);
	}

	function seller_location($seller_id)
	{
		if ($this->session->userdata('admin_login') != 1)
			redirect(base_url(), 'refresh');
		$page_data['seller_id'] = $seller_id;
		$page_data['page_name']  = 'seller_location';
		$page_data['page_title'] = get_phrase('Locate_Seller');
		$this->load->view('backend/index', $page_data);
	}
	function all_seller_location($seller_id)
	{
		if ($this->session->userdata('admin_login') != 1)
			redirect(base_url(), 'refresh');
		$page_data['page_name']  = 'all_seller_location';
		$page_data['page_title'] = get_phrase('Locate_Seller');
		$this->load->view('backend/index', $page_data);
	}

	function seller_add($param1 = '', $param2 = '', $param3 = '')
	{
		if ($this->session->userdata('admin_login') != 1)
			redirect('login', 'refresh');
		$running_year = $this->db->get_where('settings' , array(
			'type' => 'running_year'
		))->row()->description;
		if ($param1 == 'create') {
			$data['username']	= $this->input->post('contact_mail');
			$data['name']           = $this->input->post('name');
			$data['address']          = $this->input->post('address');
			$data['state_id']       = $this->input->post('state_id');
			$data['district_id']            = '1';//$this->input->post('district_id');
			$data['contact_number']        = $this->input->post('contact_number');
			$data['location_data']        = $this->input->post('location');
			$data['contact_mail']          = $this->input->post('contact_mail');
			$data['timestamp']          = date("d/m/Y");
			$data['password']          = $this->input->post('password');
			$this->db->insert('seller', $data);
			$seller_id = $this->db->insert_id();
			move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/seller_image/' . $seller_id . '.jpg');
			$this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
			redirect(base_url() . 'index.php?admin/seller/', 'refresh');
		}
		if ($param1 == 'do_update') {			
			$data['name']           = $this->input->post('name');
			$data['address']          = $this->input->post('address');
			$data['state_id']       = $this->input->post('state_id');
			$data['district_id']            = $this->input->post('district_id');
			$data['contact_number']        = $this->input->post('contact_number');
			$data['contact_mail']          = $this->input->post('contact_mail');
			$data['timestamp']          = $this->input->post('timestamp');
			$data['location_data']        = $this->input->post('location');
			$data['password']          = $this->input->post('password');
			$this->db->where('seller_id' , $param2);
			$this->db->update('seller');
			move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/seller_id/' . $param2 . '.jpg');
			$this->crud_model->clear_cache();
			$this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
			redirect(base_url() . 'index.php?admin/seller/' . $param3, 'refresh');
		}
	}

function store()
	{
		if ($this->session->userdata('admin_login') != 1)
			redirect(base_url(), 'refresh');

		$page_data['page_name']  = 'store';
		$page_data['page_title'] = get_phrase('Store');
		$this->load->view('backend/index', $page_data);
	}
	function store_add($param1 = '', $param2 = '', $param3 = '')
	{
		if ($this->session->userdata('admin_login') != 1)
			redirect('login', 'refresh');

		if ($param1 == 'create') {
			$data['username']	= $this->input->post('contact_mail');
			$data['name']           = $this->input->post('name');
			$data['address']          = $this->input->post('address');
			$data['state_id']       = $this->input->post('state_id');
			$data['district_id']            = '1';//$this->input->post('district_id');
			$data['contact_number']        = $this->input->post('contact_number');
			$data['location_data']        = $this->input->post('location');
			$data['contact_mail']          = $this->input->post('contact_mail');
			$data['timestamp']          = date("d/m/Y");
			$data['password']          = $this->input->post('password');
			$this->db->insert('seller', $data);
			$seller_id = $this->db->insert_id();
			move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/seller_image/' . $seller_id . '.jpg');
			$this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
			redirect(base_url() . 'index.php?admin/seller/', 'refresh');
		}
		if ($param1 == 'do_update') {			
			$data['name']           = $this->input->post('name');
			$data['address']          = $this->input->post('address');
			$data['state_id']       = $this->input->post('state_id');
			$data['district_id']            = $this->input->post('district_id');
			$data['contact_number']        = $this->input->post('contact_number');
			$data['contact_mail']          = $this->input->post('contact_mail');
			$data['timestamp']          = $this->input->post('timestamp');
			$data['location_data']        = $this->input->post('location');
			$data['password']          = $this->input->post('password');
			$this->db->where('seller_id' , $param2);
			$this->db->update('seller');
			move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/seller_id/' . $param2 . '.jpg');
			$this->crud_model->clear_cache();
			$this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
			redirect(base_url() . 'index.php?admin/seller/' . $param3, 'refresh');
		}
	}


function products($product_category_id)
	{
		if ($this->session->userdata('admin_login') != 1)
			redirect(base_url(), 'refresh');
		$page_data['product_category_id']  = $product_category_id;
		$page_data['page_name']  = 'products';
		$page_data['page_title'] = get_phrase('Product_Category : ' . $this->db->get_where('product_category', array('product_category_id' =>  $product_category_id))->row()->name);
		$this->load->view('backend/index', $page_data);
	}

		function product_category($param1 = '', $param2 = '', $param3 = '')
		{
		if ($this->session->userdata('admin_login') != 1)
			redirect('login', 'refresh');
		if ($param1 == 'create') {
			$data['name']           = $this->input->post('name');
			$data['description']          = $this->input->post('description');
			$this->db->insert('product_category', $data);
			$product_category_id = $this->db->insert_id();
			move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/product_category/' . $product_category_id . '.jpg');
			$this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
			redirect(base_url() . 'index.php?admin/product_category/', 'refresh');
		}
		if ($param1 == 'do_update') {			
			$data['name']           = $this->input->post('name');
			$data['description']    = $this->input->post('description');
			$this->db->where('product_category_id' , $param2);
			$this->db->update('product_category',$data);
			move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/product_category/' . $param2 . '.jpg');
			$this->crud_model->clear_cache();
			$this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
			redirect(base_url() . 'index.php?admin/product_category/', 'refresh');
		}
		$page_data['page_title'] 	= get_phrase('Product_Category');
        $page_data['page_name']  = 'product_category';
        $this->load->view('backend/index', $page_data);
	}
	function product($param1 = '', $param2 = '', $param3 = '')
	{
		if ($this->session->userdata('admin_login') != 1)
			redirect('login', 'refresh');
		if ($param1 == 'create') {
			$data['name']           = $this->input->post('name');
			$data['product_category_id']          = $this->input->post('product_category_id');
			$data['seller_id']       = $this->input->post('seller_id');
			$data['description']            = $this->input->post('description');
			$data['available_stock']        = $this->input->post('available_stock');
			$data['price']        = $this->input->post('price');
			
			$this->db->insert('products', $data);
			$seller_id = $this->db->insert_id();
			move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/product_image/' . $seller_id . '.jpg');
			$this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
			redirect(base_url() . 'index.php?admin/products/' . $data['product_category_id'], 'refresh');
		}
		if ($param1 == 'do_update') {			
			$data['name']           = $this->input->post('name');
			$data['product_category_id']          = $this->input->post('product_category_id');
			$data['seller_id']       = $this->input->post('seller_id');
			$data['description']            = $this->input->post('description');
			$data['available_stock']        = $this->input->post('available_stock');
			$data['price']        = $this->input->post('price');
			$this->db->where('product_id' , $param2);
			$this->db->update('products',$data);
			move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/product_image/' . $param2 . '.jpg');
			$this->crud_model->clear_cache();
			$this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
			redirect(base_url() . 'index.php?admin/products/' . $data['product_category_id'], 'refresh');
		}
	}
	function product_add()
	{
		if ($this->session->userdata('admin_login') != 1)
			redirect(base_url(), 'refresh');
		$page_data['page_name']  = 'product_add';
		$page_data['page_title'] = get_phrase('Add_New_Product');
		$this->load->view('backend/index', $page_data);
	}

	function institute()
	{
		if ($this->session->userdata('admin_login') != 1)
			redirect(base_url(), 'refresh');
		$page_data['page_name']  = 'institute';
		$page_data['page_title'] = get_phrase('Institute');
		$this->load->view('backend/index', $page_data);
	}
	function institute_add()
	{
		if ($this->session->userdata('admin_login') != 1)
			redirect(base_url(), 'refresh');
		$page_data['page_name']  = 'school_add';
		$page_data['page_title'] = get_phrase('Add_New_Institute');
		$this->load->view('backend/index', $page_data);
	}


	    function school($param1 = '', $param2 = '', $param3 = '')
    {
    	if ($this->session->userdata('admin_login') != 1)
    		redirect(base_url(), 'refresh');
    	if ($param1 == 'create') {
    		$data['school_name']        = $this->input->post('school_name');
    		$data['school_address']    = $this->input->post('school_address');
    		$data['school_district_id']         = $this->input->post('school_district_id');
    		$data['school_state_id']     = $this->input->post('school_state_id');
    		$data['school_postal_code']    = sha1($this->input->post('school_postal_code'));
    		$data['school_contact_primary']       = $this->input->post('school_contact_primary');
    		$data['school_contact_secondary']       = $this->input->post('school_contact_secondary');
    		$data['school_postal_code']       = $this->input->post('school_postal_code');
    		$data['location_data']       = $this->input->post('location_data');
    		$data['email']       = $this->input->post('school_email');
    		$data['password']    = sha1($this->input->post('password'));

    	$config['upload_path'] = './uploads/schools_logo';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $new_name = time() . '-' . $_FILES["userfile"]['name']; 
        $config['file_name'] = $new_name;
        $data['image'] = $config['file_name'];
        $this->load->library('upload', $config);
		move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/schools_logo/' . $data['image']);
        if (!$this->upload->do_upload() && !empty($_FILES['userfile']['name'])) {
            $error = array('error' => $this->upload->display_errors());
        } else {
            $upload_data = $this->upload->data();   
        }
    		$this->db->insert('school', $data);
    		$school_id = $this->db->insert_id();
    		$this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
            redirect(base_url() . 'index.php?admin/institute/', 'refresh');
        }
        if ($param1 == 'do_update') {
        	$data['school_name']        = $this->input->post('school_name');
    		$data['school_address']    = $this->input->post('school_address');
    		$data['school_contact_primary']       = $this->input->post('school_contact_primary');
    		$data['school_contact_secondary']       = $this->input->post('school_contact_secondary');
    		$data['school_postal_code']       = $this->input->post('school_postal_code');
    		$data['password']    = sha1($this->input->post('password'));

    	$config['upload_path'] = './uploads/schools_logo';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $new_name = time() . '-' . $_FILES["userfile"]['name']; 
        $config['file_name'] = $new_name;
        $data['image'] = $config['file_name'];
        $this->load->library('upload', $config);
        move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/schools_logo/' . $data['image']);
        if (!$this->upload->do_upload() && !empty($_FILES['userfile']['name'])) {
            $error = array('error' => $this->upload->display_errors());
        } else {
            $upload_data = $this->upload->data();   
        }

        	$this->db->where('school_id', $param2);
        	$this->db->update('school', $data);
        	
        	$this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
        	redirect(base_url() . 'index.php?admin/institute/', 'refresh');
        } 
        if ($param1 == 'delete') {
        	$this->db->where('teacher_id', $param2);
        	$this->db->delete('teacher');
        	$this->session->set_flashdata('flash_message' , get_phrase('data_deleted'));
        	redirect(base_url() . 'index.php?admin/teacher/', 'refresh');
        }
    }

    function school_location($school_id)
	{
		if ($this->session->userdata('admin_login') != 1)
			redirect(base_url(), 'refresh');
		$page_data['school_id'] = $school_id;
		$page_data['page_name']  = 'School_Location';
		$page_data['page_title'] = get_phrase('Locate_Institute');
		$this->load->view('backend/index', $page_data);
	}



	function get_district($state_id)
	{
		$district = $this->db->get_where('district' , array('state_id' => $state_id))->result_array();
    	foreach ($district as $row) {
    		echo '<option value="' . $row['district_id'] . '">' . $row['name'] . '</option>';
    	}
	}
	


function get_by_category($category) 
    {
    	$running_year = $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description;
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
    		$url = base_url() . 'index.php?admin/more_info/' . $key['student_id'];
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




    function invoice($param1 = '', $param2 = '', $param3 = '')
    {
    	if ($this->session->userdata('admin_login') != 1)
    		redirect(base_url(), 'refresh');

    	if ($param1 == 'create') {
    		$data['student_id']         = $this->input->post('student_id');
    		$data['title']              =   $this->input->post('title');
    		$data['description']        =   $this->input->post('description');
    		$data['tution_amount']      = $this->input->post('tution_amount');
    		$data['term_amount']        = $this->input->post('term_amount');
    		$data['admission_amount']   = $this->input->post('admission_amount');
    		$data['complab_amount']     = $this->input->post('complab_amount');
    		$data['exam_amount']        = $this->input->post('exam_amount');
    		$data['sibling']        = $this->input->post('sibling');
    		$data['sibling_student_id']        = $this->input->post('sibling_student_id');
    		$data['sibling_class_id']        = $this->input->post('sibling_class_id');
    		$data['others_amount']      = $this->input->post('others_amount');
    		$data['amount']             = $data['tution_amount']+$data['term_amount']+$data['admission_amount']+$data['complab_amount']+$data['exam_amount']+$data['others_amount']-$data['sibling_concession'];
    		$data['amount_paid']        = $this->input->post('amount_paid');
    		$data['due']                = $data['amount'] - $data['amount_paid'];
    		$data['status']             = $this->input->post('status');
    		$data['first_invoice']      = 1;
    		$data['creation_timestamp'] = $this->input->post('date');
    		$data['year']               = $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description;

    		$this->db->insert('invoice', $data);
    		$invoice_id = $this->db->insert_id();

    		$data2['invoice_id']        =   $invoice_id;
    		$data2['student_id']        =   $this->input->post('student_id');
    		$data2['title']             =   $this->input->post('title');
    		$data2['description']       =   $this->input->post('description');
    		$data2['payment_type']      =  'income';
    		$data2['method']            =   $this->input->post('method');
    		$data2['amount']            =   $this->input->post('amount_paid');
    		$data2['description']        = $this->input->post('amount_paid_desc');
    		$data2['timestamp']         =   $this->input->post('date');
    		$data2['year']              =  $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description;

    		$this->db->insert('payment' , $data2);

    		$this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
    		redirect(base_url() . 'index.php?admin/student_payment', 'refresh');
    	}

    	if ($param1 == 'create_mass_invoice') {
    		foreach ($this->input->post('student_id') as $id) {

    			$data['student_id']         = $id;
    			$data['title']              = $this->input->post('title');
    			$data['description']        = $this->input->post('description');
    			$data['tution_amount']      = $this->input->post('tution_amount');
	    		$data['term_amount']        = $this->input->post('term_amount');
	    		$data['admission_amount']   = $this->input->post('admission_amount');
	    		$data['complab_amount']     = $this->input->post('complab_amount');
	    		$data['exam_amount']        = $this->input->post('exam_amount');
	    		$data['others_amount']      = $this->input->post('others_amount');
	    		$data['amount']             = $data['tution_amount']+$data['term_amount']+$data['admission_amount']+$data['complab_amount']+$data['exam_amount']+$data['others_amount'];
    			$data['due']                = $data['amount'] - $data['amount_paid'];
    			$data['status']             = $this->input->post('status');
    			$data['creation_timestamp'] = $this->input->post('date');
    			$data['year']               = $this->db->get_where('settings' ,array('type' => 'running_year'))->row()->description;

    			$this->db->insert('invoice', $data);
    			$invoice_id = $this->db->insert_id();

    			$data2['invoice_id']        =   $invoice_id;
    			$data2['student_id']        =   $id;
    			$data2['title']             =   $this->input->post('title');
    			$data2['description']       =   $this->input->post('description');
    			$data2['payment_type']      =  'income';
    			$data2['method']            =   $this->input->post('method');
    			$data2['amount']            =   $this->input->post('amount_paid');
    			$data2['timestamp']         =   $this->input->post('date');
    			$data2['year']               =   $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description;

    			$this->db->insert('payment' , $data2);
    		}

    		$this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
    		redirect(base_url() . 'index.php?admin/student_payment', 'refresh');
    	}

    	if ($param1 == 'do_update') {
    		$data['student_id']         = $this->input->post('student_id');
    		$data['title']              = $this->input->post('title');
    		$data['description']        = $this->input->post('description');
    		$data['amount']             = $this->input->post('amount');
    		$data['status']             = $this->input->post('status');
    		$data['creation_timestamp'] = $this->input->post('date');

    		$this->db->where('invoice_id', $param2);
    		$this->db->update('invoice', $data);
    		$this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
    		redirect(base_url() . 'index.php?admin/invoice', 'refresh');
    	} else if ($param1 == 'edit') {
    		$page_data['edit_data'] = $this->db->get_where('invoice', array(
    			'invoice_id' => $param2
    		))->result_array();
    	}
    	if ($param1 == 'take_payment') {
    		$data['invoice_id']   =   $this->input->post('invoice_id');
    		$data['student_id']   =   $this->input->post('student_id');
    		$data['title']        =   $this->input->post('title');
    		$data['description']  =   $this->input->post('description');
    		$data['payment_type'] =   'income';
    		$data['method']       =   $this->input->post('method');
    		$data['amount']       =   $this->input->post('amount');
    		$data['discount']     =   $this->input->post('discount');
    		$data['timestamp']    =   $this->input->post('timestamp');
    		$data['year']         =   $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description;
    		$this->db->insert('payment' , $data);

    		$status['status']   =   $this->input->post('status');
    		$this->db->where('invoice_id' , $param2);
    		$this->db->update('invoice' , array('status' => $status['status']));

    		$data2['amount_paid']   =   $this->input->post('amount')+$this->input->post('discount');
    		$data2['status']        =   $this->input->post('status');
    		$this->db->where('invoice_id' , $param2);
    		$this->db->set('amount_paid', 'amount_paid + ' . $data2['amount_paid'], FALSE);
    		$this->db->set('due', 'due - ' . $data2['amount_paid'], FALSE);
    		$this->db->set('first_invoice', '0' , FALSE);
    		$this->db->update('invoice');

    		$this->session->set_flashdata('flash_message' , get_phrase('payment_successfull'));
    		redirect(base_url() . 'index.php?admin/income/', 'refresh');
    	}

    	if ($param1 == 'delete') {
    		$this->db->where('invoice_id', $param2);
    		$this->db->delete('invoice');
    		$this->session->set_flashdata('flash_message' , get_phrase('data_deleted'));
    		redirect(base_url() . 'index.php?admin/income', 'refresh');
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
    	if ($this->session->userdata('admin_login') != 1)
    		redirect('login', 'refresh');
    	$page_data['page_name']  = 'income';
    	$page_data['page_title'] = get_phrase('student_payments');
    	$this->db->order_by('creation_timestamp', 'desc');
    	$page_data['invoices'] = $this->db->get('invoice')->result_array();
    	$this->load->view('backend/index', $page_data); 
    }

    function student_payment($param1 = '' , $param2 = '' , $param3 = '') {

    	if ($this->session->userdata('admin_login') != 1)
    		redirect('login', 'refresh');
    	$page_data['page_name']  = 'student_payment';
    	$page_data['page_title'] = get_phrase('create_student_payment');
    	$this->load->view('backend/index', $page_data); 
    }


    function contact_us() {

    	if ($this->session->userdata('admin_login') != 1)
    		redirect('login', 'refresh');
    	$page_data['page_name']  = 'contact_us';
    	$page_data['page_title'] = "Contact Us";
    	$this->load->view('backend/index', $page_data); 
    }
    function about_developer() {

    	if ($this->session->userdata('admin_login') != 1)
    		redirect('login', 'refresh');
    	$page_data['page_name']  = 'about_developer';
    	$page_data['page_title'] = "About Developer";
    	$this->load->view('backend/index', $page_data); 
    }





    function expense($param1 = '' , $param2 = '')
    {
    	if ($this->session->userdata('admin_login') != 1)
    		redirect('login', 'refresh');
    	if ($param1 == 'create') {
    		$data['title']               =   $this->input->post('title');
    		$data['expense_category_id'] =   $this->input->post('expense_category_id');
    		$data['description']         =   $this->input->post('description');
    		$data['payment_type']        =   'expense';
    		$data['method']              =   $this->input->post('method');
    		$data['amount']              =   $this->input->post('amount');
    		$data['timestamp']           =   $this->input->post('timestamp');
    		$data['year']                =   $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description;
    		$this->db->insert('payment' , $data);
    		$this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
    		redirect(base_url() . 'index.php?admin/expense', 'refresh');
    	}

    	if ($param1 == 'edit') {
    		$data['title']               =   $this->input->post('title');
    		$data['expense_category_id'] =   $this->input->post('expense_category_id');
    		$data['description']         =   $this->input->post('description');
    		$data['payment_type']        =   'expense';
    		$data['method']              =   $this->input->post('method');
    		$data['amount']              =   $this->input->post('amount');
    		$data['timestamp']           =   $this->input->post('timestamp');
    		$data['year']                =   $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description;
    		$this->db->where('payment_id' , $param2);
    		$this->db->update('payment' , $data);
    		$this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
    		redirect(base_url() . 'index.php?admin/expense', 'refresh');
    	}

    	if ($param1 == 'delete') {
    		$this->db->where('payment_id' , $param2);
    		$this->db->delete('payment');
    		$this->session->set_flashdata('flash_message' , get_phrase('data_deleted'));
    		redirect(base_url() . 'index.php?admin/expense', 'refresh');
    	}

    	$page_data['page_name']  = 'expense';
    	$page_data['page_title'] = get_phrase('expenses');
    	$this->load->view('backend/index', $page_data); 
    }

    function expense_category($param1 = '' , $param2 = '')
    {
    	if ($this->session->userdata('admin_login') != 1)
    		redirect('login', 'refresh');
    	if ($param1 == 'create') {
    		$data['name']   =   $this->input->post('name');
    		$this->db->insert('expense_category' , $data);
    		$this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
    		redirect(base_url() . 'index.php?admin/expense_category');
    	}
    	if ($param1 == 'edit') {
    		$data['name']   =   $this->input->post('name');
    		$this->db->where('expense_category_id' , $param2);
    		$this->db->update('expense_category' , $data);
    		$this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
    		redirect(base_url() . 'index.php?admin/expense_category');
    	}
    	if ($param1 == 'delete') {
    		$this->db->where('expense_category_id' , $param2);
    		$this->db->delete('expense_category');
    		$this->session->set_flashdata('flash_message' , get_phrase('data_deleted'));
    		redirect(base_url() . 'index.php?admin/expense_category');
    	}

    	$page_data['page_name']  = 'expense_category';
    	$page_data['page_title'] = get_phrase('expense_category');
    	$this->load->view('backend/index', $page_data);
    }

    /**********MANAGE LIBRARY / BOOKS********************/
    function book($param1 = '', $param2 = '', $param3 = '')
    {
    	if ($this->session->userdata('admin_login') != 1)
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
    		redirect(base_url() . 'index.php?admin/book', 'refresh');
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
    		redirect(base_url() . 'index.php?admin/book', 'refresh');
    	} else if ($param1 == 'edit') {
    		$page_data['edit_data'] = $this->db->get_where('book', array(
    			'book_id' => $param2
    		))->result_array();
    	}
    	if ($param1 == 'delete') {
    		$this->db->where('book_id', $param2);
    		$this->db->delete('book');
    		$this->session->set_flashdata('flash_message' , get_phrase('data_deleted'));
    		redirect(base_url() . 'index.php?admin/book', 'refresh');
    	}
    	$page_data['books']      = $this->db->get('book')->result_array();
    	$page_data['page_name']  = 'book';
    	$page_data['page_title'] = get_phrase('manage_library_books');
    	$this->load->view('backend/index', $page_data);

    }
   
    function noticeboard($param1 = '', $param2 = '', $param3 = '')
    {
    	if ($this->session->userdata('admin_login') != 1)
    		redirect(base_url(), 'refresh');

    	if ($param1 == 'create') {
    		$data['notice_title']     = $this->input->post('notice_title');
    		$data['notice']           = $this->input->post('notice');
    		$data['create_timestamp'] = $this->input->post('create_timestamp');
    		$this->db->insert('noticeboard', $data);

    		$check_sms_send = $this->input->post('check_sms');

    		if ($check_sms_send == 1) {
                // sms sending configurations

    			$parents  = $this->db->get('parent')->result_array();
    			$students = $this->db->get('student')->result_array();
    			$teachers = $this->db->get('teacher')->result_array();
    			$date     = $this->input->post('create_timestamp');
    			$message  = $data['notice_title'] . ' ';
    			$message .= get_phrase('on') . ' ' . $date;
    			foreach($parents as $row) {
    				$reciever_phone = $row['phone'];
    				$this->sms_model->send_sms($message , $reciever_phone);
    			}
    			foreach($students as $row) {
    				$reciever_phone = $row['phone'];
    				$this->sms_model->send_sms($message , $reciever_phone);
    			}
    			foreach($teachers as $row) {
    				$reciever_phone = $row['phone'];
    				$this->sms_model->send_sms($message , $reciever_phone);
    			}
    		}

    		$this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
    		redirect(base_url() . 'index.php?admin/noticeboard/', 'refresh');
    	}
    	if ($param1 == 'do_update') {
    		$data['notice_title']     = $this->input->post('notice_title');
    		$data['notice']           = $this->input->post('notice');
    		$data['create_timestamp'] = $this->input->post('create_timestamp');
    		$this->db->where('notice_id', $param2);
    		$this->db->update('noticeboard', $data);

    		$check_sms_send = $this->input->post('check_sms');

    		if ($check_sms_send == 1) {
                // sms sending configurations

    			$parents  = $this->db->get('parent')->result_array();
    			$students = $this->db->get('student')->result_array();
    			$teachers = $this->db->get('teacher')->result_array();
    			$date     = $this->input->post('create_timestamp');
    			$message  = $data['notice_title'] . ' ';
    			$message .= get_phrase('on') . ' ' . $date;
    			foreach($parents as $row) {
    				$reciever_phone = $row['phone'];
    				$this->sms_model->send_sms($message , $reciever_phone);
    			}
    			foreach($students as $row) {
    				$reciever_phone = $row['phone'];
    				$this->sms_model->send_sms($message , $reciever_phone);
    			}
    			foreach($teachers as $row) {
    				$reciever_phone = $row['phone'];
    				$this->sms_model->send_sms($message , $reciever_phone);
    			}
    		}

    		$this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
    		redirect(base_url() . 'index.php?admin/noticeboard/', 'refresh');
    	} else if ($param1 == 'edit') {
    		$page_data['edit_data'] = $this->db->get_where('noticeboard', array(
    			'notice_id' => $param2
    		))->result_array();
    	}
    	if ($param1 == 'delete') {
    		$this->db->where('notice_id', $param2);
    		$this->db->delete('noticeboard');
    		$this->session->set_flashdata('flash_message' , get_phrase('data_deleted'));
    		redirect(base_url() . 'index.php?admin/noticeboard/', 'refresh');
    	}
    	if ($param1 == 'mark_as_archive') {
    		$this->db->where('notice_id' , $param2);
    		$this->db->update('noticeboard' , array('status' => 0));
    		redirect(base_url() . 'index.php?admin/noticeboard/', 'refresh');
    	}

    	if ($param1 == 'remove_from_archived') {
    		$this->db->where('notice_id' , $param2);
    		$this->db->update('noticeboard' , array('status' => 1));
    		redirect(base_url() . 'index.php?admin/noticeboard/', 'refresh');
    	}
    	$page_data['page_name']  = 'noticeboard';
    	$page_data['page_title'] = get_phrase('manage_noticeboard');
    	$this->load->view('backend/index', $page_data);
    }
    function reload_noticeboard() {
    	$this->load->view('backend/admin/noticeboard');
    }
    /* private messaging */

    function message($param1 = '', $param2 = '', $param3 = '') {
    	if ($this->session->userdata('admin_login') != 1)
    		redirect(base_url(), 'refresh');
    	if ($param1 == 'single') {
    		$student_id   = $this->input->post('Contact_number');
    		$data['contact_number'] = $this->db->get_where('student',array('student_id' => $student_id))->row()->phone;
    		$data['message'] = $this->input->post('smstext');
    		$message=$this->input->post('smstext');
            $sender=$this->db->get_where('settings' , array('type' =>'sms_sender_id'))->row()->description; //ex:INVITE
            $sms_api=$this->db->get_where('settings' , array('type' =>'sms_api'))->row()->description;
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
            $sender=$this->db->get_where('settings' , array('type' =>'sms_sender_id'))->row()->description; //ex:INVITE
            $sms_api=$this->db->get_where('settings' , array('type' =>'sms_api'))->row()->description;
            $mobile_number=$numbers;
           	$url= "http://sms.parkentechnology.com/httpapi/httpapi?token=".urlencode($sms_api)."&sender=".urlencode($sender)."&number=".urlencode($mobile_number)."&route=2&type=1&sms=".urlencode($message);
           
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $curl_scraped_page = curl_exec($ch);
            curl_close($ch);
            $this->session->set_flashdata('flash_message',"SMS Sent Successfully");
        }
        if ($param1 == 'whole_sms') {
        	$array1 = $this->db->query("SELECT `phone` FROM `student`")->result_array();
        	$arr = array_map (function($value){ return $value['phone'];} , $array1);
        	$tmp = implode(', ', $arr);
        	for ($i=0; $i < count($arr); $i++) { 
        		$number=substr($arr[$i],-10);
        		$numbers = $numbers . $number.',';
        	}
        	$message=$this->input->post('Whole_SMS');
           $sender=$this->db->get_where('settings' , array('type' =>'sms_sender_id'))->row()->description; //ex:INVITE
            $sms_api=$this->db->get_where('settings' , array('type' =>'sms_api'))->row()->description;
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
    	if ($this->session->userdata('admin_login') != 1)
    		redirect(base_url() . 'index.php?login', 'refresh');

    	if ($param1 == 'do_update') {
    		$data['description'] = $this->input->post('system_name');
    		$this->db->where('type' , 'system_name');
    		$this->db->update('settings' , $data);

    		$data['description'] = $this->input->post('school_name');
    		$this->db->where('type' , 'school_name');
    		$this->db->update('settings' , $data);

    		$data['description'] = $this->input->post('head');
    		$this->db->where('type' , 'head');
    		$this->db->update('settings' , $data);

    		$data['description'] = $this->input->post('sms_api');
    		$this->db->where('type' , 'sms_api');
    		$this->db->update('settings' , $data);

    		$data['description'] = $this->input->post('sms_sender_id');
    		$this->db->where('type' , 'sms_sender_id');
    		$this->db->update('settings' , $data);

    		$data['description'] = $this->input->post('school_name_hindi');
    		$this->db->where('type' , 'school_name_hindi');
    		$this->db->update('settings' , $data);

    		$data['description'] = $this->input->post('school_address');
    		$this->db->where('type' , 'school_address');
    		$this->db->update('settings' , $data);

    		$data['description'] = $this->input->post('school_contact_no');
    		$this->db->where('type' , 'school_contact_no');
    		$this->db->update('settings' , $data);

    		$data['description'] = $this->input->post('school_registeration_number');
    		$this->db->where('type' , 'school_registeration_number');
    		$this->db->update('settings' , $data);

    		$data['description'] = $this->input->post('system_email');
    		$this->db->where('type' , 'system_email');
    		$this->db->update('settings' , $data);

    		$data['description'] = $this->input->post('system_name');
    		$this->db->where('type' , 'system_name');
    		$this->db->update('settings' , $data);

    		$data['description'] = $this->input->post('language');
    		$this->db->where('type' , 'language');
    		$this->db->update('settings' , $data);

    		$data['description'] = $this->input->post('text_align');
    		$this->db->where('type' , 'text_align');
    		$this->db->update('settings' , $data);

    		$data['description'] = $this->input->post('running_year');
    		$this->db->where('type' , 'running_year');
    		$this->db->update('settings' , $data);

    		$data['description'] = $this->input->post('skin');
    		$this->db->where('type' , 'skin_colour');
    		$this->db->update('settings' , $data);
    		$this->session->set_flashdata('flash_message' , get_phrase('data_updated')); 
    		redirect(base_url() . 'index.php?admin/system_settings/', 'refresh');
    	}
    	if ($param1 == 'upload_logo') {
    		echo "<script>alert('Hello');</script";
    		move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/admin_image/logo.png');
    		echo '<script>alert(' . $_FILES['userfile'] . ';</script>';
    		$this->session->set_flashdata('flash_message', get_phrase('settings_updated'));
    		redirect(base_url() . 'index.php?admin/system_settings/', 'refresh');
    	}
    	$page_data['page_name']  = 'system_settings';
    	$page_data['page_title'] = get_phrase('system_settings');
    	$page_data['settings']   = $this->db->get('settings')->result_array();
    	$this->load->view('backend/index', $page_data);
    }



    function update( $task = '', $purchase_code = '' ) {

    	if ($this->session->userdata('admin_login') != 1)
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
    	redirect(base_url() . 'index.php?admin/system_settings');
    }

    /*****SMS SETTINGS*********/
    function sms_settings($param1 = '' , $param2 = '')
    {
    	if ($this->session->userdata('admin_login') != 1)
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
    		redirect(base_url() . 'index.php?admin/sms_settings/', 'refresh');
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
    		redirect(base_url() . 'index.php?admin/sms_settings/', 'refresh');
    	}

    	if ($param1 == 'active_service') {

    		$data['description'] = $this->input->post('active_sms_service');
    		$this->db->where('type' , 'active_sms_service');
    		$this->db->update('settings' , $data);

    		$this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
    		redirect(base_url() . 'index.php?admin/sms_settings/', 'refresh');
    	}

    	$page_data['page_name']  = 'sms_settings';
    	$page_data['page_title'] = get_phrase('sms_settings');
    	$page_data['settings']   = $this->db->get('settings')->result_array();
    	$this->load->view('backend/index', $page_data);
    }
    
    /*****LANGUAGE SETTINGS*********/
    function manage_language($param1 = '', $param2 = '', $param3 = '')
    {
    	if ($this->session->userdata('admin_login') != 1)
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
    		redirect(base_url() . 'index.php?admin/manage_language/edit_phrase/'.$language, 'refresh');
    	}
    	if ($param1 == 'do_update') {
    		$language        = $this->input->post('language');
    		$data[$language] = $this->input->post('phrase');
    		$this->db->where('phrase_id', $param2);
    		$this->db->update('language', $data);
    		$this->session->set_flashdata('flash_message', get_phrase('settings_updated'));
    		redirect(base_url() . 'index.php?admin/manage_language/', 'refresh');
    	}
    	if ($param1 == 'add_phrase') {
    		$data['phrase'] = $this->input->post('phrase');
    		$this->db->insert('language', $data);
    		$this->session->set_flashdata('flash_message', get_phrase('settings_updated'));
    		redirect(base_url() . 'index.php?admin/manage_language/', 'refresh');
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
    		redirect(base_url() . 'index.php?admin/manage_language/', 'refresh');
    	}
    	if ($param1 == 'delete_language') {
    		$language = $param2;
    		$this->load->dbforge();
    		$this->dbforge->drop_column('language', $language);
    		$this->session->set_flashdata('flash_message', get_phrase('settings_updated'));

    		redirect(base_url() . 'index.php?admin/manage_language/', 'refresh');
    	}
    	$page_data['page_name']        = 'manage_language';
    	$page_data['page_title']       = get_phrase('manage_language');
		//$page_data['language_phrases'] = $this->db->get('language')->result_array();
    	$this->load->view('backend/index', $page_data);	
    }

    /*****BACKUP / RESTORE / DELETE DATA PAGE**********/
    function backup_restore($operation = '', $type = '')
    {
    	if ($this->session->userdata('admin_login') != 1)
    		redirect(base_url(), 'refresh');

    	if ($operation == 'create') {
    		$this->crud_model->create_backup($type);
    	}
    	if ($operation == 'restore') {
    		$this->crud_model->restore_backup();
    		$this->session->set_flashdata('backup_message', 'Backup Restored');
    		redirect(base_url() . 'index.php?admin/backup_restore/', 'refresh');
    	}
    	if ($operation == 'delete') {
    		$this->crud_model->truncate($type);
    		$this->session->set_flashdata('backup_message', 'Data removed');
    		redirect(base_url() . 'index.php?admin/backup_restore/', 'refresh');
    	}

    	$page_data['page_info']  = 'Create backup / restore from backup';
    	$page_data['page_name']  = 'backup_restore';
    	$page_data['page_title'] = get_phrase('manage_backup_restore');
    	$this->load->view('backend/index', $page_data);
    }

    /******MANAGE OWN PROFILE AND CHANGE PASSWORD***/
    function manage_profile($param1 = '', $param2 = '', $param3 = '')
    {
    	if ($this->session->userdata('admin_login') != 1)
    		redirect(base_url() . 'index.php?login', 'refresh');
    	if ($param1 == 'update_profile_info') {
    		$data['name']  = $this->input->post('name');
    		$data['email'] = $this->input->post('email');

    		$this->db->where('admin_id', $this->session->userdata('admin_id'));
    		$this->db->update('admin', $data);
    		move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/admin_image/' . $this->session->userdata('admin_id') . '.jpg');
    		$this->session->set_flashdata('flash_message', get_phrase('account_updated'));
    		redirect(base_url() . 'index.php?admin/manage_profile/', 'refresh');
    	}
    	if ($param1 == 'change_password') {
    		$data['password']             = sha1($this->input->post('password'));
    		$data['new_password']         = sha1($this->input->post('new_password'));
    		$data['confirm_new_password'] = sha1($this->input->post('confirm_new_password'));

    		$current_password = $this->db->get_where('admin', array(
    			'admin_id' => $this->session->userdata('admin_id')
    		))->row()->password;
    		if ($current_password == $data['password'] && $data['new_password'] == $data['confirm_new_password']) {
    			$this->db->where('admin_id', $this->session->userdata('admin_id'));
    			$this->db->update('admin', array(
    				'password' => $data['new_password']
    			));
    			$this->session->set_flashdata('flash_message', get_phrase('password_updated'));
    		} else {
    			$this->session->set_flashdata('flash_message', get_phrase('password_mismatch'));
    		}
    		redirect(base_url() . 'index.php?admin/manage_profile/', 'refresh');
    	}
    	$page_data['page_name']  = 'manage_profile';
    	$page_data['page_title'] = get_phrase('manage_profile');
    	$page_data['edit_data']  = $this->db->get_where('admin', array(
    		'admin_id' => $this->session->userdata('admin_id')
    	))->result_array();
    	$this->load->view('backend/index', $page_data);
    }

    // VIEW QUESTION PAPERS
    function question_paper($param1 = "", $param2 = "")
    {
    	if ($this->session->userdata('admin_login') != 1)
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
    	if ($this->session->userdata('admin_login') != 1)
    		redirect('login', 'refresh');

    	if ($param1 == 'create') {
    		$data['name']       = $this->input->post('name');
    		$data['email']      = $this->input->post('email');
    		$data['password']   = sha1($this->input->post('password'));

    		$this->db->insert('librarian', $data);

    		$this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
            $this->email_model->account_opening_email('librarian', $data['email'], $this->input->post('password')); //SEND EMAIL ACCOUNT OPENING EMAIL
            redirect(base_url() . 'index.php?admin/librarian/', 'refresh');
        }

        if ($param1 == 'edit') {
        	$data['name']   = $this->input->post('name');
        	$data['email']  = $this->input->post('email');

        	$this->db->where('librarian_id' , $param2);
        	$this->db->update('librarian' , $data);

        	$this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
        	redirect(base_url() . 'index.php?admin/librarian/', 'refresh');
        }

        if ($param1 == 'delete') {
        	$this->db->where('librarian_id' , $param2);
        	$this->db->delete('librarian');

        	$this->session->set_flashdata('flash_message' , get_phrase('data_deleted'));
        	redirect(base_url() . 'index.php?admin/librarian/', 'refresh');
        }

        $page_data['page_title']    = get_phrase('all_librarians');
        $page_data['page_name']     = 'librarian';
        $this->load->view('backend/index', $page_data);
    }

function upload_settings($param1 = '', $param2 = '', $param3 = '')
    {	


    	if ($this->session->userdata('admin_login') != 1)
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
















