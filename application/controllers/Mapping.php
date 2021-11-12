<?php

class Mapping extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('product_model');
        $this->load->model('mapping_model');
        $this->load->model('crop_model');
        $this->load->model('screen_model');
        $this->load->model('states_model');
        $this->load->model('district_model');
        $this->load->model('mapping_model');
        $this->load->model('version_model');
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
            'mapping' => $this->mapping_model->getMapping($product_id),
            'version_mapping'=>$this->mapping_model->getVersionMapping($product_id)
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

    public function addMapping($product_id) {
        if ($this->input->post('product_id')) {
            $product_id = $this->input->post('product_id');
            $mapping = array(
                'product_id' => $product_id,
                'state_id' => $this->input->post('state_id'),
                'district_id' => $this->input->post('district_id'),
                'block_id' => $this->input->post('block_id')
            );

            if ($this->mapping_model->isMappingExist($mapping) == false) {
                $this->mapping_model->insertMapping($mapping);
                $this->set_success_flash("Mapping added into system.");
            } else {
                $this->set_error_flash("Mapping already exist in system.");
            }

            redirect('Mapping/product_mapping/' . $product_id);
        } else {
            $product = $this->product_model->get_one_product_joined($product_id);
            $product = $product[0];
            $data = array(
                'json_fetch_link' => site_url('Block/index_json'),
                'product' => $product
            );
            $this->loadViewEmbedded('mapping/add_new', $data);
        }
    }

    public function editMapping($mappingId) {

        if ($this->input->post('mapping_id')) {
            $product_id = $this->input->post('product_id');
            $mapping = array(
                'product_id' => $product_id,
                'state_id' => $this->input->post('state_id'),
                'district_id' => $this->input->post('district_id'),
                'block_id' => $this->input->post('block_id')
            );

            if ($this->mapping_model->isMappingExist($mapping) == false) {
                $this->mapping_model->updateMapping($this->input->post('mapping_id'), $mapping);
                $this->set_success_flash("Mapping updated into system.");
            } else {
                $this->set_info_flash("No change in mapping.");
            }


            redirect('Mapping/product_mapping/' . $product_id);
        } else {
            $mapping = $this->mapping_model->getMappingFromId($mappingId);
            $mapping = $mapping[0];
            $product = $this->product_model->get_one_product_joined($mapping->product_id);
            $product = $product[0];

            $data = array(
                'json_fetch_link' => site_url('Block/index_json'),
                'product' => $product,
                'mapping' => $mapping
            );
            $this->loadViewEmbedded('mapping/edit', $data);
        }
    }

    public function deleteMapping($mappingId) {
        $mapping = $this->mapping_model->getMappingFromId($mappingId);



        if ($this->input->post('id')) {
            $mapping = $this->mapping_model->getMappingFromId($this->input->post('id'));
            $this->mapping_model->deleteMapping($this->input->post('id'));
            $this->set_error_flash("Mapping deleted.");
            redirect('Mapping/product_mapping/' . $mapping[0]->product_id);
        } else {

            //$data['block'] = $this->block_model->get_one_block($id);
            $data = array(
                'back_url' => site_url('Mapping/product_mapping/' . $mapping[0]->product_id),
                'delete_form_url' => site_url('Mapping/deleteMapping/' . $mappingId),
                'item_id' => $mappingId,
                'confirmation_line' => 'Are you sure want to delete this mapping?'
            );


            $this->loadViewEmbedded("common/delete", $data);
        }
    }
    
    //Version Mapping
        public function addVersionMapping($product_id) {
        if ($this->input->post('product_id')) {
            $product_id = $this->input->post('product_id');
            $mapping = array(
                'product_id' => $product_id,
                'version'=>$this->input->post('version_name')
            );

            if ($this->mapping_model->isVersionMappingExist($mapping) == false) {
                $this->mapping_model->insertVersionMapping($mapping);
                $this->set_success_flash("Version Mapping added into system.");
            } else {
                $this->set_error_flash("Mapping already exist in system.");
            }

            redirect('Mapping/addVersionMapping/' . $product_id);
        } else {
            $product = $this->product_model->get_one_product_joined($product_id);
            $product = $product[0];
            $data = array(
                'json_fetch_link' => site_url('Block/index_json'),
                'product' => $product,
                'unmapped_versions'=>$this->mapping_model->getUnmappedVersions($product_id),
                'mapped_versions'=>$this->mapping_model->getMappedVersions($product_id)
            );
            $this->loadViewEmbedded('version_mapping/add_new', $data);
        }
    }
    
     public function editVersionMapping($mappingId) {

        if ($this->input->post('mapping_id')) {
            $product_id = $this->input->post('product_id');
            $mapping = array(
                'product_id' => $product_id,
                'state_id' => $this->input->post('state_id'),
                'district_id' => $this->input->post('district_id'),
                'block_id' => $this->input->post('block_id')
            );

            if ($this->mapping_model->isMappingExist($mapping) == false) {
                $this->mapping_model->updateMapping($this->input->post('mapping_id'), $mapping);
                $this->set_success_flash("Mapping updated into system.");
            } else {
                $this->set_info_flash("No change in mapping.");
            }


            redirect('Mapping/product_mapping/' . $product_id);
        } else {
            $mapping = $this->mapping_model->getVersionMappingFromId($mappingId);
            $mapping = $mapping[0];
            $product = $this->product_model->get_one_product_joined($mapping->product_id);
            $product = $product[0];

            $data = array(
                'json_fetch_link' => site_url('Block/index_json'),
                'product' => $product,
                'mapping' => $mapping
            );
            $this->loadViewEmbedded('mapping/edit', $data);
        }
    }

    public function detachVersionMapping($mappingId) {
        $mapping = $this->mapping_model->getVersionMappingFromId($mappingId);



        if ($this->input->post('id')) {
            $mapping = $this->mapping_model->getVersionMappingFromId($this->input->post('id'));
            $this->mapping_model->deleteVersionMapping($this->input->post('id'));
            $this->set_error_flash("Version Mapping deleted.");
            redirect('Mapping/addVersionMapping/' . $mapping[0]->product_id);
        } else {

            //$data['block'] = $this->block_model->get_one_block($id);
            $data = array(
                'back_url' => site_url('Mapping/addVersionMapping/' . $mapping[0]->product_id),
                'delete_form_url' => site_url('Mapping/detachVersionMapping/' . $mappingId),
                'item_id' => $mappingId,
                'confirmation_line' => 'Are you sure want to delete this version-mapping?'
            );


            $this->loadViewEmbedded("common/delete", $data);
        }
    }
    

}
