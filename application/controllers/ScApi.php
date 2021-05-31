<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Scapi extends CI_Controller
{
    
    
    function __construct()
    {
        parent::__construct();
        $this->load->database();

    }
     function index() {
       echo base_url();
       
    }
    


    
    
}




