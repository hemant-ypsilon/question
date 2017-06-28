<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends MY_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('Main_content_model','front_model');
    }

	public function index()
	{
        if($this->is_admin() == true)
        redirect('admin/dashboard');
		    $data = array();
	   	  $this->load->view('admin/common/login', $data);
	}

    public function login()
    {   
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == TRUE)
            {
                   $userName = $this->input->post('username');
                   $passWord = $this->input->post('password');
                   $options = array(
                        'table' => 'admin',
                        'where' => array('admin_email' => $userName, 'admin_password' => md5($passWord))
                    );

                  $response = $this->front_model->customGet($options);
                  if(count($response)){
                    $this->session->set_userdata(array(
                            'adminId' => $response[0]->admin_id,
                            'adminEmail' => $response[0]->admin_id
                        ));
                    $this->session->set_flashdata('success', 'Admin login successfully!');
                    redirect('admin/dashboard');
                  }else{
                     $this->session->set_flashdata('error', 'username or password not matched!');
                     $this->load->view('admin/common/login');
                  }
            }
            else
            {
                   $this->session->set_flashdata('error', 'Some error while login!');
                   $this->load->view('admin/common/login');
            }
    }

	public function dashboard()
	{   
        if($this->is_admin() == false)
        redirect('admin');
        $data = array();

        // Total user
        $query = "SELECT count('User_id') as totalUser FROM User WHERE User_id != 0";
        $data['User'] = $this->front_model->customQuery($query);

        // // Total category
         $query = "SELECT count('Question_Id') as totalQue FROM Questions WHERE Question_Id != 0";
         $data['Question'] = $this->front_model->customQuery($query);

        // // Total store
        // $query = "SELECT count('ProductsStore_id') as totalStore FROM ProductsStore WHERE ProductsStore_id != 0";
        // $data['Store'] = $this->front_model->customQuery($query);

        $data['title'] = 'Dashbaord';
        $this->view_admintemplate('dashboard', $data);
    }

    public function logout(){
        session_destroy();
        $this->session->set_flashdata('success', 'Admin logout successfully!');
        redirect('admin/index');
    }

    public function users(){
        if($this->is_admin() == false)
        redirect('admin');
        $data = array();

        // get all users
        $options = array('table' => 'User');
        $data['alluser'] = $this->front_model->customGet($options);

        $data['title'] = 'All Users';
        $this->view_admintemplate('users_list', $data);
    }


     public function changepassword(){
        if($this->is_admin() == false)
        redirect('admin');
        $data = array();
        $data['title'] = 'Change Password';
        $this->view_admintemplate('change_password', $data);
    }

    public function delete(){
        $deleteId       = $_POST['deleteId'];
        $deleteColumn   = $_POST['deleteColumn'];
        $table          = $_POST['table'];

        if(isset($deleteId ) && isset($deleteColumn ) && isset($table )){

           $this->db->delete( $table , array($deleteColumn => $deleteId)); 

             echo json_encode(array('status' => 1, 'msg' => 'Item deleted!'));
         
        }

    }

    public function updateMoreTable($id = NULL, $value =NULL){
      if($id != NULL && $value != NULL){
          $options = array(
                    'table' => 'Questions',
                    'where' => array('Questions_Template_Id' => $id),
                    'data'  => array('Status' => $value)
                  );

          $this->front_model->customUpdate( $options ); 
          return true;
         }else{
          return false;
      }
    }

    public function changeStatus(){
        $id             = $_POST['id'];
        $column         = $_POST['column'];
        $table          = $_POST['table'];
        $value          = $_POST['value'];


        if(isset($id ) && isset($column ) && isset($table ) && isset($value )){
            $options = array(
                'table' => $table,
                'where' => array($column => $id),
                'data'  => array('Status' => $value)
              );

            $this->front_model->customUpdate( $options ); 

            if($table == 'Template'){
              $this->updateMoreTable($id, $value);
            }

             echo json_encode(array('status' => 1, 'msg' => 'Status changed!'));
         
        }

    }

    function change_password() {
        if (isset($_POST['submit'])) {
            $options = array(
                'table' => 'admin',
                'where' => $where = array('admin_id' => $this->session->userdata('adminId'), 'admin_password' => md5($this->input->post('old_password')))
                );
            $check_password = $this->front_model->customGet($options);


            if (count($check_password) == 0) {

                $this->session->set_flashdata('error', 'Old Password does not match');
                redirect('change-password');

            } else {

                $options = array(
                        'table' => 'admin',
                        'where' => array('admin_id' => $this->session->userdata('adminId')),
                        'data'  => array('admin_password' => md5($this->input->post('new_password')))
                    );

                $is_update = $this->front_model->customUpdate($options);

                if(!$is_update){
                     $this->session->set_flashdata('info', 'There is no changes found in password!');
                     redirect('change-password');
                }else{
                //----------------Mail Start------------------//

                $message = '<h1>Question App</h1></b></b><p>Your password has been changed successfully Your Email = ' . $this->session->userdata('adminEmail') . '.</p>
            <p><a href="' . base_url() . '" [astyle]></a></p></b>,
            </b></b><p>The Admin</p>';

                $to = $this->session->userdata('adminEmail');
                $subject = 'Password Changed';
                $headers = "MIME-Version: 1.0" . "\r\n";
                $headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
                $headers .= 'From: Actually<"hemant.ypsilon@gmail.com">' . "\r\n";
                mail($to, $subject, $message, $headers);

                //----------------Mail End------------------//

                $this->session->set_flashdata('success', 'Password successfully changed!');
                redirect('change-password');
             }
         }
        } else {
           $this->changepassword();
        }
    }

    public function adduser(){

        if($this->is_admin() == false)
            redirect('admin');

        if(isset($_POST['submit'])){

        $this->form_validation->set_rules('userType', 'User Type', 'required');
        $this->form_validation->set_rules('User_Email', 'User Email', 'required|valid_email');
        $this->form_validation->set_rules('User_MobileNo', 'User MobileNo', 'required|numeric');
        $this->form_validation->set_rules('User_Password', 'User Password', 'required');
        $this->form_validation->set_rules('cpassword', 'Password Confirmation', 'required|matches[User_Password]');

        if ($this->form_validation->run() == TRUE)
            {

                   if($this->input->post('userType') == 1){
                        $userType = $this->input->post('userType');
                   }else{
                        $userType = $this->input->post('userType');
                   }

                  $data = array(
                        'User_FullName'         => $this->input->post('User_FullName'),
                        'User_Email'            => $this->input->post('User_Email'),
                        'User_MobileNo'         => $this->input->post('User_MobileNo'),
                        'User_FullName'         => md5($this->input->post('User_Password')),
                        'User_FullName'         => $this->input->post('User_FullName'),
                        'User_Created_Datetime' => date('Y-m-d h:i:s')
                    );

                   $options = array(
                        'table' => 'User',
                        'data' => $data
                    );

                  $response = $this->front_model->customInsert($options);

                  if(count($response)){
                    $this->session->set_flashdata('success', 'User added successfully!');
                    redirect('add-user');
                  }else{
                     $this->session->set_flashdata('error', 'some error while inserting into database!');
                     redirect('add-user');
                  }
            }
            else
            {
                   $this->adduser();
            }
        }else{

            $data = array();
            $data['title'] = 'Add User';
            $this->view_admintemplate('add_user', $data);

      }

    }

    public function questionTemplate(){
        if($this->is_admin() == false)
        redirect('admin');
        $data = array();

        // get all category
        $options = array('table' => 'Template', 'order' => array('Template_Id' => 'DESC'));
        $data['allquestion'] = $this->front_model->customGet($options);

       // echo $this->last_query(); exit;

        $data['title'] = 'All Question';
        $this->view_admintemplate('templatelist_list', $data);
    }

      public function question(){
        if($this->is_admin() == false)
        redirect('admin');

        $segement = $this->uri->segment(2);
          if(!isset($segement) || $segement == ''){
          redirect('all-template');
        }

        $data = array();


        // get all category
        $options = array('table' => 'Questions', 'order' => array('Question_Id' => 'ASC'), 'where' => array('Questions_Template_Id' => $segement));
        $data['allquestion'] = $this->front_model->customGet($options);

        // get template detail
        $optionsTemplate = array('table' => 'Template', 'where' => array('Template_Id' => $segement), 'single' => true);
        $data['template'] = $this->front_model->customGet($optionsTemplate);
        
        $data['title'] = 'All Question';
        $this->view_admintemplate('question_list', $data);
    }

    public function addquestion(){

        if($this->is_admin() == false)
            redirect('admin');

        if(isset($_POST['submit'])){

               $status = $_POST['submit'];
               $templateName = $this->input->post('Template_Name');

               $options = array(
                  'table' => 'Template',
                  'data'  => array('Template_Name' => $templateName, 'Template_Create_Datetime' => date('Y-m-d h:i:s'), 'Status' => $status)
                );

               $templateId = $this->front_model->customInsert($options);

               if(!$templateId){
                  $this->session->set_flashdata('error', 'Error occurred while inserting questions template!');
                    redirect('add-question'); exit;
               }

               for($i = 0; $i < count($_POST['Question_name']); $i++){
                  $response[] = $this->db->insert('Questions', array('Questions_Template_Id' => $templateId, 'Question_name' => $_POST['Question_name'][$i], 'Question_Input_Type' => $_POST['Question_Input_Type'][$i], 'Question_DateTime' => date('Y-m-d h:i:s'), 'Status' => $status));
               }

                if(count($response)){
                    $this->session->set_flashdata('success', 'Questions added successfully!');
                    redirect('all-template');
                  }else{
                     $this->session->set_flashdata('error', 'Error occurred while inserting questions!');
                     redirect('add-question');
           }

             
        }else{

            $data = array();
            $data['title'] = 'Add Question';
            $this->view_admintemplate('add_question', $data);

      }

    }



   public function editquestion(){

        if($this->is_admin() == false)
            redirect('admin');

        if(isset($_POST['submit'])){

      

                $questionId = $this->input->post('questionId');

                $data = array(
                                'Question_name' => $this->input->post('Question_name'),
                                'Question_Input_Type' => $this->input->post('Question_Input_Type')
                    );
                   

                 $options = array(
                      'table' => 'Questions',
                      'data' => $data,
                      'where' => array('Question_Id' => $questionId)
                  );

                  $response = $this->front_model->customUpdate($options);

                  if($response > 0){
                    $this->session->set_flashdata('success', 'Question updated successfully!');
                    redirect('all-question');
                  }elseif($response == 0){
                     $this->session->set_flashdata('info', 'No update found!');
                     redirect('all-question');
                  }else{
                     $this->session->set_flashdata('error', 'Error occurred while inserting Question!');
                     redirect('all-question');
                  }

        }else{
            $questionId = $this->uri->segment(2);
            if(isset($questionId) &&  $questionId != ''){
            $data = array();
            // get category
            $options = array('table' => 'Questions', 'where' => array('Question_Id' => $questionId), 'single' => true);
            $data['question'] = $this->front_model->customGet($options);
            $data['title'] = 'Edit Question';
            $this->view_admintemplate('edit_question', $data);
          }else{
            $this->session->set_flashdata('error', 'Some error');
            redirect('all-question');
          }

      }

    }


    public function edittemplate(){

        if($this->is_admin() == false)
            redirect('admin');

        if(isset($_POST['submit'])){

      
               $status = $_POST['submit'];

               $templateId = $this->input->post('templateId');

               $templateName = $this->input->post('Template_Name');

               $options = array(
                  'table' => 'Template',
                  'data'  => array('Template_Name' => $templateName),
                  'where' => array('Template_Id' => $templateId)
                );

               $isupdate = $this->front_model->customUpdate($options);

               $this->db->delete('Questions', array('Questions_Template_Id' => $templateId));
               $deleteQuestion = $this->db->affected_rows();

               if(!$deleteQuestion){
                  $this->session->set_flashdata('error', 'Error occurred while updating questions template!');
                    redirect('edit-question/'.$templateId); exit;
               }

               for($i = 0; $i < count($_POST['Question_name']); $i++){
                  $response[] = $this->db->insert('Questions', array('Questions_Template_Id' => $templateId, 'Question_name' => $_POST['Question_name'][$i], 'Question_Input_Type' => $_POST['Question_Input_Type'][$i], 'Question_DateTime' => date('Y-m-d h:i:s'), 'Status' => $status));
               }

                if(count($response)){
                    $this->session->set_flashdata('success', 'Questions added successfully!');
                    redirect('all-template');
                  }else{
                     $this->session->set_flashdata('error', 'Error occurred while inserting questions!');
                     redirect('edit-question/'.$templateId);
           }


        }else{
            $templateId = $this->uri->segment(2);
            if(isset($templateId) &&  $templateId != ''){
            $data = array();

            $options = array('table' => 'Template', 'where' => array('Template_Id' => $templateId), 'single' => true);
            $data['template'] = $this->front_model->customGet($options);

            $options2 = array('table' => 'Questions', 'where' => array('Questions_Template_Id' => $templateId));
            $data['question'] = $this->front_model->customGet($options2);

            $data['title'] = 'Edit Question';
            $this->view_admintemplate('edit_template', $data);
          }else{
            $this->session->set_flashdata('error', 'Some error');
            redirect('all-template');
          }

      }

    }


    public function edituser(){

        if($this->is_admin() == false)
            redirect('admin');

        if(isset($_POST['submit'])){

               $userId = $this->input->post('userId');
               if($this->input->post('userType') == 1){
                    $userType = $this->input->post('userType');
               }else{
                    $userType = $this->input->post('userType');
               }

              $data = array(
                    'User_FullName'         => $this->input->post('User_FullName'),
                    'User_Email'            => $this->input->post('User_Email'),
                    'User_MobileNo'         => $this->input->post('User_MobileNo'),
                    'User_UserType'         => $userType
                );

               $options = array(
                    'table' => 'User',
                    'data'  => $data,
                    'where' => array('User_Id' => $userId)
                );

              $response = $this->front_model->customUpdate($options);

              if($response > 0){
                  $this->session->set_flashdata('success', 'User updated successfully!');
                  redirect('all-user');
              }elseif($response == 0){
                 $this->session->set_flashdata('info', 'No update found!');
                 redirect('all-user');
              }else{
                 $this->session->set_flashdata('error', 'Error while updating user!');
                 redirect('all-user');
              }
            
        }else{

          $userId = $this->uri->segment(2);

          if(isset($userId) &&  $userId != ''){
            $data = array();
            // get user
            $options = array('table' => 'User', 'where' => array('User_Id' => $userId), 'single' => true );
            $data['user'] = $this->front_model->customGet($options);

            $data['title'] = 'Edit User';
            $this->view_admintemplate('edit_user', $data);
          }else{
            redirect('all-user');
          }

      }
    }

    function chnageOrder(){
       $sectionids = $_POST['sectionsid'];
        $count = 1;
        if (is_array($sectionids)) {
            foreach ($sectionids as $sectionid) {
                $query  = "Update Category SET Category_OrderDisplay = $count";
                $query .= " WHERE Category_Id='".$sectionid."'";
               
                 $this->db->query($query,$single = false, $updDelete = true);
               
                $count++;
            }
           
            echo '{"status":"success"}';
        } else {
            echo '{"status":"failure", "message":"No Update happened. Could be an internal error, please try again."}';
        }
    }


}