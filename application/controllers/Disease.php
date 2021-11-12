<?php

class Disease extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model("disease_model");
    }

    public function index() {
        
        $data["crops"] = $this->disease_model->get_all_entries();
        $data['json_fetch_link'] = site_url('Disease/index_json');
        
        $this->load->view("template/header",$this->activation_model->get_activation_data());
        $this->load->view("disease/list_all_crops", $data);
        $this->load->view("template/footer");
    }

    public function index_json() {
        
        $categories = $this->disease_model->get_all_entries();
        $this->output->set_content_type('application/json')
                ->set_output(json_encode($categories));
    }

    public function add_new() {
        if ($this->input->post('crop_name')) {

           

            $this->disease_model->insert(
                    $this->input->post("crop_name"),
                    $this->input->post("slug")
                    );
            
            $this->session->set_flashdata('message','Disease saved.');
            redirect('Disease');
        } else {
            $this->load->view("template/header",$this->activation_model->get_activation_data());
            $this->load->view("disease/add_new");
            $this->load->view("template/footer");
        }
    }

    public function delete($id = NULL) {
        if ($this->input->post('id')) {
           
            $this->disease_model->delete($this->input->post('id'));
            redirect('Disease');
        } else {
            
            $data['crop'] = $this->disease_model->get_one_crop($id);

            $this->load->view("template/header",$this->activation_model->get_activation_data());
            $this->load->view("disease/delete", $data);
            $this->load->view("template/footer");
        }
    }

    public function edit($id = NULL) {
        if ($id) {
            
            $data['crop'] = $this->disease_model->get_one_crop($id);
            $this->load->view("template/header");
            $this->load->view("disease/edit", $data);
            $this->load->view("template/footer");
        } else if ($this->input->post('crop_name')) {
            

            $this->disease_model->edit(
                    $this->input->post("id"),
                    $this->input->post("crop_name"),
                    $this->input->post("slug")
            );
            redirect('Disease');
        } else {
            $this->load->view("template/header",$this->activation_model->get_activation_data());
            $this->load->view("disease/edit");
            $this->load->view("template/footer");
        }
    }
    
    public function slugAvailable($slug){
        //json response
        $response = $this->disease_model->isSlugAvailble($slug);
        
        $a = array(
            'response'=>$response
        );
        
        $this->output->set_content_type('application/json')
                ->set_output(json_encode($a));
    }

}
