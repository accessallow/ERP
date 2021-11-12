<?php

class Block_model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    function insert($district) {
        $this->db->insert("block", $district);
    }

    function edit($id, $district) {
        $this->db->update("block", $district, array('id' => $id));
    }

    function delete($id) {
        $this->db->where('id', $id);
        $this->db->delete("block");
    }

    function get_all_entries() {
        $queryString = "select 
                        b.id,
                        b.block_name,
                        d.district_name,
                        s.state_name,
                        b.state_id,
                        b.district_id
                        from 
                        block b,districts d,states s
                        where
                        b.state_id = s.id and
                        b.district_id = d.id
                        order by
                        s.state_name asc,
                        d.district_name asc,
                        b.block_name asc";
        $query = $this->db->query($queryString);
        return $query->result();
    }

    function get_one_block($id) {
        $query = $this->db->get_where("block", array('id' => $id));
        return $query->result();
    }

    function get_district_name($id) {
        $a = $this->get_one_district($id);
        return $a[0]->state_name;
    }

    ///////////////////////////////////////////////////////////
    /////////////// METADATA QUERY FUNCTIONS //////////////////
    ///////////////////////////////////////////////////////////

    function getDistrictCount() {
        $query = $this->db->get('block');
        $result = $query->result();
        $q = count($result);

        return $q;
    }

}
