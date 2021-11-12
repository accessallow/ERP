<?php

class States extends MY_Controller {

    public function __construct() {

        parent::__construct();
        $this->load->model("states_model");
    }

    public function index() {
        
        $data["categories"] = $this->states_model->get_all_entries();
        $data['json_fetch_link'] = site_url('States/index_json');
        $data['total_categories'] = $this->states_model->get_total_categories();
        
        $this->load->view("template/header",$this->activation_model->get_activation_data());
        $this->load->view("states/list_all_categories", $data);
        $this->load->view("template/footer");
    }

    public function index_json() {
        $this->load->model("states_model");
        $categories = $this->states_model->get_all_entries();
        $this->output->set_content_type('application/json')
                ->set_output(json_encode($categories));
    }

    public function add_new() {
        if ($this->input->post('product_category_name')) {

            $this->load->model("states_model");

            $this->states_model->insert($this->input->post("product_category_name"));
            
            $this->session->set_flashdata('message','State saved.');
            redirect('States');
        } else {
            $this->load->view("template/header",$this->activation_model->get_activation_data());
            $this->load->view("states/add_new");
            $this->load->view("template/footer");
        }
    }

    public function delete($id = NULL) {
        if ($this->input->post('id')) {
            $this->load->model("states_model");
            $this->states_model->delete($this->input->post('id'));
            $this->index();
        } else {
            $this->load->model("states_model");
            $data['category'] = $this->states_model->get_one_category($id);

            $this->load->view("template/header",$this->activation_model->get_activation_data());
            $this->load->view("states/delete", $data);
            $this->load->view("template/footer");
        }
    }

    public function edit($id = NULL) {
        if ($id!=null) {
            $this->load->model("states_model");
            $data['category'] = $this->states_model->get_one_category($id);
            
            $this->load->view("template/header");
            $this->load->view("states/edit", $data);
            $this->load->view("template/footer");
        } else if ($this->input->post('product_category_name')) {
            $this->load->model("states_model");

            $this->states_model->edit($this->input->post("id"), $this->input->post("product_category_name")
            );
            $this->index();
        } else {
            $this->load->view("template/header",$this->activation_model->get_activation_data());
            $this->load->view("states/edit");
            $this->load->view("template/footer");
        }
    }

}
