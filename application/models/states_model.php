<?php


class States_model extends CI_Model {

    

    public function __construct() {
        $this->load->database();
    }

    function insert($name) {
        
        
        $obj = array(
            'state_name'=>$name
        );

        $this->db->insert("states", $obj);
    }

    function edit($id, $name) {
        
         $obj = array(
            'state_name'=>$name
        );
             
        $this->db->update("states", $obj, array('id' => $id));
    }

    function delete($id) {
        // bhai delete kuch nahi karenge..bas tag ki value "deleted" set kar denge
        // comman sense naam ki bhi koi cheej hoti hai
        
        $this->db->where('id', $id);
        $this->db->delete("states");
        
        
    }

    function get_all_entries() {
        $this->db->order_by("state_name","asc");
        $query = $this->db->get("states");
        return $query->result();
    }
    

    function get_one_category($id) {

        $query = $this->db->get_where("states", array('id' => $id));
        return $query->result();
    }

    function get_category_name($id) {
        $a = $this->get_one_category($id);
        return $a[0]->state_name;
    }
    
    ///////////////////////////////////////////////////////////
    /////////////// METADATA QUERY FUNCTIONS //////////////////
    ///////////////////////////////////////////////////////////
    
    function get_total_categories() {
        $query = $this->db->get('states');
        $result = $query->result();
        $q = count($result);
        
        return $q;
    }

    

}
