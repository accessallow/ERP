<?php

class Coverage extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('seller_model');
        $this->load->model('mapping_model');
        $this->load->model('crop_model');
        $this->load->model('screen_model');
        $this->load->model('states_model');
        $this->load->model('district_model');
        $this->load->model('coverage_model');
    }

    public function product_mapping($product_id) {
        $product = $this->product_model->get_one_product_joined($product_id);
        $product = $product[0];

        $crops = $this->crop_model->get_all_entries();
        $screens = $this->screen_model->get();

        $states = $this->states_model->get_all_entries();
        $districts = $this->district_model->get_all_entries();

        $data = array(
            'add_new_link' => site_url("Mapping/addMapping/$product_id"),
            'heading' => "All mappings for $product->product_name",
            //'mappings'=>$this->mapping_model->get($product_id),
            'products' => $this->product_model->get_all_entries_joined(),
            'product' => $product,
            'crops' => $crops,
            'cropString' => $product->crop_association,
            'screenString' => $product->screen_association,
            'stateString' => $product->state_association,
            'districtString' => $product->district_association,
            'cropScreens' => $this->prepareCropAndScreens($crops, $screens),
            'states' => $states,
            'statesDistricts' => $this->prepareStatesAndDistricts($states, $districts),
            'mapping' => $this->mapping_model->getMapping($product_id)
        );
        $this->loadViewEmbedded('mapping/dashboard', $data);
    }

    public function prepareCropAndScreens($crops, $screens) {
        foreach ($crops as $c) {
            $c->screens = array();
            foreach ($screens as $s) {
                if ($c->id == $s->crop_id) {
                    array_push($c->screens, $s);
                }
            }
        }
        return $crops;
    }

    public function prepareStatesAndDistricts($states, $districts) {
        foreach ($states as $c) {
            $c->districts = array();
            foreach ($districts as $s) {
                if ($c->id == $s->state_id) {
                    array_push($c->districts, $s);
                }
            }
        }
        return $states;
    }

    public function addMapping($seller_id) {
        if ($this->input->post('seller_id')) {
            $seller_id = $this->input->post('seller_id');
            $mapping = array(
                'seller_id' => $seller_id,
                'state_id' => $this->input->post('state_id'),
                'district_id' => $this->input->post('district_id'),
                'block_id' => $this->input->post('block_id')
            );

            if ($this->coverage_model->isMappingExist($mapping) == false) {
                $this->coverage_model->insertMapping($mapping);
                $this->set_success_flash("Mapping added into system.");
            } else {
                $this->set_error_flash("Mapping already exist in system.");
            }

            redirect('Seller/single_seller/' . $seller_id);
        } else {
            $seller = $this->seller_model->get_one_seller($seller_id);
            $seller = $seller[0];
            $data = array(
                'json_fetch_link' => site_url('Block/index_json'),
                'seller' => $seller
            );
            $this->loadViewEmbedded('coverage/add_new', $data);
        }
    }

    public function editMapping($mappingId) {

        if ($this->input->post('mapping_id')) {
            $seller_id = $this->input->post('seller_id');
            $mapping = array(
                'seller_id' => $seller_id,
                'state_id' => $this->input->post('state_id'),
                'district_id' => $this->input->post('district_id'),
                'block_id' => $this->input->post('block_id')
            );
            
//            var_dump($mapping);
//            die();

            if ($this->coverage_model->isMappingExist($mapping) == false) {
                $this->coverage_model->updateMapping($this->input->post('mapping_id'), $mapping);
                $this->set_success_flash("Mapping updated into system.");
            } else {
                $this->set_info_flash("No change in mapping.");
            }


            redirect('Seller/single_seller/' . $seller_id);
        } else {
            $mapping = $this->coverage_model->getMappingFromId($mappingId);
            $mapping = $mapping[0];
            $seller = $this->seller_model->get_one_seller($mapping->seller_id);
            $seller = $seller[0];

            $data = array(
                'json_fetch_link' => site_url('Block/index_json'),
                'seller' => $seller,
                'mapping' => $mapping
            );
            $this->loadViewEmbedded('coverage/edit', $data);
        }
    }

    public function deleteMapping($mappingId) {
        $mapping = $this->coverage_model->getMappingFromId($mappingId);



        if ($this->input->post('id')) {
            $mapping = $this->coverage_model->getMappingFromId($this->input->post('id'));
            $this->coverage_model->deleteMapping($this->input->post('id'));
            $this->set_error_flash("Mapping deleted.");
            redirect('Seller/single_seller/' . $mapping[0]->seller_id);
        } else {

            //$data['block'] = $this->block_model->get_one_block($id);
            $data = array(
                'back_url' => site_url('Seller/single_seller/' . $mapping[0]->seller_id),
                'delete_form_url' => site_url('Coverage/deleteMapping/' . $mappingId),
                'item_id' => $mappingId,
                'confirmation_line' => 'Are you sure want to delete this mapping?'
            );


            $this->loadViewEmbedded("common/delete", $data);
        }
    }

}
