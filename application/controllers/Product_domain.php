<?php

class Product_domain extends MY_Controller {

    public function __construct() {

        parent::__construct();
    }

    public function index() {
        $this->load->model("product_domain_model");
        $data["categories"] = $this->product_domain_model->get_all_entries();
        $data['json_fetch_link'] = site_url('Product_domain/index_json');
        $data['total_categories'] = $this->product_domain_model->get_total_categories();
        
        $this->load->view("template/header",$this->activation_model->get_activation_data());
        $this->load->view("product/domain/list_all_categories", $data);
        $this->load->view("template/footer");
    }

    public function index_json() {
        $this->load->model("product_domain_model");
        $categories = $this->product_domain_model->get_all_entries();
        $this->output->set_content_type('application/json')
                ->set_output(json_encode($categories));
    }

    public function add_new() {
        if ($this->input->post('product_category_name')) {

            $this->load->model("product_domain_model");

            $this->product_domain_model->insert($this->input->post("product_category_name"));
            
            $this->session->set_flashdata('message','Domain saved.');
            redirect('Product_domain');
        } else {
            $this->load->view("template/header",$this->activation_model->get_activation_data());
            $this->load->view("product/domain/add_new");
            $this->load->view("template/footer");
        }
    }

    public function delete($id = NULL) {
        if ($this->input->post('id')) {
            $this->load->model("product_domain_model");
            $this->product_domain_model->delete($this->input->post('id'));
            $this->index();
        } else {
            $this->load->model("product_domain_model");
            $data['category'] = $this->product_domain_model->get_one_category($id);

            $this->load->view("template/header",$this->activation_model->get_activation_data());
            $this->load->view("product/domain/delete", $data);
            $this->load->view("template/footer");
        }
    }

    public function edit($id = NULL) {
        if ($id!=null) {
            $this->load->model("product_domain_model");
            $data['category'] = $this->product_domain_model->get_one_category($id);
            
            $this->load->view("template/header");
            $this->load->view("product/domain/edit", $data);
            $this->load->view("template/footer");
        } else if ($this->input->post('product_category_name')) {
            $this->load->model("product_domain_model");

            $this->product_domain_model->edit($this->input->post("id"), $this->input->post("product_category_name")
            );
            $this->index();
        } else {
            $this->load->view("template/header",$this->activation_model->get_activation_data());
            $this->load->view("product/domain/edit");
            $this->load->view("template/footer");
        }
    }

}
