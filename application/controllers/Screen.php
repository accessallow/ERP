<?php

class Screen extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('screen_model');
        $this->load->model('crop_model');
    }

    public function addScreenToCrop($cropId) {
        if ($this->input->post('crop_id') && $this->input->post('screen_name')) {
            $cropId = $this->input->post('crop_id');
            $screenName = $this->input->post('screen_name');
            $cropSlug = $this->input->post('crop_slug');
            
            $screenName = $cropSlug.'_'.$screenName;
            
            $this->screen_model->insert(array(
                'crop_id'=>$cropId,
                'screen_name'=>$screenName
            ));
            $this->set_success_flash("Screen $screenName added to crop.");
            redirect('Screen/addScreenToCrop/'.$cropId);
        } else {
            $crop = $this->crop_model->get_one_crop($cropId);
            $crop = $crop[0];
            $data = array(
                'cropName'=>$crop->crop_name,
                'cropId'=>$crop->id,
                'formSubmitUrl'=>  site_url('Screen/addScreenToCrop/'.$cropId),
                'screenTitle'=>'Add screen to crop: '.$crop->crop_name,
                'crop_slug'=>$crop->slug,
                'screens'=>$this->screen_model->get($cropId)
            );
            $this->loadViewEmbedded('screen/add_new', $data);
        }
    }
    public function getScreensOfACrop($cropId){
        $this->jsonOutput($this, $this->screen_model->get($cropId));
    }
    
    public function slugAvailable($crop_slug,$slug){
        //json response
        $slug = $crop_slug.'_'.$slug;
        $response = $this->screen_model->isSlugAvailble($slug);
        
        $a = array(
            'response'=>$response
        );
        
        $this->output->set_content_type('application/json')
                ->set_output(json_encode($a));
    }
    public function delete($crop_id, $id){
        if ($this->input->post('id')) {

            $this->screen_model->delete($this->input->post('id'));
            redirect('Screen/addScreenToCrop/'.$crop_id);
        } else {

            $data['delete_form_url'] = site_url('Screen/delete/'.$crop_id.'/'. $id);
            $data['confirmation_line'] = "Are you sure want to delete this screen entry?";
            $data['back_url'] = site_url('Screen/addScreenToCrop/'.$crop_id);
            $data['item_id'] = $id;

            $this->loadViewEmbedded("common/delete", $data);
        }
    }
}
