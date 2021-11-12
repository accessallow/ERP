<?php

class DiseaseTags {

    public static $deleted = 0;
    public static $available = 1;

}

class Disease_model extends CI_Model {

    var $disease_name = "";
    var $slug = "";
    var $tag = NULL;

    public function __construct() {
        $this->load->database();
    }

    function insert($name,$slug) {
        $this->disease_name = $name;
        $this->slug = $slug;
        $this->tag = DiseaseTags::$available;

        $this->db->insert("diseases", $this);
    }

    function edit($id, $name,$slug) {
        $this->disease_name = $name;
        $this->slug = $slug;
        $this->tag = DiseaseTags::$available;
        
        $this->db->update("diseases", $this, array('id' => $id));
    }

    function delete($id) {
        $this->db->delete('diseases',array(
            'id'=>$id
        ));
    }

    function get_all_entries() {
        $this->db->order_by("disease_name","asc");
        $query = $this->db->get_where("diseases",
                array('tag'=>  DiseaseTags::$available));
        return $query->result();
    }
    
    

    function get_one_crop($id) {

        $query = $this->db->get_where("diseases", array('id' => $id,'tag'=>  DiseaseTags::$available));
        return $query->result();
    }

    function get_crop_name($id) {
        $a = $this->get_one_crop($id);
        return $a[0]->crop_name;
    }
    
    ///////////////////////////////////////////////////////////
    /////////////// METADATA QUERY FUNCTIONS //////////////////
    ///////////////////////////////////////////////////////////
    
    function get_total_crops() {
        $q = $this->db->count_all('diseases');

        return $q;
    }

    function isSlugAvailble($slug){
        $query = $this->db->get_where('diseases',array(
            'slug'=>$slug
        ));
        $result = $query->result();
        if(count($result)>0){
            return false;
        }
        return true;
    }

}
