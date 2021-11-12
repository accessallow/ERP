<?php

class Inquiry extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('inquiry_model');
    }

    public function dashboard() {
        $inquiries = $this->inquiry_model->get_all();
        $this->loadViewEmbedded("inquiry/dashboard", array(
            'inquiries'=>$inquiries
        ));
    }

    public function addEdit() {
        
    }

    public function delete($id) {
        if ($this->input->post('inquiry_id')) {
            
            $this->inquiry_model->deleteInquiry($this->input->post('inquiry_id'));
            redirect('Inquiry/dashboard');
        } else {
            
            $data['inquiry'] = $this->inquiry_model->getOneInquiry($id);

            
            $this->loadViewEmbedded("inquiry/delete", $data);
            
        }
    }

    public function mark($inquiryId,$inquiryStatus) {
        $this->inquiry_model->updateStatus($inquiryId,$inquiryStatus);
        redirect('Inquiry/dashboard');
    }

    public function loadViewEmbedded($viewName, $data) {
        $this->load->view("template/header", $this->activation_model->get_activation_data());
        $this->load->view($viewName, $data);
        $this->load->view("template/footer");
    }

}
