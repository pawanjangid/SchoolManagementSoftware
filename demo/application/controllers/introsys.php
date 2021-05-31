<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class introsys extends CI_Controller
{
    
    
    function __construct()
    {
        parent::__construct();
		$this->load->database();
        $this->load->library('session');
        /*cache control*/
        $this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
        $this->output->set_header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
    }
    

    public function index()
    {
            redirect(base_url() . 'index.php?introsys/main', 'refresh');
    }


    function main()
    {
        
        $page_data['page_name']  = 'main';
        $page_data['page_title'] = get_phrase('teacher_dashboard');
        $this->load->view('backend/introsys', $page_data);
    }
     function school()
    {
        
        $page_data['page_name']  = 'school';
        $page_data['page_title'] = get_phrase('School');
        $this->load->view('backend/introsys', $page_data);
    }
    function login()
    {
        
        $page_data['page_name']  = 'login';
        $page_data['page_title'] = get_phrase('School');
        $this->load->view('backend/login', $page_data);
    }
        function contact_us()
    {
        
        $page_data['page_name']  = 'contact_us';
        $page_data['page_title'] = get_phrase('School');
        $this->load->view('backend/introsys', $page_data);
    }

}