<?php

//core/micontroller
class MY_Controller extends CI_Controller {

    var $message = null;
    var $alert_type = null;
    var $icon_class = null;
    var $data = null;

    function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');


        //Authentication check
        if ($this->session->userdata('login')) {

            //Activation releted common code
            $this->load->model('activation_model');
            $this->activation_model->degrade();
            $activated = $this->activation_model->is_product_activated();
            if ($activated == false) {
                redirect('Activation/register');
            }
        } else {
            redirect('Front/login');
        }
    }

    function set_success_flash($message) {
        $this->session->set_flashdata('alert_class', 'alert-success');
        $this->session->set_flashdata('message', $message);
        $this->session->set_flashdata('glyphicon_class', 'glyphicon-ok-circle');
    }

    function set_error_flash($message) {
        $this->session->set_flashdata('alert_class', 'alert-danger');
        $this->session->set_flashdata('message', $message);
        $this->session->set_flashdata('glyphicon_class', 'glyphicon-remove-circle');
    }

    function set_info_flash($message) {
        $this->session->set_flashdata('alert_class', 'alert-info');
        $this->session->set_flashdata('message', $message);
        $this->session->set_flashdata('glyphicon_class', 'glyphicon-info-sign');
    }

    function loadViewEmbedded($viewName, $data) {
        $this->load->view("template/header", $this->activation_model->get_activation_data());
        $this->load->view($viewName, $data);
        $this->load->view("template/footer");
    }

    function flashTag() {
        if ($this->session->flashdata('message')) {
            echo "<div class=\"alert".$this->session->flashdata('alert_class')."\" role=\"alert\">";
            echo "<span class=\"glyphicon ".$this->session->flashdata('glyphicon_class')."\"></span>";
            echo "<strong>".$this->session->flashdata('message')."</strong>";
            echo "</div>";
        }
    }
    function jsonOutput($context,$data){
        $context->output->set_content_type('application/json')
                ->set_output(json_encode($data));
    }
    
    function assertOrDie($variable,$message){
        if(sizeof($variable)==0){
            echo $message.'<br/>';
            echo "<a href=\"#\" onclick=\"window.history.back();\">Back</a>";
            die();
        }
    }

}
