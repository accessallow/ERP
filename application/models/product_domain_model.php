<?php

class DomainTags {

    public static $deleted = 0;
    public static $available = 1;

}

class Product_domain_model extends CI_Model {

    var $product_category_name = "";
    var $tag = NULL;

    public function __construct() {
        $this->load->database();
    }

    function insert($name) {
        $this->product_category_name = $name;
        $this->tag = DomainTags::$available;

        $this->db->insert("product_domain", $this);
    }

    function edit($id, $name) {
        $this->product_category_name = $name;
        $this->tag = DomainTags::$available;
        
        $this->db->update("product_domain", $this, array('id' => $id));
    }

    function delete($id) {
        // bhai delete kuch nahi karenge..bas tag ki value "deleted" set kar denge
        // comman sense naam ki bhi koi cheej hoti hai
        if($id==1000){
            return;
        }
        
        $this->db->where('id', $id);
        $this->db->delete("product_domain");
        // send all the orphans to orphanage
        // the products which were having that died-category are orphan records
        // all orphans products will fall under special category called "uncategorized"
        // programmers too have sentiments...
        
        
        // here I took a very big number 1000 as "uncategorized" category
        // if the business grows too much...ho sakta hai hame ye value change karni pade
        // and I hope this happens... :D
        
        // whatever it is...this logic works
        $product_category_update_query = "update products set"
                . " product_domain=1000 where product_domain=$id;";
        $this->db->query($product_category_update_query);
        
    }

    function get_all_entries() {
        $this->db->order_by("product_category_name","asc");
        $query = $this->db->get_where("product_domain",
                array('tag'=>  DomainTags::$available));
        return $query->result();
    }
    

    function get_one_category($id) {

        $query = $this->db->get_where("product_domain", array('id' => $id,'tag'=>  DomainTags::$available));
        return $query->result();
    }

    function get_category_name($id) {
        $a = $this->get_one_category($id);
        return $a[0]->crop_name;
    }
    
    ///////////////////////////////////////////////////////////
    /////////////// METADATA QUERY FUNCTIONS //////////////////
    ///////////////////////////////////////////////////////////
    
    function get_total_categories() {
        $query = $this->db->get_where('product_category',array(
            'tag'=>  DomainTags::$available
        ));
        $result = $query->result();
        $q = count($result);
        
        return $q;
    }

    

}
