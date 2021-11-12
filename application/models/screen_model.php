<?php

class Screen_model extends CI_Model{
    var $tableName = 'screens';
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    public function insert($obj){
        $this->db->insert($this->tableName,$obj);
    }
    public function update($id,$obj){
        $this->db->update($this->tableName,$obj,array(
            'id'=>$id
        ));
    }
    public function delete($id){
        $this->db->delete($this->tableName,array(
            'id'=>$id
        ));
    }
    public function get($crop_id=null){
        $query = null;
        if($crop_id!=null){
            $query = $this->db->get_where($this->tableName,array(
                'crop_id'=>$crop_id
            ));
        }else{
            $query = $this->db->get($this->tableName);
        }
        return $query->result();
    }
    
    function isSlugAvailble($slug){
        $query = $this->db->get_where($this->tableName,array(
            'screen_name'=>$slug
        ));
        $result = $query->result();
        if(count($result)>0){
            return false;
        }
        return true;
    }
}


