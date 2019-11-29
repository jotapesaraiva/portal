<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Select_ctrl extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('select_model');
    }
    public function index(){
    // Loading model to fetch all records from database
        $data['students'] = $this->select_model->show_students();
        vd($data);
        $this->load->view('select_view', $data);
    }
    // Validation Function
    public function error(){
        $this->load->library('form_validation');
        $abcd = $this->input->post('city');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        $this->form_validation->set_rules('dname', 'Username', 'required|min_length[5]|max_length[15]');// Validating Name field.
        $this->form_validation->set_rules('demail', 'Email', 'required|valid_email'); // Validating Email field.
        $this->form_validation->set_rules('city', 'city', 'required|callback_select_validate'); // Validating select option field.
        if ($this->form_validation->run() == FALSE) {
            $this->index();
        } else{
            echo "<script>alert('Form Submitted Successfully....!!!! ');</script>";
            $this->index();
        }
    }
    // Below function is called for validating select option field.
    public function select_validate($abcd)
    {
        // 'none' is the first option that is default "-------Choose City-------"
        if($abcd=="none"){
            $this->form_validation->set_message('select_validate', 'Please Select Your City.');
            return false;
        } else{
        // User picked something.
            return true;
        }
    }

}

/* End of file Select_ctrl.php */
/* Location: ./application/controllers/Select_ctrl.php */