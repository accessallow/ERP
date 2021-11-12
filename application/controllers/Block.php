<?php

class Block extends MY_Controller {

    public function __construct() {

        parent::__construct();
        $this->load->model("district_model");
        $this->load->model('states_model');
        $this->load->model('block_model');
    }

    public function index() {

        $data["categories"] = $this->district_model->get_all_entries();
        $data['json_fetch_link'] = site_url('Block/index_json');
        $data['total_categories'] = $this->district_model->getDistrictCount();


        $this->loadViewEmbedded("block/dashboard", $data);
    }

    public function index_json() {

        $states = $this->states_model->get_all_entries();
        $districts = $this->district_model->get_all_entries();
        $blocks = $this->block_model->get_all_entries();

        foreach ($states as $s) {
            $s->districts = $this->getMyDistricts($districts, $s->id);
            foreach ($s->districts as $d) {
                $district_blocks = $this->getMyBlocks($blocks, $d->id);
                $d->blocks = $district_blocks;
            }
        }



        $this->output->set_content_type('application/json')
                ->set_output(json_encode($states));
    }

    public function getMyDistricts($allDistricts, $stateId) {
        $myDistricts = array();
        foreach ($allDistricts as $d) {
            if ($d->state_id == $stateId) {
                array_push($myDistricts, $d);
            }
        }
        return $myDistricts;
    }
    public function getMyBlocks($allBlocks,$districtId){
        $myBlocks = array();
        foreach ($allBlocks as $d) {
            if ($d->district_id == $districtId) {
                array_push($myBlocks, $d);
            }
        }
        return $myBlocks;
    }

    public function add_new() {
        if ($this->input->post('block_name')) {
            $this->block_model->insert(array(
                'state_id' => $this->input->post('state_id'),
                'district_id' => $this->input->post("district_id"),
                'block_name'=>$this->input->post('block_name')
            ));

            $this->set_success_flash("Block saved.");
            redirect('Block/add_new');
        } else {

            $data = array(
                'states' => $this->states_model->get_all_entries(),
                'json_fetch_link'=>  site_url('Block/index_json')
            );

            $this->loadViewEmbedded("block/add_new", $data);
        }
    }

    public function delete($id = NULL) {
        if ($this->input->post('id')) {

            $this->block_model->delete($this->input->post('id'));
            $this->set_error_flash("Block deleted.");
            redirect('Block');
        } else {

            //$data['block'] = $this->block_model->get_one_block($id);
            $data = array(
                'back_url'=>  site_url('Block'),
                'delete_form_url'=> site_url('Block/delete'),
                'item_id'=>$id,
                'confirmation_line'=>'Are you sure want to delete this block?'
            );


            $this->loadViewEmbedded("common/delete", $data);
        }
    }

    public function edit($id = NULL) {
        if ($id != null) {
            $block = $this->block_model->get_one_block($id);
           $data = array(
                'states' => $this->states_model->get_all_entries(),
                'json_fetch_link'=>  site_url('Block/index_json'),
                'block'=>$block[0]
            );

            $this->loadViewEmbedded("block/edit", $data);
            
        } else if ($this->input->post('block_name')) {
            $id = $this->input->post('id');
            $this->block_model->edit($id, array(
                'state_id' => $this->input->post('state_id'),
                'district_id' => $this->input->post("district_id"),
                'block_name'=>$this->input->post('block_name')
            ));
            
         

            $this->set_success_flash("Block updated.");
            redirect('Block');
        }
    }

}
