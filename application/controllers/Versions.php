<?php

class Versions extends MY_Controller {

    public function __construct() {

        parent::__construct();
        $this->load->model("version_model");
    }

    public function index() {
        $data = array();
        
        if($this->input->get('version')){
            $this->load->model('product_model');
            $version = $this->input->get('version');
            $data['products'] = $this->product_model->getVersionProducts($version);
        }else{
            
        }
        
        
        $data["categories"] = $this->version_model->get_all_entries();
        $data['json_fetch_link'] = site_url('Versions/index_json');
        $data['total_categories'] = $this->version_model->get_total_categories();
        
        
        $this->loadViewEmbedded("product/versions/list_all_categories", $data);
        
    }

    public function index_json() {
        
        $categories = $this->version_model->get_all_entries();
        $this->output->set_content_type('application/json')
                ->set_output(json_encode($categories));
    }

    public function add_new() {
        if ($this->input->post('product_category_name')) {

            

            $this->version_model->insert($this->input->post("product_category_name"));
            
            $this->session->set_flashdata('message','Version saved.');
            redirect('Versions');
        } else {
            
            $this->loadViewEmbedded("product/versions/add_new",array());
            
        }
    }

    public function delete($id = NULL) {
        if ($this->input->post('id')) {
            
            $this->version_model->delete($this->input->post('id'));
            $this->index();
        } else {
            
            $data['category'] = $this->version_model->get_one_category($id);

            
            $this->loadViewEmbedded("product/versions/delete", $data);
            
        }
    }

    public function edit($id = NULL) {
        if ($id) {
            
            $data['category'] = $this->version_model->get_one_category($id);
            
            $this->loadViewEmbedded("product/versions/edit", $data);
            
        } else if ($this->input->post('product_category_name')) {
            

            $this->version_model->edit($this->input->post("id"), $this->input->post("product_category_name")
            );
            $this->index();
        } else {
            
            $this->loadViewEmbedded("product/versions/edit");
            
        }
    }

}
