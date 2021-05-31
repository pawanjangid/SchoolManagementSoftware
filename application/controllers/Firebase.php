<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Firebase extends CI_Controller
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
       echo 'hello';
    }

    /***** UPDATE PRODUCT *****/

    function sendnotification(){

    //API URL of FCM
    
    $title = 'this is message for anom';
    $message = 'this is first message from anom.com';


    $registration_ids = array('d9ldZ0JaeII:APA91bEQD7U1kzcNHgJ0IJMxiDHXWR5S8WN003IwGFayrzBQjtvfj2C2hcvoAJ8mL1mc2RWuKwcjR2QIMfoM05B2YfX5zg8wn-jJwHTr0Pwm10d50P-SV-YdM018b4hTA5SADTEK1Sog','d9ldZ0JaeII:APA91bEQD7U1kzcNHgJ0IJMxiDHXWR5S8WN003IwGFayrzBQjtvfj2C2hcvoAJ8mL1mc2RWuKwcjR2QIMfoM05B2YfX5zg8wn-jJwHTr0Pwm10d50P-SV-YdM018b4hTA5SADTEK1Sog');

    $url = base_url().'uploads/logo.png';
    
    define( 'API_ACCESS_KEY', 'AAAAOKq35Bw:APA91bFzDDZM_y5gFUyrnPsxS8ABVXOhc5yNYUD_Wg5BBooDvx4LX7SO41dw98qwqvAHJw9IdDORjm4YuSDVEYyh4-AagEvFD_lIouO-uRc-jwSuDYXql-QjCn1ypx0ZjpJjpp_Iuo0q');

        
    $msg = array
          (
        'body'  => $message,
        'title' => $title,
        "picture" => $url
         );
    $fields = array
            (
                'registration_ids'        => $registration_ids,
                'notification'  => $msg
            );
    
    
    $headers = array
            (
                'Authorization: key=' . API_ACCESS_KEY,
                'Content-Type: application/json'
            );
#Send Reponse To FireBase Server    
        $ch = curl_init();
        curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
        curl_setopt( $ch,CURLOPT_POST, true );
        curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
        curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
        curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
        curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
        $result = curl_exec($ch );
        echo $result;
        curl_close( $ch );
   
}

}
