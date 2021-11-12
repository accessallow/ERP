<?php

class CategoryTags {

    public static $deleted = 0;
    public static $available = 1;

}

class Version_model extends CI_Model {

    var $product_category_name = "";
    var $tag = NULL;

    public function __construct() {
        $this->load->database();
    }

    function insert($name) {
        $this->product_category_name = $name;
        $this->tag = CategoryTags::$available;

        $this->db->insert("product_version", $this);
    }

    function edit($id, $name) {
        $this->product_category_name = $name;
        $this->tag = CategoryTags::$available;
        
        $this->db->update("product_version", $this, array('id' => $id));
    }

    function delete($id) {
        // bhai delete kuch nahi karenge..bas tag ki value "deleted" set kar denge
        // comman sense naam ki bhi koi cheej hoti hai
        if($id==1000){
            return;
        }
        
        $this->db->where('id', $id);
        $this->db->update("product_version",array('tag'=>  CategoryTags::$deleted));
       //TBD CASCADING LOGIC
        $product_category_update_query = "";
        //$this->db->query($product_category_update_query);
        
    }

    function get_all_entries() {
        $this->db->order_by("product_category_name","asc");
        $query = $this->db->get_where("product_version",
                array('tag'=>  CategoryTags::$available));
        return $query->result();
    }
    
    

    function get_one_category($id) {

        $query = $this->db->get_where("product_version", array('id' => $id,'tag'=>  CategoryTags::$available));
        return $query->result();
    }

    function get_category_name($id) {
        $a = $this->get_one_category($id);
        return $a[0]->product_category_name;
    }
    
    ///////////////////////////////////////////////////////////
    /////////////// METADATA QUERY FUNCTIONS //////////////////
    ///////////////////////////////////////////////////////////
    
    function get_total_categories() {
        $query = $this->db->get_where('product_version',array(
            'tag'=>  CategoryTags::$available
        ));
        $result = $query->result();
        $q = count($result);
        
        return $q;
    }
    
    
    
    

}
