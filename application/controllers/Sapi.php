<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Sapi extends CI_Controller
{
    
    
    function __construct()
    {
        parent::__construct();
        $this->load->database();

    }
     function index() {
       echo base_url();
       
    }
    
    function login($value='')
    {
        $student_id = $this->input->post('student_id');
        $password = sha1($this->input->post('password'));
        $result_array = array();
        $check = $this->db->get_where('student',array('student_id'=>$student_id,'password'=>$password));
        if ($check->num_rows() > 0) {
            
            $result_array = $check->row_array();
            $result_array['birthday'] = date('d-M-Y',$result_array['birthday']);
            $result_array['image'] = base_url().'uploads/student_image/'.$student_id. '.jpg';
            $running_year = $this->db->get_where('school',array('school_id'=>$result_array['school_id']))->row()->running_year;
            $class_id = $this->db->get_where('enroll',array('student_id'=>$student_id,'year'=>$running_year))->row()->class_id;
            $result_array['class'] = $this->db->get_where('class',array('class_id'=>$class_id))->row()->name;
            $result_array['school'] = $this->db->get_where('school',array('school_id'=>$result_array['school_id']))->row()->school_name;
            $result_array['school_address'] = $this->db->get_where('school',array('school_id'=>$result_array['school_id']))->row()->school_address;
            $result_array['running_year'] = $this->db->get_where('enroll',array('student_id'=>$result_array['student_id']))->row()->year;
            $result_array['school_logo'] = base_url().'uploads/schools_logo/'.$this->db->get_where('school',array('school_id'=>$result_array['school_id']))->row()->image;
            
            
            
            
            echo json_encode(array('status'=>'1','message'=>'succesfully','data'=>$result_array));
        }else{
            echo json_encode(array('status'=>'0','message'=>'failed'));
        }
    }
    
    function device_token(){
        $student_id = $this->input->post('student_id');
        $school_id = $this->db->get_where('student',array('student_id'=>$student_id))->row()->school_id;
        $data['user_id'] = $student_id;
        $data['school_id'] = $school_id;
        $data['user_type'] = 'Student';
        $data['device_token'] = $this->input->post('device_token');
        $data['added_time'] = time();
        $check = $this->db->get_where('student',array('student_id'=>$student_id));
        if($check->num_rows() > 0){
            $already = $this->db->get_where('user_token',array('user_id'=>$student_id,'user_type'=>'Student'));
            if($already->num_rows() < 1){
                            $this->db->insert('user_token',$data);
            echo json_encode(array('status'=>'1','message'=>'successfully added'));
            }else{
                $this->db->where('user_id',$student_id);
                $this->db->where('user_type','Student');
                $this->db->update('user_token',$data);
                echo json_encode(array('status'=>'1','message'=>'successfully updated'));
            }

        }else{
            echo json_encode(array('status'=>'0','message'=>'user no longer available'));
        }
    }
    
    function dashboard(){
        $student_id = $this->input->post('student_id');
        $check =  $this->db->get_where('student',array('student_id'=>$student_id));
        if($check->num_rows()>0){
            $school_id = $this->db->get_where('student',array('student_id'=>$student_id))->row()->school_id;
            $running_year = $this->db->get_where('school',array('school_id'=>$school_id))->row()->running_year;
            $enroll_data = $this->db->get_where('enroll',array('student_id'=>$student_id,'year'=>$running_year))->row_array();
            $result_array = array();
            $result_array['school_detail'] = $this->db->get_where('school',array('school_id'=>$school_id))->row_array();
            $result_array['class_detail'] = $this->db->get_where('class',array('class_id'=>$enroll_data['class_id']))->row_array();
            echo json_encode(array('status'=>'1','message'=>'successfully','data'=>$result_array));
        }else{
            echo json_encode(array('status'=>'0','message'=>'Student Not available'));
        }
    }
    
    function push_notifications(){
        $student_id=$this->input->post('student_id');
        $notification = $this->db->get_where('firebase_notification',array('user_id'=>$student_id,'user_type'=>'Student'));
        $output = array();
        if($notification->num_rows()>0){
            $noti = $notification->result_array();
            foreach($noti as $row){
                $row['time'] = date('d-m-Y H:i:s',$row['time']);
                array_push($output,$row);
            }
            $count = $notification->num_rows();
            echo json_encode(array('status'=>'1','message'=>'successfully','data'=>$output,'count'=>$count));
        }else{
            echo json_encode(array('status'=>'0','message'=>'Not any notification available'));
        }
        
    }
    
    function notice(){
        $student_id = $this->input->post('student_id');
        $check = $this->db->get_where('student',array('student_id'=>$student_id));
        if($check->num_rows()>0){
            $school_id = $check->row()->school_id;
            $notice = $this->db->get_where('noticeboard',array('school_id'=>$school_id))->result_array();
            $output = array();
            foreach($notice as $row){
                $row['create_timestamp'] = date('d-m-Y H:i:s',$row['create_timestamp']);
                array_push($output,$row);
            }
            if($notice){
                echo json_encode(array('status'=>'1','message'=>'successfully','data'=>$output));
            }else{
                echo json_encode(array('status'=>'0','message'=>'Not any notification'));
            }
            
        }else{
            echo json_encode(array('status'=>'0','message'=>'invalid student'));
        }
    }
    
    function fees_detail(){
        $student_id = $this->input->post('student_id');
        $school_id = $this->db->get_where('student',array('student_id'=>$student_id))->row()->school_id;
        $student_name = $this->db->get_where('student',array('student_id'=>$student_id))->row()->name;
        $running_year =  $this->db->get_where('school',array('school_id'=>$school_id))->row()->running_year;
        $enroll_id = $this->db->get_where('enroll',array('student_id'=>$student_id,'year'=>$running_year))->row()->enroll_id;
        $payments = $this->db->get_where('payment',array('enroll_id'=>$enroll_id,'year'=>$running_year))->result_array();
        $class_id = $this->db->get_where('enroll',array('enroll_id'=>$enroll_id))->row()->class_id;
        $total_fees = $this->db->get_where('class',array('class_id'=>$class_id))->row()->total_school_fee;
        $output = array();
        $total_paid = 0;
        $total_discount = 0;
        foreach($payments as $row){
            $fees['student_name'] = $student_name;
            $fees['payment_type'] = $row['payment_type'];
            $fees['description']  = $row['description'];
            $fees['amount']       = $row['amount'];
            $fees['discount']     = $row['discount'];
            $fees['time']         = date('d-m-Y',$row['timestamp']);
            $total_paid = $total_paid+$row['amount'];
            $total_discount = $total_discount+$row['discount'];
            array_push($output,$fees);
        }
        $remaining = $total_fees-$total_paid-$total_discount;
        if($payments){
            echo json_encode(array('status'=>'1','message'=>'successfully listed','data'=>$output,'total_fees'=>$total_fees,'total_paid'=>"$total_paid",'total_discount'=>"$total_discount",'total_remaining'=>"$remaining"));
        }else{
            echo json_encode(array('status'=>'0','message'=>'no data found'));
        }
    }
    
    function exam_list(){
        $student_id = $this->input->post('student_id');
        $school_id = $this->db->get_where('student',array('student_id'=>$student_id))->row()->school_id;
        $running_year = $this->db->get_where('school',array('school_id'=>$school_id))->row()->running_year;
        $class_id = $this->db->get_where('enroll',array('student_id'=>$student_id,'year'=>$running_year))->row()->class_id;
        $exam_list = $this->db->get_where('exam',array('class_id'=>$class_id));
        if($exam_list->num_rows()>0){
            $exam_list = $exam_list->result_array();
            echo json_encode(array('status'=>'1','message'=>'successfully','data'=>$exam_list));
        }else{
            echo json_encode(array('status'=>'0','message'=>'failed'));
        }
    }
    
    function marks(){
        $student_id = $this->input->post('student_id');
        $exam_id = $this->input->post('exam_id');
        $school_id = $this->db->get_where('student',array('student_id'=>$student_id))->row()->school_id;
        $running_year = $this->db->get_where('school',array('school_id'=>$school_id))->row()->running_year;
        $check = $this->db->order_by('subject_id desc')->get_where('mark',array('student_id'=>$student_id,'year'=>$running_year,'exam_id'=>$exam_id));
        $mark = array();;
        if($check->num_rows() > 0){
            $marks = $check->result_array();
            foreach($marks as $row){
                $row['subject'] = $this->db->get_where('subject',array('subject_id'=>$row['subject_id']))->row()->name;
                $row['mark_total'] = $this->db->get_where('exam',array('exam_id'=>$row['exam_id']))->row()->maxmarks;
                array_push($mark,$row);
            }
            echo json_encode(array('status'=>'1','message'=>'successfully','data'=>$mark));
        }else{
            echo json_encode(array('status'=>'0','message'=>'failed'));
        }
    } 
    
    function attendence(){
        $student_id = $this->input->post('student_id');
        $school_id = $this->db->get_where('student',array('student_id'=>$student_id))->row()->school_id;
        $running_year = $this->db->get_where('school',array('school_id'=>$school_id))->row()->running_year;
        $attendence = $this->db->get_where('attendance',array('student_id'=>$student_id,'year'=>$running_year));
        $output = array();
        if($attendence->num_rows() > 0){
            $attendence = $attendence->result_array();
            foreach($attendence as $row){
                $row['timestamp'] = date('d-m-Y',$row['timestamp']);
                array_push($output,$row);
            }
            echo json_encode(array('status'=>'1','message'=>'successfully','data'=>$output));
        }else{
            echo json_encode(array('status'=>'0','message'=>'no data found'));
        }
    }
    
    
    function sendmail(){
        $html = '<!DOCTYPE html>
						<html lang="en">
						    <head>
						        <title>Forgot Password Of ANOM</title>
						        <meta charset="utf-8">
						        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
						        <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,900" rel="stylesheet">
						    </head>
						    <body>
						        <div class="container">
						            <div class="row">
						                <div style="background: #54bfe3;width: 100%;">
						                    <h2 style="color: #fff;font-size: 40px;font-weight: bold;text-align: center;padding: 15px 0px;font-family: Arial-black;"><strong>Ebook</strong></h2>
						                </div>
						                <div style="margin: 30px;display: block;">
						                    <h3>Hi ANOM User,</h3>
					                		<p>Click <a href="#">Reset Password</a> for reset password.
						                </div>
						                <div style="display: block;width: 100%;background: #54bfe3;color: floralwhite;">
						                    <p style="text-align: center;margin: 0;padding: 14px;"> For more details contact us.<a href="#"> ANOM</a></p>
						                </div>
						            </div>
						        </div>
						    </body>
						</html>';
			        $config['protocol'] 	= 'smtp';
			        $config['smtp_host'] 	= 'smtp.gmail.com';
			        $config['smtp_port'] 	= '587';
			        $config['smtp_user'] 	= 'pomskhati8@gmail.com';
			        $config['smtp_pass'] 	= 'pomskhati@8';
			        $config['mailtype'] 	= 'html';
			        $config['charset'] 		= 'utf-8';
			        $config['newline'] 		= "\r\n";
			        $config['wordwrap'] 	= TRUE;
					$this->email->initialize($config);
					$this->email->set_mailtype("html");
					$this->email->set_newline("\r\n");

					$this->email->to('pawanjangid.ele@gmail.com');
			        $this->email->from('pomskhati8@gmail.com', 'ANOM');
			        $this->email->subject('Forgot Password Link of ANOM');
			        $this->email->message($html);
			        $ret = $this->email->send();
			        echo $this->email->print_debugger();
                    print_r($ret);
    }
    
    
    
    
}




