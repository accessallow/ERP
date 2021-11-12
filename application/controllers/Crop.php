<?php

class Crop extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model("crop_model");
    }

    public function index() {
        
        $data["crops"] = $this->crop_model->get_all_entries();
        $data['json_fetch_link'] = site_url('Crop/index_json');
        
        $this->load->view("template/header",$this->activation_model->get_activation_data());
        $this->load->view("crop/list_all_crops", $data);
        $this->load->view("template/footer");
    }

    public function index_json() {
        
        $categories = $this->crop_model->get_all_entries();
        $this->output->set_content_type('application/json')
                ->set_output(json_encode($categories));
    }

    public function add_new() {
        if ($this->input->post('crop_name')) {

           

            $this->crop_model->insert(
                    $this->input->post("crop_name"),
                    $this->input->post("slug")
                    );
            
            $this->session->set_flashdata('message','Crop saved.');
            redirect('Crop');
        } else {
            $this->load->view("template/header",$this->activation_model->get_activation_data());
            $this->load->view("crop/add_new");
            $this->load->view("template/footer");
        }
    }

    public function delete($id = NULL) {
        if ($this->input->post('id')) {
           
            $this->crop_model->delete($this->input->post('id'));
            redirect('Crop');
        } else {
            
            $data['crop'] = $this->crop_model->get_one_crop($id);

            $this->load->view("template/header",$this->activation_model->get_activation_data());
            $this->load->view("crop/delete", $data);
            $this->load->view("template/footer");
        }
    }

    public function edit($id = NULL) {
        if ($id) {
            
            $data['crop'] = $this->crop_model->get_one_crop($id);
            $this->load->view("template/header");
            $this->load->view("crop/edit", $data);
            $this->load->view("template/footer");
        } else if ($this->input->post('crop_name')) {
            

            $this->crop_model->edit(
                    $this->input->post("id"),
                    $this->input->post("crop_name"),
                    $this->input->post("slug")
            );
            $this->index();
        } else {
            $this->load->view("template/header",$this->activation_model->get_activation_data());
            $this->load->view("crop/edit");
            $this->load->view("template/footer");
        }
    }
    
    public function slugAvailable($slug){
        //json response
        $response = $this->crop_model->isSlugAvailble($slug);
        
        $a = array(
            'response'=>$response
        );
        
        $this->output->set_content_type('application/json')
                ->set_output(json_encode($a));
    }

}
