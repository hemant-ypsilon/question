<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class MY_Controller extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('main_content_model', 'front_model');
       
    }

    function replaceStr($str = "", $repTo = NULL, $repWith = NULL) {
        if ($repTo != NULL && $repWith != NULL && $str != '') {
            $str = str_replace($repTo, $repWith, $str);

            return $str;
        } else {
            return FALSE;
        }
    }

    public function view_admintemplate($file = NULL, $data = NULL, $script = NULL){
            if(!empty($this->session->userdata('userData'))){
                $userData = $this->session->userdata('userData');
                $user_id  = $userData['userData'][0]->user_id;
                $where    = array('user_id'=>$user_id);
                $data['userData'] = $this->login_model->get_record_where('user', $where);
            };
            
            //print_r($userData);
            if($script != NULL)
            $this->load->view("$script");
            $this->load->view('admin/common/header.php', $data);
            $this->load->view('admin/common/sidebar.php', $data);
            if($file  != NULL)
            $this->load->view('admin/'.$file, $data );
            $this->load->view('admin/common/footer.php', $data );
        }

    //  calculate lat long
    function getLatLong() {

        $address = $this->input->post('address');
        $zipcode = $this->input->post('zipcode');
        if ($zipcode != '') {
            $zip = trim($address) . ", " . trim($postcode);
        } else {
            $zip = trim($address);
        }
        $url = "http://maps.googleapis.com/maps/api/geocode/json?address=" . urlencode($zip) . "&sensor=false";
        $result_string = file_get_contents($url);
        $result = json_decode($result_string, TRUE);
        if ($result['status'] != "ZERO_RESULTS") {
            //echo "HERE";
            if ($result['status'] != 'OVER_QUERY_LIMIT') {
                //echo "NT HERE";
                $result1[] = $result['results'][0];
                $result2[] = $result1[0]['geometry'];
                $result3[] = $result2[0]['location'];
                $responce = array('status' => 1, 'lat' => $result3[0]['lat'], 'long' => $result3[0]['lng']);
            } else {
                $result3 = array("Error" => "Can't find latitude, longitude. Please fill manually");
                $responce = array('status' => 0, 'error' => $result3);
            }
            echo json_encode($responce);
        }
    }


    function is_admin(){
        if(isset($_SESSION['adminId'])){
            return true;
        }else{
            return false;
        }
    }

    function last_query(){
        return $this->db->last_query();
    }

    function uploadImag($image = NULL, $folder = NULL, $name = NULL){
      //  echo $image['ProductsStore_ProfileImage']['name']; exit;
         if($image != NULL && $folder != NULL && $name != NULL){
                  $temp = explode('.',$image[$name]['name']);
                  $extension = end($temp);
                  $config['upload_path'] = './images/'.$folder.'/';
                  $config['allowed_types'] = 'gif|jpg|png|jpeg';
                  $config['max_size'] = '8600';
                  $config['max_width']  = '2000';
                  $config['max_height']  = '2000';
                  $new_name = time().preg_replace("/[^a-zA-Z0-9]/", "", $image[$name]['name']).'.'.$extension;
                  $config['file_name'] = $new_name;
                  $this->load->library('upload');
                  $this->upload->initialize($config);
                  $error = array();

                if ( ! $this->upload->do_upload($name)) {
                          $error = array('error' => $this->upload->display_errors());
                }


                if(count($error)){
                    return array('status' => 0, 'error' => $error);
                }else{
                    return  array('status' => 1, 'name' => $new_name);
                }

            }else{

            return false;
        }
    }

}
