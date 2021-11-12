<?php

class District extends MY_Controller {

    public function __construct() {

        parent::__construct();
        $this->load->model("district_model");
        $this->load->model('states_model');
    }

    public function index() {

        $data["categories"] = $this->district_model->get_all_entries();
        $data['json_fetch_link'] = site_url('District/index_json');
        $data['total_categories'] = $this->district_model->getDistrictCount();


        $this->loadViewEmbedded("district/dashboard", $data);
    }

    public function index_json() {

        $states = $this->states_model->get_all_entries();
        $districts = $this->district_model->get_all_entries();

        foreach ($states as $s) {
            $s->districts = $this->getMyDistricts($districts, $s->id);
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

    public function add_new() {
        if ($this->input->post('district_name')) {
            $this->district_model->insert(array(
                'state_id' => $this->input->post('state_id'),
                'district_name' => $this->input->post("district_name")
            ));

            $this->session->set_flashdata('message', 'District saved.');
            redirect('District/add_new');
        } else {

            $data = array(
                'states' => $this->states_model->get_all_entries()
            );

            $this->loadViewEmbedded("district/add_new", $data);
        }
    }

    public function delete($id = NULL) {
        if ($this->input->post('id')) {

            $this->district_model->delete($this->input->post('id'));
            $this->index();
        } else {

            $data['district'] = $this->district_model->get_one_district($id);


            $this->loadViewEmbedded("district/delete", $data);
        }
    }

    public function edit($id = NULL) {
        if ($id != null) {
            $data = array(
                'states' => $this->states_model->get_all_entries(),
                'district' => $this->district_model->get_one_district($id)
            );
            $this->loadViewEmbedded("district/edit", $data);
        } else if ($this->input->post('district_name')) {

            $id = $this->input->post('id');
            
            $this->district_model->edit($id,array(
                'state_id' => $this->input->post('state_id'),
                'district_name' => $this->input->post("district_name")
            ));
            $this->session->set_flashdata('message', 'District updated.');
            redirect('District');
        }
    }

}
