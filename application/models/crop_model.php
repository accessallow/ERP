<?php

class CropTags {

    public static $deleted = 0;
    public static $available = 1;

}

class Crop_model extends CI_Model {

    var $crop_name = "";
    var $slug = "";
    var $tag = NULL;

    public function __construct() {
        $this->load->database();
    }

    function insert($name,$slug) {
        $this->crop_name = $name;
        $this->slug = $slug;
        $this->tag = CropTags::$available;

        $this->db->insert("crops", $this);
    }

    function edit($id, $name,$slug) {
        $this->crop_name = $name;
        $this->slug = $slug;
        $this->tag = CropTags::$available;
        
        $this->db->update("crops", $this, array('id' => $id));
    }

    function delete($id) {
        $this->db->delete('crops',array(
            'id'=>$id
        ));
        // bhai delete kuch nahi karenge..bas tag ki value "deleted" set kar denge
        // comman sense naam ki bhi koi cheej hoti hai
        
//        $this->db->where('id', $id);
//        $this->db->update("crops",array('tag'=>  CropTags::$deleted,
//            ));
        // send all the orphans to orphanage
        // the products which were having that died-category are orphan records
        // all orphans products will fall under special category called "uncategorized"
        // programmers too have sentiments...
        
        
        // here I took a very big number 1000 as "uncategorized" category
        // if the business grows too much...ho sakta hai hame ye value change karni pade
        // and I hope this happens... :D
        
        // whatever it is...this logic works
        //$product_category_update_query = "update products set"
         //       . " product_category=1000 where product_category=$id;";
        //$this->db->query($product_category_update_query);
        
    }

    function get_all_entries() {
        $this->db->order_by("crop_name","asc");
        $query = $this->db->get_where("crops",
                array('tag'=>  CropTags::$available));
        return $query->result();
    }
    
    

    function get_one_crop($id) {

        $query = $this->db->get_where("crops", array('id' => $id,'tag'=>  CropTags::$available));
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
        $q = $this->db->count_all('crops');

        return $q;
    }

    function isSlugAvailble($slug){
        $query = $this->db->get_where('crops',array(
            'slug'=>$slug
        ));
        $result = $query->result();
        if(count($result)>0){
            return false;
        }
        return true;
    }

}
